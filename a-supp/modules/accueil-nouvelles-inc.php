<?php include 'config.php' ?>       


 <form method="POST" name="formRecherche" >
       <?
     //On initialise la variable mois  	
     $mois = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');      
      //Si la section n'est pas 
      if(!isset($_GET["section"]))
             $_GET["section"]=1;
         //Titre      
       //Tableau pour les sections			
      /* echo"<table width='100%'  >";
            echo "<tr >";
                     //On met  la section en gras tout dependant où on est situé
                     echo "<td style='margin:0; padding:0;'  width='30%'>";
                      if (isset($_GET["section"])&&$_GET["section"]==1)
                        echo '<a href="_bulletins.php?section=1"><strong>Nouvelles</strong></a>&nbsp; &nbsp;';
                      else  
                        echo '<a href="_bulletins.php?section=1">Nouvelles</a>&nbsp; &nbsp;';
                      
                      if (isset($_GET["section"])&&$_GET["section"]==0)
                        echo '<a href="_bulletins.php?section=0"><strong>Archives</strong></a>';
                       else echo '<a href="_bulletins.php?section=0">Archives</a>';
                    
                     echo "</td>";
                     
                      //Si section est égal à 0 on affiche le moteur de recherche						 
                      if($_GET["section"]==0)
                       {
                          echo "<td  width='70% 'style='text-align:right; '>";
                            echo Lstannees()."&nbsp; ";
                            echo lstMois()."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo  "<td></td><td style='text-align:right; '><input  class='button' type='submit' name='rechercher' value='Rechercher'/></td>";
                            echo "</tr>";
                        
                       }

                  echo "</tr>";
              echo"</table>";*/
     // echo "</form>";
     //On décale le contenu
      echo '<div class="div-nouvelle">';
                $type="";
                if(isset($_GET["type"])){
                    $type = " AND fk_type_nouvelle = ".intval($_GET["type"]);
                }
                
               //On construit la requête
                $sqlchercheAnnee = "SELECT  datecreation
                                    FROM _pro_nouvelles, _pro_nouvelles_langues
                                    WHERE  _pro_nouvelles_langues.fk_nouvelle=_pro_nouvelles.pk_nouvelle
                                    AND  _pro_nouvelles_langues.fk_langue=1
                                    AND actif =".$_GET["section"]."
                                    ".$type."
                                    order by datecreation DESC";
                //On construit la requête
                $res_annees = mysql_query($sqlchercheAnnee,$mycn) or die(msql_error());	
                 
                
                //On initilise le compteur j et le tableau d'années
                $j=0;
                $tabAnnees=array();
                
                //On parcours les années de la base dedonnées
                 while($row_annes=mysql_fetch_row($res_annees ))
                 {
            
                   //Si le tableau ne  contient pas l'année trouvée 
                   if(!Contient($tabAnnees,date("Y",$row_annes[0]) ))
                      {
                       //On ajoute au tableau
                        $tabAnnees[$j]=date("Y",$row_annes[0]);
                        
                       //On augment le compteur
                        $j++;
                      }
                 }
        
              $testAucune=0;
                // Si le mois  et l'annéee n'existent pas  ou que le mois est égal a 0 et l'année est égal à rien  
                if( (!isset($_POST["Mois"]) || !isset($_POST["annee"])) || ($_POST["Mois"]==0 && $_POST["annee"]==0))
                { 
        
                       
                   //Pour tous les années trouvés
                   for ($cptannees=0; $cptannees<Count($tabAnnees); $cptannees++)
                   {
                       //Parcours  le tableau des mois  de decembre à janvier
                       for ($cpt=Count($mois); $cpt>=0; $cpt--)
                       { //Initialise le titre
                          $titre=""; 
                    
                        //On fait la requête pour touver les nouvelles pour une section en particulier			
                        $sqlNouvelles = "SELECT resume, titre, texte, pk_nouvelle,  datecreation
                            FROM _pro_nouvelles, _pro_nouvelles_langues 
                            WHERE  _pro_nouvelles_langues.fk_nouvelle=_pro_nouvelles.pk_nouvelle
                            AND  _pro_nouvelles_langues.fk_langue=1 
                            AND actif =".$_GET["section"]."
                            ".$type."
                            ORDER BY datecreation DESC LIMIT 2";
                        
                        $res_nouvelles = mysql_query($sqlNouvelles,$mycn) or die(msql_error());	 
                        
                        //Pour toutes les dates trouvés
                        while($row_nouvelle=mysql_fetch_object($res_nouvelles))
                            {
                                 //Si la date correspond   à l'année et mois actuel afficher
                                 if(date("Y-m", $row_nouvelle->datecreation)==$tabAnnees[$cptannees]."-".(strlen($cpt)==1?"0".$cpt:$cpt))
                                 {    $testAucune++;
                                      //Si le titre est vide , on affecte le titre 
                                       //if($titre=="")
                                            //{$titre="<h3>&nbsp; " .$mois[$cpt]."  ".$tabAnnees[$cptannees]."</h3>" ;echo $titre;}
                                       //On décale le contenu
                                      echo '<div  class="boite_texteBulletin">';
                                      //On affiche le titre et le résué de la nouvelle 
                                          echo "<h5>".date("d m Y",$row_nouvelle->datecreation)." - ".$row_nouvelle->titre."</h5>";
                                          echo '' .stripslashes($row_nouvelle->resume). '<p class="btn btn-default"><a href="/fr/activites/_bulletinChoix.php?
                                                pk_nouvelle='.$row_nouvelle->pk_nouvelle.'">Voir plus...</a></p>';
                                    echo '</div>';
                                }
                            
                            }
                        }
                      }
            
                }
            else
                {
                        $titre="";
                        $tabDte=array();
                        //construit la requête de toutes les date  pour la section archive seulement
                        $sqlNouvelles = "SELECT resume, titre, texte, pk_nouvelle,  datecreation
                                            FROM _pro_nouvelles, _pro_nouvelles_langues
                                            WHERE  _pro_nouvelles_langues.fk_nouvelle=_pro_nouvelles.pk_nouvelle
                                            AND  _pro_nouvelles_langues.fk_langue=1
                                            AND actif =0
                                            ".$type."
                                            ORDER BY datecreation DESC";
                        
                        
                        $res_nouvelles = mysql_query($sqlNouvelles,$mycn) or die(msql_error());	 
                         
                         //Pour toutes les dates trouvés
                         while($row_nouvelle=mysql_fetch_object($res_nouvelles))
                            {
                            
                                      //Si l'utilisateur choisi le mois et l'année   
                                     if($_POST["Mois"]!=0 && $_POST["annee"]!=0)
                                     {
                                        if(date("Y-m", $row_nouvelle->datecreation)==$_POST["annee"]."-".(strlen($_POST["Mois"] )==1?"0".$_POST["Mois"]:$_POST["Mois"]))
                                         { $testAucune++;
                                               //if($titre=="")
                                                   // {$titre="<h3> &nbsp;" .$mois[$_POST["Mois"]]."  ".$_POST["annee"]."</h3>" ;echo $titre;}
                                                 //On décale le contenu
                                                 echo '<div class="boite_texteBulletin">';
                                                  echo "<h3>".date("Y-m-d",$row_nouvelle->datecreation)." - ".$row_nouvelle->titre."</h3>";
                                                  echo '<p>' .stripslashes($row_nouvelle->resume). '<a href="/fr/club/_bulletinChoix.php?
                                                        pk_nouvelle='.$row_nouvelle->pk_nouvelle.'"> Voir plus...</a></p>';
                                                 //On décale le contenu
                                                echo '</div>';
                                             }
                                     }//Si l'utilisateur choisi le mois
                                    
                                    else if($_POST["Mois"]!=0 && $_POST["annee"]==0)
                                      {
                                             $i=0;
                                            //Pour tous les années trouvés
                                           for ($cptannees=0; $cptannees<Count($tabAnnees); $cptannees++)
                                           {
                                        
                                               if (   date("Y-m", $row_nouvelle->datecreation)==$tabAnnees[$cptannees]."-".(strlen($_POST["Mois"] )==1?"0".$_POST["Mois"]:$_POST["Mois"]))
                                                   {
                                                    
                                                      //if(!contient($tabDte,$mois[$_POST["Mois"]]."  ".$tabAnnees[$cptannees]))
                                                          //  {$titre="<h3>&nbsp; " .$mois[$_POST["Mois"]]."  ".$tabAnnees[$cptannees]."</h3>" ;echo $titre;}
                                                    //On décale le contenu
                                                     echo '<div class="boite_texteBulletin" >';
                                                          echo "<h5>".date("Y-m-d",$row_nouvelle->datecreation)." - ".$row_nouvelle->titre."</h5>";
                                                          echo '<p >' .stripslashes($row_nouvelle->resume). '<a href="/fr/club/_bulletinChoix.php?
                                                                pk_nouvelle='.$row_nouvelle->pk_nouvelle.'"> Voir plus...</a></p>'; 
                                                     //On décale le contenu
                                                     echo '</div>';
                                                      $tabDte[$i]=$mois[$_POST["Mois"]]."  ".$tabAnnees[$cptannees];
                                                   }
                                                   
                                             }
                                         }
                                         else if($_POST["Mois"]==0 && $_POST["annee"]!=0)
                                         {
                                            $i=0;
                                            for ($cpt=Count($mois); $cpt>=0; $cpt--)
                                            { 
                                                if (   date("Y-m", $row_nouvelle->datecreation)==$_POST["annee"]."-".(strlen($cpt)==1?"0".$cpt:$cpt))
                                               {
                                                
                                                  //if(!contient($tabDte,$mois[ $cpt]."  ".$_POST["annee"]))
                                                       // {$titre="<h3>&nbsp; " .$mois[ $cpt]."  ".$_POST["annee"]."</h3>" ;echo $titre;}
                                                //On décale le contenu
                                                 echo '<div class="boite_texteBulletin" >';
                                                      echo "<h5>".date("Y-m-d",$row_nouvelle->datecreation)." - ".$row_nouvelle->titre."</h5>";
                                                      echo '<p >' .stripslashes($row_nouvelle->resume). '<a href="/fr/club/_bulletinChoix.php?
                                                            pk_nouvelle='.$row_nouvelle->pk_nouvelle.'">  Voir plus...</a></p>'; 
                                                 //On décale le contenu
                                                 echo '</div>';
                                                 $tabDte[$i]=$mois[ $cpt]."  ".$_POST["annee"];
                                               }
                                            }	 
                                        }												
                            } 
                                  
                
                    
            
                
                }
                     
                    if($testAucune==0){echo"<p style='margin:30px;'>Aucune nouvelle à lister...</p>";} 
                     
                     
                     
                

        
     echo '</div>';
 //echo '</div>';
 
