<?

//S'il existe un paramètre pk  dans adresse de la page  on est en mode modification
if(isset($_GET["pk"]))
{  
    //On construit la requête  pour  rechercher  le programme actuel
	$sql = "SELECT * 
			FROM Programmes 
			WHERE pk_Programme= ".$_GET["pk"];
	
	$myrs = mysql_query($sql,$mycn) or die(msql_error());
	$nb = mysql_num_rows($myrs);
	
	//Si on trouve pas de programme actuel, on revient à la liste des programmes  
	if(!$nb)
	{
		header("Location:index.php?section=11-3");
		exit;
	}
	$rs = mysql_fetch_object($myrs);
	$nom=$rs->nomProgramme;
	//on défini le titre
	$titre="Modification d'un programme";
	
	//On crée le l'action du formulaire pour la modification
	$formAction = "&pageRedirect=mmm".urlencode("index.php?section=11-3&pk=".$rs->pk_Programme)."&table=Programmes&mode=update&pk_Programme=".$rs->pk_Programme;
}
else
{
    //on défini le titre
	$titre="Ajout d'un programme";
	//On crée le l'action du formulaire pour la modification
	$formAction = "&pageRedirect=mmm".urlencode("index.php?section=11-3&pk=lastid")."&table=Programmes&mode=nouveau";
	
	//Oninitialise tout les variables, car celle-ci doit  être vide pour l'ajout
	$nom="";
	$rs->actif=1;
	$rs->nomProgramme="";
    $rs->datecreation=time();
	$rs->datefin=time();
	$rs->pk_Programme="";
}

// Identifiant du responsable
$idResponsable="";

// Lorsqu'il y a un numéro d'activité (en modification)
if(isset($_GET["pk"]))
{
	// Requête SQL trouvant l'identifiant du responsable
	$sql_IdResponsable = "SELECT pk_idMembre
				         FROM  Programmes, membre
				         WHERE membre.pk_idMembre = Programmes.fk_membre
			                   AND pk_Programme = ".$_GET["pk"];
	// Exécution de la requête sql						   
	$result_IdResponsable = mysql_query($sql_IdResponsable,$mycn) or die(msql_error());
	
	// Recherche de l'enregistrement
	if($row = mysql_fetch_array($result_IdResponsable))
	{
	
		// Affectation de l'identifiant du responsable
		$idResponsable = $row['pk_idMembre'];
	}

}
// Variable contenant une liste affichant les responsables	
$sel_Responsable = "<SELECT style='margin-left:-1px;' name='txtfk_membre' id='txtfk_membre'>";
	// Requête affichant les responsables
	$sql_Responsable = "SELECT pk_idMembre,nom,prenom 
						FROM membre WHERE Actif = 'Oui' 
						ORDER BY nom";
	// Exécution de la requête
	$result_Responsable= mysql_query($sql_Responsable,$mycn) or die(msql_error());
	
	// Parcours des enregistrements de la requête
	while($row = mysql_fetch_array($result_Responsable))
	{
		// Lorsque l'identifiant du responsable est différent du responsable inséré dans la liste
		if($idResponsable <> $row['pk_idMembre'])
			// Le responsable est ajouté à la liste sans être sélectionné
		   $sel_Responsable .="<option value='".$row['pk_idMembre']."'>".$row["nom"].', '.$row["prenom"]."</option>";
		else
			// Le responsable est sélectionné si celui-ci est le responsable
		   $sel_Responsable .="<option selected='selected' value='".$row['pk_idMembre']."'>".$row["nom"].', '.$row["prenom"]."</option>";
	}
// Fin de la liste 
$sel_Responsable .= "</SELECT>";

// Variable pour le fil d'ariane
$Section = array("11-2","Activités");
$Sous_Section = "Programmes";
$Sous_Section2 = $titre;
					
?>
<!-- fil d'ariane -->
<?
	include("../prospecteur/_filariane.php");
