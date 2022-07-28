<?php
include("conexion.php");
session_start();
$u = $_SESSION['username'];
$c = $_SESSION['contra'];
$id = $_SESSION['id'];

if(empty($id))
        {
            echo "<script>
                window.location='index.php';
              </script>
        ";
        }
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
</head>
<body>
    <?php
    include_once"menu.php";
    ?>
    <div class="container is-max-desktop">
    <h2 class="is-size-2">Alta de productos</h2>
    </div>
<div class="container is-max-desktop">
  <div class="notification contenido">
    <form action="" method="post">
        <label class="label" for="">Nombre</label>
        <input class="input" type="text" name="nombre" id="nombre" required><br>
        <label class="label" for="">Descripcion</label>
        <input class="input" type="text" name="desc" id="desc" required><br>
        <label class="label" for="">Cantidad (En kilos)</label>
        <input class="input" type="text" name="cantidad" id="cantidad" required><br>
        <label class="label" for="">Precio por KG</label>
        <input class="input" type="text" name="precio" id="precio" required><br>
        <div class="control">
            <br><button class="button is-dark is-rounded is-responsive is-medium" type="submit">Guardar </button>
        </div><br>
        <div class="control">
            <button class="button is-light is-rounded is-responsive is-medium" type="reset">Cancel</button>
            </div>
        </div>
    </form>
  </div>
</div>
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