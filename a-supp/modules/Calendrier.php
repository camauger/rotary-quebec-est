<?
// Variable pour le fil d'ariane
$Section = array("11-4","Activit�s");
$Sous_Section = "Calendrier";
// Redirige sur la m�me page
$redirect="mmm".urlencode("index.php?section=11-4");
// Recherche le param�tre de la langue
$Langue = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$Langue = strtolower(substr(chop($Langue[0]),0,2));
// R�cup�re la date pass� dans l'URL
if(isset($_GET["date"])){
	$redirect="mmm".urlencode("index.php?section=11-4&date=".$_GET["date"]);
}
// Permet de cacher la liste d'affichage des activit�s sur le premier chargement de la page
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
    	<input style="margin-top:5px;" type="submit" name="btnActiviteMois" class="button" value="Activit�s du mois" />
		<INPUT style="margin-top:5px;" class=button type="button" value="Ajouter une activit�" onClick="location='index.php?section=11-5&date=<?=date("Y-m-d");?>'">
</td>

<td valign="top" style="padding-left:30px;" width="700">

<TABLE  border="0" width="100%">
	<TR class="tetedeliste">
	<Td width="30%">&nbsp;&nbsp;<?
		if ($ordre == "nom")  // Trie par nom d'activit�
			print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"nom\";filter();'><B>Activit�(s)</B><img src=img/" .$direction[$indice] . ".gif BORDER=0 HSPACE=5 VALIGN=middle></A>";
		else
			print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"nom\";filter();'><B>Activit�(s)</B></A>";
	?>
	</Td>	
	<Td width="30%"><?
		if ($ordre == "nomType")  // Trie par type d'activit�
			print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"nomType\";filter();'><B>Cat�gorie</B><img src=img/" .$direction[$indice] . ".gif BORDER=0 HSPACE=5 VALIGN=middle></A>";
		else
			print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"nomType\";filter();'><B>Cat�gorie</B></A>";
	?></Td>	
	<Td width="25%"><?
		if ($ordre == "datecreation")  // Trie par date de cr�ation d'activit�
			print "<A href='#' onclick='document.form_calendar.direction.value=\"" .abs(1-$indice) ."\";document.form_calendar.ordre.value=\"datecreation\";filter();'><B>Date</B><img src=img/" .$direction[$indice] . ".gif BORDER=0 HSPACE=5 VALIGN=middle></A>";
		else
			print "<A href='#' onclick='document.form_calendar.direction.value=\"0\";document.form_calendar.ordre.value=\"datecreation\";filter();'><B>Date</B></A>";
	?></Td>
	
	<Td width="5%">&nbsp;</Td>
	</TR>
<?	

$cpt = 0;
// Lorsqu'une date est pass� dans l'url et que le bonton des activit� du mois n'a pas �t� enfonc�
if(isset($_GET["date"]) && $_GET["date"] != "" && !isset($_POST["btnActiviteMois"]) && $afficheDate =="o")
{	// Affichage des activit� pour la date cliqu�e
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
			<IMG SRC="img/delete.gif" style="cursor:pointer" Border="0" title="Supprimer" onClick="effacer_onclick('<?=$row->pk_activite?>','activit�','<?=addslashes($row->nom)?>','_pro_activite_calendrier','pk_activite','<?=$redirect?>');return false;">	
		</TD>
</TR><?
	$cpt++;
 
}
if ( ! $cpt ){   echo "<TR><TD colspan=5><FONT COLOR=crimson>Aucune activit� pour cette date...</FONT></TD></TR>";
echo '<TR><TD colspan=9 class="tetedeliste">&nbsp;</TD></TR>';}
}
// Lorsque le bonton des activit�s du mois est enfonc�
if((isset($_POST["annee"]) && $_POST["annee"] != "" && !isset($_GET["date"]) ) 
	|| isset($_POST["btnActiviteMois"]) || !isset($_GET["date"]) || $afficheDate =="n")
	
{	// S�lectionne toutes les activit�s
	$sql_ActiviteCal ="SELECT * FROM _pro_activite_calendrier,_pro_types_activites".
					  " WHERE _pro_activite_calendrier.fk_type_activite = _pro_types_activites.pk_type_activite".
					  " ORDER BY ".$ordre. ' ' . $direction[$indice];
	$res_ActiviteCal =mysql_query($sql_ActiviteCal,$mycn);
	
$HTML ="";
// Parcours les activit�s
while($row = mysql_fetch_object($res_ActiviteCal))
{	// Extraction des dates de cr�ation et de fin
	$dateCreation = date("Y-m",$row->datecreation);
	$dateFin = date("Y-m",$row->datefin);
	// R�cup�re l'ann�e et le mois des activit�s (date de d�but, date de fin)
	$anneeActCrea = substr($dateCreation,0,4);
	$moisActCrea = substr($dateCreation,5,2);
	$anneeActFin = substr($dateFin,0,4);
	$moisActFin = substr($dateFin,5,2);
	
	// ann�e et mois choisit par la liste
	$anneeCourante =  isset($_POST["annee"])?$_POST["annee"]:substr(date("Y-m"),0,4);
	$moisCourant = isset($_POST["mois"])?$_POST["mois"]+1:(int)substr(date("Y-m"),5,2);
	// Lorsque les ann�es et les mois choisient concordent, il y a affichage de l'activit� 
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
			<IMG SRC="img/delete.gif" style="cursor:pointer" Border="0" title="Supprimer" onClick="effacer_onclick('<?=$row->pk_activite?>','activit�','<?=addslashes($row->nom)?>','_pro_activite_calendrier','pk_activite','<?=$redirect?>');return false;">	
		</TD>
</TR><?
	$cpt++;
    }
}
if ( ! $cpt ){   echo "<TR><TD colspan=5><FONT COLOR=crimson>Aucune activit� pour ce mois...</FONT></TD></TR>";
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

