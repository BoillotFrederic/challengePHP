<?php

// Session/Connexion/Functions
include('../includes/common.php');

// Vérification si l'utilisateur est admin
$isAdmin = $user['admin'] ? true : false;

// Modification des couleurs
if(isset($_POST['sendColor']) && $isAdmin)
{
  $title = isset($_POST['colorTitle']) ? $_POST['colorTitle'] : '';
  $navbar = isset($_POST['colorNavBar']) ? $_POST['colorNavBar'] : '';
  $urls = isset($_POST['colorUrl']) ? $_POST['colorUrl'] : '';
  $button = isset($_POST['colorButton']) ? $_POST['colorButton'] : '';
  $fixednavbar = isset($_POST['fixedNavBar']) ? 1 : 0;

  $updateColor = mysqli_query($db, 'UPDATE config SET ctitle="' . $title . '", cnavbar="' . $navbar . '", curls="' . $urls . '", cbutton="' . $button . '", fixednavbar=' . $fixednavbar);
}


// HEAD HTML
define('headTitle', 'challengePHP : Admin');
define('headDescription', 'challengePHP : Admin Page');
include(path . 'includes/head.php');

?>
  <body>
    <!-- Navigation -->
    <?php include(path . 'includes/navBar.php'); ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Administration</h1>
          <ol class="breadcrumb">
            <li><a href="<?= path ?>index.html">Home</a>
            </li>
            <li class="active">Administration</li>
          </ol>
        </div>
      </div>
      <!-- /.row -->

      <?php

      if ($isAdmin)
      {
      ?>
      <!-- Content Row -->
      <div class="row">
        <div class="col-md-6">
          <h2 class="page-header">Configuration du CSS</h2>
          <?php
          if (@$updateColor)
          {
          ?>
          <small>Les couleurs ont été mise à jours</small>
          <?php
          }
          ?>
          <form name="changeTheme" action="admin.php" method="post" id="contactForm" novalidate>
            <div class="row">
              <div class="col-md-6">
                <div class="control-group form-group">
                  <div class="controls">
                    <label>Couleur des titres:</label>
                    <input name="colorTitle" type="text" class="form-control" id="colorTitle" value="<?= $config['ctitle']; ?>">
                    <p class="help-block"></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="control-group form-group">
                  <div class="controls">
                    <label>Couleur de la navbar:</label>
                    <input name="colorNavBar" type="text" class="form-control" id="colorNavBar" value="<?= $config['cnavbar']; ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="control-group form-group">
                  <div class="controls">
                    <label>Couleur des URLs:</label>
                    <input name="colorUrl" type="text" class="form-control" id="colorUrl" value="<?= $config['curls']; ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="control-group form-group">
                  <div class="controls">
                    <label>Couleur des boutons:</label>
                    <input name="colorButton" type="text" class="form-control" id="colorButton" value="<?= $config['cbutton']; ?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="control-group form-group">
                <div class="checkbox">
                  <label>
                    <input name="fixedNavBar" type="checkbox"<?php echo $config['fixednavbar'] ? ' checked="checked"' : '' ?>> Fixer la navbar
                  </label>
                </div>
              </div>
            </div>
            <div id="success"></div>
            <div class="col-md-12">
              <button name="sendColor" value="true" type="submit" class="btn btn-primary">Change color</button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <h2 class="page-header">Messages</h2>
          <?php
          // Récupération des messages
          $query = mysqli_query($db, 'SELECT * FROM contact ORDER BY created DESC LIMIT 0,10');
          while($data = mysqli_fetch_assoc($query))
          {
          ?>
          <div class="contactMsg">
            <span>Full Name</span> : <?= $data['fullname'] ?> |
            <span>Email</span> : <?= $data['email'] ?>
            <?php
            if($data['iduser'])
            {
              $query = mysqli_query($db, 'SELECT *, DATE_FORMAT(birth, "%d/%m/%Y") AS birthFormat FROM users WHERE id=' . $data['iduser']);
              $dataUser = mysqli_fetch_assoc($query);
            ?>
            <br />
            <span>Pseudo</span> : <?= $dataUser['user'] ?> |
            <span>Prénom</span> : <?= $dataUser['lastname'] ?>
            <br />
            <span>Jeux</span> : <?= $dataUser['games'] ?> |
            <span>Date de naissance</span> : <?= $dataUser['birthFormat'] ?>
            <?php
            }
            ?>
            <hr />
            <?= $data['msg'] ?>
          </div>
          <?php
          }
          ?>
        </div>
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
