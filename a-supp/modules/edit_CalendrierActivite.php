<?
// Lorsqu'une activité est en mode modification
if(isset($_GET["pk"]))
{	// Affiche l'activité passé en paramètre dans l'url  
	$sql = "SELECT _pro_activite_calendrier.*, _pro_types_activites.nomType as nom_type
			FROM _pro_activite_calendrier 
			inner join _pro_types_activites on _pro_activite_calendrier.fk_type_activite = _pro_types_activites.pk_type_activite
			WHERE pk_activite = ".$_GET["pk"];
			
	$myrs = mysql_query($sql,$mycn) or die(msql_error());
	$nb = mysql_num_rows($myrs);
	
	
	
	$rs = mysql_fetch_object($myrs);
	$nom=$rs->nom;  // Nom de l'activité
	$titre="Modification d'une activité au calendrier";	
	// Action du formulaire en modification
	$formAction = "&pageRedirect=mmm".urlencode("index.php?section=11-5&pk=".$rs->pk_activite)."&table=_pro_activite_calendrier&mode=update&pk_activite=".$rs->pk_activite;
}
else
{
	$titre="Ajout d'une activité au calendrier";
	// Action du ofrmulaire en insertion
	$formAction = "&pageRedirect=mmm".urlencode("index.php?section=11-5&pk=lastid")."&table=_pro_activite_calendrier&mode=nouveau";
	
	// Valeur(s) par défaut:
	$rs->pk_activite="";
	$rs->prixmembre=0;
	$rs->prixnonmembre=0;
	$rs->fk_type_activite=-1;
	$rs->actif = 1;
	$rs->datecreation = ConvertDate($_GET["date"]);
	$rs->LieuActivite ="";
	$rs->UrlLieuActivite = "";
	$rs->VilleActivite = "";
	$rs->UrlVilleActivite ="";
	$rs->ProvinceActivite ="";
	$rs->PaysActivite ="";
	$rs->OrganismeActivite ="";
	$rs->DescriptionActivite ="";
	$rs->datefin=date("Y-m-d");
	$rs->nom="";
	$rs->accueil=1;
	$nom="";
}
// Permet de choisir le type de l'activité
$sql_type_activite ="select * from _pro_types_activites order by nomType";
$res_type_activite = mysql_query($sql_type_activite,$mycn);
$sel_type_activite = "<select style='margin-left:-1px; 'name='txtfk_type_activite'>";

while($rs_type_activite = mysql_fetch_object($res_type_activite))
{
	if($rs->fk_type_activite == $rs_type_activite->pk_type_activite)
		$sel_type_activite .= "<option value='".$rs_type_activite->pk_type_activite."' SELECTED>".$rs_type_activite->nomType."</option>";	
	else
		$sel_type_activite .= "<option value='".$rs_type_activite->pk_type_activite."'>".$rs_type_activite->nomType."</option>";	
}
$sel_type_activite .= "</select>";

// Identifiant du responsable
$idResponsable="";

