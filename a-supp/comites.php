<?
include("../../_config.inc.php");
include("../../_includes/functions.php");
// Variables du fil d'Ariane
$Page="comites";
$Section="membres";
$Sous_Section ="Comités";

$id_galerie = ""; // id de la galerie
// Permet d'afficher les commssions ayant des membres  inscrit à leurs comités 
$sql_Commission = "SELECT * FROM Commission
				   WHERE IDComission IN(SELECT IDCommission FROM InterComite WHERE IDMembre IN
				   (SELECT pk_IDMembre FROM membre WHERE Actif = 'Oui')) 
				   ORDER BY NomComm";
$res_Commission = mysql_query($sql_Commission,$mycn)


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
    <h1>Le Comité</h1>
                
            
		
            <?  
                include("comites.inc");
				print "<div>";
				// Vérifie la présence de commissions
				if(mysql_num_rows($res_Commission) > 1)
				{
					// Parcours des commissions ayant des membres participant à leurs comités
					while($row = mysql_fetch_object($res_Commission))
					{
						// Affiche un comité si celui-ci est lié à des membres
						
						//$sql_Comites = "SELECT * FROM Comite, InterComite, Membre 
										//WHERE IDCommission =".$row->IDComission."
									   	//AND InterComite.IDComite = membre.pk_IDMembre 
									   //	AND membre.Actif = 'Oui'";
						
						
						
						
						
						$sql_Comites = "SELECT * FROM Comite WHERE IDCommission =".$row->IDComission." 
										AND IDComite IN(SELECT IDComite FROM InterComite WHERE IDMembre IN(SELECT pk_IDMembre
									     FROM membre WHERE Actif = 'Oui')) 
									    ORDER BY NomComite";
										
										//echo "-->" .$sql_Comites;
										
										
						$res_Comites = mysql_query($sql_Comites,$mycn);
						// Nom de la commission
						print "<h3>".$row->NomComm."</h3>";
						
						// Parcours des comités ayant des membres y participant
						while($rs = mysql_fetch_object($res_Comites))
						{
							print "<p class='Indentation'><a href='_InterComite.php?Commission=".
									$row->IDComission."&Comite=".$rs->IDComite."'>".$rs->NomComite."</a></p>";
						}
						
					}
				
				}
				print "</div>"
				
            ?>
</article>
</div>
        
       <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->		
 
<?php require_once ('../../_includes/footer.php'); ?>

</body>