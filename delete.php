<?php 
    require_once('bd.php');
    $tra = new BD();
    $tra->delete($_GET['numero'],$_GET['fecha_ingreso'],$_GET['fecha_salida'],$_GET['dni'],$_GET['codreserva']);
?>