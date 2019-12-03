<?
// Variable pour le fil d'ariane
$Section = array("11-4","Activités");
$Sous_Section = "Calendrier";
// Redirige sur la même page
$redirect="mmm".urlencode("index.php?section=11-4");
// Recherche le paramètre de la langue
$Langue = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$Langue = strtolower(substr(chop($Langue[0]),0,2));
// Récupère la date passé dans l'URL
if(isset($_GET["date"])){
	$redirect="mmm".urlencode("index.php?section=11-4&date=".$_GET["date"]);
}
// Permet de cacher la liste d'affichage des activités sur le premier chargement de la page
$listeCache = "none";
if(isset($_GET["date"]) || isset($_POST["btnActiviteMois"]) || isset($_POST["mois"]) || isset($_POST["annee"]))
	$listeCache = "block";
 ?>

<div id="contour">
<h2>Calendrier</h2>     
<br />

<table>
<tr>
	<td>
		<?
        include("calendar.php");
        ?>
      
<br /><br />
    	<input style="margin-top:5px;" type="submit" name="btnActiviteMois" class="button" value="Activités du mois" />
		<INPUT style="margin-top:5px;" class=button type="button" value="Ajouter une activité" onClick="location='index.php?section=11-5&date=<?=date("Y-m-d");?>'">
</td>

<td valign="top" style="padding-left:30px;" width="700">

<TABLE  border="0" width="100%">
	<TR class="tetedeliste">
	<Td width="30%">&nbsp;&nbsp;<?
		if ($ordre == "nom")  // Trie par nom d'activité
			print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"nom\";filter();'><B>Activité(s)</B><img src=img/" .$direction[$indice] . ".gif BORDER=0 HSPACE=5 VALIGN=middle></A>";
		else
			print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"nom\";filter();'><B>Activité(s)</B></A>";
	?>
	</Td>	
	<Td width="30%"><?
		if ($ordre == "nomType")  // Trie par type d'activité
			print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"nomType\";filter();'><B>Catégorie</B><img src=img/" .$direction[$indice] . ".gif BORDER=0 HSPACE=5 VALIGN=middle></A>";
		else
			print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"nomType\";filter();'><B>Catégorie</B></A>";
	?></Td>	
	<Td width="25%"><?
		if ($ordre == "datecreation")  // Trie par date de création d'activité
			print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"datecreation\";filter();'><B>Date</B><img src=img/" .$direction[$indice] . ".gif BORDER=0 HSPACE=5 VALIGN=middle></A>";
		else
			print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"datecreation\";filter();'><B>Date</B></A>";
	?></Td>
	
	<Td width="5%">&nbsp;</Td>
	</TR>
<?	

$cpt = 0;
// Lorsqu'une date est passé dans l'url et que le bonton des activité du mois n'a pas été enfoncé
if(isset($_GET["date"]) && $_GET["date"] != "" && !isset($_POST["btnActiviteMois"]) && $afficheDate =="o")
{	// Affichage des activité pour la date cliquée
	$sql_ActiviteCal ="SELECT * FROM _pro_activite_calendrier, _pro_types_activites WHERE datecreation <=".strtotime($_GET["date"]).
					  " AND _pro_activite_calendrier.fk_type_activite = _pro_types_activites.pk_type_activite".
					  " AND datefin >=".strtotime($_GET["date"])." ORDER BY ".$ordre. ' ' . $direction[$indice];
					  
					  //echo "-->" .$sql_ActiviteCal;
					  
					  
	$res_ActiviteCal =mysql_query($sql_ActiviteCal,$mycn);
	
$HTML ="";
while($row = mysql_fetch_object($res_ActiviteCal))
{
		$nomClass = "clsImpair";
		if ($cpt % 2 == 0)
			$nomClass = "clsPair";
	?>
<TR class=<?=$nomClass?>>
		<TD><a href="#" onclick="document.location.href = 'index.php?section=11-5&pk=<?=$row->pk_activite?>&1=1';return false"><?=$row->nom?></a></TD>
		<TD><?=$row->nomType?></TD>
		<TD><?="Du ".date("Y-m-d",$row->datecreation)." au ".date("Y-m-d",$row->datefin);?></TD>
		<TD width=10% align=center><IMG SRC="img/modifier.gif" style="cursor:pointer" Border="0" title="Modifier" onClick="modifier_onclick('11-5','<?=$row->pk_activite?>','&1=1');return false">
			<IMG SRC="img/delete.gif" style="cursor:pointer" Border="0" title="Supprimer" onClick="effacer_onclick('<?=$row->pk_activite?>','activité','<?=addslashes($row->nom)?>','_pro_activite_calendrier','pk_activite','<?=$redirect?>');return false;">	
		</TD>
</TR><?
	$cpt++;
 
}
if ( ! $cpt ){   echo "<TR><TD colspan=5><FONT COLOR=crimson>Aucune activité pour cette date...</FONT></TD></TR>";
echo '<TR><TD colspan=9 class="tetedeliste">&nbsp;</TD></TR>';}
}
// Lorsque le bonton des activités du mois est enfoncé
if((isset($_POST["annee"]) && $_POST["annee"] != "" && !isset($_GET["date"]) ) 
	|| isset($_POST["btnActiviteMois"]) || !isset($_GET["date"]) || $afficheDate =="n")
	
