<?php 
/*
 * Catédrale : temple avancé
 * (inclus dans dtemple.php)
 */
$param = new parametres();
/* Seul les fidèles du dieu peuvent se rendre à l'intérieur (map réservée) */
$req = '	SELECT dper_dieu_cod FROM dieu_perso WHERE dper_perso_cod = '. $perso_cod;
$db->query($req);
if ($db->nf() != 0) {
	$db->next_record();
	$dieu_perso = $db->f('dper_dieu_cod');
}
$req = '	SELECT dieu_cod, dieu_nom FROM dieu, lieu WHERE lieu_cod='. $tab_lieu['lieu_cod'] .' AND lieu_dieu_cod=dieu_cod ';
$db->query($req);
$db->next_record();
$dieu_cod = $db->f('dieu_cod');
$dieu_nom = $db->f('dieu_nom');

if (!$db->is_lieu($perso_cod))
	echo '<p>Erreur : vous n\'êtes pas sur un lieu !</p>';
elseif ($tab_lieu['type_lieu'] != 17) 
	echo '<p>Erreur : vous n\'êtes pas devant la cathédrale !</p>';
elseif ($perso_fam == false) { // Soit un perso, soit un monstre (pour les admin), mais pas un familier.
	if ($dieu_perso != $dieu_cod)
		echo '<p>N\'étant pas fidèle de ce dieu, vous ne pouvez entrer dans la cathédrale.</p>';
	else
		echo '<p>'.$dieu_nom.' a confiance en vous, il vous autorise à <a href="action.php?methode=passage">entrer dans la cathédrale ('.$param->getparm(13).' PA)</a>.</p>';
}