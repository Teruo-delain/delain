<?php 
include_once "verif_connexion.php";
include '../includes/template.inc';
$t = new template;
$t->set_file('FileRef','../template/delain/general_jeu.tpl');
// chemins
$t->set_var('URL',$type_flux.G_URL);
$t->set_var('URL_IMAGES',G_IMAGES);
// on va maintenant charger toutes les variables liées au menu
include('variables_menu.php');

//
//Contenu de la div de droite
//
$contenu_page = '';
ob_start();
  if(isset($_POST['methode'])){
      switch ($methode) {
       case "valide_modif":
          //echo "modification de la description";
          $db = new base_delain;
          $req_guilde = "select pguilde_rang_cod,rguilde_admin from guilde_perso,guilde_rang
															where pguilde_perso_cod = $perso_cod
															and pguilde_guilde_cod = rguilde_guilde_cod
															and pguilde_guilde_cod = $num_guilde
															and pguilde_rang_cod = rguilde_rang_cod
															and pguilde_valide = 'O' ";
					$db->query($req_guilde);
					$db->next_record();
					$admin = $db->f("rguilde_admin");
          if ($admin == 'O')
					{ 
		          if(!isset($_POST['noBR']) or ($noBR != "true"))
			          {
			            $desc = nl2br($desc);
			          }
		          $desc = str_replace(";",chr(127),$desc);
		          $desc = pg_escape_string($desc);
		          $req_modif = "update guilde set guilde_description = e'$desc' where guilde_cod = $num_guilde ";
		          $db->query($req_modif);
		          echo "<p><b>La description de la guilde a été modifiée.</b></p>";
        	}
        	else
        	{
        			echo "<p><b>Vous n'êtes pas administrateur de cette guilde ! Vous ne pouvez pas modifier la description de cette guilde</b></p>";
        	}
       break;
      }
  }
$req_desc = "select pguilde_guilde_cod,guilde_nom,guilde_description from guilde_perso,guilde where pguilde_perso_cod = $perso_cod and pguilde_guilde_cod = guilde_cod ";
$db->query($req_desc);
$db->next_record();
$num_guilde = $db->f("pguilde_guilde_cod");
?>
<form name="modif_guilde" method="post" action="modif_guilde.php">
<input type="hidden" name="methode" value="valide_modif">
<input type="hidden" name="num_guilde" value="<?php  echo $num_guilde; ?>">
<table>
<tr>
<td class="soustitre2"><p>Nom de la guilde : </td>
<td class="soustitre2"><p><?php  echo $db->f("guilde_nom");?></td>
</tr>
<?php 
$description = $db->f("guilde_description");
$desc = str_replace("<br />","",$db->f("guilde_description"));
?>
<tr>
<td class="soustitre2"><p>Description : </td>
<td><p><textarea name="desc" cols="100" rows="20"><?php  echo str_replace(chr(127),";",$desc); ?></textarea></td>
</tr>

<tr><td colspan="2"><center>Si votre description est rédigée en html et que vous ne voulez pas que les balises &lt;br&gt;
s'ajoutent automatiquement à la fin de chaque ligne cochez cette case:<input type="checkbox" class="test" name="noBR" value="true"></center></td></tr>
<tr><td colspan="2"><center><input type="submit" class="test" value="Valider les changements"></center></td></tr>
</table>
</form>

<HR>
<p> DESCRIPTION ACTUELLE:</p>

<?php 

echo '<table width="100%"><tr><td class="titre"><p class="titre">' ,$db->f("guilde_nom") , '</td></tr></table>';
echo  "<p>" . str_replace(chr(127),";",$description) ."</p>";

$close=pg_close($dbconnect);
$contenu_page = ob_get_contents();
ob_end_clean();
$t->set_var("CONTENU_COLONNE_DROITE",$contenu_page);
$t->parse('Sortie','FileRef');
$t->p('Sortie');
?>