//****************************Fonctions****************************************   	
//Méthode qui vérifie dans un tableau ,si un element est présent
function Contient($tab,$element)
{
  //On initialise element present à false
  $elementPres=false;
  for($i=0;$i<Count($tab);$i++)
  {
    if ($tab[$i]==$element)
          $elementPres=true; //si oui  retourne true
  }
 //On retourne si l'element est present ou pas
return $elementPres;
}
            

//Méthode qui liste  les mois  de l'année
Function lstMois()
{
 //Tableau du mois
 global $mois ;

                //On remplace les 0 par rien      			
                $date = str_replace("0","",date("m"));
                  
                 // On crée la liste des mois
                 echo '<select  id="Mois" name="Mois" >';
                 //La premiere option par défaut
                 echo '<option value="0">--Tous les mois--</option>';
                 //On parcourt le tableau et on crée le reste des options
                  for($i=1;$i<count($mois);$i++)
                    {
                      // Si la option choisi correspond à l'option présente  on la sélection
                      if(isset($_POST['Mois'])&&str_replace ( 0, "", $_POST['Mois'])==$i)
                        echo '<option selected value="'.$i.'">'. $mois[$i].' </option>';
                      else//Sinon on la sélection pas
                        echo '<option value="'.$i.'">'. $mois[$i].' </option>';
                    }
                //On ferme la liste
                 echo '</select>';
}

 //Méthode qui liste les années existantes
 function Lstannees()
 {
     //Source global de la base de données   
     global $mycn;
    
        //Si la galerie existe  on recherche tous les photos de l'année choisi mais qui appartient à la galerie choisi
    
           $sql_dateNouvelle= "SELECT  datecreation
                                    FROM _pro_nouvelles, _pro_nouvelles_langues
                                    WHERE  _pro_nouvelles_langues.fk_nouvelle=_pro_nouvelles.pk_nouvelle
                                    AND  _pro_nouvelles_langues.fk_langue=1
                                    AND actif =0
                                    ".$type."
                                    ORDER BY datecreation ASC";

            
            //On récupère le jeu d,enregistrements
            $res_dateNouvelle =mysql_query( $sql_dateNouvelle,$mycn);
       
        //On initialise les variables de travail
        $cpt=0;
        $tabDates=array();
        
                    //On parcours le jeu d'enregistrements
        $row_dateNouvelle = mysql_fetch_row( $res_dateNouvelle);
        echo '<select id="lstannees"    name="annee" >';
           echo '<option value="0" >--Toutes les années--</option>';
    
        
                
    for ($m=substr( date("Y",time()),0,1);$m>=substr( date('Y',$row_dateNouvelle[0]),0,1);$m--)
                  for ( $c=substr(  date("Y",time()),1,1);$c>=substr( date('Y',$row_dateNouvelle[0]),1,1); $c--)
                        for ( $d=substr(  date("Y",time()),2,1); $d>=substr( date('Y',$row_dateNouvelle[0]),2,1);$d--)
                            for ( $u=substr(  date("Y",time()),3,1); $u>=substr( date('Y',$row_dateNouvelle[0]),3,1);$u--)
                                  {
                                         //Si l'annee est égal à l'année choisie on la sélection
                                        if(isset($_POST["annee"])&& $_POST["annee"]==($m.$c.$d.$u))											  
                                            echo "<option selected>".$m.$c.$d.$u. "</option>";
                                        else 
                                           echo "<option >".$m.$c.$d.$u. "</option>";
                                      
                                      
                                    }					
            echo "</select>";
            
    


               
               // On increment le compteur 
               $cpt++; 

            
            
        
        
        //On ferme la liste			
        echo '</select>';
 
 }


       
     ?>
     </form>