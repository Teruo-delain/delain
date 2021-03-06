<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Les souterrains de Delain</title>
		<link rel="shortcut icon" href="{{ URL }}/drake_head_red.ico" type="image/gif">
		<link rel="stylesheet" type="text/css" href="{URL}style.css" title="essai">
		<link rel="stylesheet" type="text/css" href="{URL}style.php">
		<style>
			div#colonne1 {
				float: left;
				width: 175px;
				height : 100%;
				background-image:url({URL_IMAGES}fondparchemin.gif);
				border-color:#800000;
				border-style:solid;
				border-radius: 10px;
				height:auto;
				overflow:auto;
				}
			div#colonne2 {
				border-radius: 10px;
				padding:10px;
				border-color:#800000;
				background-image:url({URL_IMAGES}fondparchemin.gif);
				border-style:solid;
				margin-left: 205px;
				}
		</style>
	</head>
<body style="background-image:url({URL_IMAGES}fond5.gif);">
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1534416-3', 'auto');
  ga('require', 'GTM-M2VTQQW');
  ga('send', 'pageview');

</script>
<div id="colonne1">
	<div id="nom" style="background-color:#800000;color:white;font-weight:bold;text-align:center;padding:3px 0 3px 0;">{PERSO_NOM}</div>
	<div style="text-align:center;padding:5px">
		<div id="intangible" style="padding:2px">{INTANGIBLE}</div>
		<div id="pa" style="padding:2px"><img src="{URL_IMAGES}barrepa_{PERSO_PA}.gif" title="{PERSO_PA} PA " alt="{PERSO_PA} PA "></div>
		<div id="hp" style="padding:0px"><img src="{URL_IMAGES}coeur.gif" alt=""> <img src="{URL_IMAGES}hp{PERSO_BARRE_VIE}.gif" title="{PERSO_PV}/{PERSO_PV_MAX}PV" alt="{PERSO_PV}/{PERSO_PV_MAX}PV"></div>
		<div id="enchanteur" style="padding:0px">{ENCHANTEUR}</div>
		<div id="xp" style="padding:0px"><img src="{URL_IMAGES}iconexp.gif" alt=""> <img src="{URL_IMAGES}xp{PERSO_BARRE_XP}.gif" title="{PERSO_PX} PX, prochain niveau à {PERSO_PROCHAIN_NIVEAU}" alt="{PERSO_PX}/{PERSO_PROCHAIN_NIVEAU} PX"></div>
		<div id="divin" style="padding:0px">{FAM_DIVIN}</div>
		<div id="degats"><img src="{URL_IMAGES}att.gif" title="fourchette de dégats" alt="Att"> <b>{PERSO_DEGATS}</b><img src="{URL_IMAGES}del.gif" height="2" width="16" alt=" "><img src="{URL_IMAGES}def.gif" title="Armure" alt="Def"> <b>{PERSO_ARMURE}</b></div>
		<div id="position"><br>X : <b>{PERSO_POS_X}</b> Y : <b>{PERSO_POS_Y}</b><br><b><a href="{URL_RELATIVE}desc_etage.php"><img alt="" src="/images/iconmap.gif" style="height:12px;border:0px;" />{PERSO_ETAGE}</a></b></div>
		</div>
<div style="padding:10px;">
		<div id="passageniveau">{PASSAGE_NIVEAU}</div>
		<div id="quete">{PERSO_QUETE}</div>
		<div id="lieu">{PERSO_LIEU}</div>
		
		<img src="{URL_IMAGES}ficheperso.gif" alt=""> <a href="{URL_RELATIVE}perso2.php" >Fiche de perso</a><br>
		<img src="{URL_IMAGES}vue.gif" alt=""> <b><a href="{URL_RELATIVE}frame_vue.php">Vue</a></b><br>
		<img src="{URL_IMAGES}evenements.gif" alt=""> <a href="{URL_RELATIVE}evenements.php">Événements</a><br>
		<hr />

		<img src="{URL_IMAGES}inventaire.gif" alt=""> <a href="{URL_RELATIVE}inventaire.php">Inventaire</a><br>
		<div id="ramasser">{RAMASSER}</div>
		<div id="transaction"><img src="{URL_IMAGES}transaction.gif" alt=""> <a href="{URL_RELATIVE}transactions2.php">{TRANSACTIONS}</a></br></div>
		<hr />
		<div id="deplacement">{TEXTE_DEP}</div>
		<img src="{URL_IMAGES}attaquer.gif" alt=""> <b><a href="{URL_RELATIVE}combat.php">Combat !</a></b><br>
		<img src="{URL_IMAGES}magie.gif" alt=""> <b><a href="{URL_RELATIVE}magie.php">Magie !</a></b><br>
		{VOIE_MAGIQUE}
		<hr />
		{FORGE}
		{CREUSER}
		{ENLUMINEUR}
		{POTION}
		{RELIGION}
		{ENSEIGNEMENT}
		<img src="{URL_IMAGES}concentration.gif" alt=""> <a href="{URL_RELATIVE}concentration.php">Concentration</a><br>
		{VOL}
		<hr />
		<div id="messagerie"><img src="{URL_IMAGES}messagerie.gif" alt=""> <a href="{URL_RELATIVE}messagerie2.php">{PERSO_MESSAGERIE}</a></div>
		<img src="{URL_IMAGES}guilde.gif" alt=""/> <a href="{URL_RELATIVE}guilde.php">Guilde</a><br />
		<img src="{URL_IMAGES}guilde.gif"  alt=""/> <a href="{URL_RELATIVE}groupe.php">Coterie</a>
		<hr />
		{CONTROLE}
		{CONTROLE_ADMIN}
		{DROIT_LOGS}
		{GESTION_DROITS}
		{MODIF_PERSO}
		{MODIF_MONSTRE}
		{MODIF_OBJETS}
		{DROIT_CARTE}
		{DROIT_ENCHANTEMENT}
		{DROIT_POTION}
		{QUETE_AUTO}
		{FACTIONS}
		{NEWS}
		{ANIMATIONS}
		{ECHOPPE}
		{GERANT}
		{COMMANDEMENT}
		{OPTION_MONSTRE}
		<img src="{URL_IMAGES}iconeswitch.gif" alt=""> <a href="{URL_RELATIVE}switch.php"><b>Gestion compte</b></a>
		<hr />
		<img src="{URL_IMAGES}forum.gif" alt=""> <a href="http://forum.jdr-delain.net" target="_blank">Forum</a> - <a href="https://forum.jdr-delain.net/app.php/chat/popup" target="_blank">Chat</a> -{WIKI}<br>
		<img src="{URL_IMAGES}deconnection.gif" alt=""> <a href="{URL}" target="_top">Accueil</a><br />
		
		<hr />
		<img src="{URL_IMAGES}deconnection.gif" alt=""> <a href="{URL}logout.php" target="_top">Se déconnecter</a>
	</div>
</div>

<div id="colonne2">
{CONTENU_COLONNE_DROITE}

</div>
</body>
</html>

