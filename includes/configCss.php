<?php

$query = mysqli_query($db, 'SELECT * FROM config');
$config = mysqli_fetch_assoc($query);

$cTitle = explode(',', $config['ctitle']);
$cNavbar = explode(',', $config['cnavbar']);
$cUrl = explode(',', $config['curls']);
$cButton = explode(',', $config['cbutton']);
$fixedNavBar = $config['fixednavbar'] ? ' navbar-fixed-top' : ' navbar-top';

trimArray($cTitle);
trimArray($cNavbar);
trimArray($cUrl);
trimArray($cButton);

?>

<style>
  .page-header
  {
    color:rgba(<?= $cTitle[1] ?>, <?= $cTitle[2] ?>, <?= $cTitle[3] ?>, <?= $cTitle[0] ?>);
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
  }
</style>
