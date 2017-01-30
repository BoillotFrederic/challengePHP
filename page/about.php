<?php

// Session/Connexion/Functions
include('../includes/common.php');

// HEAD HTML
define('headTitle', 'challengePHP : About');
define('headDescription', 'challengePHP : About Page');
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
          <h1 class="page-header">About</h1>
          <ol class="breadcrumb">
            <li><a href="<?= path ?>index.html">Home</a>
            </li>
            <li class="active">About</li>
          </ol>
        </div>
      </div>
      <!-- /.row -->

      <!-- Intro Content -->
      <div class="row">
        <div class="col-md-6">
          <img class="img-responsive" src="<?= path ?>img/about-profil.jpg" alt="">
        </div>
        <div class="col-md-6">
          <h2>About Project</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis?</p>
        </div>
      </div>
      <!-- /.row -->

      <!-- Our Customers -->
      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-header">Our Customers</h2>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6">
          <img class="img-responsive customer-img" src="<?= path ?>img/customers-profil.jpg" alt="">
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6">
          <img class="img-responsive customer-img" src="<?= path ?>img/customers-profil.jpg" alt="">
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6">
          <img class="img-responsive customer-img" src="<?= path ?>img/customers-profil.jpg" alt="">
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6">
          <img class="img-responsive customer-img" src="<?= path ?>img/customers-profil.jpg" alt="">
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6">
          <img class="img-responsive customer-img" src="<?= path ?>img/customers-profil.jpg" alt="">
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6">
          <img class="img-responsive customer-img" src="<?= path ?>img/customers-profil.jpg" alt="">
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
