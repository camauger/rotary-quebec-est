<?php 	// Affiche les honneurs ayant des membre associés à ceux-ci
global  $mycn;  
$sql_Honneur = "SELECT * FROM TypeMerite ". 
				"WHERE IDTypeMerite IN(SELECT IDTypeMerite 
									   FROM Merite WHERE IDMembre IN(SELECT pk_IDMembre
																     FROM membre WHERE Actif = 'Oui')) ". 
				"ORDER BY TypeMerite";
				
				//echo "-->" .$sql_Honneur;
				
$res_Honneur = mysql_query($sql_Honneur,$mycn);

// Affiche les membres faisant partie du conseil d'administration
$sql_Admin = "SELECT InterComite.*,Comite.*,nom,prenom,Fonction.* FROM membre, InterComite,Comite,Fonction ".
		     "WHERE membre.pk_IDMembre = InterComite.IDMembre ". 
			 "AND InterComite.IDComite = Comite.IDComite ". 
			 "AND InterComite.Fonction = Fonction.IDFonction ". 
			 "AND InterComite.IDComite =".$consAdmin."  
			  ORDER BY IDFonction";
			 
			 //echo "-->" .$sql_Admin;
			 
$res_Admin = mysql_query($sql_Admin,$mycn);

// Affiche le nom du comité du conseil d'administration
$res_NomConseil = mysql_query("SELECT NomComite FROM Comite WHERE IDComite =".$consAdmin,$mycn);

$resultatNom = mysql_fetch_object($res_NomConseil);
$nom = isset($resultatNom->NomComite) ? $resultatNom->NomComite : "Conseil d'administration";  // Nom du comité
?>


//print "<div id='HonneurGauche'>\n";
				print"<table border=0 width=100% border=0>\n\t<tr valign=top>\n\t\t<td>";
				
				print "<h4 style='color:#1D387D'>Les membres d'honneur</h4>\n";
				
				$cptHonneur = 0;
				
				?>
                <table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>

</td>

<TD width=6%>&nbsp;&nbsp;&nbsp;</TD>

<?
				
				// Parcours des honneurs dans la table Merite
				while($row = mysql_fetch_object($res_Honneur))
				{
						print "<table border=0 cellspacing=0 cellpadding=0 width=100%>";
						
				
					// Affiche les membres selon l'honneur parcouru
					$sql_MembreHonore ="SELECT nom,prenom,Merite.* FROM membre,Merite ".
										"WHERE membre.pk_IDMembre = Merite.IDMembre ".
										"AND IDTypeMerite =".$row->IDTypeMerite.
										" AND Actif = 'Oui'";
										
										//echo "-->" .$sql_MembreHonore;
										
										
					$res_MembreHonneur = mysql_query($sql_MembreHonore,$mycn);
					print "<tr><td width=40%><strong>".$row->TypeMerite."</strong></td>\n</tr>\n";
			
					$cpt = 0;
					
					$nbPersHonore = mysql_num_rows($res_MembreHonneur);
					// Vérifie pour chaque Honneur s'il y a des membres associés 
					while($rs = mysql_fetch_object($res_MembreHonneur))
					{
						if ($cpt % 2 == 0)
							print "<tr><td width=40%>- ".$rs->nom." ".$rs->prenom."</td>\n";
						else
							print "<td width=40%>- ".$rs->nom." ".$rs->prenom."</td>\n</tr>\n";
						
						$cpt++;
						
					}
					if($nbPersHonore % 2 != 0)
						print "</tr>";
					$cptHonneur++;
					
					print "</table>\n";
					print "<br/>\n";
					
				}
				if(	$cptHonneur==0)
			      echo"<p>À venir...</p>";
				  
				print "</td>\n<td>\n";
				//print "<div id='HonneurDroite'>\n";
				print "<table align=center border=0 cellspacing=0 cellpadding=0>\n";
				print "<tr>\n<td><H4 style='color:#1D387D; margin-bottom:1.5em;'>".$nom."</H4></td>\n</tr>\n";
				$cpt = 0;
				
				
				// Parcours er affiche les personnes faisant partie du consil d'administration
				while($rs = mysql_fetch_object($res_Admin))
				{
					if($cpt % 2 == 0)
						print "<tr class='impair'><td>".$rs->nom." ".$rs->prenom."</td>\n<td>".$rs->Titre."</td>\n</tr>\n";
					else
						print "<tr><td>".$rs->nom." ".$rs->prenom."</td>\n<td>".$rs->Titre."</td>\n</tr>\n";
					
					$cpt++;
				}
				
				
				print "</table>\n";
				print "</td>\n";
				
            ?>
				</tr>
				</table>