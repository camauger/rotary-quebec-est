<?

$lang=$Langue;
// Lien vers la feuille de style
echo "<link href='../calendar.css' rel='stylesheet' media='screen' type='text/css' />";

echo "<script language=\"javascript\">\n";
echo "tabActivites = new Array();\n";  // Tableau des noms des activités
echo "tabActiviteId = new Array();\n";  // Tableau contenant l'id des activités
echo "tabActiviteDate = new Array();\n"; //Tableau contenant la date de début des activités
echo "tabActiviteDateFin = new Array();\n"; //Tableau contenant la date de fin des activités
echo "var dateActuelle =\"".date("Y-m-d")."\";"; //Date d'aujourd'hui
echo "</script>\n";

# Fonction javascript qui va contenir toutes les activités selon la langue.
echo "<script language=\"javascript\">\nfunction loadTableauActivites()\n{\n";

		
// Requête sélectionnant le nom de chaque activités actives contenues dans la table _pro_activite_calendrier
$sql = "SELECT _pro_types_activites.nomType 
		FROM _pro_types_activites, _pro_activite_calendrier
		where _pro_types_activites.pk_type_activite = _pro_activite_calendrier.fk_type_activite 
		and _pro_activite_calendrier.actif = 1";
		
		//echo "-->" .$sql;
		
		
$result = mysql_query($sql,$mycn) or die("<font color=\"crimson\">Select activités: ".mysql_error()."</font>");
$cmpt = 0;
while($row = mysql_fetch_object($result))
{
	echo "\ttabActivites[$cmpt] = \"".$row->nomType."\";\n";
	$cmpt += 1;
}
mysql_free_result($result);
	
echo "\treturn tabActivites;\n";
echo "}\n</script>\n";

# Fonction javascript qui va contenir toutes les ID des activités selon la langue.
echo "<script language=\"javascript\">\nfunction loadTableauActiviteId()\n{\n";

$sql = "SELECT _pro_activite_calendrier.pk_activite  
		FROM _pro_types_activites, _pro_activite_calendrier 
		WHERE _pro_types_activites.pk_type_activite = _pro_activite_calendrier.fk_type_activite
		and _pro_activite_calendrier.actif = 1";
	
$result = mysql_query($sql,$mycn) or die("<font color=\"crimson\">Select activite_id: ".mysql_error()."</font>");
$cmpt = 0;
while($row = mysql_fetch_object($result))
{
	echo "\ttabActiviteId[$cmpt] = $row->pk_activite;\n";
	$cmpt += 1;
}
mysql_free_result($result);

echo "\treturn tabActiviteId;\n";
echo "}\n</script>\n";

# Fonction javascript qui va contenir toutes les dates des activités selon la langue.
echo "<script language=\"javascript\">\nfunction loadTableauActiviteDate()\n{\n";
		
// Requête contenant la date de début de chacunes des activités 
$sql = "SELECT _pro_activite_calendrier.datecreation  
		FROM _pro_types_activites, _pro_activite_calendrier 
		WHERE _pro_types_activites.pk_type_activite = _pro_activite_calendrier.fk_type_activite
		and _pro_activite_calendrier.actif = 1";
		
$result = mysql_query($sql,$mycn) or die("<font color=\"crimson\">Select activite_date: ".mysql_error()."</font>");
$cmpt = 0;
while($row = mysql_fetch_object($result))
{
	echo "\ttabActiviteDate[$cmpt] = \"".strftime("%Y-%m-%d",$row->datecreation)."\";\n";
	$cmpt += 1;
}
mysql_free_result($result);

echo "\treturn tabActiviteDate;\n";
echo "}\n</script>\n";
//=====================================================================================================
# Fonction javascript qui va contenir toutes les dates des activités selon la langue.
echo "<script language=\"javascript\">\nfunction loadTableauActiviteDateFin()\n{\n";

// Requête contenant la date de fin de chacune des activités
$sql = "SELECT _pro_activite_calendrier.datefin   
		FROM _pro_types_activites, _pro_activite_calendrier  
		where _pro_types_activites.pk_type_activite = _pro_activite_calendrier.fk_type_activite 
		and _pro_activite_calendrier.actif = 1";
$result = mysql_query($sql,$mycn) or die("<font color=\"crimson\">Select activite_date: ".mysql_error()."</font>");
$cmpt = 0;

while($row = mysql_fetch_object($result))
{
	echo "\ttabActiviteDateFin[$cmpt] = \"".date("Y-m-d",$row->datefin)."\";\n";
	$cmpt += 1;
}
mysql_free_result($result);

echo "\treturn tabActiviteDateFin;\n";
echo "}\n</script>\n";

echo "<script src='calendar.js'></script>\n";

// Lorsqu'une date est sélectionnée le mois courant change sur le chargement de la page pour être sur le bon mois, par défaut c'est le mois actuel
$thismonth = isset($_GET["date"])?(int)substr($_GET["date"],5,2):(int) date("m");

// Lorsque le bouton pour afficher les activités du mois courant est enfoncé, assignation du mois d'affichage
if(isset($_POST["mois"]) && $_POST["mois"] != "")
	$thismonth = $_POST["mois"] + 1;

