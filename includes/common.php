<?php

// Chemin d'accès
define('path', preg_match('#page|ajax#', $_SERVER['REQUEST_URI']) ? '../' : '');

// Session
session_start();

// Connexion
include(path . 'includes/connexion.php');

// Fonctions
include(path . 'includes/functions.php');

// Connexion de l'utilisateur
if(isset($_POST['send']))
{
  $_SESSION['user'] = (isset($_POST['user']) && trim($_POST['user'])) ? mysqli_real_escape_string($db, $_POST['user']) : '';
  $_SESSION['pass'] = (isset($_POST['pass']) && trim($_POST['pass'])) ? mysqli_real_escape_string($db, md5($_POST['pass'])) : '';
}

// Déconnexion de l'utilisateur
if(isset($_GET['logout']))
{
  session_destroy();
  $_SESSION = array();
  header('Location:' . path . './');
}

// Test de l'utilisateur
$query = mysqli_query($db, 'SELECT *, DATE_FORMAT(birth, "%d/%m/%Y") AS dateBirth FROM users WHERE user="'. @$_SESSION['user'] .'" AND pass="'. @$_SESSION['pass'] .'"');
$user = mysqli_fetch_assoc($query);

?>
