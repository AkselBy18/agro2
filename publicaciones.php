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
<?php 
    include("conexion.php"); 
    //consulta para obtenere toda la información de la tabla
    $resultados = $mysqli->query("SELECT pk_publicacion,fecha_publicacion,titulo,publicacion.descripcion,ruta_archivo, CONCAT(nombre,' ',apellido_paterno,' ',apeelido_materno) as 'nombre',cantidad,precio,correo
    FROM publicacion, persona,producto
    WHERE publicacion.fk_persona=persona.pk_persona and pk_producto=fk_producto and estado = 0");

    $datos = $resultados->fetch_all(MYSQLI_ASSOC);

    //obtenemos el numero de registros
    $total = mysqli_num_rows($resultados);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGRO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>
<body>

    <?php 
    include_once("menu.php");
    ?>
    <div class="container is-max-widescreen">
    <h2 class="is-size-2">Publicaciones realizadas</h2>
    </div>
    <div class="container is-max-widescreen">
    <div class="box contenido" >
    <?php
    foreach($datos as $registro)
    {
        ?>
<div class="card public">
  <div class="card-content">
    <div class="media">
      <div class="media-content">
        <p class="title is-4"><?php echo $registro['nombre'];?></p>
        <p class="subtitle is-6"><?php echo $registro['correo'];?></p>
        <p class="is-size-3"><?php echo $registro['titulo'];?></p>
        <img src="<?php echo $registro['ruta_archivo'];?>" alt="" style="width: 350px; height: 350px;">
      </div>
    </div>
    <div class="content">
    <?php echo $registro['descripcion'];?>
      <br>
      <time datetime="2016-1-1"><?php echo $registro['fecha_publicacion'];?></time>
      <br><a href="publicacion.php?producto=<?php echo $registro['pk_publicacion'] ?>"><button class="button is-dark is-rounded is-responsive is-medium" type="submit">Comprar producto</button></a>
    </div>
  </div>
</div><br><br>
        <?php
    }
    ?>  

</body>
</html>