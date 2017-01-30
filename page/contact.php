<?php

// Session/Connexion/Functions
include('../includes/common.php');

// HEAD HTML
define('headTitle', 'challengePHP : Contact');
define('headDescription', 'challengePHP : Contact Page');
include(path . 'includes/head.php');

// Traitement du POST
if(isset($_POST['submit']))
{
  define('fullname', (isset($_POST['fullname']) && trim($_POST['fullname'])) ? mysqli_real_escape_string($db, $_POST['fullname']) : '');
  define('email', (isset($_POST['email']) && trim($_POST['email'])) ? mysqli_real_escape_string($db, $_POST['email']) : '');
  define('msg', (isset($_POST['msg']) && trim($_POST['msg'])) ? mysqli_real_escape_string($db, $_POST['msg']) : '');

  if(fullname && email && msg && checkEmail(email))
  {
    $rslPost = mysqli_query($db, 'INSERT INTO contact(iduser, fullname, email, msg, created) VALUES("'. ($user['id'] ? $user['id'] : 0) .'", "'. fullname .'", "'. email .'", "'. msg .'", now())');

    // Envoi du message par mail
    $message = fullname . "\r\n\r\n\r\n" . msg;
    $message = wordwrap($message, 70, "\r\n");
    mail(email, 'Contact', $message);
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
          <h1 class="page-header">Contact</h1>
          <ol class="breadcrumb">
            <li><a href="<?= path ?>index.html">Home</a>
            </li>
            <li class="active">Contact</li>
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
          if (@$rslPost)
          {
          ?>
          <p id="succ">Le message a bien été envoyé !</p>
          <?php
          }
          ?>
          <form autocomplete="off" action="contact.php" method="post" name="sentMessage" id="contactForm" novalidate>
            <div class="control-group form-group">
              <div class="controls">
                <label>Full Name:</label>
                <div class="input-group">
                  <input name="fullname" type="text" class="form-control" id="fullnameInput">
                  <div class="input-group-addon">
                    <span id="fullnameInputHelp" class="glyphicon glyphicon-remove"></span>
                  </div>
                </div>
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Email Address:</label>
                <div class="input-group">
                  <input name="email" type="email" class="form-control" id="emailInput">
                  <div class="input-group-addon">
                    <span id="emailInputHelp" class="glyphicon glyphicon-remove"></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="control-group form-group">
              <div class="controls">
                <label>Message:</label>
                <div class="input-group">
                  <textarea name="msg" rows="4" cols="100" class="form-control" id="messageInput" maxlength="999" style="resize:none"></textarea>
                  <div class="input-group-addon">
                    <span id="messageInputHelp" class="glyphicon glyphicon-remove"></span>
                  </div>
                </div>
              </div>
            </div>
            <div id="success"></div>
            <button name="submit" type="submit" class="btn btn-primary valid" disabled>Send Message</button>
          </form>
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
