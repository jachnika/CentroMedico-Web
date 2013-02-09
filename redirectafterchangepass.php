<?php
//ob_start();
session_start();

	if (isset($_POST["NEWPASSWORD"]) && isset($_POST["CONFIRMEDNEWPASSWORD"]) && isset($_POST["OLDPASSWORD"]))
    {
        $PASSWORD				=   $_POST["OLDPASSWORD"];
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
		
		$NUM_ROWS   =   mysql_num_rows($result);
		
		if ($NUM_ROWS != NULL) 
        {
			while ($row = mysql_fetch_assoc($result)) //przeglądaj wynik
			{
					if($row['password'] == $PASSWORD) //JEŻELI STARE HASŁO JEST ZGODNE Z HASŁEM W BAZIE
					{
						if($_POST['NEWPASSWORD']==$_POST['CONFIRMEDNEWPASSWORD'])//JEŻELI HASŁO NOWE JEST TAKIE SAMO JAK WPROWADZONE PO RAZ DRUGI
						{
							$QUERY      =   "UPDATE Osoby"
										.	" SET password = '" . $_POST['NEWPASSWORD'] . "', firstLogon = '1'"
										.	" WHERE pesel = '" . $_SESSION['USERNAME'] . "'";
							$result     =   MYSQL_QUERY($QUERY) OR DIE ('ZAPYTANIE'.$QUERY.'BLAD'.  mysql_error());  
							$_SESSION['LOGIN']    =   1;   
							header("Location: usermenu.php",303); // i przekierowanie na stronę główną użytkownika
							
						}
						else
						{
							header("Location: logowanie.php?ERROR=ERROR1",303); // złe hasło i wracamy na stronę główną
						
						}
					
					}	
					else
					{
						header("Location: logowanie.php?ERROR=ERROR1",303); // złe hasło i wracamy na stronę główną
					}	
			}
		}
	}
	else
	{
	echo'asdf';
	}


?>