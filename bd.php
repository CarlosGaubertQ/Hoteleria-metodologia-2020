<?php
    class BD {
        private $dbh;
        private $reservas;
        private $habitaciones;
        private $tipo_habitaciones;
        private $hoteles;
        private $pasajeros;

        public function __construct(){
            $this->dbh = new PDO('pgsql:host=localhost;port=5432;dbname=Hoteles','postgres', 'd380b6bd');
            $this->reservas= array();
            $this->habitaciones = array();
            $this->tipo_habitaciones = array();
            $this->hoteles = array();
            $this->pasajeros = array();
        }
    
        public function getEstadias(){
             $sql = 'SELECT reserva.*, pasajero.nombre_pas  
             FROM reserva inner join pasajero on reserva.dni = pasajero.dni inner join habitaciones on habitaciones.numero = reserva.numero
             ';
             foreach ($this->dbh->query($sql) as $row) {
                 $this->reservas[] = $row;
             }
             return $this->reservas;
             $this->dbh = null;

        }


        public function getAllPasajeros(){
            $this->pasajeros = null;
            $sql = 'Select * from pasajero;';
            foreach($this->dbh->query($sql) as $row){
                $this->pasajeros[] = $row;
            }
            return $this->pasajeros;
        }

        public function getHabitaciones(){
            $this->reservas = null;
            $sql = 'Select * from habitaciones inner join tipo_habitacion on habitaciones.codigo_tipo_hab = tipo_habitacion.codigo_tipo_hab
                    where habitaciones.disponibilidad = true;';
            foreach ($this->dbh->query($sql) as $row) {
                $this->reservas[] = $row;
            }
            return $this->reservas;
            $this->dbh = null;

        }

        public function getHoteles(){
            $this->hoteles = null;
            $sql = 'Select * from Hotel';
            foreach ($this->dbh->query($sql) as $row) {
                $this->hoteles[] = $row;
            }
            return $this->hoteles;
            $this->dbh = null;
        }

        public function getTipoHabitaciones(){
            $this->tipo_habitaciones = null;
            $sql = 'Select * from tipo_habitacion;';
            foreach ($this->dbh->query($sql) as $row) {
                $this->tipo_habitaciones[] = $row;
            }
            return $this->tipo_habitaciones;
            $this->dbh = null;
        }

        public function getAllHabitaciones(){
            $this->habitaciones = null;
            $sql = 'select * from habitaciones inner join tipo_habitacion on habitaciones.codigo_tipo_hab = tipo_habitacion.codigo_tipo_hab;';
            foreach($this->dbh->query($sql) as $row){
                $this->habitaciones[] =$row;
            }
            return $this->habitaciones;
            $this->dbh = null;

        }

        public function getPasajeros(){
            $this->reservas = null;
            $sql = 'select * from pasajero where pasajero.enhabitacion = false;';
            foreach ($this->dbh->query($sql) as $row) {
                $this->reservas[] = $row;
            }
            return $this->reservas;
            $this->dbh = null;

        }

        public function regSalida($numero, $dni){
            //actualizar
            $sql = 'update habitaciones set disponibilidad=true where numero=?';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue(1,$numero, PDO::PARAM_STR);
            $stmt->execute();

            $sql = 'update pasajero set enhabitacion=false where dni=?';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue(1,$dni, PDO::PARAM_STR);
            $stmt->execute();

            $this->dbh= null;
            header("Location: estadia.php?m=2");

        }

        


        public function delete($numero,$fecha_ingreso,$fecha_salida,$dni,$codreserva){

            //actualizar
            $sql = 'update habitaciones set disponibilidad=true where numero=?';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue(1,$numero, PDO::PARAM_STR);
            $stmt->execute();

            $sql = 'update pasajero set enhabitacion=false where dni=?';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue(1,$dni, PDO::PARAM_STR);
            $stmt->execute();

            //eliminar
            $sql = 'delete from reserva where codreserva=?';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1,$codreserva);
            $stmt->execute();
            
            header("Location: estadia.php?m=1");
        
        }


        public function editPasajero(){
            $dni = $_GET['dni'];
            if(empty($_POST['nombre']) or empty($_POST['apellido']) or empty($_POST['direccion']) or empty($_POST['contacto']) or empty($_POST['fechanacimiento'])){
                header("Location: modificarpasajero.php?m=1&dni=$dni");
            }else{
                $sql = 'update pasajero set nombre_pas=?, apellido_pas=?, fecha_nac_pas=?, direccion_pas=?, contacto_pas=? where dni=?;';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue(1,$_POST["nombre"], PDO::PARAM_STR);
                $stmt->bindValue(2,$_POST["apellido"], PDO::PARAM_STR);
                $stmt->bindValue(3,$_POST["fechanacimiento"], PDO::PARAM_STR);
                $stmt->bindValue(4,$_POST["direccion"], PDO::PARAM_STR);
                $stmt->bindValue(5,$_POST["contacto"], PDO::PARAM_STR);
                $stmt->bindValue(6,$dni, PDO::PARAM_STR);
                $stmt->execute();
                $this->dbh= null;
                header("Location: modificarpasajero.php?m=2&dni=$dni");
            }
        }


        public function editHabitacion(){
            $numero = $_GET['numero'];

            if(empty($_POST['codigo']) or empty($_POST['codigo_tipo_hab']) or empty($_POST['num_hab'])){
                header("Location: modificarhabitacion.php?m=1&numero=$numero");
            }else{
                $sql = 'update habitaciones set codigo=?, codigo_tipo_hab=?, numero_habitacion=? where numero=? ';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue(1,$_POST["codigo"], PDO::PARAM_STR);
                $stmt->bindValue(2,$_POST["codigo_tipo_hab"], PDO::PARAM_STR);
                $stmt->bindValue(3,$_POST["num_hab"], PDO::PARAM_STR);
                $stmt->bindValue(4,$numero, PDO::PARAM_STR);
                $stmt->execute();
                $this->dbh= null;
                header("Location: modificarhabitacion.php?m=2&numero=$numero");
            }

        }

        
        public function edit(){
            $numero = $_GET['numero'];
            $fecha_ingreso = $_GET['fecha_ingreso'];
            $nombre_pas = $_GET['nombre_pas'];
            $numero_nuevo = $_POST['habitacion'];
            if(empty($_POST["fecha"]) or empty($_POST["hora"]) or empty($_POST["habitacion"])){   
                header("Location: modificarestadia.php?m=1&numero=$numero&fecha_ingreso=$fecha_ingreso&nombre_pas=$nombre_pas");
            }else{
                
                //update habitacion
                $sql = 'update habitaciones set disponibilidad = true where numero=?';
                $stmt = $this->dbh->prepare($sql);
                
                $stmt->bindValue(1,$_GET["numero"], PDO::PARAM_STR);
                $stmt->execute();
                $sql = 'update habitaciones set disponibilidad = false where numero=?';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue(1,$_POST["habitacion"], PDO::PARAM_STR);
                $stmt->execute();
                //update reserva
                $sql = 'update reserva set fecha_salida=?, hora_salida=?, numero=? where numero=? and fecha_ingreso=?';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue(1,$_POST["fecha"], PDO::PARAM_STR);
                $stmt->bindValue(2,$_POST["hora"], PDO::PARAM_STR);
                $stmt->bindValue(3,$_POST["habitacion"], PDO::PARAM_STR);
                $stmt->bindValue(4,$_GET["numero"], PDO::PARAM_STR);
                $stmt->bindValue(5,$_GET["fecha_ingreso"], PDO::PARAM_STR);
                $stmt->execute();
                $this->dbh= null;
                header("Location: modificarestadia.php?m=2&numero=$numero_nuevo&fecha_ingreso=$fecha_ingreso&nombre_pas=$nombre_pas");
            }
        }

        public function addPasajero(){
            if(empty($_POST['dni']) or empty($_POST['nombre']) or empty($_POST['apellido']) or empty($_POST['direccion']) or empty($_POST['contacto']) or empty($_POST['fechaNacimiento'])){
                header("Location: nuevopasajero.php?m=1");
            }else{

                //validar pasajero que ya este en la bd URGENTE
                

                $sql= 'INSERT INTO pasajero(dni, nombre_pas, apellido_pas, fecha_nac_pas, direccion_pas, contacto_pas, enhabitacion)
                VALUES( ?, ? ,?, ?, ?, ?, FALSE );';

                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(1,$dni);
                $stmt->bindParam(2,$nombre_pas);
                $stmt->bindParam(3,$apellido_pas);
                $stmt->bindParam(4,$fecha_nac);
                $stmt->bindParam(5,$direccion);
                $stmt->bindParam(6,$contacto);

                $dni = strip_tags($_POST['dni']);
                $nombre_pas = strip_tags($_POST['nombre']);
                $apellido_pas = strip_tags($_POST['apellido']);
                $fecha_nac = strip_tags($_POST['fechaNacimiento']);
                $direccion = strip_tags($_POST['direccion']);
                $contacto = strip_tags($_POST['contacto']);

                $stmt->execute();
                header("Location: nuevopasajero.php?m=2");
            }
        }


        public function addHabitacion(){
            if(empty($_POST['codigo']) or empty($_POST['codigo_tipo_hab']) or empty($_POST['num_hab'])){
                header("Location: nuevahabitacion.php?m=1");
            }else{
                $sql= "INSERT INTO habitaciones(
                    numero_habitacion, codigo_tipo_hab, codigo, disponibilidad)
                    VALUES (?,?,?, TRUE);";
                    $stmt= $this->dbh->prepare($sql);

                    $stmt->bindParam(1,$num_hab);
                    $stmt->bindParam(2,$codigo_tipo_hab);
                    $stmt->bindParam(3,$codigo);

                    $num_hab = strip_tags($_POST['num_hab']);
                    $codigo_tipo_hab = strip_tags($_POST['codigo_tipo_hab']);
                    $codigo = strip_tags($_POST['codigo']);

                    $stmt->execute();
                    header("Location: nuevahabitacion.php?m=2");
            }
        }


        public function add(){
            if(empty($_POST["pasajero"]) or empty($_POST["habitacion"]) or empty($_POST["FechaSalida"]) or empty($_POST["HoraSalida"])){
                header("Location: nuevaestadia.php?m=1");
            }else{
                //actualizar
                $sql = 'update habitaciones set disponibilidad=false where numero=?';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue(1,$_POST["habitacion"], PDO::PARAM_STR);
                $stmt->execute();

                $sql = 'update pasajero set enhabitacion=true where dni=?';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue(1,$_POST["pasajero"], PDO::PARAM_STR);
                $stmt->execute();

                //insertar
                $hoy = date("Y-m-d");
                $hora = date("H:i:s");
                
                $sql = 'INSERT INTO reserva(
                    numero, dni, fecha_ingreso, hora_ingreso, fecha_salida, hora_salida)
                     VALUES (?, ?, ? , ?, ?, ?)';
                
                $stmt= $this->dbh->prepare($sql);

                $stmt->bindParam(1,$habitacion);
                $stmt->bindParam(2,$pasajero);
                $stmt->bindParam(3,$fechaingreso);
                $stmt->bindParam(4,$horaingreso);
                $stmt->bindParam(5,$fechasalida);
                $stmt->bindParam(6,$horasalida);
                


                $habitacion = strip_tags($_POST["habitacion"]);
                $pasajero = strip_tags($_POST["pasajero"]);
                $fechaingreso = $hoy;
                $horaingreso = $hora;
                $fechasalida = strip_tags($_POST["FechaSalida"]);
                $horasalida = strip_tags($_POST["HoraSalida"]);

                $stmt->execute();
                header("Location: nuevaestadia.php?m=2");

            }
            
            

        }
        
        

    }

    
?>