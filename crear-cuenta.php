<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="icon" href="img/AGRO-LOGO.png">
</head>
<body>
<center>
<h1 class="is-size-2">Crear cuenta</h1>
</center>
<div class="container is-max-desktop">
  <div class="notification contenido">

    <form action="" method="post">
        <label for="" class="label">Nombre</label>
        <input class="input" type="text" name="nombre" id="nombre" required><br>
        <label for="" class="label">Apellido Paterno</label>
        <input class="input" type="text" name="paterno" id="paterno" required><br>
        <label for="" class="label">Apellido Materno</label>
        <input class="input" type="text" name="materno" id="materno" required><br>
        <label for="" class="label">direccion</label>
        <input class="input" type="text" name="direccion" id="direccion" required><br>
        <label for="" class="label">Telefono</label>
        <input class="input" type="text" name="telefono" id="telefono" required><br>
        <label for="" class="label">Correo</label>
        <input class="input" type="email" name="correo" id="correo" required><br>
        <label for="" class="label">Contraseña</label>
        <input class="input" type="password" name="contra" id="contra" required><br>
        <label for="" class="label">Fecha de nacimiento</label>
        <input class="input" type="date" name="fecha" id="fecha" required><br>
        <label for="" class="label">Ciudad</label>
        <div class="select">
        <select name="ciudad" id="ciudad">
            <option value="">Seleccione...</option>
            <?php   
                $consulta = "SELECT pk_ciudad, CONCAT(nombre,' ',estado) as 'ciudad' from ciudad";
                $resultado = mysqli_query($mysqli, $consulta);

                foreach ($resultado as $result => $values) {
                    echo ' <option value="'.$values['pk_ciudad'].'">'.$values['ciudad'].'</option>';
                }
            ?>
        </select>
        </div><br>
        <p><b> No encuentra su ciudad? <a href="alta-ciudad.php">Ingrese aquí la suya</a></b></p><br>
<div class="field is-grouped">
  <div class="control">
    <button class="button is-dark is-rounded is-responsive is-medium" type="submit">Guardar </button>
  </div>
  <div class="control">
    <button class="button is-link is-light is-rounded is-responsive is-medium" type="reset">Cancel</button>
  </div>
</div>
    </form>
    </div>
</div>
    <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Recibimos los datos
            $nombre = $_POST['nombre'];
            $paterno = $_POST['paterno'];
            $materno = $_POST['materno'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $contra = $_POST['contra'];
            $fecha = $_POST['fecha'];
            $ciudad = $_POST['ciudad'];
            $tipo=2;

            //Query para insertar los datos
            $sentencia = $mysqli->prepare("INSERT INTO persona (nombre,apellido_paterno,apeelido_materno,direccion,telefono,correo,contrasena,fecha_nacimiento,ciudad,fk_tipo_persona) VALUES (?,?,?,?,?,?,?,?,?,?)");

            $sentencia->bind_param("ssssisssii", $nombre,$paterno,$materno,$direccion,$telefono,$correo,$contra,$fecha,$ciudad,$tipo);

            //ejecutamos la consulta
            if($sentencia->execute()){
                echo '<script>
                        alert("Registrado correctamente");
                        window.location="index.php";
                    </script>';
            }else{
                echo '<script>
                        alert("Error al guardar los datos");
                    </script>';
            }
        }
        ?>
</body>
</html>