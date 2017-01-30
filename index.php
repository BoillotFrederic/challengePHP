<?php

// Session/Connexion/Functions
include('includes/common.php');

// HEAD HTML
define('headTitle', 'challengePHP : Home');
define('headDescription', 'challengePHP : Home Page');
include('includes/head.php');

// Suppression d'un slide
if(isset($_GET['supprSlide']) && is_numeric($_GET['supprSlide']) && $user['admin'])
{
  $querySlideDel = mysqli_query($db, 'SELECT slide FROM homeslides WHERE id=' . $_GET['supprSlide']);
  $slideImg = mysqli_fetch_assoc($querySlideDel);
  $slideImg = $slideImg['slide'];

  @unlink('img/slides/' . $slideImg);

  mysqli_query($db, 'DELETE FROM homeslides WHERE id=' . $_GET['supprSlide']);

  header('Location:./');
}

// Modification d'un slide
if(isset($_POST['editSlide']) && $user['admin'])
{
  define('idSlide', (isset($_POST['id']) && is_numeric($_POST['id'])) ? $_POST['id'] : '');
  define('name', isset($_POST['nameSlide']) ? mysqli_real_escape_string($db, trim($_POST['nameSlide'])) : '');
  define('description', isset($_POST['descriptionSlide']) ? mysqli_real_escape_string($db, trim($_POST['descriptionSlide'])) : '');

  if(name && description && strlen(name) <= 30 && strlen(description) >= 10 && idSlide)
  {
    $fileName = basename($_FILES['fileSlide']['name']);
    $fileNameTmp = $_FILES['fileSlide']['tmp_name'];
    $fileType = $_FILES['fileSlide']['type'];

    switch ($fileType)
    {
      case 'image/jpeg': $ext = '.jpg'; break;
      case 'image/gif': $ext = '.gif'; break;
      case 'image/png': $ext = '.png'; break;
      default: $ext = '';
    }

    if($ext)
    {
      $newName = md5(rand()) . $ext;
      if(@move_uploaded_file($fileNameTmp, $_SERVER['DOCUMENT_ROOT'] . '/challengePHP/img/slides/' . $newName))
      {
        $querySlideEdit = mysqli_query($db, 'SELECT slide FROM homeslides WHERE id=' . idSlide);
        $slideImg = mysqli_fetch_assoc($querySlideEdit);
        $slideImg = $slideImg['slide'];

        @unlink('img/slides/' . $slideImg);
        $newName = ', slide="' . $newName .'"';
      }
      else $newName = '';
    }
    else $newName = '';

    mysqli_query($db, 'UPDATE homeslides SET name="'. name .'", description="'. description .'"'. $newName .' WHERE id='. idSlide);
  }
}

// Ajout d'un slide
if(isset($_POST['addSlide']) && $user['admin'])
{
  define('name', isset($_POST['addName']) ? mysqli_real_escape_string($db, trim($_POST['addName'])) : '');
  define('description', isset($_POST['addDescription']) ? mysqli_real_escape_string($db, trim($_POST['addDescription'])) : '');

  if(name && description && strlen(name) <= 30 && strlen(description) >= 10)
  {
    $fileName = basename($_FILES['addFileSlide']['name']);
    $fileNameTmp = $_FILES['addFileSlide']['tmp_name'];
    $fileType = $_FILES['addFileSlide']['type'];

    switch ($fileType)
    {
      case 'image/jpeg': $ext = '.jpg'; break;
      case 'image/gif': $ext = '.gif'; break;
      case 'image/png': $ext = '.png'; break;
      default: $ext = '';
    }

    if($ext)
    {
      $newName = md5(rand()) . $ext;
      if(@move_uploaded_file($fileNameTmp, $_SERVER['DOCUMENT_ROOT'] . '/challengePHP/img/slides/' . $newName))
      mysqli_query($db, 'INSERT INTO homeslides(name, description, slide) VALUES("'. name .'", "'. description .'", "'. $newName .'")');
    }
  }
}

