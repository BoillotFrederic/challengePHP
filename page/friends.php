<?php

// Session/Connexion/Functions
include('../includes/common.php');

// HEAD HTML
define('headTitle', 'challengePHP : Friends');
define('headDescription', 'challengePHP : Friends Page');
include(path . 'includes/head.php');

// Accepter une demande d'ami
define('acceptFriend', (isset($_GET['acceptFriend']) && is_numeric($_GET['acceptFriend']) ? $_GET['acceptFriend'] : ''));
if(acceptFriend)
{
  $acceptFriend = mysqli_query($db, 'SELECT * FROM friends WHERE user='. acceptFriend .' AND friend='. $user['id']);
  $acceptFriend = mysqli_fetch_assoc($acceptFriend);

  if($acceptFriend['id'])
  mysqli_query($db, 'UPDATE friends SET valid=1 WHERE user='. acceptFriend .' AND friend='. $user['id']);
}

// Supprimer une demande d'ami
define('supprFriend', (isset($_GET['supprFriend']) && is_numeric($_GET['supprFriend']) ? $_GET['supprFriend'] : ''));
if(supprFriend)
{
  $supprFriend = mysqli_query($db, 'SELECT * FROM friends WHERE (user='. $user['id'] .' AND friend='. supprFriend .') OR (user='. supprFriend .' AND friend='. $user['id'] .')');
  $supprFriend = mysqli_fetch_assoc($supprFriend);

  if($supprFriend['id'])
  mysqli_query($db, 'DELETE FROM friends WHERE (user='. $user['id'] .' AND friend='. supprFriend .') OR (user='. supprFriend .' AND friend='. $user['id'] .')');
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
          <h1 class="page-header">Friends</h1>
          <ol class="breadcrumb">
            <li><a href="<?= path ?>index.html">Home</a>
            </li>
            <li class="active">Friends</li>
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
        <?php
        $i = 0;
        $members = mysqli_query($db, 'SELECT users.id, users.user, DATE_FORMAT(created, "%d/%m/%Y") AS datCreat,  friends.valid
                                      FROM users
                                      LEFT JOIN friends ON users.id = friends.user
                                      WHERE friends.friend = '. $user['id'] .' AND !friends.valid
                                      GROUP BY users.user');
        if(@mysqli_fetch_assoc($members)['id'])
        {
        mysqli_data_seek($members, 0);
        ?>
        <div class="col-md-12">
          <!-- Table -->
          <h2>Invitations reçus</h2>
          <table class="table">
            <tr>
              <th>#</th>
              <th>Utilisateur</th>
              <th>Inscription le</th>
              <th>Action</th>
            </tr>
            <?php
            while($memData = mysqli_fetch_assoc($members))
            {
            $i++;
            ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $memData['user'] ?></td>
              <td><?= $memData['datCreat'] ?></td>
              <td>
                <a class="button" href="?acceptFriend=<?= $memData['id'] ?>">
                  <button>Accepter</button>
                </a>
                <a class="button" href="javascript:supprElm(<?= $memData['id'] ?>, 'friends.php?supprFriend')">
                  <button>Refuser</button>
                </a>
              </td>
            </tr>
            <?php
            }
            ?>
          </table>
        </div>
        <?php
        }

        $i = 0;
        $members = mysqli_query($db, 'SELECT users.id, users.user, DATE_FORMAT(created, "%d/%m/%Y") AS datCreat, friends.valid
                                      FROM friends
                                      LEFT JOIN users ON friends.friend = users.id
                                      WHERE friends.user = '. $user['id'] .'
                                      AND !friends.valid
                                      GROUP BY users.user');
        if(mysqli_fetch_assoc($members)['id'])
        {
        mysqli_data_seek($members, 0);
        ?>
        <div class="col-md-12">
          <!-- Table -->
          <h2>Invitations envoyés</h2>
          <table class="table">
            <tr>
              <th>#</th>
              <th>Utilisateur</th>
              <th>Inscription le</th>
              <th>Action</th>
            </tr>
            <?php
            while($memData = mysqli_fetch_assoc($members))
            {
            $i++;
            ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $memData['user'] ?></td>
              <td><?= $memData['datCreat'] ?></td>
              <td>
                <a class="button" href="javascript:supprElm(<?= $memData['id'] ?>, 'friends.php?supprFriend')">
                  <button>Annuler</button>
                </a>
              </td>
            </tr>
            <?php
            }
            ?>
          </table>
        </div>
      <?php
      }

      $i = 0;
      $members = mysqli_query($db, 'SELECT friends.id AS idFriend, users.id, users.user, DATE_FORMAT(created, "%d/%m/%Y") AS datCreat
                                    FROM friends
                                    LEFT JOIN users ON users.id = friends.user
                                    OR users.id = friends.friend
                                    WHERE friends.valid AND
                                    (friends.user = '. $user['id'] .'
                                    OR friends.friend = '. $user['id'] .')
                                    AND users.id != '. $user['id'] .'
                                    GROUP BY users.user');
      if(mysqli_fetch_assoc($members)['id'])
      {
      mysqli_data_seek($members, 0);
      ?>
      <div class="col-md-12">
        <!-- Table -->
        <h2>Mes amis</h2>
        <table class="table">
          <tr>
            <th>#</th>
            <th>Utilisateur</th>
            <th>Inscription le</th>
            <th>Action</th>
          </tr>
          <?php
          while($memData = mysqli_fetch_assoc($members))
          {
          $i++;
          ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $memData['user'] ?></td>
            <td><?= $memData['datCreat'] ?></td>
            <td>
              <a class="button" href="javascript:supprElm(<?= $memData['id'] ?>, 'friends.php?supprFriend')">
                <button>Supprimer</button>
              </a>
            </td>
          </tr>
          <?php
          }
          ?>
        </table>
      </div>
      <?php
      }
      ?>
    </div>
    <!-- /.row -->
      <?php
      }
      ?>

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