// Lorsqu'il y a un numéro d'activité (en modification)
if(isset($_GET["pk"]))
{
	// Requête SQL trouvant l'identifiant du responsable
	$sql_IdResponsable = "SELECT pk_idMembre
				         FROM  _pro_activite_calendrier, membre
				         WHERE membre.pk_idMembre = _pro_activite_calendrier.fk_responsable
			                   AND pk_activite = ".$_GET["pk"];
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
$sel_Responsable = "<SELECT style='margin-left:-1px;' name='txtfk_responsable' id='txtfk_membre'>";
	// Requête affichant les responsables
	$sql_Responsable = "SELECT pk_idMembre,nom,prenom
						FROM membre WHERE Actif = 'Oui'
						ORDER BY Nom";
	// Le responsable est ajouté à la liste sans être sélectionné
	$sel_Responsable .="<option value='0'>Aucun</option>";
	// Exécution de la requête
	$result_Responsable= mysql_query($sql_Responsable,$mycn) or die(msql_error());
	
	// Parcours des enregistrements de la requête
	while($row = mysql_fetch_array($result_Responsable))
	{
		// Lorsque l'identifiant du responsable est différent du responsable inséré dans la liste
		if($idResponsable == $row['pk_idMembre'])
		{	// Le responsable est sélectionné si celui-ci est le responsable
		   $sel_Responsable .="<option selected='selected' value='".$row['pk_idMembre']."'>".$row["nom"].', '.$row["prenom"]."</option>";
			
		}
		else
			// Le responsable est ajouté à la liste sans être sélectionné
		   $sel_Responsable .="<option value='".$row['pk_idMembre']."'>".$row["nom"].', '.$row["prenom"]."</option>";
	}
// Fin de la liste 
$sel_Responsable .= "</SELECT>";

// Variable pour le fil d'ariane
$Section = array("11-4","Activités");
$Sous_Section = "Calendrier";
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
<TABLE width="100%" BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center">
<FORM action="?section=0<?=$formAction?>" method="post" name="formz" onSubmit="return valide_CalActivite(this);">

	<tr>
		<TD valign="top">
        <?
		if(isset($_GET["pk"]))
	    {
			$request = mysql_query("SELECT * FROM _pro_activite_calendrier WHERE pk_activite = ". $rs->pk_activite,$mycn);
			if(mysql_num_rows($request)==0){
		?>	
			<INPUT class="field" type="hidden" name="txtpk_activite" value="<?=$rs->pk_activite?>">
        <? } 
		}
		?>
			<fieldset>
				<legend style="color:#000000"><b>Identification :</b>&nbsp;</legend>
				<TABLE cellSpacing=2 cellPadding=2 border=0 >
				<TR>
					<TD class="edit" width="100">Nom : </TD>
					<TD colspan=4>
					<INPUT class="field" size="85" type=text name=txtnom value="<?=str_replace("\"","&quot;",$rs->nom)?>"  maxlength=45><FONT face=Verdana size=2 COLOR=crimson>*</FONT>
					</TD>					
				</TR>
				<TR>
					<TD class="edit" width="10%" nowrap="nowrap">Date de début :</TD>
					<TD>
						<INPUT type=text name=dtedatecreation value="<?=date("Y-m-d",$rs->datecreation)?>" maxlength=10 size="8"  >
						(aaaa-mm-jj)<FONT face=Verdana size=2 COLOR=crimson>*</FONT>
						</TD>
					<TD>Date de fin :</TD>
					<TD>
						<INPUT type=text name=dtedatefin value="<?= !isset($_GET["date"])?date("Y-m-d",$rs->datefin):$_GET["date"];?>" maxlength=10 size="8"  >
						(aaaa-mm-jj)<FONT face=Verdana size=2 COLOR=crimson>*</FONT>
						</TD>		
					
									
				</TR>
				<TR>
					<TD class="edit" width="100">Catégorie : </TD>
					<TD  align="left">
					<?
					echo $sel_type_activite;
					?>
					</TD>			
					<TD  >Responsable : </TD> 					
					<TD align="left">
						<? echo $sel_Responsable; ?>
					</TD>		
				</TR>
				
				
				<TR>
					<TD class="edit" width="10%" nowrap="nowrap">Prix Membre : </TD>
					<TD>
					<INPUT class="field" size="10" type=text name=txtprixmembre onattrmodified="javascript:verifTxtBoxDecimal(this);" onpropertychange="javascript:verifTxtBoxDecimal(this);" value="<?=str_replace("\"","&quot;",$rs->prixmembre)?>" onBlur="javascript:formatePrix(this);" maxlength=8>
					<TD >Prix Non-Membre : </TD>
					<TD colspan=5>
					<INPUT class="field" size="10" type=text name=txtprixnonmembre onattrmodified="javascript:verifTxtBoxDecimal(this);" onpropertychange="javascript:verifTxtBoxDecimal(this);" onBlur="javascript:formatePrix(this);" value="<?=str_replace("\"","&quot;",$rs->prixnonmembre)?>"  maxlength=8>
					</TD>	
					</TD>					
				</TR>
				
				<TR>
					<TD class="edit" style="white-space:nowrap">Lieu de l'activité : </TD>
					<TD >
                    <INPUT type=hidden name=txtactif  value="<?=$rs->actif?>"  >
					<INPUT class="field" type=text name=txtLieuActivite  value="<?=str_replace("\"","&quot;",$rs->LieuActivite)?>"  >
					<FONT face=Verdana size=2 COLOR=crimson>*</FONT>
					</TD>	
					<TD class="edit" width="10%" nowrap="nowrap">Url du lieu : </TD>
					<TD >
					<INPUT class="field" type=text name=txtUrlLieuActivite value="<?=str_replace("\"","&quot;",$rs->UrlLieuActivite)?>"  maxlength=8>
					</TD>	
				</TR>
				<TR>
					<TD class="edit" width="100">Ville  : </TD>
					<TD>
					<INPUT class="field" type=text name=txtVilleActivite value="<?=str_replace("\"","&quot;",$rs->VilleActivite)?>">
					</TD>	
					<TD class="edit" width="10%" nowrap="nowrap">Url de la ville : </TD>
					<TD >
					<INPUT class="field" type=text name=txtUrlVilleActivite value="<?=str_replace("\"","&quot;",$rs->UrlVilleActivite)?>"  maxlength=8>
					</TD>			
				</TR>
				<TR>
					<TD class="edit" width="100">Province : </TD>
					<TD>
					<INPUT class="field" type=text name=txtProvinceActivite value="<?=str_replace("\"","&quot;",$rs->ProvinceActivite)?>">
					</TD>	
					<TD class="edit" width="10%" nowrap="nowrap">Pays : </TD>
					<TD >
					<INPUT class="field" type=text name=txtPaysActivite value="<?=str_replace("\"","&quot;",$rs->PaysActivite)?>"  maxlength=8>
					</TD>					
			    </TR>
				<TR>
					<TD class="edit" width="100">Organisme : </TD>
					<TD>
					<INPUT class="field" type=text name=txtOrganismeActivite value="<?=str_replace("\"","&quot;",$rs->OrganismeActivite)?>">
					</TD>				
			    </TR>
				<!--<tr>
					<TD class="edit" valign="middle">Contenu:</TD>
					<TD colspan="3">
						<?
							/*$oFCKeditor = new FCKeditor($rsl->fk_langue.'txttexte');
							$oFCKeditor->BasePath	= "/prospecteur/editor/" ;
							$oFCKeditor->ToolbarSet ="detail";
							$oFCKeditor->Height=250;
							$oFCKeditor->Value	= $rsl->texte;
							$oFCKeditor->Create() ;
							$spaw1 = new SpawEditor("txtDescriptionActivite",$rs->DescriptionActivite);
							$spaw1->show();	*/
						?>
						
					</TD>
				<tr>-->
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
if($rs->pk_activite > 0)
{
	$opts="";
	$first=-1;
	$getlng=-1;
	$i=0;
	// Langues de la table langue
	$myrs = mysql_query("SELECT * FROM _pro_langues WHERE actif=1",$mycn);
	while($rst = mysql_fetch_object($myrs))
	{	// Ajoute les languages présent dans les table des langue sous forme de bouton radio
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
	{	// Sélection de l'activité selon sa langue
		$myrsl = mysql_query("SELECT * FROM _pro_activites_langues_calendrier where fk_langue='".$rst->pk_langue_id."' and fk_activite='".$rs->pk_activite."'", $mycn);
		if($rsl = mysql_fetch_object($myrsl))
		{	
			// Action du formulaire sous la forme update
			$formAction = "&pageRedirect=mmm".urlencode("index.php?section=11-5&pk=".$rs->pk_activite."&pk_langue=".$rst->pk_langue_id)."&table=_pro_activites_langues_calendrier&mode=update&pk_activite_langue=".$rsl->pk_activite_langue;
		
		}
		else
		{	// Action du formulaire sous la forme d'insertion
			$formAction = "&pageRedirect=mmm".urlencode("index.php?section=11-5&pk=".$rs->pk_activite."&pk_langue=".$rst->pk_langue_id)."&table=_pro_activites_langues_calendrier&mode=nouveau";
			$rsl->pk_activite_langue=$rsl->titre=$rsl->resume=$rsl->texte="";
			$rsl->fk_activite=$rs->pk_activite;
			$rsl->fk_langue=$rst->pk_langue_id;	
	
		}
	?>
	<div id="lng_<?=$rst->pk_langue_id?>" style="<?=$rst->pk_langue_id==$getlng?"display:block;":"display:none;"?>border-left:10px #000000;">
	<FORM action="?section=0<?=$formAction?>" method="post" name="form<?=$rst->pk_langue_id?>" onSubmit="return valide_activite_langue(this,'<?=$rst->abreviation?>');">
	<INPUT class="field" type="hidden" name="txtfk_langue" value="<?=$rsl->fk_langue?>">
    <?
    	//$request = mssql_query("SELECT * FROM _pro_activites_langues_calendrier WHERE pk_activite_langue = ". $rsl->fk_activite,$mycn);
		//if(mssql_num_rows($request)==0){
	?>	
  	<INPUT class="field" type="hidden" name="txtfk_activite" value="<?=$rsl->fk_activite?>">
	<? //} 
		// Requête retournant les textes des activités selon l'activité choisit
		$reqPkActLangExist = mysql_query("SELECT * FROM _pro_activites_langues_calendrier WHERE fk_activite = ".$_GET["pk"],$mycn);
		// Vérifie s'il y a une activité (si oui mode modification sinon mode ajout)
		if(mysql_num_rows($reqPkActLangExist) == 0){
		
	?>
	
	<INPUT class="field" type="hidden" name="pk_activite_langue" value="<?=$rsl->pk_activite_langue?>">
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
				/*$oFCKeditor = new FCKeditor($rsl->fk_langue.'txtresume') ;
				$oFCKeditor->BasePath	= "/prospecteur/editor/" ;
				$oFCKeditor->ToolbarSet ="Basic";
				$oFCKeditor->Height=150;
				$oFCKeditor->Value	= $rsl->resume;
				$oFCKeditor->Create() ;*/
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
