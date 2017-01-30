<?php

// Session/Connexion/Functions
include('../includes/common.php');

// Vérification si l'utilisateur est admin
$isAdmin = $user['admin'] ? true : false;

// Changement de config
if(isset($_GET['change']) && is_numeric($_GET['change']))
{
  mysqli_query($db, 'UPDATE config SET selected=0');
  mysqli_query($db, 'UPDATE config SET selected=1 WHERE id=' . $_GET['change']);
  header('Location:admin.php');
}

// Modification des couleurs
if((isset($_POST['modConfig']) || isset($_POST['addConfig'])) && $isAdmin)
{
  $nameconfig = isset($_POST['nameconfig']) ? $_POST['nameconfig'] : '';
  $title = isset($_POST['colorTitle']) ? $_POST['colorTitle'] : '';
  $navbar = isset($_POST['colorNavBar']) ? $_POST['colorNavBar'] : '';
  $urls = isset($_POST['colorUrl']) ? $_POST['colorUrl'] : '';
  $button = isset($_POST['colorButton']) ? $_POST['colorButton'] : '';
  $fontTitle = isset($_POST['fontTitle']) ? $_POST['fontTitle'] : '';
  $fixednavbar = isset($_POST['fixedNavBar']) ? 1 : 0;
  $jsSnow = isset($_POST['jsSnow']) ? 1 : 0;

  if (isset($_POST['modConfig']))
  $modConfig = mysqli_query($db, 'UPDATE config SET nameconfig="'. $nameconfig .'", ctitle="' . $title . '", cnavbar="' . $navbar . '", curls="' . $urls . '", cbutton="' . $button . '", ftitle="'. $fontTitle .'", fixednavbar=' . $fixednavbar .', jsSnow=' . $jsSnow . ' WHERE selected');

  elseif (isset($_POST['addConfig']))
  {
    mysqli_query($db, 'UPDATE config SET selected=0 WHERE selected');
    $addConfig = mysqli_query($db, 'INSERT INTO config (nameconfig, ctitle, cnavbar, curls, cbutton, ftitle, fixednavbar, jsSnow) VALUES("'. $nameconfig .'", "'. $title .'", "'. $navbar .'", "'. $urls .'", "'. $button .'", "'. $fontTitle .'", "'. $fixednavbar .'", "'. $jsSnow .'")');
  }
}

