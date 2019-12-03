<?
// Variable pour le fil d'ariane
$Section = array("11-2","Activités");
$Sous_Section = "Programmes";

//Variables pour le triage 
$redirect="mmm".urlencode("index.php?section=11-2");
$direction = array("ASC","DESC");

$actif = 1;
if (isset($_GET["actif"]))
	$actif = $_GET["actif"];
	
$indice = 0;
if (isset($_GET["direction"]))
	$indice = $_GET["direction"];

$ordre = "datecreation";
if (isset($_GET["ordre"]))
	$ordre = $_GET["ordre"];
	
$type= "";
$typesort="";


$filter ="";
$alpha = "";
if(isset($_GET["alpha"]))
	$alpha = $_GET["alpha"];
	
switch ($alpha)
{
	case "a":
		$filter = " and  Programmes.nomProgramme between('a*') and ('d*') ";
		break;
	case "d":
		$filter = " and   Programmes.nomProgramme between('d*') and ('g*')  ";
		break;
	case "g":
		$filter = " and   Programmes.nomProgramme between('g*') and ('j*')  ";
		break;
	case "j": 
		$filter = " and   Programmes.nomProgramme between('j*') and ('m*') ";
		break;
	case "m":
		$filter = " and   Programmes.nomProgramme between('m*') and ('p*') ";
		break;
	case "p":
		$filter = " and   Programmes.nomProgramme between('p*') and ('s*') ";
		break;
	case "s":
		$filter = " and   Programmes.nomProgramme between('s*') and ('v*') ";
		break;
	case "v":
		$filter = " and   (Programmes.nomProgramme like 'v%' or Programmes.nomProgramme  like 'w%' or Programmes.nomProgramme  like 'x%' or Programmes.nomProgramme like 'y%' or Programmes.nomProgramme  like 'z%') ";
		break;
	case "":
		$filter = "";
		break;
}

//On construit la requête pour lister le programme
$sql =  "SELECT    * FROM  Programmes
		 WHERE actif = '".$actif."'".$filter."
		ORDER BY ".$ordre." ".$direction[$indice];
		


$res = mysql_query($sql,$mycn) ;//or die(msql_error());


?>
<!-- fil d'ariane -->
<?
	include("../prospecteur/_filariane.php");
?>
<!-- / fil d'ariane -->
<form name="form1" method="post" action="index.php?section=11-2">
<input name="mode" type="hidden" value="">
<input name="pk_Programme" type="hidden" value="">

