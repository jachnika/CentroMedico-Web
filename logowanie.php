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
						//ZAPYTANIE PONI�EJ SPRAWDZA, CZY ZALOGOWANY U�YTKOWNIK JEST LEKARZEM
						$QUERY      =   "SELECT *"
							.	" FROM Pracownik "
							.	" WHERE idOsoby = '" . $_SESSION['IDUSER'] . "'";
					
						$result     =   MYSQL_QUERY($QUERY) OR DIE ('ZAPYTANIE'.$QUERY.'BLAD'.  mysql_error());
						$NUM_ROWS   =   mysql_num_rows($result);
						//JE�ELI ZALOGOWANY U�YTKOWNIK NIE JEST LEKARZEM 
						if ($NUM_ROWS == NULL) 
        				{
        					echo "
 								<a href=\"index.php\" id=\"home\">HOME</a>
 								<a href=\"order.php\" id=\"makeanappointment\">MAKE AN APPOINTMENT</a>
 								<a href=\"visits.php\" id=\"userappointments\">USER APPOINTMENTS</a>
 								<a href=\"yourdata.php\" id=\"userdetails\">USER DETAILS</a>";
 						}
            			//JE�ELI U�YTKOWNIK JEST LEKARZEM
            			else 
            			{
            				echo "
            					<a href=\"index.php\" id=\"home\">HOME</a>
 								<a href=\"order.php\" id=\"makeanappointment\">MAKE AN APPOINTMENT</a>
 								<a href=\"visits.php\" id=\"userappointments\">USER APPOINTMENTS</a>
 								<a href=\"visityourpatients.php\" id=\"uservisits\">USER APPOINTMENTS</a>
 								<a href=\"yourdata.php\" id=\"userdetails\">USER DETAILS</a>";
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
 			<center>
 				<?PHP
    				if (isset($_GET['ERROR']))
    				{
            			if ($_GET['ERROR'] == 'ERROR')
            			{
                			echo "<FONT COLOR = 'RED'>LOGIN OR PASSWORD ERROR</FONT>";
            			}
            			elseif ($_GET['ERROR'] == 'WYLOGOWANY') 
            			{
                			echo "<FONT COLOR = 'GREEN'>LOGGED OUT</FONT>";
            			}
    				}
            		echo '<p>
           	 			<FORM METHOD = "POST" ACTION="redirect.php" NAME = "FORMULARZ">
            			<TABLE>
                			<tr>
                				<th colspan="2">ENTER USERNAME AND PASSORD:</th>
                			</tr>
                			<TR>
                   		 		<TD>USERNAME*:</TD>
                    			<TD><INPUT TYPE="TEXT" VALUE="" NAME="USERNAME" ID="USERNAME"> </TD>
               				</TR>
               			 	<TR>
                    			<TD>PASSWORD*:</TD>
                    			<TD><INPUT TYPE="PASSWORD" VALUE="PASSWORD" NAME="PASSWORD"></TD>
                			</TR>
                			<TR>
                    			<TD colspan="2"><INPUT TYPE="SUBMIT" VALUE="ZATWIERDZ" NAME="ENTER"></TD>
                			</TR>
            			</TABLE>
            		</FORM>
            		</ BR>
            		</ BR>
        			</p>';
           	?>
           	</center>	
 			</div>
 			
 			<div id="stopka">
 			</div>
 			
 			
 	</div>	
	</BODY>
</HTML>