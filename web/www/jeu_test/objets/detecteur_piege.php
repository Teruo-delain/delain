<?php 
include "../verif_connexion.php";
include '../../includes/template.inc';

$t = new template('..');
$t->set_file('FileRef','../template/delain/general_jeu.tpl');
// chemins
$t->set_var('URL',$type_flux.G_URL);
$t->set_var('URL_IMAGES',G_IMAGES);

$contenu_page = '';

$bd=new base_delain;
$req_matos = "select perobj_obj_cod from perso_objets,objets
												where perobj_obj_cod = obj_cod and perobj_perso_cod = $perso_cod and obj_gobj_cod = 535 ";
$bd->query($req_matos);
if($bd->next_record())
{	
	$baguette = $bd->f("perobj_obj_cod");
	if(isset($_POST['methode']))
	{
			$req_pa = "select perso_pa from perso where perso_cod = $perso_cod";
			$bd->query($req_pa);
			$bd->next_record();
		if ($bd->f("perso_pa") < 4)
		{
				$contenu_page .= "Vous n’avez pas assez de PA !";
		}
		else
		{
				$req_use = "select use_artefact($baguette)";
				$bd->query($req_use);
				$req_enl_pa = "update perso set perso_pa = perso_pa - 4 where perso_cod = $perso_cod";
				$bd->query($req_enl_pa);
				
				$contenu_page .= '<p>Le cadran du détecteur affiche les pièges disposés aux alentours.</p>
			<center><table background="../../images/fond5.gif" border="0" cellspacing="1" cellpadding="0">';

			// POSITION DU JOUEUR
			$req_position = "select pos_x,pos_y,pos_etage
												from perso_position,positions
												where ppos_perso_cod = $perso_cod
												and ppos_pos_cod = pos_cod ";
			$bd->query($req_position);
			$bd->next_record();
			$perso_pos_x = $bd->f("pos_x");
			$perso_pos_y = $bd->f("pos_y");
			$perso_pos_etage = $bd->f("pos_etage");
			//echo "POSJ = $perso_pos_x ; $perso_pos_y ; $perso_pos_etage <br>";
			$piegeArray = array();
			// POSITION DES PIEGES
			$req_piege = "select pos_x,pos_y,pos_etage from positions
															where substring(pos_fonction_arrivee from 1 for 5) = 'piege'
															and pos_etage = $perso_pos_etage";
			$bd->query($req_piege);
			while($bd->next_record())
			{
				//echo "POS=".$bd->f("pos_x").";".$bd->f("pos_y").";".$bd->f("pos_etage")."<br>";
					$key = $bd->f("pos_x")."X".$bd->f("pos_y");
					if(isset($piegeArray[$key]))
					{
						$piegeArray[$key]++;	
					} 
					else 
					{
						$piegeArray[$key] = 1;
					}
			};
			
			for ($i=-8; $i<9; $i++)
			{  
				$contenu_page .= "<tr>";
				for ($j=-8; $j<9; $j++)
				{
					if(($i*$i + $j*$j) <65 )
					{
						$pos_case_x = $perso_pos_x + $j;
						$pos_case_y = $perso_pos_y - $i;
						$key = $pos_case_x."X".$pos_case_y;
						if(isset($piegeArray[$key]))
						{
							$contenu_page .= "<td><img src=\"../../images/automap_1_3.gif\" title=\"Danger, piège en position : X = ".$pos_case_x." / Y = ".$pos_case_y."\"></td>";	
						} 
						else 
						{
							if($i == 0 && $j == 0)
							{
								$contenu_page .= "<td><img src=\"../../images/automap_1_6.gif\" title=\"rien $key\"></td>";
							} 
							else 
							{
								$contenu_page .= "<td><img src=\"../../images/automap_0_0.gif\" title=\"rien $key\"></td>";
							}
						}
						
					} 
					else 
					{
						$contenu_page .= "<td></td>";
					}
				}
				$contenu_page .= "</tr>";
			}
			$contenu_page .= '</table></center>';
		}
	}
	$contenu_page .= '<p align="center">Le détecteur fonctionne. 
		<br>Les voleurs ont pour habitude, n’étant pas très malins, de s’aider d’objets magiques pour détecter les pièges
		<br>Appuyer sur le bouton ?<br><br>
	<form method="post" action="detecteur_piege.php">
		<input type="hidden" name="methode" value="detecter">
		<input type="submit" value="Appuyer (4PA)"  class="test">
	</form>
	</p>';
} 
else 
{
	$contenu_page .= "<p>Accès interdit</p>";	
}

// on va maintenant charger toutes les variables liées au menu
include('../variables_menu.php');

$t->set_var("CONTENU_COLONNE_DROITE",$contenu_page);
$t->parse("Sortie","FileRef");
$t->p("Sortie");