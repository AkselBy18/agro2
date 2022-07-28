<?php
        session_start();
        $u = $_SESSION['username'];
        $id = $_SESSION['id'];

        if(empty($id))
        {
            echo "<script>
                window.location='index.php';
              </script>
        ";
        }

    include("conexion.php"); 
    //consulta para obtener el nombre del usuario
    $resultados = $mysqli->query("SELECT CONCAT(nombre,' ',apellido_paterno,' ',apeelido_materno) as 'nombre' FROM persona where pk_persona = $id");
    
    $datos = $resultados->fetch_all(MYSQLI_ASSOC);
    foreach($datos as $valores)
    {
        $info = $valores['nombre'];
    }    

    // consulta para obtener las publicaciones del usuario
    $pubUsuario = $mysqli->query("SELECT pk_publicacion,fecha_publicacion,titulo,publicacion.descripcion,ruta_archivo
    FROM publicacion, persona,producto
    WHERE publicacion.fk_persona=persona.pk_persona and pk_producto=fk_producto and fk_persona=$id");
    
    $datosPublicacion = $pubUsuario->fetch_all(MYSQLI_ASSOC);
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
    include_once("menu.php");
    ?>

    <div class="borde">
    <?php
        echo"<h1 class='is-size-2' style='text-transform:capitalize;'>Bienvenido $info</h1>";
    ?>
    
    <h1 class="title">Publicaciones realizadas</h1>
    <h2 class="subtitle">Publicaciones activas e inactivas </h2>
    <?php
    if (empty($datosPublicacion)) 
    {
        echo"<h1 class='is-size-5'>Sin publicaciones realizadas </h1>";
    }
    foreach($datosPublicacion as $publicacion)
    {
    ?> 
        <div class="box" style="height:13rem; width:30%; background-color:#E9EFC0; display: inline-block; margin: 1%;">
        <article class="media">
            <div class="media-left">
            <figure class="image is-64x64">
                <img src="<?php echo $publicacion['ruta_archivo'];?>" alt="Image">
            </figure>
            </div>
            <div class="media-content">
            <div class="content" >
                <p>
                <strong style='text-transform:capitalize;'><?php echo $info?></strong> <small><?php echo $u?></small> <small><?php echo $publicacion['fecha_publicacion']?></small>
                <br>
                <?php echo $publicacion['titulo']?> <br>
                <?php echo $publicacion['descripcion']?> <br>
                <a href="publicacion.php?producto=<?php echo $publicacion['pk_publicacion'] ?>" class="has-text-success-dark">Ver publicación</a>
                </p>
            </div>
            </div>
        </article>
        </div>
    <?php
    }
    ?>


    </div>
</body>
</html>

