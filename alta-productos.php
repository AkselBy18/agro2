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
    <h2>Alta de productos</h2>
    <form action="" method="post">
        <label for="">Nombre</label>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="">Descripcion</label>
        <input type="text" name="desc" id="desc" required><br>
        <label for="">Cantidad (En kilos)</label>
        <input type="text" name="cantidad" id="cantidad" required><br>
        <label for="">Precio por KG</label>
        <input type="text" name="precio" id="precio" required><br>
        <input type="submit" value="Guardar">
    </form>
    <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Recibimos los datos
            $nombre_producto = $_POST['nombre'];
            $desc = $_POST['desc'];
            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];

            //Query para insertar los datos
            $sentencia = $mysqli->prepare("INSERT INTO producto (nombre_producto,descripcion,cantidad,precio) VALUES (?,?,?,?)");

            $sentencia->bind_param("sssd", $nombre_producto,$desc,$cantidad,$precio);

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