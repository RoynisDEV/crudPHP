<!-- codigo php para agregar un alumno--> 
<?php
// incluimos la funcion para evitar ataque xss
include 'funciones.php';

    if (isset($_POST['submit'])){
        
        $resultado = [
            'error' => false,
            'mensaje' => 'El alumno ' . escapar($_POST['nombre']).' ha sido agregado con exito'
        ];

        $config = include 'config.php';

        try {
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

            //codigo para crear al alumno en la base de datos
            $alumno = array(
                "nombre"   => $_POST['nombre'],
                "apellido" => $_POST['apellido'],
                "email"    => $_POST['email'],
                "edad"     => $_POST['edad'],
            );

            $consultaSQL = "INSERT INTO alumnos (nombre, apellido, email, edad)";
            $consultaSQL .= "values (:" . implode(", :", array_keys($alumno)) . ")";


            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute($alumno);

        } catch(PDOException $error){
            $resultado['error'] = true;
            $resultado['mensaje'] = $error->getMessage();
        }
    }
?>

<!-- codigo html y php para la interfaz--> 
<?php include "templates/header.php"; ?>

<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error']? 'danger' : 'success'?>" role="alert">
        <?= $resultado['mensaje'] ?>
      </div>
    </div>
  </div>
</div>
<?php
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4"> Crear un alumno </h2>
            <hr>
            <form method="post">
                <div class="form-group">
                    <label for="nombre"> Nombre </label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="apellido"> Apellido </label>
                    <input type="text" name="apellido" id="apellido" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email"> Email </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="edad"> Edad </label>
                    <input type="text" name="edad" id="edad" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success" value="Enviar">
                    <a class="btn btn-info" href="index.php"> Regresar al incio </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>