// Suppression des messages
if(isset($_GET['supprMsgContact']))
{
  mysqli_query($db, 'DELETE FROM contact WHERE id=' . $_GET['supprMsgContact']);
  header('Location:admin.php');
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
          <h2 class="page-header">Configuration</h2>
          <?php
          if (@$modConfig)
          {
          ?>
          <p id="succ">La configuration a été mise à jours</p>
          <?php
          }
          elseif(@$addConfig)
          {
          ?>
          <p id="succ">La configuration a été mise ajouté et sélectionné</p>
          <?php
          }
          ?>
          <div class="row">
            <div class="col-md-12">
              <div class="control-group form-group">
                <div class="controls">
                  <label>Config sélectionné:</label>
                  <select id="changeConfig" class="form-control">
                    <?php
                    $queryConfig = mysqli_query($db, 'SELECT id, nameconfig FROM config');
                    while($dataConfig = mysqli_fetch_assoc($queryConfig))
                    {
                    ?>
                    <option value="<?= $dataConfig['id'] ?>"<?php if($config['id'] == $dataConfig['id']) echo ' selected'; ?>><?= $dataConfig['nameconfig'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <form name="changeTheme" action="admin.php" method="post" id="contactForm" novalidate>
            <div class="row">
              <div class="col-md-6">
                <div class="control-group form-group">
                  <div class="controls">
                    <label>Nom du style:</label>
                    <input name="nameconfig" type="text" class="form-control" id="nameconfig" value="<?= $config['nameconfig']; ?>">
                    <p class="help-block"></p>
                  </div>
                </div>
              </div>
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
              <div class="col-md-6">
                <div class="control-group form-group">
                  <div class="controls">
                    <label>Font Family des titre:</label>
                    <select id="fontTitle" name="fontTitle" class="form-control">
                      <option<?= (($fTitle == "'Prata', serif") ? ' selected' : '') ?>>'Prata', serif</option>
                      <option<?= (($fTitle == "'Carme', sans-serif") ? ' selected' : '') ?>>'Carme', sans-serif</option>
                      <option<?= (($fTitle == "'PT Serif Caption', serif") ? ' selected' : '') ?>>'PT Serif Caption', serif</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="control-group form-group">
                  <div class="checkbox">
                    <label>
                      <br />
                      <input name="jsSnow" type="checkbox"<?php echo $config['jsSnow'] ? ' checked="checked"' : '' ?>> Faire tomber les neiges
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="control-group form-group">
                  <div class="checkbox">
                    <label>
                      <br />
                      <input name="fixedNavBar" type="checkbox"<?php echo $config['fixednavbar'] ? ' checked="checked"' : '' ?>> Fixer la navbar
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div id="success"></div>
            <div class="col-md-12">
              <button name="addConfig" value="true" type="submit" class="btn btn-primary">Nouvelle config</button>
              <button name="modConfig" value="true" type="submit" class="btn btn-primary">Modifier</button>
              <button onclick="return false;" name="supprConfig" value="true" type="submit" class="btn btn-primary">Supprimer</button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <h2 class="page-header">Aperçu</h2>
          <div id="preview">
            <nav id="navBarPreview" class="navbar navbar-inverse" role="navigation">
              <div class="container">
                <!-- Left -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Logo preview</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-left">
                    <li>
                      <a href="#">Preview link</a>
                    </li>
                  </ul>
                </div>
                <!-- /.navbar-collapse -->
              </div>
              <!-- /.container -->
            </nav>
            <h2 id="titlePreview" class="page-header">Preview title</h2>
            <a id="urlPreview" href="#">Preview link</a>
            <br /><br />
            <button id="btnPreview" class="btn btn-secondary">Preview button</button>
          </div>
        </div>
        <div class="col-md-12">
          <h2 class="page-header">Messages</h2>
          <?php
          // Récupération des messages
          $query = mysqli_query($db, 'SELECT *, DATE_FORMAT(created, "%d/%m/%Y") AS dateCreated FROM contact ORDER BY created DESC LIMIT 0,10');
          while($data = mysqli_fetch_assoc($query))
          {
          ?>
          <div class="contactMsg">
            <div>
              <a href="javascript:supprElm(<?= $data['id'] ?>, 'admin.php?supprMsgContact')">
                <img src="<?= path ?>img/close.png" alt="Supprimer" />
              </a>
              <span>Full Name</span> : <?= $data['fullname'] ?> |
              <span>Email</span> : <?= $data['email'] ?>
              <?php
              if($data['iduser'])
              {
                $queryUser = mysqli_query($db, 'SELECT *, DATE_FORMAT(birth, "%d/%m/%Y") AS birthFormat FROM users WHERE id=' . $data['iduser']);
                $dataUser = mysqli_fetch_assoc($queryUser);

                if($dataUser['imgprofil'])
                {
                ?>
                <img class="imgProfil" src="<?= path ?>img/profils/<?= $dataUser['imgprofil'] ?>" alt="Profil" />
                <?php
              }
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
            </div>
            <hr />
            <p><?= $data['msg'] ?></p>
            <span class="contactMsgCreated">Envoyé le <?= $data['dateCreated'] ?></span>
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

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              Êtes vous sur ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button id="modalYes" onclick="" type="button" class="btn btn-primary">Oui</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <?php include(path . 'includes/footer.php'); ?>
    </div>
    <!-- /.container -->

    <?php include(path . 'includes/jsBottom.php'); ?>
  </body>
</html>
