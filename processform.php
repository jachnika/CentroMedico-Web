<?PHP
	ob_start();
	session_start();
    if (isset($_GET["USERNAME"]) && isset($_GET["PASSWORD"]))
    {
		$_SESSION['USERNAME']	=	$_GET["USERNAME"];
        $PASSWORD				=   $_GET["PASSWORD"];
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
			
		$QUERY      =   "SELECT *"
					.	" FROM Osoby"
					.	" WHERE pesel = '" . $_SESSION['USERNAME'] . "'";
					
		$result     =   MYSQL_QUERY($QUERY) OR DIE ('ZAPYTANIE'.$QUERY.'BLAD'.  mysql_error());
		
		$NUM_ROWS   =   mysql_num_rows($result);
		
		if ($NUM_ROWS != NULL) 
        {
			while ($row = mysql_fetch_assoc($result)) //przeglądaj wynik
				{
					$_SESSION['IDUSER'] = $row['idOsoby'];
					
					if(($row['pesel'] == $_SESSION['USERNAME']) AND ($row['firstLogon'] == 1 )) //jeżeli login się zgadza i nie jest to pierwsze logowanie
					{
						if($row['password'] == $PASSWORD) //jeżeli hasło jest zgodne to zmiennej sesyjnej przypisz wart 1 co oznacza, że użytkownik jest zalogowany
						{
							$_SESSION['LOGIN']    =   1;
							header("Location: usermenu.php",303); // i przekierowanie na stronę główną użytkownika
						}
						else
						{
							header("Location: logowanie.php?ERROR=ERROR1",303); // złe hasło i wracamy na stronę główną
						}
					}
					elseif (($row['pesel'] == $_SESSION['USERNAME']) AND ($row['firstLogon'] == 0 ))
					{
						header("Location: changepass.php"); // login prawidłowy natomiast pierwsze logowanie wymusza zmianę hasła
					}
					else
					{
						header("Location: logowanie.php?ERROR=ERROR2",303); // zły login więc wracamy na stronę logowania
					}
				}		
		}
		else
		{
			header("Location: logowanie.php?ERROR=ERROR2",303); // zły login więc wracamy na stronę logowania
		}
	}
	/*Wartości zmiennych:
		LOGIN 	--> not initialized - nie zalogowany 
					--> 1				- zalogowany
		ERROR		--> error1			- błąd hasła
					--> error2			- błąd loginu
		*/
?>