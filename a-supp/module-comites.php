	<?php $sql_Commission = "SELECT * FROM Commission
				   WHERE IDComission IN(SELECT IDCommission FROM InterComite WHERE IDMembre IN
				   (SELECT pk_IDMembre FROM membre WHERE Actif = 'Oui')) 
				   ORDER BY NomComm";
			$res_Commission = mysql_query($sql_Commission,$mycn) ?>

    <?php
    	global  $mycn;     
              
		print "<div>";
		// Vérifie la présence de commissions
		if(mysql_num_rows($res_Commission) > 1)
		{
			
		// Parcours des commissions ayant des membres participant à leurs comités
		while($row = mysql_fetch_object($res_Commission))
		{
		// Affiche un comité si celui-ci est lié à des membres
		
		$sql_Comites = "SELECT * FROM Comite WHERE IDCommission =".$row->IDComission." 
		AND IDComite IN(SELECT IDComite FROM InterComite WHERE IDMembre IN(SELECT pk_IDMembre
		FROM membre WHERE Actif = 'Oui')) 
		ORDER BY NomComite";
		
		//echo "-->" .$sql_Comites;
		
		
		$res_Comites = mysql_query($sql_Comites,$mycn);
		// Nom de la commission
		print "<h3>".$row->NomComm."</h3>";
		
		// Parcours des comités ayant des membres y participant
		while($rs = mysql_fetch_object($res_Comites))
		{
		print "<p class='Indentation'><a href='/fr/membres/_InterComite.php?Commission=".
		$row->IDComission."&Comite=".$rs->IDComite."'>".$rs->NomComite."</a></p>";
		}
		
		}
		
		}
		print "</div>"
				
            ?>