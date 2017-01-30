<?php

// Session/Connexion/Functions
include('../includes/common.php');

// HEAD HTML
define('headTitle', 'challengePHP : Repertory');
define('headDescription', 'challengePHP : Repertory Page');
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
          <h1 class="page-header">Repertory</h1>
          <ol class="breadcrumb">
            <li><a href="<?= path ?>index.html">Home</a>
            </li>
            <li class="active">Portfolio</li>
          </ol>
        </div>
      </div>
      <!-- /.row -->

      <!-- Friends Row -->
      <div class="row">
        <?php
        $members = mysqli_query($db, 'SELECT users.id, users.user, users.games, users.birth, users.imgprofil,
                                      DATE_FORMAT(birth, "%d/%m/%Y") AS dateBirth
                                      FROM friends
                                      LEFT JOIN users ON users.id = friends.user
                                      OR users.id = friends.friend
                                      WHERE friends.valid AND
                                      (friends.user = '. $user['id'] .'
                                      OR friends.friend = '. $user['id'] .')
                                      AND users.id != '. $user['id'] .'
                                      GROUP BY users.user');
        while($memData = @mysqli_fetch_assoc($members))
        {
        ?>
        <div class="col-md-4 img-portfolio">
          <img style="background-image:url('../img/profils/<?= ($memData['imgprofil'] ? $memData['imgprofil'] : 'default.png') ?>');" class="imgPort img-responsive img-hover" src="" alt="">
          <h3><?= $memData['user'] ?></h3>
          <?php
          if($memData['dateBirth'] != '00/00/0000')
          {
            $age = floor((time() - strtotime($memData['birth'])) / 60 / 60 / 24 / 365.224);
          ?>
          <p><?= $age ?> ans <span>(<?= $memData['dateBirth'] ?>)</span></p>
          <?php
          }
          ?>

          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
          <h4>Games</h4>
          <table class="table table-striped  table-hover">
            <thead>
              <tr>
                <th><?= $memData['games'] ?></td>
                <th><?= $memData['user'] ?></td>
              </tr>
            </thead>
            <tr>
              <td>Lorem</td>
              <td>Ipsum</td>
            </tr>
          </table>
        </div>
        <?php
        }
        ?>
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
