<?
include("../../_config.inc.php");
include("../../_includes/functions.php");

$id_galerie = ""; // id de la galerie

// Affiche les informations concernant le numéro de comité (pk) passé en paramètre dans l'URL
$sql_Comite = 	  "SELECT Titre,Comite.*,InterComite.*,Nom,Prenom FROM Comite,InterComite,membre,Fonction ".
				  "WHERE Comite.IDComite = InterComite.IDComite ".
				  "AND InterComite.IDMembre = membre.pk_IDMembre ".
				  "AND InterComite.Fonction = Fonction.IDFonction ".
				  "AND InterComite.IDComite =".$_GET["Comite"].				  
				  " AND InterComite.IDCommission =".$_GET["Commission"]."
				  AND Actif = 'Oui'";

$res_Comite = mysql_query($sql_Comite,$mycn);

// Affiche les informations d'un comité
$sql_ComiteNom ="SELECT * FROM Comite WHERE IDComite =".$_GET["Comite"];
$res_ComiteNom = mysql_query($sql_ComiteNom,$mycn);

$nomComite = mysql_fetch_object($res_ComiteNom);

// Variable pour le fil d'Ariane
$Page="comites";
$Section="membres";
$Sous_Section="Comités";
$Sous_Page = "_InterComite";
$Sous_Section2=$nomComite->NomComite;
?>
<!DOCTYPE html>
<!--[if lte IE 6]> <html lang="fr" class="ie6 oldies"> <![endif]-->
<!--[if lte IE 7]> <html lang="fr" class="ie7 oldies"> <![endif]-->
<!--[if IE 8]> <html lang="fr" class="ie8 oldies">  <![endif]-->
<!--[if IE 9]> <html lang="fr" class="ie9">  <![endif]-->
<!--[if gt IE 9]><!--> <html lang="fr"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <title>Rotary Club de St-Nicolas</title>
    <meta name="keywords" content="Rotary Club de St-Nicolas" />
    <meta name="description" content="Le Club Rotary de St-Nicolas/Chutes-de-la-Chaudière, Québec." />
    <?php require_once ('../../_includes/liens-head.php'); ?>
</head>	
<style type="text/css">
	.nom_membre_comite{
		vertical-align: top; 
		padding-bottom: .5em;
		width: 12em;
	}
	
	.titre_membre_comite{
		vertical-align: top; 
		padding-bottom: .5em;
		line-height: 1.5em; 
		width: 25em;
	}
</style>
</head>
<body>
	<?php require_once ('../../_includes/menu/entete-et-menu-principal.php'); ?>       
	<?php require_once ("../../_includes/menu/SousSections_".$Section.".php"); //SousMenu  ?>
			    
	<div class="col-md-8">
		<article class="rt-article rt-round"> <a href="comites.php" style="float:right;">Retour à la liste des comités</a>
			  <div>
	            <?  
					// Nom du comité
					print "<h3>".$nomComite->NomComite."</h3>";
						
					print "<table width='60%' border=0>";
					if(mysql_num_rows($res_Comite) > 0)
					{	// Parcours des informations du comité et affichage de ses membres et de leurs fonctions
						while($rs = mysql_fetch_object($res_Comite))
						{
							print "<tr><td class='nom_membre_comite'>".$rs->Nom." ".$rs->Prenom."</td>";
							print "<td class='titre_membre_comite'>".$rs->Titre."</td></tr>";
							
						}
					}
					else
						print "<tr><td>Aucun membre pour ce comite</td>";
					
					
					print "</table>"
	            ?>
			</div>
	</article>
</div>
     <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->		
 
<?php require_once ('../../_includes/footer.php'); ?>

</body>
</html>