?>
<!-- / fil d'ariane -->
<div id="contour">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
		<tr>
			<td valign="top" class="titre"><?=$titre?><HR SIZE="1" NOSHADE></td>
		</tr>
	</table>
   <!-- Tableau qui liste les programmes-->
	<TABLE width="100%" BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center">
	<FORM action="?section=0<?=$formAction?>" method="post" name="formz" onSubmit="return valide_Programme(this);">

		<tr>
			<TD valign="top">
	        <?
			if(isset($_GET["pk"]))
		    {
				$request = mysql_query("SELECT * FROM Programmes WHERE pk_Programme = ". $rs->pk_Programme,$mycn);
				if(mysql_num_rows($request)==0){
			?>	
				<INPUT class="field" type="hidden" name="pk_Programme" value="<?=$rs->pk_Programme?>">
	        <? } 
			}
			?>
				<fieldset>
					<legend style="color:#000000"><b>Identification :</b>&nbsp;</legend>
					<TABLE cellSpacing=2 cellPadding=2 border=0 >
					<TR>
						<TD class="edit" width="100">Nom : </TD>
						<TD colspan=4>
						<INPUT class="field" size="85" type="text" name="txtnomProgramme" id="txtnomProgramme" value="<?=str_replace("\"","&quot;",$rs->nomProgramme)?>"  maxlength=80><FONT face=Verdana size=2 COLOR=crimson>*</FONT>
						</TD>					
					</TR>
					<TR>
																			
						<TD class="edit" width="10%" nowrap="nowrap">Date de création :</TD>
						<TD>
							<INPUT type="text" name="dtedatecreation" value="<?=date("Y-m-d",$rs->datecreation)?>" maxlength=10 size="8" ><FONT face=Verdana size=2 COLOR=crimson>*</FONT>(aaaa-mm-jj)
							</TD>
					</TR>
					<TR>
					   <TD class="edit" width="10%" nowrap="nowrap">Responsable :</TD>
						<td><?=$sel_Responsable?></td>		
					</TR>
					<TR>
						<TD class="edit" width="100">Active : </TD>
						<TD>
						<input type="radio" name="intactif" value="1" <?=$rs->actif==1?'checked':''?>/>&nbsp;Oui&nbsp;&nbsp;<input type="radio" name="intactif" value="0"  <?=$rs->actif==0?'checked':''?>/>&nbsp;Non&nbsp;&nbsp;
						</TD>
				
					
					<tr>
						<td valign="middle" colspan="4" align="center">
							<INPUT type="submit" value="   Sauvegarder   " class="button">
						</td>						
					</tr>
					</TABLE>				
				</fieldset>		 
			</TD>
		</TR>
	</FORM>
