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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="icon" href="img/AGRO-LOGO.png">
</head>
<body>
<div class="container is-max-desktop">
    <h2 class="is-size-2">Alta de ciudades</h2>

    <div class="notification contenido">
    <form action="" method="post">
        <label class="label" for="">Nombre</label>
        <input class="input" type="text" name="nombre" id="nombre" required><br>
        <label class="label" for="">Estado</label>
        <input class="input" type="text" name="estado" id="estado" required><br>
        <label class="label" for="">Municipio</label>
        <input class="input" type="text" name="muni" id="muni" required><br>
        <label class="label" for="">Codigo Postal</label>
        <input class="input" type="text" name="codigo" id="codigo" required><br>
        <br>
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
            $nombre_cuidad = $_POST['nombre'];
            $estado = $_POST['estado'];
            $municipio = $_POST['muni'];
            $codigo = $_POST['codigo'];

            //Query para insertar los datos
            $sentencia = $mysqli->prepare("INSERT INTO ciudad (nombre,estado,municipio,codigo_postal) VALUES (?,?,?,?)");

            $sentencia->bind_param("sssi", $nombre_cuidad,$estado,$municipio,$codigo);

            //ejecutamos la consulta
            if($sentencia->execute()){
                    header("location: crear-cuenta.php");
            }else{
                echo '<script>
                        alert("Error al guardar los datos");
                    </script>';
            }
        }
        ?>
</body>
</html>
