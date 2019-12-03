<?
include("../../_config.inc.php");
include("../../_includes/functions.php");
// Variables pour fil d'Ariane
$Page="bottin";
$Section="membres";
$Sous_Section="Bottin des membres";

$id_galerie = ""; // id de la galerie

// Nombre de personnes à afficher par page
$nbPersPage = 300;
// Affiche les membres actif de la table Membre

$sql_Bottin = "SELECT * FROM membre,TypeMembre, compagnie  ". 
				  "WHERE membre.Type = TypeMembre.ID ". 
				  "AND membre.pk_IDMembre = compagnie.IDMembre 
				  AND Actif = 'Oui' ";
				  
				  //echo "-->" .$sql_Bottin;


/*$sql_Bottin = "SELECT * FROM Membre,TypeMembre ".
				  "WHERE Actif = 'Oui' ".
				  "AND Membre.Type = TypeMembre.ID ";*/
				  
				  //echo "-->" .$sql_Bottin;
				  
				  
// Récupère un paramètre lettre passé dans l'url 
if(isset($_GET["lettre"]))
{	
	if($_GET["lettre"] =="A")
		$sql_Bottin .= "AND (nom Between ('A*') And ('F*')) ";
	if($_GET["lettre"] =="F")
		$sql_Bottin .= "AND (nom Between ('F*') And ('K*')) ";
	if($_GET["lettre"] =="K")
		$sql_Bottin .= "AND (nom Between ('K*') And ('P*')) ";
	if($_GET["lettre"] =="P")
		$sql_Bottin .= "AND (nom Between ('P*') And ('U*')) ";
	if($_GET["lettre"] =="U")
		$sql_Bottin .= "AND (nom Between ('U*') And ('Z*') OR nom LIKE 'z%') ";
	
}
$sql_Bottin .= "ORDER BY nom";
$res_Bottin = mysql_query($sql_Bottin,$mycn);

