<?php

// Session/Connexion/Functions
include('../includes/common.php');

// HEAD HTML
define('headTitle', 'challengePHP : Members');
define('headDescription', 'challengePHP : Members Page');
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
          <h1 class="page-header">Members</h1>
          <ol class="breadcrumb">
            <li><a href="<?= path ?>index.html">Home</a>
            </li>
            <li class="active">Members</li>
          </ol>
        </div>
      </div>
      <!-- /.row -->

      <?php
      if ($user['id'])
      {
      ?>
      <!-- Content Row -->
      <div class="row">
        <div class="col-md-12">
          <!-- Table -->
          <table class="table">
            <tr>
              <th>#</th>
              <th>Utilisateur</th>
              <th>Inscription le</th>
              <th>Demander en ami</th>
            </tr>
            <?php
            $i = 0;
            $members = mysqli_query($db, 'SELECT friends.id AS idFriend, users.id, users.user, DATE_FORMAT(created, "%d/%m/%Y") AS datCreat
                                          FROM users
                                          LEFT JOIN friends ON
                                          (users.id = friends.friend AND friends.user = '. $user['id'] .')
                                          OR
                                          (users.id = friends.user AND friends.friend = '. $user['id'] .')
                                          WHERE users.id != '. $user['id'] .'
                                          GROUP BY users.user');
            while($memData = mysqli_fetch_assoc($members))
            {
            $i++;
            ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $memData['user'] ?></td>
              <td><?= $memData['datCreat'] ?></td>
              <td><button onclick="addFriend(this, <?= $memData['id'] ?>);"<?php if($memData['idFriend']) echo ' disabled'; ?>>Envoyer</button></td>
            </tr>
            <?php
            }
            ?>
          </table>
        </div>
      </div>
      <!-- /.row -->
      <?php
      }
      ?>

      <hr>

      <!-- Footer -->
      <?php include(path . 'includes/footer.php'); ?>
    </div>
    <!-- /.container -->

    <?php include(path . 'includes/jsBottom.php'); ?>
  </body>
</html>