<div id="contour">
	<table width=100% cellpadding=0 cellspacing=0 border=0 align="center">
		<tr>
			<? $actif==1?$texte_titre="actifs":$texte_titre="inactifs" ?>
			<td valign="top" class="titre">Programmes <?=$texte_titre?><HR SIZE=1 NOSHADE></td>
		</tr>
		<tr>
			<td align=center>
				<FONT SIZE=1 face="verdana"><a href="index.php?section=11-2&alpha=a&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">ABC</a> | <a href="index.php?section=11-2&alpha=d&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">DEF</a> | <a href="index.php?section=11-2&alpha=g&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">GHI</a> | <a href="index.php?section=11-2&alpha=j&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">JKL</a> | <a href="index.php?section=11-2&alpha=m&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">MNO</a> | <a href="index.php?section=11-2&alpha=p&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">PQR</a> | <a href="index.php?section=11-2&alpha=s&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">STU</a> | <a href="index.php?section=11-2&alpha=v&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">VWXYZ</a> | <a href="index.php?section=11-2&direction=<?=$indice?>&ordre=<?=$ordre?>&actif=<?=$actif?>">Tous</a></FONT>
			</td>
		</tr>
		<tr>
		    <td>
				<? 
			if(!isset($_GET["actif"])||$_GET["actif"]==1)
			    echo "<a href='index.php?section=11-2&actif=1'><strong>Actifs</strong></a> / ";
			else
			   echo "<a href='index.php?section=11-2&actif=1'>Actifs</a> / ";
			
			if(isset($_GET["actif"]) && $_GET["actif"]==0)
				echo "<a href='index.php?section=11-2&actif=0'><strong>Inactifs</strong></a> ";
			else
			 	echo "<a href='index.php?section=11-2&actif=0'>Inactifs</a> ";
	?>	
			</td>
		</tr>
	</table>
	<br>
	<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0 align="center">
		<TR  class="tetedeliste">
		<Td width=30%>&nbsp;&nbsp;<?
		if ($ordre == "nomProgramme")
			Print "<A href='index.php?section=11-2&actif=$actif&alpha=$alpha&direction=" .abs(1-$indice) ."&ordre=nomProgramme'><B>Nom</B><img src=img/" .$direction[$indice] . ".gif BORDER=0 HSPACE=5 VALIGN=middle></A>";
		else
			Print "<A href='index.php?section=11-2&actif=$actif&alpha=$alpha&direction=0&ordre=nomProgramme'><B>Nom</B></A>";
		?>
		</Td>
		<Td width=15% align="center">&nbsp;&nbsp;<?
		if ($ordre == "datecreation")
			Print "<A href='index.php?section=11-2&actif=$actif&alpha=$alpha&direction=" .abs(1-$indice) ."&ordre=datecreation'><B>Date de début</B><img src=img/" .$direction[$indice] . ".gif BORDER=0 HSPACE=5 VALIGN=middle></A>";
		else
			Print "<A href='index.php?section=11-2&actif=$actif&alpha=$alpha&direction=0&ordre=datecreation'><B>Date de début</B></A>";
		?>
		</Td>
		
		<Td width=10% colspan=4></Td>
		</TR>
	<?
	$cpt = 0;
	$HTML ="";

	while($rs=mysql_fetch_object($res))
	{
		$nomClass = "clsImpair";
		if ($cpt % 2 == 0)
			$nomClass = "clsPair";?>
			<TR class=<?=$nomClass?>>
				<TD><a href="" onClick="modifier_onclick('11-3','<?=$rs->pk_Programme?>','&1=1');return false"><?=$rs->nomProgramme ?></a></TD>		
				<TD align=center><?=date("Y-m-d",$rs->datecreation)?></TD>
				<TD  align="center">
							<?
				$img_archive = "archive.gif";
				$img_title = "Désactiver";
				
				if(!$rs->actif)
				{
					$img_archive = "desarchive.gif";
					$img_title = "Activer";
				}
				?>	
				<IMG SRC="img/modifier.gif" style="cursor:pointer" Border="0" title="Modifier" onClick="modifier_onclick('11-3','<?=$rs->pk_Programme?>','&1=1');return false"/>

				<IMG SRC="img/<?=$img_archive?>"  style="cursor:pointer" Border="0" title="<?=$img_title?>" onClick="archiver_onclick('<?=$rs->pk_Programme?>','<?=addslashes($rs->nomProgramme)?>','<?=$img_title?>','Programmes','<?=$redirect?>','pk_Programme');return false">
				<IMG SRC="img/delete.gif" style="cursor:pointer" Border="0" title="Effacer" onClick="effacer_onclick('<?=$rs->pk_Programme?>','programme','<?=addslashes($rs->nomProgramme)?>','Programmes','pk_Programme','<?=$redirect?>');return false">

			
				
				</TD>
			</TR>
		<?
		$cpt++;
	}
if ( ! $cpt )   echo "<TR><TD colspan=4><FONT COLOR=crimson>Aucun programme n'est disponible pour le moment...</FONT></TD></TR>";	
?>
<TR><TD colspan=9 class="tetedeliste">&nbsp;</TD></TR>
<TR><TD colspan=9 align=center>
	<INPUT class=button type="button" value="Ajouter un programme" onClick="location='index.php?section=11-3'">
	&nbsp;&nbsp;&nbsp;&nbsp;
		
	</TD>
</TR>
</TABLE>
</form>
</div>
	
	