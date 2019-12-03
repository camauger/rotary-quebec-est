<?
include("../../_config.inc.php");
include("../../_includes/functions.php");
$Page="_bulletins";
$Section="club";
$Sous_Section="Nouvelles";
$Sous_Page = "_bulletinChoix";

//Info pour fil d'ariane
$rs_NouvChoix = RechercherNouvelle();
$Sous_Section2=$rs_NouvChoix->titre;
$id_galerie = ""; // id de la galerie
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
<body>
<?php require_once ('../../_includes/menu/entete-et-menu-principal.php'); ?>       
<?php require_once ("../../_includes/menu/SousSections_".$Section.".php"); //SousMenu  ?>
			    
<div class="col-md-8">
	<article class="rt-article rt-round">
	<h1>Nouvelles</h1>
	<a href="_bulletins.php" style="float:right;">Retour aux nouvelles</a>
            <?
	            //Infos pour afficher la nouvelle 		
				$row_nouvelle=RechercherNouvelle();	
				
				//On affiche le titre et le contenu
                if (isset($_GET["pk_nouvelle"]))
				{
					 # echo ' <div class="titre_page"><h1>Notre Club</h1><h2>Nouvelles</h2></div>';
					 
					  echo '<h3 style="margin-top:1em;">'.$row_nouvelle->titre.'</h3>';
					  echo "".stripslashes($row_nouvelle->texte)."";
					  echo '</div>';

				}
				
				//Méthode qui contruit la requête pour chercher les informariosn pour la nouvelle choisie
				function RechercherNouvelle()
				{
					global $mycn;
						$sqlNouvelles= "SELECT titre, texte, datecreation 
							FROM _pro_nouvelles, _pro_nouvelles_langues
							WHERE _pro_nouvelles.pk_nouvelle=  _pro_nouvelles_langues.fk_nouvelle
							AND  _pro_nouvelles_langues.fk_langue=1
							AND   _pro_nouvelles.pk_nouvelle=".$_GET["pk_nouvelle"]."
							ORDER BY datecreation";
						$res_nouvelles = mysql_query($sqlNouvelles,$mycn) or die(msql_error());
						$row_nouvelle=mysql_fetch_object($res_nouvelles);	
						return $row_nouvelle;

				}
            ?>
	</article>
</div>
        
       <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->		
 
<?php require_once ('../../_includes/footer.php'); ?>

</body>
</html>
<?mysql_close($mycn);?>