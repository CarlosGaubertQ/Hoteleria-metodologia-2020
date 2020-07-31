<?php 
    require_once('../bd.php');
    $tra = new BD();
    if(isset($_POST["grabar"]) and $_POST["grabar"] =="si"){
      $tra->edit();
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
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <title>Proyecto Semestral</title>
  </head>

<body>
<nav style="background:rgb(140, 207, 36)">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <a href="../index.php"><img src="../img/logohotel.png" alt="" width="10%" style="margin-left:1rem;"></a>
      </div>
      <div class="col-6">
        <a href="estadia.php"style="display:flex; justify-content:flex-end"><img src="../img/atras.png" alt="" width="10%"></a>
      </div>
    </div>
  </div>
</nav>

<main>
  <div class="container" style="margin-top:3rem">
    <h1 align="center">MODIFICAR RESERVA</h1>
    <h3 align="center"><?php echo $_GET['nombre_pas'] ?></h3>
    <br>
    <p>Hola! Bienvenido/a, este este apartado te permitira modificar una reserva</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui exercitationem voluptatum doloremque dolorum animi, possimus doloribus, odit voluptatem sit iure, quo aut. Eligendi quaerat excepturi dicta ea quos nisi a!</p>
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
                <b>-- Especifica datos a modificar --</b>
              </div>
            </div>
            <?php
          break;
          case '2':
            ?>
            <div class="container">
              <div class="alert alert-success" role="alert" align="center">
                <b>-- Los Datos han sido modificados exitosamente. --</b>
              </div>
            </div>
            <?php
          break;
        }
      }            
?>

<div class="container" style="margin-top:3rem;margin-bottom:3rem" align="center">
  <div class="row">
    <div class="col-12 col-md-6">
      <table>
        <tr>
          <th>Seleccionar</th><th>Habitacion</th><th>Tipo Habitacion</th>
        </tr>
        <?php 
          $a = $tra->getHabitaciones();
          if(!empty($a)){
          for ($i=0; $i < sizeof($a); $i++) { 
        ?>
        <tr>
          <td><input type="radio" value="<?php echo $a[$i]["numero"] ?>" name="habitacion"></td><td>Habitacion #<?php echo $a[$i]["numero_habitacion"] ?></td><td><?php echo $a[$i]["descripcion_hab"] ?></td>
          <?php }} ?>
        </tr>
      </table>
      <br>
    </div>
    <div class="col-12 col-md-6">
      <table>
        <tr>
          <th scope="row">Fecha de Salida: <br></th>
          <td><input name="fecha" type="date"></td><td><input name="hora" type="time"></td>
        </tr>
      </table>
    </div>
  </div>
  <input type="hidden" name="grabar" value="si"/>
  <input type="hidden" name="id" value="<?php echo $_GET['numero']; ?>"/>
  <input width="4%" type="image" alt="submit"  src="../img/guardar.png" />
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
