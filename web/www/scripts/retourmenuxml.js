function request(callback)
{
    var xhr;
    try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
    catch (e)
    {
        try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
        catch (e2)
        {
          try {  xhr = new XMLHttpRequest();     }
          catch (e3) {  xhr = false;   }
        }
     }

    xhr.onreadystatechange  = function()
    {
         if(xhr.readyState  == 4)
         {
              if(xhr.status  == 200)
              {
               	var tab = callback(xhr.responseXML);
               	parent.gauche.document.getElementById("nom").innerHTML = tab['nom'];
               	parent.gauche.document.getElementById("pa").innerHTML = '<img src="http://images.jdr-delain.net/barrepa_' + tab['pa'] + '.gif" title="' +  tab['pa'] + ' PA " alt="' +  tab['pa'] + ' PA ">';
               	parent.gauche.document.getElementById("hp").innerHTML = '<img src="http://images.jdr-delain.net/coeur.gif" alt=""> <img src="http://images.jdr-delain.net/hp' + tab['barre_hp'] + '.gif" title="' + tab['pv'] + '/' + tab['pv_max'] + 'PV" alt="' + tab['pv'] + '/' + tab['pv_max'] + 'PV"><br><br>';
               	parent.gauche.document.getElementById("xp").innerHTML = '<img src="http://images.jdr-delain.net/iconexp.gif" alt="">  <img src="http://images.jdr-delain.net/xp' + tab['barre_xp'] + '.gif" title="' + tab['perso_px'] + ' PX, prochain niveau à ' + tab['prochain_niveau'] + '" alt="' + tab['perso_px'] + '/' + tab['prochain_niveau'] + ' PX"><br><br>';
               	parent.gauche.document.getElementById("degats").innerHTML = '<img src="http://images.jdr-delain.net/att.gif" title="fourchette de dégats" alt="Att"> <b>' + tab['degats'] + '</b><img src="http://images.jdr-delain.net/del.gif" height="8" width="16" alt=" "><img src="http://images.jdr-delain.net/def.gif" title="Armure" alt="Def"> <b>' + tab['armure'] + '</b>';
               	parent.gauche.document.getElementById("position").innerHTML = '<span style="line-height:100%;"><br>X : <b>'+ tab['posx'] +'</b> Y : <b>' + tab['posy']  + '</b><br><b><a href="desc_etage.php" target="droite"><img alt="" src="http://images.jdr-delain.net/iconmap.gif" style="height:12px;border:0px;">' + tab['etage']  + '</a></b><br><br></span>';

						//messagerie
               	var texte_mess = '<p class="texteMenu"><img src="http://images.jdr-delain.net/messagerie.gif" alt=""> <a href="messagerie2.php" target="droite">';
               	if(tab['nb_mess'] != 0)
               		texte_mess += '<b>';
               	texte_mess += 'Messagerie';
               	if(tab['nb_mess'] != 0)
               		texte_mess += ' (' + tab['nb_mess'] + ')</b>';
               	texte_mess += '</a></p>';
               	parent.gauche.document.getElementById("messagerie").innerHTML = texte_mess;

               	//déplacement
               	var texte_dep = '';
               	if(tab['is_fam'] != 1)
               	{
               		if(tab['lock'] == 0)
               		{
               			// dep normal
               			texte_dep += '<img src="http://images.jdr-delain.net/deplacement.gif" alt=""> <a href="deplacement.php" target="droite">D&eacute;placement (' + tab['pa_dep'] + ' PA)</a><br></p';
               		}
               		else
               		{
               			//fuite
               			texte_dep += '<img src="http://images.jdr-delain.net/fuite.gif" alt=""> <a href="deplacement.php" target="droite">Fuite (' + tab['pa_dep'] + ' PA)</a><br></p';
               		}
               	}
               	parent.gauche.document.getElementById("deplacement").innerHTML = texte_dep;

               	if(tab['objet_case'] != 0)
               		parent.gauche.document.getElementById("ramasser").innerHTML = '<p class="texteMenu"><img  src="http://images.jdr-delain.net/ramasser.gif" alt=""> <a href="ramasser.php" target="droite">Ramasser (' + tab['pa_ramasse'] + 'PA)</a></p>';
               	else
               		parent.gauche.document.getElementById("ramasser").innerHTML = '';

               	if(tab['intangible'] == 1)
               		parent.gauche.document.getElementById("intangible").innerHTML = '<i>Perso impalpable !</i><br><br>';
               	else
               		parent.gauche.document.getElementById("intangible").innerHTML = '';

						if(tab['enchanteur'] == 1)
							parent.gauche.document.getElementById("enchanteur").innerHTML =  '<img src="http://images.jdr-delain.net/energi10.png" alt="" /> <img src="http://images.jdr-delain.net/nrj' + tab['barre_energie'] + '.png" title="' + tab['perso_energie'] + '/100 énergie" alt="' + tab['perso_energie'] + '/100 énergie" /><br><br>';
						else
							parent.gauche.document.getElementById("enchanteur").innerHTML = '';

						if(tab['is_fam_divin'] == 1)
							parent.gauche.document.getElementById("divin").innerHTML =  '<img src="http://images.jdr-delain.net/magie.gif" alt=""> <img src="http://images.jdr-delain.net/nrj' + tab['barre_divine'] + '.png" title="Énergie divine : ' + tab['energie_divine'] + '" alt="Énergie divine : ' + tab['energie_divine'] + '"><br><br>';
						else
							parent.gauche.document.getElementById("divin").innerHTML = '';

						if(tab['passage_niveau'] == 1)
							parent.gauche.document.getElementById("passageniveau").innerHTML = '<p class="texteMenu"><a href="niveau.php" target="droite"><b>Passer au niveau supérieur ! </b>(6 PA)</a><br></p>';
						else
							parent.gauche.document.getElementById("passageniveau").innerHTML = '';

						if(tab['quete'] == 1)
							parent.gauche.document.getElementById("quete").innerHTML = '<p class="texteMenu"><a href="quete_perso.php" target="droite"><b>Quête</b></a></p>';
						else
							parent.gauche.document.getElementById("quete").innerHTML = '';

						if(tab['lieu'] == 1)
							parent.gauche.document.getElementById("lieu").innerHTML = '<p class="texteMenu"><a href="lieu.php" target="droite"><b>' + tab['nom_lieu'] + '</b><br>(' + tab['desc_lieu'] + ')</a></p>';
						else
							parent.gauche.document.getElementById("lieu").innerHTML = '';

						if(tab['transaction'] == 0)
							parent.gauche.document.getElementById("transaction").innerHTML = '<img src=\"http://images.jdr-delain.net/transaction.gif\" alt=""> <a href=\"transactions2.php\" target=\"droite\">Transactions</a>';
						else
							parent.gauche.document.getElementById("transaction").innerHTML = '<img src=\"http://images.jdr-delain.net/transaction.gif\" alt=""> <a href=\"transactions2.php\" target=\"droite\"><b> Transactions (' + tab['transaction']  + ')</a></b>';
               }
              else
                 parent.gauche.document.getElementById("nom").innerHTML = '<a href="javascript:request(readData);"><img src="http://images.jdr-delain.net/refresh.png" border="0" alt="Rafraîchir"> Rafraichir</a>';
         }
    };

   xhr.open( "GET", parent.location.protocol + "//www.jdr-delain.net/api/menu.php",  true);
   xhr.send(null);
}
function readData(oData) {
	var tab = new Array;

	var nodes = oData.getElementsByTagName("nom");
	cn = nodes[0].getAttribute("valeur");
	tab['nom'] = cn;
	var nodes = oData.getElementsByTagName("pa");
	cn = nodes[0].getAttribute("valeur");
	tab['pa'] = cn;

	var nodes = oData.getElementsByTagName("is_fam");
	cn = nodes[0].getAttribute("valeur");
	tab['is_fam'] = cn;

	var nodes = oData.getElementsByTagName("barre_hp");
	cn = nodes[0].getAttribute("valeur");
	tab['barre_hp'] = cn;

	var nodes = oData.getElementsByTagName("pv");
	cn = nodes[0].getAttribute("valeur");
	tab['pv'] = cn;

	var nodes = oData.getElementsByTagName("pv_max");
	cn = nodes[0].getAttribute("valeur");
	tab['pv_max'] = cn;

	var nodes = oData.getElementsByTagName("intangible");
	cn = nodes[0].getAttribute("valeur");
	tab['intangible'] = cn;

	var nodes = oData.getElementsByTagName("barre_xp");
	cn = nodes[0].getAttribute("valeur");
	tab['barre_xp'] = cn;

	var nodes = oData.getElementsByTagName("perso_px");
	cn = nodes[0].getAttribute("valeur");
	tab['perso_px'] = cn;

	var nodes = oData.getElementsByTagName("prochain_niveau");
	cn = nodes[0].getAttribute("valeur");
	tab['prochain_niveau'] = cn;

	var nodes = oData.getElementsByTagName("armure");
	cn = nodes[0].getAttribute("valeur");
	tab['armure'] = cn;

	var nodes = oData.getElementsByTagName("degats");
	cn = nodes[0].getAttribute("valeur");
	tab['degats'] = cn;

	var nodes = oData.getElementsByTagName("etage");
	cn = nodes[0].getAttribute("valeur");
	tab['etage'] = cn;

	var nodes = oData.getElementsByTagName("posx");
	cn = nodes[0].getAttribute("valeur");
	tab['posx'] = cn;

	var nodes = oData.getElementsByTagName("posy");
	cn = nodes[0].getAttribute("valeur");
	tab['posy'] = cn;

	var nodes = oData.getElementsByTagName("passage_niveau");
	cn = nodes[0].getAttribute("valeur");
	tab['passage_niveau'] = cn;

	var nodes = oData.getElementsByTagName("enchanteur");
	cn = nodes[0].getAttribute("valeur");
	tab['enchanteur'] = cn;

	var nodes = oData.getElementsByTagName("barre_energie");
	cn = nodes[0].getAttribute("valeur");
	tab['barre_energie'] = cn;

	var nodes = oData.getElementsByTagName("perso_energie");
	cn = nodes[0].getAttribute("valeur");
	tab['perso_energie'] = cn;

	var nodes = oData.getElementsByTagName("quete");
	cn = nodes[0].getAttribute("valeur");
	tab['quete'] = cn;

	var nodes = oData.getElementsByTagName("lieu");
	cn = nodes[0].getAttribute("valeur");
	tab['lieu'] = cn;

	var nodes = oData.getElementsByTagName("nom_lieu");
	cn = nodes[0].getAttribute("valeur");
	tab['nom_lieu'] = cn;

	var nodes = oData.getElementsByTagName("desc_lieu");
	cn = nodes[0].getAttribute("valeur");
	tab['desc_lieu'] = cn;

	var nodes = oData.getElementsByTagName("nb_mess");
	cn = nodes[0].getAttribute("valeur");
	tab['nb_mess'] = cn;

	var nodes = oData.getElementsByTagName("lock");
	cn = nodes[0].getAttribute("valeur");
	tab['lock'] = cn;

	var nodes = oData.getElementsByTagName("pa_dep");
	cn = nodes[0].getAttribute("valeur");
	tab['pa_dep'] = cn;

	var nodes = oData.getElementsByTagName("pa_ramasse");
	cn = nodes[0].getAttribute("valeur");
	tab['pa_ramasse'] = cn;

	var nodes = oData.getElementsByTagName("objet_case");
	cn = nodes[0].getAttribute("valeur");
	tab['objet_case'] = cn;

	var nodes = oData.getElementsByTagName("transaction");
	cn = nodes[0].getAttribute("valeur");
	tab['transaction'] = cn;

	var nodes = oData.getElementsByTagName("is_fam_divin");
	cn = nodes[0].getAttribute("valeur");
	tab['is_fam_divin'] = cn;

	var nodes = oData.getElementsByTagName("energie_divine");
	cn = nodes[0].getAttribute("valeur");
	tab['energie_divine'] = cn;

	var nodes = oData.getElementsByTagName("barre_divine");
	cn = nodes[0].getAttribute("valeur");
	tab['barre_divine'] = cn;

	return tab;
}
