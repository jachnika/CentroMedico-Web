<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<HEAD>
		<meta charset="iso-8859-2">  
        <title>CENTRO MEDICO - Program dla przychodni</title>  
        <link rel="stylesheet" href="css/style.css">
	</HEAD>
	<BODY>
	<div id="kontener">
 			<div id="naglowek">
 				<center>
 					<img src="images/LGO-3.png"></img>
 				</center>
 			</div>
 			<div id="menu">
 				<center>
 				<?PHP
            		session_start();
            
            		if($_SESSION['LOGIN'] == 1)
            		{
            			$DATABASESERVER			=	'iwm.ocw.nazwa.pl:3307';
						$DATABASEUSER			=	'ocw_1';
						$DATABASEPASS			=	'SlawekArek12';
						$SELECTEDDATABASE		=	'ocw_1';
        				$DATABASE       		=   mysql_connect($DATABASESERVER,$DATABASEUSER,$DATABASEPASS) or die (mysql_error());
		
                		mysql_select_db($SELECTEDDATABASE,$DATABASE);
		
						if(!$DATABASE)
            			{
                			die("Could not connect to MySQL");
            			}
						//ZAPYTANIE PONIŻEJ SPRAWDZA, CZY ZALOGOWANY UŻYTKOWNIK JEST LEKARZEM
						$QUERY      =   "SELECT *"
							.	" FROM Pracownik "
							.	" WHERE idOsoby = '" . $_SESSION['IDUSER'] . "'";
					
						$result     =   MYSQL_QUERY($QUERY) OR DIE ('ZAPYTANIE'.$QUERY.'BLAD'.  mysql_error());
						$NUM_ROWS   =   mysql_num_rows($result);
						//JEŻELI ZALOGOWANY UŻYTKOWNIK NIE JEST LEKARZEM 
						if ($NUM_ROWS == NULL) 
        				{
        					echo "
 								<a href=\"usermenu.php\" id=\"home\">HOME</a>
 								<a href=\"order.php\" id=\"makeanappointment\">MAKE AN APPOINTMENT</a>
 								<a href=\"visits.php\" id=\"userappointments\">USER APPOINTMENTS</a>
 								<a href=\"yourdata.php\" id=\"userdetails\">USER DETAILS</a>
 								<a href=\"logout.php\" id=\"logout\">LOGOUT</a>";
 						}
            			//JEŻELI UŻYTKOWNIK JEST LEKARZEM
            			else 
            			{
            				echo "
            					<a href=\"usermenu.php\" id=\"home\">HOME</a>
 								<a href=\"order.php\" id=\"makeanappointment\">MAKE AN APPOINTMENT</a>
 								<a href=\"visits.php\" id=\"userappointments\">USER APPOINTMENTS</a>
 								<a href=\"visityourpatients.php\" id=\"uservisits\">USER APPOINTMENTS</a>
 								<a href=\"yourdata.php\" id=\"userdetails\">USER DETAILS</a>
 								<a href=\"logout.php\" id=\"logout\">LOGOUT</a>";
 						}
            	}
            	else
            	{
            		echo "
            			<a href=\"index.php\" id=\"home\">HOME</a>
            			<a href=\"logowanie.php\" id=\"login\">LOGIN</a>
            			<a href=\"autorzy.php\" id=\"about\">ABOUT</a>
            			<a href=\"kontakt.php\" id=\"contact\">CONTACT</a>";
            	}	
			?>
 			</center>
 			</div>
 			<div id="tresc">
 				<?php
 				if ($_SESSION['LOGIN'] == 1)
    				{
    					$DATABASESERVER			=	'iwm.ocw.nazwa.pl:3307';
				$DATABASEUSER			=	'ocw_1';
				$DATABASEPASS			=	'SlawekArek12';
				$SELECTEDDATABASE		=	'ocw_1';
        		$DATABASE       		=   mysql_connect($DATABASESERVER,$DATABASEUSER,$DATABASEPASS) or die (mysql_error());
		
                mysql_select_db($SELECTEDDATABASE,$DATABASE);
		
				if(!$DATABASE)
            	{
                	die("Could not connect to MySQL");
            	}
        			//TO ZAPYTANIE WYŚWIETLA WIZYTY KTÓRE PACJENT MA ZAPLANOWANE
        			$QUERY 	= 	"SELECT dataWizyty AS DATA_WIZYTY, godzinaWizyty AS GODZINA_WIZYTY, CONCAT( nazwisko,\" \", imie ) AS LEKARZ, objawy AS OBJAWY, diagnoza AS DIAGNOZA"
							.	" FROM Wizyty W"
							.	" JOIN Osoby O ON W.idLekarza = O.idOsoby"
							.	" WHERE idPacjenta = '" . $_SESSION['IDUSER'] . "'"
							.	" AND CURDATE() <= dataWizyty"
							.	" ORDER BY dataWizyty ASC" ;
							
					$result     =   MYSQL_QUERY($QUERY) OR DIE ('ZAPYTANIE'.$QUERY.'BLAD'.  mysql_error());
					$NUM_ROWS   =   mysql_num_rows($result);
					
					if ($NUM_ROWS != NULL) 
        			{
        				echo "<center>WIZYTY ZAPLANOWANE";
        				echo "<BR>";
        				echo "<TABLE>";
        				echo '<tr><th>DATA</th>';
                   	 	echo '<th>GODZINA</th>';
                    	echo '<th>LEKARZ</th>';
                    	echo '<th>OBJAWY</th></tr>';
        				while ($row = mysql_fetch_assoc($result)) //przeglądaj wynik
                		{
                	    	echo '<tr><td>'.$row['DATA_WIZYTY'].'</td>';
                   	 		echo '<td>'.$row['GODZINA_WIZYTY'].'</td>';
                    		echo '<td>'.$row['LEKARZ'].'</td>';
                    		echo '<td>'.$row['OBJAWY'].'</td></tr>';
                		}
        				echo '</TABLE></center>';
        			}
    				}
    				else
    				{
    					echo "Log in first please!";
    				}
    			?>
 			</div>
 			
 			<div id="stopka">
 			</div>
 			
 			
 	</div>	
	</BODY>
</HTML>