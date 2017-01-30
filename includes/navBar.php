<nav class="navbar navbar-inverse<?= $fixedNavBar ?>" role="navigation">
  <div class="container">
    <!-- Left -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= path ?>./">Start Bootstrap</a>
    </div>
    <!-- Right -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="<?= path ?>./">Home</a>
        </li>
        <?php
        if($user['id'])
        {
        ?>
        <li>
          <a href="<?= path ?>page/members.php">Members</a>
        </li>
        <li>
          <a href="<?= path ?>page/repertory.php">Repertory</a>
        </li>
        <?php
        }
        ?>
        <li>
          <a href="<?= path ?>page/about.php">About</a>
        </li>
        <li>
          <a href="<?= path ?>page/contact.php">Contact</a>
        </li>
        <?php
        if($user['admin'])
        {
        ?>
        <li>
          <a href="<?= path ?>page/admin.php">Administration</a>
        </li>
        <?php
        }
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= ($user['id'] ? $user['user'] : 'Login') ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
            if ($user['id'])
            {
            ?>
            <li><a href="<?= path ?>page/profilUp.php">Profil</a></li>
            <li><a href="<?= path ?>page/friends.php">Gérer mes amis</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="?logout=true">Déconnexion</a></li>
            <?php
            }
            else
            {
            ?>
            <li>
              <form autocomplete="off" name="connect" action="" method="post" id="loginForm" novalidate>
                <div class="control-group form-group">
                  <div class="controls">
                    <label>Pseudo:</label>
                    <input name="user" type="text" class="form-control" id="name">
                    <p class="help-block"></p>
                  </div>
                </div>
                <div class="control-group form-group">
                  <div class="controls">
                    <label>Mot de passe:</label>
                    <input name="pass" type="password" class="form-control" id="password">
                  </div>
                </div>
                <div id="success"></div>
                <div class="text-center">
                  <button name="send" value="true" type="submit" class="btn btn-primary">Connexion</button>
                </div>
              </form>
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="<?= path ?>page/account.php">Pas encore inscrit ?</a></li>
            <?php
            }
            ?>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>
