<?php

// Suppression des espaces en début et fin de chaque entrée d'un array
function trimArray(&$array)
{
  array_walk($array, '_trimArray');
}

function _trimArray(&$item)
{
  $item = trim($item);
}

// Vérification de l'addresse email
function checkEmail($str)
{
  return preg_match('#[a-z][a-z0-9_.]*@[a-z][a-z0-9_.]*\.[a-z]{2,4}#', $str);
}

// Vérification de la date
function checkDat($str)
{
  return preg_match('#[0-9]{2}/[0-9]{2}/[0-9]{4}#', $str);
}

?>
