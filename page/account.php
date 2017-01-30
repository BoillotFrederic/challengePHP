<?php

// Session/Connexion/Functions
include('../includes/common.php');

// HEAD HTML
define('headTitle', 'challengePHP : Account');
define('headDescription', 'challengePHP : Account Page');
include(path . 'includes/head.php');

// Traitement du POST
if(isset($_POST['submit']))
{
  define('user', (isset($_POST['user']) && trim($_POST['user'])) ? mysqli_real_escape_string($db, $_POST['user']) : '');
  define('pass', (isset($_POST['pass']) && trim($_POST['pass'])) ? mysqli_real_escape_string($db, $_POST['pass']) : '');
  define('rePass', (isset($_POST['rePass']) && trim($_POST['rePass'])) ? mysqli_real_escape_string($db, $_POST['rePass']) : '');
  define('email', (isset($_POST['email']) && trim($_POST['email'])) ? mysqli_real_escape_string($db, $_POST['email']) : '');

  if(user && email && pass && rePass && (pass == rePass) && checkEmail(email) && !preg_match('#[0-9]#', user) && strlen(user) <= 30)
  $rslPost = mysqli_query($db, 'INSERT INTO users(user, pass, email, created) VALUES("'. user .'", "'. md5(pass) .'", "'. email .'", now())');
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
          <h1 class="page-header">Account</h1>
          <ol class="breadcrumb">
            <li><a href="<?= path ?>index.html">Home</a>
            </li>
            <li class="active">Account</li>
          </ol>
        </div>
      </div>
      <!-- /.row -->

      <!-- Content Row -->
      <div class="row">
        <!-- Form Column -->
        <div class="col-md-4">
          <!-- Contact form -->
          <?php
          if (!@$rslPost)
          {
          ?>
          <form autocomplete="off" action="account.php" method="post" name="account" id="account">
            <div class="control-group form-group">
              <div class="controls">
                <label>Pseudo:</label>
                <div class="input-group">
                  <input maxlength="30" name="user" type="text" class="form-control" id="userInput">
                  <div class="input-group-addon">
                    <span id="userInputHelp" class="glyphicon glyphicon-remove"></span>
                  </div>
                </div>
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Email:</label>
                <div class="input-group">
                  <input name="email" type="text" class="form-control" id="emailInput">
                  <div class="input-group-addon">
                    <span id="emailInputHelp" class="glyphicon glyphicon-remove"></span>
                  </div>
                </div>
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Mot de passe:</label>
                <div class="input-group">
                  <input name="pass" type="password" class="form-control" id="passInput">
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-remove passInputHelp"></span>
                  </div>
                </div>
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Tapez à nouveau le mot de passe:</label>
                <div class="input-group">
                  <input name="rePass" type="password" class="form-control" id="rePassInput">
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-remove passInputHelp"></span>
                  </div>
                </div>
                <p class="help-block"></p>
              </div>
            </div>

            <div id="success"></div>
            <button name="submit" type="submit" class="btn btn-primary valid" disabled>Créer mon compte</button>
          </form>
          <?php
          }
          else
          {
          ?>
          <p>Le compte a bien été créé !</p>
          <?php
          }
          ?>
        </div>
        <div class="col-md-8" id="Err">
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Footer -->
      <?php include(path . 'includes/footer.php'); ?>
    </div>
    <!-- /.container -->

    <?php include(path . 'includes/jsBottom.php'); ?>
  </body>
</html>
