<?php 
    include("conexion.php"); 
    //consulta para obtenere toda la información de la tabla
    $resultados = $mysqli->query("SELECT pk_publicacion,fecha_publicacion,titulo,descripcion,ruta_archivo, CONCAT(nombre,' ',apellido_paterno,' ',apeelido_materno) as 'nombre' 
    FROM publicacion, persona
    WHERE publicacion.fk_persona=persona.pk_persona ");

    $datos = $resultados->fetch_all(MYSQLI_ASSOC);

    //obtenemos el numero de registros
    $total = mysqli_num_rows($resultados);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGRO</title>
    <style>
        
    </style>
</head>
<body>
    <?php
    foreach($datos as $registro)
    {
        ?>
        <div style="width: 20%; height: 15%; border-color=#000">
        <h1><?php echo $registro['titulo'];?></h1>
        <img src="<?php echo $registro['ruta_archivo'];?>" alt="" style="width: 350px; height: 350px;">
        <h5><?php echo $registro['descripcion'];?></h5>
        <h6>Publicado: <?php echo $registro['fecha_publicacion'];?></h6>
        <p>Vendedor: <?php echo $registro['nombre'];?></p>
        <a href="publicacion.php?producto=<?php echo $registro['pk_publicacion'] ?>"><button style="width: 350px; height: 50px;">Ver producto</button></a>
        </div>
        <?php
    }
    ?>    
</body>
</html>