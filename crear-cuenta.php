<?php
include("conexion.php")
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
    <h2>Alta de ciudades</h2>
    <form action="" method="post">
        <label for="">Nombre</label>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="">Estado</label>
        <input type="text" name="estado" id="estado" required><br>
        <label for="">Municipio</label>
        <input type="text" name="muni" id="muni" required><br>
        <label for="">Codigo Postal</label>
        <input type="text" name="codigo" id="codigo" required><br>
        <input type="submit" value="Guardar">
    </form>
    <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Recibimos los datos
            $nombre_cuidad = $_POST['nombre'];
            $estado = $_POST['estado'];
            $municipio = $_POST['muni'];
            $codigo = $_POST['codigo'];

            //Query para insertar los datos
            $sentencia = $mysqli->prepare("INSERT INTO ciudad (nombre,estado,municipio,codigo_postal) VALUES (?,?,?,?)");

            $sentencia->bind_param("sssi", $nombre_cuidad,$estado,$municipio,$codigo);

            //ejecutamos la consulta
            if($sentencia->execute()){
                echo '<script>
                        alert("Datos guardados correctamente");
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