{	// Sélectionne toutes les activités
	$sql_ActiviteCal ="SELECT * FROM _pro_activite_calendrier,_pro_types_activites".
					  " WHERE _pro_activite_calendrier.fk_type_activite = _pro_types_activites.pk_type_activite".
					  " ORDER BY ".$ordre. ' ' . $direction[$indice];
	$res_ActiviteCal =mysql_query($sql_ActiviteCal,$mycn);
	
$HTML ="";
// Parcours les activités
while($row = mysql_fetch_object($res_ActiviteCal))
{	// Extraction des dates de création et de fin
	$dateCreation = date("Y-m",$row->datecreation);
	$dateFin = date("Y-m",$row->datefin);
	// Récupère l'année et le mois des activités (date de début, date de fin)
	$anneeActCrea = substr($dateCreation,0,4);
	$moisActCrea = substr($dateCreation,5,2);
	$anneeActFin = substr($dateFin,0,4);
	$moisActFin = substr($dateFin,5,2);
	
	// année et mois choisit par la liste
	$anneeCourante =  isset($_POST["annee"])?$_POST["annee"]:substr(date("Y-m"),0,4);
	$moisCourant = isset($_POST["mois"])?$_POST["mois"]+1:(int)substr(date("Y-m"),5,2);
	// Lorsque les années et les mois choisient concordent, il y a affichage de l'activité 
	if(($anneeCourante == $anneeActCrea &&  $moisCourant == $moisActCrea) || 
		($anneeCourante == $anneeActFin &&  $moisCourant == $moisActFin))
	
	{
	
		$nomClass = "clsImpair";
		if ($cpt % 2 == 0)
			$nomClass = "clsPair";
	?>
<TR class=<?=$nomClass?>>
		<TD><a href="#" onclick="document.location.href = 'index.php?section=11-5&pk=<?=$row->pk_activite?>&1=1';return false"><?=$row->nom?></a></TD>
		<TD><?=$row->nomType?></TD>
		<TD><?="Du ".date("Y-m-d",$row->datecreation)." au ".date("Y-m-d",$row->datefin);?></TD>
		<TD width=10% align=center><IMG SRC="img/modifier.gif" style="cursor:pointer" Border="0" title="Modifier" onClick="document.location.href = 'index.php?section=11-5&pk=<?=$row->pk_activite?>&1=1';return false">
			<IMG SRC="img/delete.gif" style="cursor:pointer" Border="0" title="Supprimer" onClick="effacer_onclick('<?=$row->pk_activite?>','activité','<?=addslashes($row->nom)?>','_pro_activite_calendrier','pk_activite','<?=$redirect?>');return false;">	
		</TD>
</TR><?
	$cpt++;
    }
}
if ( ! $cpt ){   echo "<TR><TD colspan=5><FONT COLOR=crimson>Aucune activité pour ce mois...</FONT></TD></TR>";
echo '<TR><TD colspan=9 class="tetedeliste">&nbsp;</TD></TR>';}
}


?>

</TABLE>
</td></tr></table>
			
</div>
</form>
<script language="javascript">
function filter()
{	
	document.form_calendar.submit();
}


</script>
<!-- fin du bloc calendrier -->

