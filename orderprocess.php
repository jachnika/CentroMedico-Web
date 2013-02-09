<?php
ob_start();
	session_start();
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
   	
    //SZUKAMY OSOBY W BAZIE DANYCH
    $QUERY      =   "SELECT *"
					.	" FROM Osoby"
					.	" WHERE pesel = '" . $_SESSION['USERNAME'] . "'";
					
	$result     =   MYSQL_QUERY($QUERY) OR DIE ('ZAPYTANIE'.$QUERY.'BLAD'.  mysql_error());
	
	while ($row = mysql_fetch_assoc($result)) //przeglądaj wynik
                	{
                	    $IDUSER=$row['idOsoby'];
                	}
    
	
	$QUERY      =   "INSERT INTO Wizyty (dataWizyty,godzinaWizyty, idPacjenta, idLekarza, objawy) VALUES ("
				.	"\"" . $_SESSION['DATE'] . "\", "
				.	"\"" . $_SESSION['GODZINA'] . "\", "
				.	"\"" . $IDUSER . "\", "
				.	"\"" . $_SESSION['LEKARZ'] . "\", "
				.   "\"" . $_SESSION['OBJAWY'] . "\")";
	
	$result     =   MYSQL_QUERY($QUERY) OR DIE ('ZAPYTANIE'.$QUERY.'BLAD'.  mysql_error());
	header("Location: ordered.php");
?>