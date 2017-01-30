<?php

// Session/Connexion/Functions
include('../includes/common.php');

if($user['id'])
{
  define('friend', (isset($_POST['id']) && is_numeric($_POST['id'])) ? $_POST['id'] : '');

  // Vérification que l'utilisateur ne s'ajoute pas lui même
  if(friend && friend != $user['id'])
  {
    // Vérification que la demande n'est pas déjà présente
    $checkFriend = mysqli_query($db, 'SELECT * FROM friends WHERE user="'. $user['id'] .'" AND friend="'. friend .'"');
    $checkFriend = mysqli_fetch_assoc($checkFriend);

    // Vérification que l'utilisateur demandé existe
    $checkUser = mysqli_query($db, 'SELECT id FROM users WHERE id='. friend);
    $checkUser = mysqli_fetch_assoc($checkUser);

    // Ajout de l'ami
    if(!$checkFriend['id'] && $checkUser['id'])
    {
      mysqli_query($db, 'INSERT INTO friends(user, friend, valid) VALUES('. $user['id'] .', '. friend .', 0)');
      echo 'OK';
    }
  }
}

?>
