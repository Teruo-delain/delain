<?php 
include "includes/classes.php";
include "ident.php";
//page_open(array("sess" => "My_Session", "auth" => "My_Auth"));
?>
<html>
<link rel="stylesheet" type="text/css" href="../style.css" title="essai">
<head>
</head>
<body background="../images/fond5.gif">
<?php include "jeu_test/tab_haut.php";
echo("<p>Cliquez sur le portrait du perso à supprimer :");
$db = new base_delain;
$req_perso = "select pcompt_perso_cod,perso_nom,to_char(perso_dlt,'DD/MM/YYYY hh24:mi:ss'),perso_pv,perso_pv_max,dlt_passee(perso_cod),perso_pa,perso_race_cod,perso_sex,limite_niveau(perso_cod),limite_niveau_actuel(perso_cod),perso_px,pos_x,pos_y,pos_etage,perso_niveau from perso,perso_compte,perso_position,positions
										where pcompt_compt_cod = $compt_cod
										and pcompt_perso_cod = perso_cod 
										and ppos_perso_cod = perso_cod 
										and ppos_pos_cod = pos_cod 
										order by perso_cod ";
$db->query($req_perso);
	$nb_perso = $db->nf();

	if ($nb_perso == 0)
	{
		echo("<p>Aucun joueur dirigé.");
	}
	else
	{
		echo("<table border=\"0\">");
		echo("<form name=\"login\" method=\"post\" action=\"valide_suppr_perso1.php\">");
		echo("<input type=\"hidden\" name=\"perso\">");
		echo("<input type=\"hidden\" name=\"compt_cod\" value=\"$compt_cod\">");
				
		include "tab_switch.php";
		
		echo("</table>");	
		echo("</form>");
	}
include "jeu_test/tab_bas.php";
?>
</body>
</html>
