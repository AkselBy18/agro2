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

    // consulta para obtener las ventas realizadas de los productos
    $ventas = $mysqli->query("SELECT pk_venta, pk_producto, nombre_producto, cantidad, precio, fecha_compra, CONCAT(nombre,' ',apellido_paterno,' ',apeelido_materno) as 'nombre', comision FROM producto,persona,venta
    WHERE fk_producto=pk_producto and fk_persona = pk_persona and fk_persona_vende = $id");
    
    $datosVentas = $ventas->fetch_all(MYSQLI_ASSOC);

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
    <h1 class="title">Ventas realizadas</h1>
    
    <?php
    if (empty($datosVentas)) 
    {
        echo"<h1 class='is-size-5'>Sin ventas realizadas </h1>";
    }
    else{
        ?>
        <div class="table-container " >
                                <table class="table is-striped is-bordered ">
                                <thead>
                                    <tr>
                                        <th>Id de venta</th>
                                        <th>Nombre Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Comicion</th>
                                        <th>Total con comicion</th>
                                        <th>Fecha compra</th>
                                        <th>Persona de compra</th>    
                                        <th>Ociones</th>
                                    </tr>
                                </thead>
                                <tbody>
        <?php
        foreach($datosVentas as $ventas)
        {
            
            ?>
                        
                            <tr>
                                <th><?php echo $ventas['pk_venta'] ?></th>
                                <th><?php echo $ventas['nombre_producto'] ?></th>
                                <th><?php echo $ventas['cantidad'] ?></th>
                                <th><?php echo $ventas['precio'] ?></th>
                                <th><?php echo $ventas['comision'] ?></th>
                                <th><?php echo $ventas['precio']*$ventas['cantidad']+$ventas['comision'] ?></th>
                                <th><?php echo $ventas['fecha_compra'] ?></th>
                                <th><?php echo $ventas['nombre'] ?></th>
                                <th><a href="factura.php?venta=<?php echo $ventas['pk_venta']?>&producto=<?php echo $ventas['pk_producto']?>"> <button class="button is-success is-outlined is-small"><b>Facturar</b></button></a></th>
                            </tr>
                        
             
            <?php
        }
    }
    ?>
    </tbody>
    </table>
       </div>
    </div>
    
</body>
</html>

