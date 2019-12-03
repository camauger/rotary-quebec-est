
<?

$root_directory=$_SERVER['DOCUMENT_ROOT']."/";


$myServerClub = "10.10.1.80";
$myUserClub = "usrrotar"; 
$myPassClub = "MouCHACHA";
$myDBClub = "rotary_prospectionnc";
$mois = array('', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai','Jui', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc');

////////////////////////////////////////
/*			Anti SQL Injection	 	  */
////////////////////////////////////////
require_once("_includes/anti_sql_injection.php");


//connection to the database
$mycn = mysql_connect($myServerClub, $myUserClub, $myPassClub) or die("Couldn't connect to SQL Server on $myServer");
  
//select a database

mysql_select_db($myDBClub, $mycn ) or die("Couldn't open database $myDB"); 


//////mail
//$smtp_server="smtpint.prospection.qc.ca";
$courriel_nom_envoi="Rotary Club de St-Nicolas";
$courriel_envoi="info@rotary-st-nicolas.com";
//// INFOS DU CLUB ////
$query = mysql_query("SELECT * FROM Club",$mycn);
$club_infos = mysql_fetch_object($query);
if (mysql_num_rows($query)==0){$club_infos ="";}
//SELECT TEST

//// VARIABLES ////
$strDomaine = "http://".$_SERVER['HTTP_HOST'];
$imgPath_gallery = "../_uploads/photos";



$photo_upload="C:\\Inetpub\\www\\rotary-quebecest.org\\_uploads\\photos\\";
$files_upload="C:\\Inetpub\\www\\rotary-quebecest.org\\_uploads\\ficheAtt\\";
$document_upload_default="C:\\Inetpub\\www\\rotary-quebecest.org\\_uploads\\documents\\";
$imgPath_membre = "../_uploads/photosMembre";
$photo_uploadMembre = "C:\\Inetpub\\www\\rotary-quebecest.org\\_uploads\\photosMembre\\";




/*$photo_upload = "C:\\Inetpub\\wwwroot\\rotary-quebec-php.prospection.qc.ca\\_uploads\\photos\\";
$files_upload="C:\\Inetpub\\wwwroot\\rotary-quebec-php.prospection.qc.ca\\_uploads\\ficheAtt\\";
$document_upload_default="C:\\Inetpub\\wwwroot\\rotary-quebec-php.prospection.qc.ca\\_uploads\\documents\\";
$imgPath_membre = "../_uploads/photosMembre";
$photo_uploadMembre = "C:\\Inetpub\\wwwroot\\rotary-quebec-php.prospection.qc.ca\\_uploads\\photosMembre\\";*/

$strPath = $_SERVER['DOCUMENT_ROOT'];
$smtp_server = "10.10.11.2";
// tableau contenant les fichiers editables mais contenant du code dynamique, on s'en sert pour bloquer la suppression
$arr_dynamic_files[0] = 'fr/contact.php';

$galeries_path="../_uploads/galeries/";
$fichier_path="../_uploads/fichier/";

/*$myDB = "ri7790";
$myServer = "10.10.1.96";
$myUser = "sa2";
$myPass = "micro987%%%";*/
			
//$mycnDisctrict = mssql_connect($myServer, $myUser, $myPass);
//select a database
//mssql_select_db($myDB, $mycnDisctrict) or die("Couldn't open database $myDB"); 

//Id d'activité obligatoire pour chaque club
$activiteObliClub=1; 
// Identifiant du conseil d'administration afin de ne pas l'effacer
$consAdmin=63;
//$consAdmin=1;
//Numéro Ri du club
$IdClubRI=2000;
////wisywig
$BasePath =  "/prospecteur/fckeditor/";


?>




