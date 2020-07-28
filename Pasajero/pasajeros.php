<?php 
    require_once('../bd.php');
    $tra = new BD();
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
        <a href="../index.php"style="display:flex; justify-content:flex-end"><img src="../img/atras2.png" alt="" width="10%"></a>
      </div>
    </div>
  </div>
</nav>

<main>
  <div class="container" style="margin-top:1rem">
    <br>
    <h1 align="center"><b><u><i>PASAJEROS</i></u></b></h1>
    <br>
    <p>Hola! Bienvenido/a, este este apartado podras registrar nuevos pasajeros y visualizar a los ya inscritos!, tambien permite modificar los datos de los pasajeros</p>
    <hr>
  </div>
  <div class="container" align="center">
      <a href="nuevopasajero.php"><img src="../img/pasajero.png" width=3%> Registrar Pasajero</a>
      <hr>
  </div>
</main>


<div class="container" style="margin-top:3rem;margin-bottom:3rem" align="center">
    <table>
      <tr>
        <th>DNI</th><th>Nombre Completo</th><th>Contacto</th><th>Estado de estadia</th><th>Accion</th>
      </tr>

      <?php 
          $a = $tra->getAllPasajeros();

          for ($i=0; $i < sizeof($a); $i++) {
      ?>
      <tr>
        <td><?php echo $a[$i]["dni"] ?></td>
        <td><?php echo $a[$i]["apellido_pas"] . ', ' . $a[$i]["nombre_pas"] ?></td>
        <td><?php echo $a[$i]["contacto_pas"] ?></td>
        <td><?php 
        
            if($a[$i]["enhabitacion"] == 1){
              echo 'En habitacion';
            }else{
              echo 'Sin habitacion';
            }
          ?>
        </td>
        <td><a href="modificarpasajero.php?dni=<?php echo $a[$i]["dni"] ?>">Modificar</a></td>
      </tr>

      <?php }?>
    </table>
</div>


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
