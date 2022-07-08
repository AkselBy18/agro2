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
</head>
<body>
    <h2>Crear cuenta</h2>
    <form action="" method="post">
        <label for="">Nombre</label>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="">Apellido Paterno</label>
        <input type="text" name="paterno" id="paterno" required><br>
        <label for="">Apellido Materno</label>
        <input type="text" name="materno" id="materno" required><br>
        <label for="">direccion</label>
        <input type="text" name="direccion" id="direccion" required><br>
        <label for="">Telefono</label>
        <input type="text" name="telefono" id="telefono" required><br>
        <label for="">Correo</label>
        <input type="email" name="correo" id="correo" required><br>
        <label for="">Contraseña</label>
        <input type="password" name="contra" id="contra" required><br>
        <label for="">Fecha de nacimiento</label>
        <input type="date" name="fecha" id="fecha" required><br>
        <label for="">Ciudad</label>
        <select name="ciudad" id="ciudad">
            <option value="">Seleccione...</option>
            <?php   
                $consulta = "SELECT pk_ciudad, CONCAT(nombre,' ',estado) as 'ciudad' from ciudad";
                $resultado = mysqli_query($mysqli, $consulta);

                foreach ($resultado as $result => $values) {
                    echo ' <option value="'.$values['pk_ciudad'].'">'.$values['ciudad'].'</option>';
                }
            ?>
        </select><br>
        <input type="submit" value="Guardar">
    </form>
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