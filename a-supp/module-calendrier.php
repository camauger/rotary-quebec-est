 
   <?php global $mycn; ?>
 	

				<input class="button" type="submit" name="btnActiviteMois" value="Activités du mois" />			
				<table width=60% cellspacing="0" cellpadding="6"  >	
							<tr>
								<td width="40%">
								<? 
									if ($ordre == "nom")  // Affiche les activités par nom
										print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"nom\";filter();'><B>Activité(s)</B></A>";
									else
										print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"nom\";filter();'><B>Activité(s)</B></A>";
								?>
								</td>	
								<td width="20%">
								<?
									if ($ordre == "nomType")  // Affiche les activités par type
										print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"nomType\";filter();'><B>Catégorie</B></A>";
									else
										print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"nomType\";filter();'><B>Catégorie</B></A>";
								?>
								</td>	
								<td width="20%">
								<?  // Affiche les activités par date de création
									if ($ordre == "datecreation")
										print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"datecreation\";filter();'><B>Début</B></A>";
									else
										print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"datecreation\";filter();'><B>Début</B></A>";
								?>
								</td>
								<td width="20%">
								<?  // Affiche les activités par date de fin
									if ($ordre == "datefin")
										print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"datefin\";filter();'><B>Fin</B></A>";
									else
										print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"datefin\";filter();'><B>Fin</B></A>";
								?>
								</td>
						
							</tr>
							<?	
					
							$cpt = 0;  
							// Lorsqu'une date dans le calendrier est sélectionnée
							if(isset($_GET["date"]) && $_GET["date"] != "" && !isset($_POST["btnActiviteMois"]) && $afficheDate =="o") //&&
								//!isset($_POST["annee"]) && !isset($_POST["mois"]))
							{
									
								$sql_ActiviteCal ="SELECT * FROM _pro_activite_calendrier, _pro_types_activites WHERE datecreation <=".strtotime($_GET["date"]).
												  " AND _pro_activite_calendrier.fk_type_activite = _pro_types_activites.pk_type_activite".
												  " AND datefin >=".strtotime($_GET["date"])." ORDER BY ".$ordre. ' ' . $direction[$indice]; 
								$res_ActiviteCal =mysql_query($sql_ActiviteCal,$mycn);
								
							$HTML ="";
							// Affiche les activités prévues pour cette date
							while($row = mysql_fetch_object($res_ActiviteCal))
							{
								$nomClass = "pair";
									if ($cpt % 2 == 0)
										$nomClass = "impair";
							?>
							<tr class="<?=$nomClass?>">
									<td><a href="_calendrierActivite.php?pk=<?=$row->pk_activite;?>"><?=$row->nom?></a></td>
									<td><?=$row->nomType?></td>
									<td><?=date("Y-m-d",$row->datecreation);?></td>
									<td><?=date("Y-m-d",$row->datefin);?></td>
									
							</tr>
							
							<?
									$cpt++;
								 
								}
								if ( ! $cpt ){   echo "<tr><td colspan=5><FONT COLOR=crimson>Aucune activité pour cette date...</FONT></td></tr>";
								echo '<tr><td colspan=9 class="tetedeliste">&nbsp;</td></tr>';}
								}
							
								// Lorsque l'on veut afficher les activités du mois
								if((isset($_POST["annee"]) && $_POST["annee"] != "" && !isset($_GET["date"]) ) 
									|| isset($_POST["btnActiviteMois"]) || !isset($_GET["date"]) || $afficheDate =="n")
										
								{

									$sql_ActiviteCal ="SELECT * FROM _pro_activite_calendrier,_pro_types_activites".
													  " WHERE _pro_activite_calendrier.fk_type_activite = _pro_types_activites.pk_type_activite".
													  " ORDER BY ".$ordre. ' ' . $direction[$indice];
									$res_ActiviteCal =mysql_query($sql_ActiviteCal,$mycn);
									
								$HTML ="";
							
								while($row = mysql_fetch_object($res_ActiviteCal))
								{
									$dateCreation = date("Y-m",$row->datecreation);
									$dateFin = date("Y-m",$row->datefin);
									// Déconcatène l'année et le mois de la chaîne de la date de création et de la date de fin à partir de la requête des activités
									$anneeActCrea = substr($dateCreation,0,4);
									$moisActCrea = substr($dateCreation,5,2);
									$anneeActFin = substr($dateFin,0,4);
									$moisActFin = substr($dateFin,5,2);
									
									// Année et mois couramment sélectionné
									$anneeCourante =  isset($_POST["annee"])?$_POST["annee"]:substr(date("Y-m"),0,4);
									$moisCourant = isset($_POST["mois"])?$_POST["mois"]+1:(int)date("m");
									$moisCourant = strlen($moisCourant)==1?"0".$moisCourant:$moisCourant;
									
									// Lorsque les années et les mois correspondent à l'année et au mois sélectionné par l'utilisateur, l'activité est affichée
									if(($anneeCourante == $anneeActCrea &&  $moisCourant == $moisActCrea) || 
										($anneeCourante == $anneeActFin &&  $moisCourant == $moisActFin))
									
									{
									
										$nomClass = "pair";
										if ($cpt % 2 == 0)
											$nomClass = "impair";
														?>
							<tr class="<?=$nomClass?>">
									<td><a  href="_calendrierActivite.php?pk=<?=$row->pk_activite;?>"><?=$row->nom?></a></td>
									<td><?=$row->nomType?></td>
									<td><?=date("Y-m-d",$row->datecreation);?></td>
									<td><?=date("Y-m-d",$row->datefin);?></td>
							</tr>
							
							<?
								$cpt++;
								}
							}
							if ( ! $cpt ){   echo "<tr><td colspan=5><FONT COLOR=crimson>Aucune activité pour ce mois...</FONT></td></tr>";
							echo '<tr><td colspan=9 class="tetedeliste">&nbsp;</td></tr>';}
							}
						
						
							?>

					</table>