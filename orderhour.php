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
        		$_SESSION['DATE']		= 	$_GET['YEAR']."-".$_GET['MONTH']."-".$_GET['DAY'];		
        		$_SESSION['LEKARZ']		=	$_GET['LEKARZ'];	
        		$_SESSION['OBJAWY']		=	$_GET['OBJAWY'];
		
                mysql_select_db($SELECTEDDATABASE,$DATABASE);
		
				if(!$DATABASE)
            	{
                	die("Could not connect to MySQL");
            	}
				//ZAPYTANIE WYSZUKUJE PRZYJĘCIA W DANYM DNIU
				$QUERY      =   "SELECT godzinaWizyty"
							.	" FROM Wizyty"
							.	" WHERE dataWizyty=\"".$_GET['YEAR']."-".$_GET['MONTH']."-".$_GET['DAY']."\"";
					
				
				$result     =   MYSQL_QUERY($QUERY) OR DIE ('ZAPYTANIE'.$QUERY.'BLAD'.  mysql_error());
				
				$condition = true;
        		echo "<FORM METHOD = \"GET\" ACTION=\"orderconfirm.php\" NAME = \"ZAMOWIENIE\">";
        		echo "<TABLE>";
        		echo "<tr><th>DATA</th>";
                echo "<th>GODZINA</th>";
            	echo "<th>WYBIERZ</th>";
            	echo "</tr>";
                for($i=8;$i<=19;$i++)
                {
                	if ($i<10)
                	{
                		$j = "0".(string)$i.":00:00";
                		
                	}
                	else
                	{
                		$j = (string)$i.":00:00";
                	}
                	 
                	//$j = strtotime($j);
                    $condition = true;
                    mysql_data_seek($result,0);
        			while ($row = mysql_fetch_assoc($result)) //przeglądaj wynik
                	{
                	    if(strcmp((string)$row['godzinaWizyty'],(string)$j)==0)
                	    {
                   	 		$condition=false;
                   	 	}
                   	 	//echo (string)$row['godzinaWizyty'];
                   	 	//echo $j;
                	}
                	
                	if($condition==true)
                	{
                		
                		echo '<tr><td>'.$_GET['YEAR']."-".$_GET['MONTH']."-".$_GET['DAY'].'</td>';
                   	 	echo 	'<td>'.$j.'</td>';
                    	echo 	"<td><INPUT TYPE=\"RADIO\" NAME=\"HOUR\" VALUE=\"".$j."\"/></td>";
                    	echo '</tr>';
                	}
                	
                	if ($i<10)
                	{
                		$j = "0".(string)$i.":30:00";
                		
                	}
                	else
                	{
                		$j = (string)$i.":30:00";
                	}
                	$conditon = true;
                	mysql_data_seek($result,0);
                	while ($row = mysql_fetch_assoc($result)) //przeglądaj wynik
                	{
                	    if(strcmp((string)$row['godzinaWizyty'],(string)$j)==0)
                	    {
                   	 		$condition=false;
                		}
                	}
                	if($condition==true)
                	{
                		echo '<tr><td>'.$_GET['YEAR']."-".$_GET['MONTH']."-".$_GET['DAY'].'</td>';
                   	 	echo 	'<td>'.$j.'</td>';
                    	echo 	"<td><INPUT TYPE=\"RADIO\" NAME=\"HOUR\" VALUE=\"".$j."\"/></td>";
                    	echo '</tr>';
                	}
        			$j++;
        		}
        		echo "
				<tr>
					<td colspan=\"3\"><INPUT TYPE=\"SUBMIT\" VALUE=\"ZATWIERDŹ\" NAME=\"ENTER\"></td>
				</tr>";
        		echo '</TABLE>';
        		echo '</FORM>';
        		echo "<BR></center>";
            		
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