</TABLE>
<?
// Si on sauvegarde  on a la posibilité  de écrire une description et un contenu
if($rs->pk_Programme > 0)
{
	$opts="";
	$first=-1;
	$getlng=-1;
	$i=0;
	$myrs = mysql_query("SELECT * FROM _pro_langues where actif=1", $mycn);
	while($rst = mysql_fetch_object($myrs))
	{
		$first=$first==-1?$rst->pk_langue_id:$first;
		$getlng=isset($_GET["pk_langue"])?$_GET["pk_langue"]:$first;
		$opts.="<INPUT class='field' type=radio name=optLangue value=".$rst->pk_langue_id." onclick='toggle_langue(".$rst->pk_langue_id.")' ".($rst->pk_langue_id==$getlng?"checked":"")."> ".$rst->nom;
		echo "<script language='javascript'>arr_lng[$i]='".$rst->pk_langue_id."';</script>";
		$i++;
	}
	?>
	<br />
	<fieldset>
	<legend style="color:#000000"><b>Contenus / Langues :</b>&nbsp;</legend>
	<TABLE width=100% BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center">
	<tr>
		<TD valign="top">			
				<?=$opts?>			
		</TD>
	</tr>
	</TABLE>
	<HR SIZE="1" NOSHADE>
	<?
	$myrs = mysql_query("SELECT * FROM _pro_langues where actif=1", $mycn);
	while($rst = mysql_fetch_object($myrs))
	{
		$myrsl = mysql_query("SELECT * FROM _pro_programmes_langues where fk_langue='".$rst->pk_langue_id."' and fk_Programme='".$rs->pk_Programme."'", $mycn);
		if($rsl = mysql_fetch_object($myrsl))
		{
			$formAction = "&pageRedirect=mmm".urlencode("index.php?section=11-3&pk=".$rs->pk_Programme."&pk_langue=".$rst->pk_langue_id)."&table=_pro_programmes_langues&mode=update&pk_Programme_langue=".$rsl->pk_Programme_langue;
		}
		else
		{
			$formAction = "&pageRedirect=mmm".urlencode("index.php?section=11-3&pk=".$rs->pk_Programme."&pk_langue=".$rst->pk_langue_id)."&table=_pro_programmes_langues&mode=nouveau";
			$rsl->pk_Programme_langue=$rsl->titre=$rsl->resume=$rsl->texte="";
			$rsl->fk_pr=$rs->pk_Programme;
			$rsl->fk_langue=$rst->pk_langue_id;	
		
			
		}
	?>
	<div id="lng_<?=$rst->pk_langue_id?>" style="<?=$rst->pk_langue_id==$getlng?"display:block;":"display:none;"?>border-left:10px #000000;">
	<FORM action="?section=0<?=$formAction?>" method="post" name="form<?=$rst->pk_langue_id?>" onSubmit="return valide_programme_langue(this,'<?=$rst->abreviation?>');">
	<INPUT class="field" type="hidden" name="txtfk_langue" value="<?=$rsl->fk_langue?>"/>
  	<INPUT class="field" type="hidden" name="txtfk_programme" value="<?=$rs->pk_Programme?>"/>
	 <?  
	
		// Requête retournant les textes des activités selon l'activité choisit
		$reqPkActLangExist = mysql_query("SELECT * FROM _pro_programmes_langues WHERE fk_programme = ".$_GET["pk"],$mycn);
		// Vérifie s'il y a une activité (si oui mode modification sinon mode ajout)
		if(mysql_num_rows($reqPkActLangExist) == 0){
	?>
	<INPUT class="field" type="hidden" name="pk_Programme_langue" value="<?=$rsl->pk_Programme_langue?>">
	<? } ?>
	<TABLE cellSpacing=2 cellPadding=2 border=0 width=100% style="">
	<TR>
		<TD class="edit" valign="middle">Titre :<br />(<?=$rst->nom?>) </TD>
		<TD colspan="3">
		<INPUT class="field" size="85" type=text name=txttitre value="<?=$rsl->titre!=""?str_replace("\"","&quot;",$rsl->titre):$nom?>"><FONT face=Verdana size=2 COLOR=crimson>*</FONT>
		</TD>
	</tr>
	<tr>
		<TD class="edit" valign="middle">Résumé :<br />(<?=$rst->nom?>) </TD>
		<TD colspan="3">
			<?
				$oFCKeditor = new FCKeditor($rst->abreviation."_resume");
				$oFCKeditor->BasePath = $BasePath ;
				$oFCKeditor->ToolbarSet ="Default";
				$oFCKeditor->Height=250;
				$oFCKeditor->Value	=$rsl->resume;
				$oFCKeditor->Create() ;
			
			?>
			
		</TD>
	</TR>
	<tr>
		<TD class="edit" valign="middle">Contenu:<br />(<?=$rst->nom?>)</TD>
		<TD colspan="3">
			<?
				$oFCKeditor = new FCKeditor($rst->abreviation."_texte");
				$oFCKeditor->BasePath = $BasePath ;
				$oFCKeditor->ToolbarSet ="Default";
				$oFCKeditor->Height=250;
				$oFCKeditor->Value	=$rsl->texte;
				$oFCKeditor->Create() ;
			
			?>
			
		</TD>
	</TR>							
	
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td valign="middle" align="center" colspan="4"><INPUT type="submit" value="   Sauvegarder  (<?=$rst->nom?>) " class="button"></td>
	</tr>
</TABLE>
</FORM></div> 
<?}}?>

</div>
