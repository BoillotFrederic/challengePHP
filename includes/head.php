<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= headDescription ?>">
    <meta name="author" content="">

    <title><?= headTitle ?></title>

    <link href="<?= path ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= path ?>css/main.css" rel="stylesheet">
    <link href="<?= path ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Carme|PT+Serif+Caption|Prata" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php

    $query = mysqli_query($db, 'SELECT * FROM config WHERE selected');
    $config = mysqli_fetch_assoc($query);

    $cTitle = explode(',', $config['ctitle']);
    $cNavbar = explode(',', $config['cnavbar']);
    $cUrl = explode(',', $config['curls']);
    $cButton = explode(',', $config['cbutton']);
    $fTitle = $config['ftitle'];
    $fixedNavBar = $config['fixednavbar'] ? ' navbar-fixed-top' : ' navbar-top';

    trimArray($cTitle);
    trimArray($cNavbar);
    trimArray($cUrl);
    trimArray($cButton);

    ?>

    <style>
      .page-header, h2
      {
        color:rgba(<?= $cTitle[1] ?>, <?= $cTitle[2] ?>, <?= $cTitle[3] ?>, <?= $cTitle[0] ?>);
        font-family:<?= $fTitle ?>;
      }
      .navbar
      {
        background-color:rgba(<?= $cNavbar[1] ?>, <?= $cNavbar[2] ?>, <?= $cNavbar[3] ?>, <?= $cNavbar[0] ?>);
      }
      a
      {
        color:rgba(<?= $cUrl[1] ?>, <?= $cUrl[2] ?>, <?= $cUrl[3] ?>, <?= $cUrl[0] ?>);
      }
      .btn
      {
        background-color:rgba(<?= $cButton[1] ?>, <?= $cButton[2] ?>, <?= $cButton[3] ?>, <?= $cButton[0] ?>);
        color:#FFFFFF !important;
      }
    </style>
  </head>
