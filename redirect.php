<?php
session_start();
header("Location: processform.php?USERNAME=".$_POST['USERNAME']."&PASSWORD=".$_POST['PASSWORD'],303);
exit();
?>