?>
  <body>
    <!-- Navigation -->
    <?php include('includes/navBar.php'); ?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
      <!-- Indic -->
      <ol class="carousel-indicators">
        <?php
        $i = 0;
        $querySlides = mysqli_query($db, 'SELECT * FROM homeslides ORDER BY id DESC');
        while($dataSlides = mysqli_fetch_assoc($querySlides))
        {
        ?>
        <li data-target="#myCarousel" data-slide-to="<?= $i ?>"<?= ($i == 0 ? ' class="active"' : '') ?>></li>
        <?php
        $i++;
        }
        ?>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?php
          $i = 0;
          mysqli_data_seek($querySlides, 0);
          while($dataSlides = mysqli_fetch_assoc($querySlides))
          {
          ?>
          <div data-id="<?= $dataSlides['id'] ?>" class="item<?= ($i == 0 ? ' active' : '') ?>">
            <div class="fill" style="background-image:url('<?= path ?>img/slides/<?= $dataSlides['slide'] ?>');"></div>
            <div class="carousel-caption">
              <h2><?= $dataSlides['name'] ?></h2>
              <p><?= $dataSlides['description'] ?></p>
            </div>
          </div>
          <?php
          $i++;
          }
          ?>
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
      </a>
      <?php
      if($user['admin'])
      {
      ?>
      <div class="editBox">
        <img id="slideEdit" src="img/edit.png" alt="" />
        <img id="slideDel" src="img/del.png" alt="" />
        <img id="slideAdd" src="img/add.png" alt="" />
      </div>
      <?php
      }
      ?>
    </header>

    <!-- Page Content -->
    <div class="container">

      <!-- Icons Section -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome !
          </h1>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4><i class="fa fa-fw fa-check"></i> Lorem ipsum7</h4>
            </div>
            <div class="panel-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
              <a href="#" class="btn btn-default">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4><i class="fa fa-fw fa-gift"></i> Dolor Sit</h4>
            </div>
            <div class="panel-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
              <a href="#" class="btn btn-default">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4><i class="fa fa-fw fa-compass"></i> Amet</h4>
            </div>
            <div class="panel-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
              <a href="#" class="btn btn-default">Learn More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Repertory Section -->
      <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Last creation</h2>
        </div>
        <?php
        $queryMember = mysqli_query($db, 'SELECT imgprofil FROM users ORDER BY created DESC LIMIT 0,6');
        while($dataMem = mysqli_fetch_assoc($queryMember))
        {
        ?>
        <div class="portfolio-item col-md-4 col-sm-6">
          <a href="<?= path ?>page/repertory.php">
            <img style="background-image:url('img/profils/<?= ($dataMem['imgprofil'] ? $dataMem['imgprofil'] : 'default.png') ?>');" class="imgPort img-responsive img-portfolio img-hover" src="" alt="">
          </a>
        </div>
        <?php
        }
        ?>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Call to Action Section -->
      <div class="well">
        <div class="row">
          <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
          </div>
          <div class="col-md-4">
            <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
          </div>
        </div>
      </div>

      <hr>

      <!-- Modal -->
      <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="editFormLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="editFormLabel">Modification du slide</h4>
            </div>
            <div class="modal-body">
              <form onclick="checkArea = '#editFormSubmit'" id="editFormSubmit" enctype="multipart/form-data" action="./" method="post">
                <div class="form-group">
                  <label for="nameSlide">Titre du slide</label>
                  <div class="input-group">
                    <input data-size="30" maxlength="30" name="nameSlide" type="text" class="form-control" id="nameSlide">
                    <div class="input-group-addon">
                      <span id="nameSlideHelp" class="glyphicon glyphicon-ok"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="descriptionSlide">Description</label>
                  <div class="input-group">
                    <input data-size="10" name="descriptionSlide" type="text" class="form-control" id="descriptionSlide">
                    <div class="input-group-addon">
                      <span id="descriptionSlideHelp" class="glyphicon glyphicon-ok"></span>
                    </div>
                  </div>
                </div>
                <input id="id" name="id" type="hidden" />
                <div class="form-group">
                  <label for="fileSlide">Image du slide <small>(vide pour laisser l'ancien)</small></label>
                  <input name="fileSlide" type="file" id="fileSlide">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                  <button name="editSlide" type="submit" class="btn btn-primary valid">Modifier</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="addFormLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="addFormLabel">Ajout d'un slide</h4>
            </div>
            <div class="modal-body">
              <form onclick="checkArea = '#addFormSubmit'" id="addFormSubmit" enctype="multipart/form-data" action="./" method="post">
                <div class="form-group">
                  <label for="addName">Titre du slide</label>
                  <div class="input-group">
                    <input data-size="30" maxlength="30" name="addName" type="text" class="form-control" id="addName">
                    <div class="input-group-addon">
                      <span id="addNameHelp" class="glyphicon glyphicon-remove"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="addDescription">Description</label>
                  <div class="input-group">
                    <input data-size="10" name="addDescription" type="text" class="form-control" id="addDescription">
                    <div class="input-group-addon">
                      <span id="addDescriptionHelp" class="glyphicon glyphicon-remove"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="addFileSlide">Image du slide</label>
                  <input name="addFileSlide" type="file" id="addFileSlide">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                  <button name="addSlide" type="submit" class="btn btn-primary valid" disabled>Ajouter</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

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
      <?php include('includes/footer.php'); ?>
    </div>
    <!-- /.container -->

    <?php include('includes/jsBottom.php'); ?>
    <script>
        $('.carousel').carousel({
            interval: 5000
        })
    </script>
  </body>
</html>
