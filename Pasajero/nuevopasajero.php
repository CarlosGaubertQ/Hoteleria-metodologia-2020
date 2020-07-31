<?php 
    require_once('../bd.php');
    $tra = new BD();
    if(isset($_POST["grabar"])){
      $tra->addPasajero();
      exit;
    }
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="main3.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <title>Proyecto Semestral</title>
  </head>

<body>
<nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <a href="../index.php"><img src="../img/logohotel.png" alt="" width="10%" style="margin-left:1rem;"></a>
      </div>
      <div class="col-6">
        <a href="pasajeros.php"style="display:flex; justify-content:flex-end"><img src="../img/atras.png" alt="" width="10%"></a>
      </div>
    </div>
  </div>
</nav>

<main>
  <div class="container" style="margin-top:3rem">
    <h1 align="center">REGISTRAR PASAJERO</h1>
    <br>
    <p>Hola! Bienvenido/a, este este apartado te permitira agregar un nuevo pasajero</p>
    <p>para ello solo ingrese los datos en los campos de a continuación.</p>
    <br>
    <hr>
  </div>
</main>

<form name="form" action="" method="post">

  <?php 
        if(isset($_GET["m"])){
          switch ($_GET["m"]) {
            case '1':
              ?>
              <div class="container">
                <div class="alert alert-danger" role="alert" align="center">
                 <b>-- Faltaron Datos --</b>
                </div>
              </div>
              <?php
            break;
            case '2':
              ?>
              <div class="container">
                <div class="alert alert-success" role="alert" align="center">
                 <b>-- Los Datos han sido guardados exitosamente ---</b>
                </div>
              </div>
              <?php
              break;
          }
        }
              
  ?>
  <div class="container" style="margin-top:3rem;margin-bottom:3rem" align="left">
    <div class="row">
      <div class="col-12 col-md-4">
        <h4><b>DNI:</b></h4>
        <input type="text" name="dni" value="">
      </div>
      <div class="col-12 col-md-4">
        <h4><b>Nombre:</b></h4>
        <input type="text" name="nombre" value="">
      </div>
      <div class="col-12 col-md-4">
        <h4><b>Apellido:</b></h4>
        <input type="text" name="apellido" value="">
      </div>
    </div>
    <br>
    <br>
    <div class="row">
      <div class="col-12 col-md-4">
        <h4><b>Dirección:</b></h4>
        <input type="text" name="direccion" value="">
      </div>
      <div class="col-12 col-md-4">
        <h4><b>Contacto/Fono:</b></h4>
        <input type="number" name="contacto" value="">
      </div>
      <div class="col-12 col-md-4">
        <h4><b>Fecha de Nacimiento:</b></h4>
        <input type="date" name="fechaNacimiento" value="">
      </div>
    </div>
    <div class="row">
      <div class="col-12" align="center">
        <br>
        <br>
        <input type="hidden" name="grabar" value="si"/>
        <input width="4%" type="image" alt="submit"  src="../img/validar.png" />
      </div>
    </div>
  </div>
</form>

<footer class="footer">
  <hr>
  <ul class="nav justify-content-center">
    <li class="nav-item"><a class="nav-link" href="#"><b>Hotel California</b></a></li>
    <li class="nav-item"><a class="nav-link" href="#">
          <div style="float:left;">
          <script src=../js/fecha.js></script></div></a></li>
    <li class="nav-item"><a class="nav-link" href="#">
      <script src=../js/hora.js>  </script>
      <div id="reloj" style="font-family: 'DS-Digital';background-color: white;font-size:1em;color: rgb(74, 112, 15);"></div></a></li>
</footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