// Lorsqu'une date est sélectionnée l'année courante change sur le chargement de la page pour être sur la bonne année par défaut c'est l'année actuel
$thisyear = isset($_GET["date"])?(int)substr($_GET["date"],0,4):date("Y");

// Lorsque le bouton pour afficher les activités du mois courant est enfoncé, assignation de l'année d'affichage
if(isset($_POST["annee"]) && $_POST["annee"] != "")
	$thisyear = $_POST["annee"];

$afficheDate = "o";

if(isset($_POST["AfficheDate"]))
	$afficheDate = $_POST["AfficheDate"];
	
// Est trié par
$ordre ="datecreation";
// Indice du trie (voir direction..ASC, DESC)
$indice =0;
// Trie de la requête
$direction = array("ASC","DESC");

// Direction du trie (Asc,DESC)
if (isset($_POST["direction"]))
{
	$indice = $_POST["direction"];
}
// Le nom du champ trié	
if (isset($_POST["ordre"]))
{
	$ordre = $_POST["ordre"];
}
// Action du formulaire
$formAction ="";
// Lorsqu'un paramètre date est passé dans l'URL on le récupère pour l'action du formulaire
if(isset($_GET["date"]) && $_GET["date"] != "" && !isset($_POST["btnActiviteMois"]))
	$formAction = "index.php?section=11-4&date=".$_GET["date"];
else
	$formAction = "index.php?section=11-4";
	

// Affiche un calendrier français ou anglais	
switch($lang)
{
	case "fr":
		$janvier = 'Janvier';
		$fevrier = 'Février';
		$mars = 'Mars';
		$avril = 'Avril';
		$mai = 'Mai';
		$juin = 'Juin';
		$juillet = 'Juillet';
		$aout = 'Août';
		$septembre = 'Septembre';
		$octobre = 'Octobre';
		$novembre = 'Novembre';
		$decembre = 'Décembre';
	break;
	default:
		$janvier = 'January';
		$fevrier = 'February';
		$mars = 'March';
		$avril = 'April';
		$mai = 'May';
		$juin = 'June';
		$juillet = 'July';
		$aout = 'August';
		$septembre = 'September';
		$octobre = 'October';
		$novembre = 'November';
		$decembre = 'December';
}
?>
<form name="form_calendar" method="post" action="<?=$formAction?>">
 <input name="ordre" type="hidden" value="<?=$ordre?>">
<input name="direction" type="hidden" value="<?=$indice?>">
<input name="AfficheDate" type="hidden" value="<?=$afficheDate?>">
<select name="mois" onChange="javascript:document.form_calendar.AfficheDate.value='n';document.form_calendar.submit();return show_calendrier('<?=$lang?>');">
<? $thismonth-1==0?$selected="selected":$selected="";?>
<option value="0" <?=$selected?>><?=$janvier?></option>
<? $thismonth-1==1?$selected="selected":$selected="";?>
<option value="1" <?=$selected?>><?=$fevrier?></option>
<? $thismonth-1==2?$selected="selected":$selected="";?>
<option value="2" <?=$selected?>><?=$mars?></option>
<? $thismonth-1==3?$selected="selected":$selected="";?>
<option value="3" <?=$selected?>><?=$avril?></option>
<? $thismonth-1==4?$selected="selected":$selected="";?>
<option value="4" <?=$selected?>><?=$mai?></option>
<? $thismonth-1==5?$selected="selected":$selected="";?>
<option value="5" <?=$selected?>><?=$juin?></option>
<? $thismonth-1==6?$selected="selected":$selected="";?>
<option value="6" <?=$selected?>><?=$juillet?></option>
<? $thismonth-1==7?$selected="selected":$selected="";?>
<option value="7" <?=$selected?>><?=$aout?></option>
<? $thismonth-1==8?$selected="selected":$selected="";?>
<option value="8" <?=$selected?>><?=$septembre?></option>
<? $thismonth-1==9?$selected="selected":$selected="";?>
<option value="9" <?=$selected?>><?=$octobre?></option>
<? $thismonth-1==10?$selected="selected":$selected="";?>
<option value="10" <?=$selected?>><?=$novembre?></option>
<? $thismonth-1==11?$selected="selected":$selected="";?>
<option value="11" <?=$selected?>><?=$decembre?></option>
</select>
&nbsp;
<select style="width:75px;" name="annee" onChange="javascript:document.form_calendar.AfficheDate.value='n';document.form_calendar.submit();return show_calendrier('<?=$lang?>');">

<?
// Année actuelle
$varDate = date("Y");
// Pour l'année actuelle -1 jusqu'à l'année actuelle + 9
for($i = $varDate - 6 ; $i < $varDate + 9; $i++)
{	
	// Affichage de l'année sélectionnée dans la liste
	$thisyear == $i ? $selected="selected":$selected="";
	// Imprime l'année dans la liste de choix
	echo "<option value='".$i."' ".$selected.">".$i."</option>";
}
?>
</select>
<br /><br />
<div id="description_activite"></div>
<div id="calendrier">
<script language="javascript">show_calendrier('<?=$lang?>')</script>
</div>
<!--</form>-->