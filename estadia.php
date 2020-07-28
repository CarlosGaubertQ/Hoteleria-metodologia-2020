<?php 
    require_once('bd.php');
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
    
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <title>Proyecto Semestral</title>

    <script type="text/javascript"> 
      function eliminar(url){
        if(confirm("¿Realmente desea anular esta reserva ?")){
          window.location= url;
        }
      }

      function regSalida(url){
        if(confirm("¿Desea registrar la salida de esta estadia?")){
          window.location= url;
        }
      }

    </script>

  </head>

<body>
<nav style="background:rgb(140, 207, 36)">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <img src="img/logohotel.png" alt="" width="10%" style="margin-left:1rem;">
      </div>
      <div class="col-6">
        <a href="index.php"style="display:flex; justify-content:flex-end"><img src="img/atras.png" alt="" width="10%"></a>
      </div>
    </div>
  </div>
</nav>

<main>
  <div class="container" style="margin-top:1rem">
    <h1 align="center"><b><u>ESTADIAS</u></b></h1>
    <p>Hola! Bienvenido/a, este este apartado podras agregar nuevas estadias y visualizar a los ya inscritos!, tambien permite modificar las estadias de los pasajeros</p>
    <p>Es sencillo para buscar un pasajero pincha nuestra barra de busqueda e ingrese los datos o tambien puedes buscarlos manualmente</p>
    <hr>
  </div>
  <div class="container" align="center">
      <a href="nuevaestadia.php"><img src="img/estrella.png" width=3%>Crear nueva Estadia</a>
      <hr>
  </div>
</main>

<?php 
  if(isset($_GET["m"])){
    switch ($_GET["m"]) {
      case '1':
        ?>
          <div class="alert alert-success" role="alert">
            Datos anulados correctamente.
          </div>
        <?php
      break;
      case '2':
        ?>
          <div class="alert alert-success" role="alert">
            Registro de salida guardado exitosamente.
          </div>
        <?php
      break;
    }
  }
            
?>



<div class="container" style="margin-top:3rem;margin-bottom:3rem" align="center">
    <table class="table table-striped table-hover">
      <tr>
        <th>Habitacion</th><th>Pasajero</th><th>Fecha de Ingreso</th><th>Fecha de Salida</th><th>Accion</th>
      </tr>
      <?php 
        $a = $tra->getEstadias();

      for ($i=0; $i < sizeof($a); $i++) { 
        
      ?>
      <tr>
          <td>Habitacion <?php echo $a[$i]["numero"] ?></td>
          <td><?php echo $a[$i]["nombre_pas"] ?>       </td>
          <td><?php echo $a[$i]["fecha_ingreso"] . " - " . $a[$i]["hora_ingreso"] ?>    </td>
          <td><?php echo $a[$i]["fecha_salida"] . " - " . $a[$i]["hora_salida"] ?>     </td>
          <td>
<a href="modificarestadia.php?numero=<?php echo $a[$i]["numero"] ?>&fecha_ingreso=<?php echo $a[$i]["fecha_ingreso"] ?>&nombre_pas=<?php echo $a[$i]["nombre_pas"] ?>">Modificar</a>/
<a href="javascript:void(0);" title="Anular reserva del pasajero <?php echo $a[$i]["nombre_pas"] ?>" onclick="eliminar('delete.php?numero=<?php echo $a[$i]["numero"] ?>&fecha_ingreso=<?php echo $a[$i]["fecha_ingreso"] ?>&fecha_salida=<?php echo $a[$i]["fecha_salida"] ?>&dni=<?php echo $a[$i]["dni"] ?>&codreserva=<?php echo $a[$i]["codreserva"] ?>')">Anular</a>/
<a href="javascript:void(0);" title="Registrar salida del pasajero <?php echo $a[$i]["nombre_pas"] ?>" onclick="regSalida('regSalida.php?numero=<?php echo $a[$i]["numero"] ?>&dni=<?php echo $a[$i]["dni"] ?>')"  >Registrar salida</a> 
          </td>
      </tr>
      <?php }?>

    </table>
</div>


  <footer class="">
    <hr>
    <ul class="nav justify-content-center">
      <li class="nav-item"><a class="nav-link" href="#"><b>Hotel California</b></a></li>
      <li class="nav-item"><a class="nav-link" href="#">
            <div style="float:left;">
            <script src=js/fecha.js></script></div></a></li>
      <li class="nav-item"><a class="nav-link" href="#">
        <script src=js/hora.js>  </script>
        <div id="reloj" style="font-family: 'DS-Digital';background-color: white;font-size:1em;color: rgb(74, 112, 15);"></div></a></li>
  </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
