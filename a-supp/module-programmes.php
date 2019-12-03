	<?
    
    global  $mycn;   
    // On construit la requête  pour trouver les programmes
    $sqlProgramme =  "SELECT resume, titre, texte, pk_Programme,  datecreation
    FROM Programmes, _pro_programmes_langues
    WHERE  _pro_programmes_langues.fk_Programme=Programmes.pk_Programme
    AND  _pro_programmes_langues.fk_langue=1
    AND actif =1
    ORDER BY datecreation";
    
    //On décale un peut les programmes à l'aide d'une div
    
    $res_programme = mysql_query($sqlProgramme,$mycn) or die(msql_error());	  
  
    //Pour chaque programme  on affiche on affiche le titre et  sa description
    while($row_Programme=mysql_fetch_object($res_programme))
    {	  echo '<div style="margin-bottom:2em;">';
    echo '<h3><a href="/fr/activites/_programmeChoix.php?pk_programme='.$row_Programme->pk_Programme.'" >'
    .$row_Programme->titre .'</a></h3>';
    echo '<p>' .$row_Programme->resume.'</p>';
    echo '<a href="/fr/activites/_programmeChoix.php?pk_programme='.$row_Programme->pk_Programme.'" >Lire la suite
    </a>';
    //On ferme la division
    echo "</div >";
    }
    
    
    ?>