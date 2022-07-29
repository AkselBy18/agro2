<?php 
if(isset($_GET['compra']))
{
    $producto = $_GET['compra'];
    include("conexion.php"); 
    //consulta para obtenere toda la información de la tabla
    $resultados = $mysqli->query("SELECT pk_publicacion,fk_persona,fk_producto, nombre_producto, cantidad, precio, CONCAT(nombre,' ',apellido_paterno,' ',apeelido_materno) as 'nombre', ruta_archivo
    FROM producto,persona,publicacion
    WHERE fk_persona = persona.pk_persona and producto.pk_producto = fk_producto and pk_producto = $producto");

    $datos = $resultados->fetch_all(MYSQLI_ASSOC);

    //obtenemos el numero de registros
    $total = mysqli_num_rows($resultados);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGRO</title>
   <link rel="stylesheet" href="css/estilo.css">
   <link rel="icon" href="img/AGRO-LOGO.png">
</head>
<body>
    <div class="borde">
    <?php 
    include_once("menu.php");
    ?>
    </div>
    <div class="borde">
        <h2>Confirme la compra</h2>
    <?php
    foreach($datos as $registro)
    {
        ?>
        <div style="width: 20%; height: 15%; border-color=#000">
        <h1><?php echo $registro['nombre'];?></h1>
        <img src="<?php echo $registro['ruta_archivo'];?>" alt="" style="width: 350px; height: 350px;">
        <a href="venta.php?producto=<?php echo $registro['pk_publicacion'] ?>"><button style="width: 350px; height: 50px;">Comprar</button></a>
        </div>
        <?php
    }
    ?>   
    </div> 
</body>
</html>