<?php 
    require_once('../bd.php');
    $tra = new BD();
    $tra->regSalida($_GET['numero'],$_GET['dni']);
?>