// Function permettant d'afficher le nombre de pages
function PageDuBottin($nbPage)
{
	print "<p class='noPageAlign'>Page(s) : ";
	// Affiche le nombre de page 
	for($i = 1; $i < $nbPage + 1;$i++)
	{	
		$pageActuelle = $i;
		// Lorsque l'utilisateur est sur le numéro de page courant, le numéro de page est mis en gras
		if((isset($_GET["page"]) && $_GET["page"] == $i) ||(!isset($_GET["page"]) && $i == 1))
			$pageActuelle  = "<SPAN class='PageActuelle'>".$i."</SPAN>";
			
		if(isset($_GET["lettre"]))
			print "<a class='lienPage' href='bottin.php?lettre=".$_GET["lettre"]."&page=".$i."'>".$pageActuelle ."</a>";
		else
			print "<a class='lienPage' href='bottin.php?page=".$i."'>".$pageActuelle ."</a>";
	}
	print "</p>\n";
	
}

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
<script LANGUAGE="JavaScript">
<!-- debut du script
// Permet d'ouvrir une fenêtre affichant le site web de la compagnie du membre si celui-ci a une adresse http
function OuvreFenetre(siteComp) 
{

  var Fenetre = window.open(siteComp, "Fenetre1", "scrollbars=1,toolbar=0,menubar=0,width=600,height=400,resizable=1,status=0,scrolling=yes");
}
//  fin du script -->
</script>
</head>
<body>

	<?php require_once ('../../_includes/menu/entete-et-menu-principal.php'); ?>       
    <?php require_once ("../../_includes/menu/SousSections_".$Section.".php"); //SousMenu  ?>
            
    <div class="col-md-8">
        <article class="rt-article rt-round">
    			    
             <h1>Le bottin des membres</h1>			  
						 
            	<?
                include("bottin.inc");
				// Achaque fois qu'un lien est cliqué retour sur la page 1
				//$noPage ="&page=1" ;
				$noPage ="" ;
				
				// Lien passé en paramètre dans l'url de la page permettant de trier les membres par caégorie de lettres
				print "<p class='noPageAlign'>\n<a href='bottin.php?lettre=A".$noPage."'>A-E</a>&nbsp;&nbsp;&nbsp;";
				print "<a href='bottin.php?lettre=F".$noPage."'>F-J</a>&nbsp;&nbsp;&nbsp;";
				print "<a href='bottin.php?lettre=K".$noPage."'>K-O</a>&nbsp;&nbsp;&nbsp;";
				print "<a href='bottin.php?lettre=P".$noPage."'>P-T</a>&nbsp;&nbsp;&nbsp;";
				print "<a href='bottin.php?lettre=U".$noPage."'>U-Z</a>&nbsp;&nbsp;&nbsp;";
				print "<a href='bottin.php?lettre=Tous".$noPage."'>Tous</a>\n</p>\n";
				
				// Récupère le nombre de membre dans le bottin
				$nbPage = mysql_num_rows($res_Bottin);
				if($nbPage != 0)	
				{
					// Arrondi à l'entier supérieur le nombre de page, lorsque le nombre de page est 0 on le change pour 1
					$nbPage = ceil($nbPage / $nbPersPage) == 0 ? 1 : ceil($nbPage / $nbPersPage);
					
					// Valeur maximale de personnes par page
					$valMax = isset($_GET["page"]) ? $nbPersPage * $_GET["page"] :$nbPersPage * 1;
					// Valeur minimale de personnes par page
					$valMin = $valMax - $nbPersPage;
					
					// Fonction affichant le nombre de pages
					//PageDuBottin($nbPage);
					
					print "<table border=0 width=100%>\n";
					
					$cpt = 0;
					// Parcours des membres actifs
					while($rs = mysql_fetch_object($res_Bottin))
					{	
						// Sépare les membres par page selon la valeur voulue (nb perssone par page)
						if($cpt < $valMax && $cpt >= $valMin)
						{
							// L'affichage se fait 2 par ligne
							if($cpt % 2 == 0)
							{
								print "<tr>\n<td>\n";
							
									print "<div class=\"tabBottinMembre\">\n";
									
										if($rs->Photo != "")
											print "<img class='photoMembre' src='../../_uploads/photosMembre/".$rs->Photo."' alt='Photo du membre'>\n";
										else
											print "<img class='photoMembre' src='../../_uploads/photosMembre/nondispo.jpg'>\n";
								
											
										print "<div class='infoMembre'><div class='nomMemBottin'>".$rs->nom." ".$rs->prenom."</div>";
										print "<p>$rs->TypeMembre</p>";
										
										
										$SiteComp = "";
										if(isset($rs->SiteComp)){
											$SiteComp = $rs->SiteComp;
										
										}else{
											$SiteComp = "Inconnu";
										}
										
										$NomComp = "";
										if(isset($rs->NomComp)){
											$NomComp = $rs->NomComp;
										
										}else{
											$NomComp = "Inconnu";
										}
										
										if($SiteComp != "" && $SiteComp != "http://")
											print "<p><a href='#' onclick=\"OuvreFenetre('http://".$SiteComp."')\">".$NomComp."</a></p>";
										else
											print "<p>".$NomComp."</p>";
											
										print "<p>Tél : ".$rs->TelephoneComp."</p>";
										//print "<p>Fax :".$rs->FaxComp."</p>";
									print "</div>";
									
								
								print "</td>";
							}
						    else
							{
								print "<td>";
									print "<div class=\"tabBottinMembre\">";
									
										if($rs->Photo != "")
											print "<img class='photoMembre' src='../../_uploads/photosMembre/".$rs->Photo."' alt='Photo du membre'>";
										else
											print "<img class='photoMembre' src='../../_uploads/photosMembre/nondispo.jpg'>";
														
										print "<div class='infoMembre'><div class='nomMemBottin'>".$rs->nom." ".$rs->prenom."</div>";
										print "<p>$rs->TypeMembre</p>";
										
										$SiteComp = "";
										if(isset($rs->SiteComp)){
											$SiteComp = $rs->SiteComp;
										
										}else{
											$SiteComp = "Inconnu";
										}
										
										$NomComp = "";
										if(isset($rs->NomComp)){
											$NomComp = $rs->NomComp;
										
										}else{
											$NomComp = "Inconnu";
										}
										
										if($SiteComp != "" && $SiteComp != "http://"){
											if($SiteComp == "Inconnu"){
												//print "<p><".$NomComp."</p>";
												print "<p><a href='#'>".$NomComp."</a></p>";
											}else{
												print "<p><a href='#' onclick=\"OuvreFenetre('http://".$SiteComp."')\">".$NomComp."</a></p>";
											}
											
										}else{
											print "<p>".$NomComp."</p>";
										}
											
										print "<p>Tél :".$rs->TelephoneComp."</p>";
										//print "<p>Fax :".$rs->FaxComp."</p>";
										
								
								print "</td>";
								
							}
						}
						$cpt++;
						
					}
					print "</table>";
					print "<br/>";
					
					// Fonction affichant le nombre de pages
					PageDuBottin($nbPage);
					
					// Lien passé en paramètre dans l'url de la page permettant de trier les membres par caégorie de lettres
					print "<p class='noPageAlign'>\n<a href='bottin.php?lettre=A".$noPage."'>A-E</a>&nbsp;&nbsp;&nbsp;";
					print "<a href='bottin.php?lettre=F".$noPage."'>F-J</a>&nbsp;&nbsp;&nbsp;";
					print "<a href='bottin.php?lettre=K".$noPage."'>K-O</a>&nbsp;&nbsp;&nbsp;";
					print "<a href='bottin.php?lettre=P".$noPage."'>P-T</a>&nbsp;&nbsp;&nbsp;";
					print "<a href='bottin.php?lettre=U".$noPage."'>U-Z</a>&nbsp;&nbsp;&nbsp;";
					print "<a href='bottin.php?lettre=Tous".$noPage."'>Tous</a>\n</p>\n";
					print "<br/>\n";
					print "<br/>\n";
					
				}
				else // Sinon Affichage d<un message disant qu<il n'y a aucun membre pour ce choix de lettre
				{
					$nomLettre ="";
					if(isset($_GET["lettre"]))
					{	
						if($_GET["lettre"] =="A")
							$nomLettre ="A-E";
						if($_GET["lettre"] =="F")
							$nomLettre ="F-J";
						if($_GET["lettre"] =="K")
							$nomLettre ="K-O";
						if($_GET["lettre"] =="P")
							$nomLettre ="P-T";
						if($_GET["lettre"] =="U")
							$nomLettre ="U-Z";
						
					}
					if($nomLettre == "")
						print "<p>Il n'y a aucun membre dans le bottin</p>";
					else
						print "<p>Il n'y a aucun membre dont le nom est dans la catégorie : ".$nomLettre."</p>";
					print "<br/>";
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