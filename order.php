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
    					echo "<p>
            				<FORM METHOD = \"GET\" ACTION=\"orderhour.php\" NAME = \"ZAMOWIENIE\">
           						<TABLE>
                					<tr>
                						<th colspan=\"3\">
                       						 WPROWADŹ DATĘ WIZYTY:
                						</th>
                					</tr>
            
               						 <TR>
                   						 <TD>
                       						 DZIEŃ
                    					</TD>
                    					<TD>
                        					MIESIĄC
                    					</TD>
                    					<TD>
                        					ROK
                    					</TD>
                					</TR>
                					<TR>
                   						 <TD>
                        					<INPUT TYPE=\"TEXT\" VALUE=\"01\" NAME=\"DAY\" ID=\"DAY\">
                    					</TD>
                    					<TD>
                       						<INPUT TYPE=\"TEXT\" VALUE=\"01\" NAME=\"MONTH\" ID=\"MONTH\">
                    					</TD>
                    					<TD>
                        					<INPUT TYPE=\"TEXT\" VALUE=\"2012\" NAME=\"YEAR\" ID=\"YEAR\">
                    					</TD>
                					</TR>
            
                					<tr>
                						<th colspan=\"3\">
                        					WYBIERZ LEKARZA:
                						</th>
                					</tr>
                					<tr>
										<td colspan=\"2\">NAZWISKO</td>
										<td>WYBÓR</td>
									</tr>"
										;
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
									$QUERY2		= 	"SELECT P.idOsoby as idOsoby, nazwisko, imie FROM Pracownik P JOIN Osoby O ON P.idOsoby = O.idOsoby WHERE etat = 'Lekarz'";
									$_SESSION['result2']     =   MYSQL_QUERY($QUERY2) OR DIE ('ZAPYTANIE'.$QUERY2.'BLAD'.  mysql_error());
									$NUM_ROWS2   =   mysql_num_rows($result2);
				
            						while ($row = mysql_fetch_assoc($_SESSION['result2'])) //przeglądaj wynik
									{
										echo "<tr>
											<td colspan=\"2\">".$row['nazwisko']." ".$row['imie']."</td>
											<td><INPUT TYPE=\"RADIO\" NAME=\"LEKARZ\" VALUE=\"".$row['idOsoby']."\"/></td>
						  					</tr>";
									}
									echo "
										<tr>
											<th colspan=\"3\">OBJAWY</th>
										</tr>
										<tr>
											<td colspan=\"3\"><INPUT TYPE=\"TEXT\" VALUE=\"OBJAWY\" NAME=\"OBJAWY\"></td>
										</tr>
										<tr>
											<td colspan=\"3\"><INPUT TYPE=\"SUBMIT\" VALUE=\"ZATWIERDŹ\" NAME=\"ENTER\"></td>
										</tr>
        						</TABLE>
            				</FORM>
            				</ BR>
            				</ BR>
        					</p>";
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