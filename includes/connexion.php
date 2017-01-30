<?php

$db = mysqli_connect("localhost", "root", "Az3rty", "challengePHP")
or die("Impossible de se connecter : " . mysql_error());

mysqli_query($db, 'SET NAMES utf8');

?>
