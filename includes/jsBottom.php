<script>snow_img = "<?= path ?>img/snow.png";</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="<?= path ?>js/bootstrap.min.js"></script>
<?php
if($config['jsSnow'])
{
?>
<script src="<?= path ?>js/snow.js"></script>
<?php
}
?>
<script src="<?= path ?>js/main.js"></script>
