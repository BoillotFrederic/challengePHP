<?php

// Session/Connexion/Functions
include('../includes/common.php');

// HEAD HTML
define('headTitle', 'challengePHP : Profil');
define('headDescription', 'challengePHP : Profil Page');
include(path . 'includes/head.php');

// Traitement du POST
if(isset($_POST['submit']) && $user['id'])
{
  define('lastname', (isset($_POST['lastname']) && trim($_POST['lastname'])) ? mysqli_real_escape_string($db, $_POST['lastname']) : '');
  define('email', (isset($_POST['email']) && trim($_POST['email'])) ? mysqli_real_escape_string($db, $_POST['email']) : '');
  define('games', (isset($_POST['games']) && trim($_POST['games'])) ? mysqli_real_escape_string($db, $_POST['games']) : '');
  define('birth', (isset($_POST['birth']) && trim($_POST['birth'])) ? mysqli_real_escape_string($db, $_POST['birth']) : '');
  define('pass', (isset($_POST['pass']) && trim($_POST['pass'])) ? mysqli_real_escape_string($db, $_POST['pass']) : '');
  define('rePass', (isset($_POST['rePass']) && trim($_POST['rePass'])) ? mysqli_real_escape_string($db, $_POST['rePass']) : '');

  if(isset($_FILES['imgProfil']['name']) && $_FILES['imgProfil']['name'] != '')
  {
    $fileName = basename($_FILES['imgProfil']['name']);
    $fileTmpName = $_FILES['imgProfil']['tmp_name'];
    $fileType = $_FILES['imgProfil']['type'];

    switch ($fileType)
    {
      case 'image/jpeg': $ext = ".jpg"; break;
      case 'image/png': $ext = ".png"; break;
      case 'image/gif': $ext = ".gif"; break;
    }

    $fileNewName = $user['id'] . md5(rand()) . @$ext;

    list($lastWidth, $lastHeight) = @getimagesize($fileTmpName);
  }
  else $fileName = '';


  if(!email)
  $errPost = 'L\'email est obligatoire !';
  elseif(!checkEmail(email))
  $errPost = 'Le format d\'email est incorrect !';
  elseif(!checkDat(birth))
  $errPost = 'Le format de la date est incorrect !';
  elseif(pass && pass != rePass)
  $errPost = 'Les mots de passe ne sont pas identique !';
  elseif($fileName && !$ext)
  $errPost = 'JPG, GIF, PNG uniquement !';
  elseif($fileName && $lastWidth != 100 && $lastHeight != 100)
  $errPost = 'La taille doit être de 100 x 100 !';
  elseif($fileName && !move_uploaded_file($fileTmpName, $_SERVER['DOCUMENT_ROOT'] . '/challengePHP/img/profils/' . $fileNewName))
  $errPost = 'L\'upload de l\'image a échoué !';
  else
  {
    $birth = implode('-', array_reverse(explode('/', birth)));

    if (pass)
    {
      $pass = ', pass="' . md5(pass) . '" ';
      $_SESSION['pass'] = md5(pass);
    }
    else $pass = '';

    $fileNewName = @$fileNewName ? ', imgprofil="' . @$fileNewName . '" ' : '';
    if($fileNewName) @unlink($_SERVER['DOCUMENT_ROOT'] . '/challengePHP/img/profils/' . $user['imgprofil']);

    $rslPost = mysqli_query($db, 'UPDATE users SET lastname="'. lastname .'", email="'. email .'", games="'. games .'", birth="'. $birth .'"'. $pass . $fileNewName .' WHERE id=' . $user['id']);
  }
}

?>
  <body>
    <!-- Navigation -->
    <?php include(path . 'includes/navBar.php'); ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Profil</h1>
          <ol class="breadcrumb">
            <li><a href="<?= path ?>index.html">Home</a>
            </li>
            <li class="active">Profil</li>
          </ol>
        </div>
      </div>
      <!-- /.row -->

      <?php
      if($user['id'])
      {
        if (@$errPost)
        echo '<div id="err">'. $errPost .'</div>';

        if (@$rslPost)
        {
        ?>
        <p id="succ">Le profil a bien été modifié !</p>
        <?php
        }
        ?>
      <!-- Content Row -->
      <div class="row">
        <!-- Form Column -->
          <!-- Contact form -->
          <form enctype="multipart/form-data" action="profilUp.php" method="post" name="sentMessage">
            <div class="col-md-4">
              <div class="control-group form-group">
                <div class="controls">
                  <label>Prénom:</label>
                  <input name="lastname" type="text" class="form-control" value="<?= $user['lastname'] ?>" id="lastName">
                  <p class="help-block"></p>
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <label>Email:</label>
                  <div class="input-group">
                    <input name="email" type="text" class="form-control" value="<?= $user['email'] ?>"  id="emailInput">
                    <div class="input-group-addon">
                      <span id="emailInputHelp" class="glyphicon glyphicon-ok"></span>
                    </div>
                  </div>
                  <p class="help-block"></p>
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <label>Jeux:</label>
                  <input name="games" type="text" class="form-control" value="<?= $user['games'] ?>"  id="games">
                  <p class="help-block"></p>
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <label>Date de naissance:</label>
                  <div class="input-group">
                    <input name="birth" type="text" class="form-control" value="<?= $user['dateBirth'] ?>"  id="dateInput">
                    <div class="input-group-addon">
                      <span id="dateInputHelp" class="glyphicon glyphicon-ok"></span>
                    </div>
                  </div>
                  <p class="help-block"></p>
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <label>Nouveau mot de passe:</label>
                  <div class="input-group">
                    <input name="pass" type="password" class="form-control" id="passInputProfil">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-ok passInputProfilHelp"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <label>Tapez à nouveau le mot de passe:</label>
                  <div class="input-group">
                    <input name="rePass" type="password" class="form-control" id="rePassInputProfil">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-ok passInputProfilHelp"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <img src="<?= path ?>img/profils/<?= ($user['imgprofil'] ? $user['imgprofil'] : 'default.png') ?>" alt="Profil" />
              <br /><br />
              <input type="file" name="imgProfil" />
              <small>100 x 100 uniquement</small>
            </div>
            <div class="col-md-12">
              <div id="success"></div>
              <button name="submit" type="submit" class="btn btn-primary valid">Enregistré</button>
            </div>
          </form>
      </div>
        <?php
        }
        ?>
      <!-- /.row -->

      <hr>

      <!-- Footer -->
      <?php include(path . 'includes/footer.php'); ?>
    </div>
    <!-- /.container -->

    <?php include(path . 'includes/jsBottom.php'); ?>
  </body>
</html>
