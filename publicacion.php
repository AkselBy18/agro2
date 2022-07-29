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
if(isset($_GET['producto']))
{
    $producto = $_GET['producto'];
    include("conexion.php"); 
    //consulta para obtenere toda la información de la tabla
    $resultados = $mysqli->query("SELECT pk_publicacion,titulo,publicacion.descripcion,ruta_archivo,cantidad,precio,fk_producto,fk_persona FROM publicacion,producto where pk_publicacion = $producto and fk_producto = pk_producto");

    $datos = $resultados->fetch_all(MYSQLI_ASSOC);

    //consulta para obtenere toda la información de la tabla
    $comentarios = $mysqli->query("SELECT contenido, CONCAT(nombre,' ', apellido_paterno,' ',apeelido_materno) as nombre  FROM comentario_publicacion, comentario, persona WHERE fk_publicacion = $producto AND fk_persona = pk_persona AND pk_comentario = fk_comentario ORDER BY pk_comentario_publicacion");

    $datosComentarios = $comentarios->fetch_all(MYSQLI_ASSOC);

    //obtenemos el numero de registros
    $total = mysqli_num_rows($resultados);

    // session_start();
        $usuario = $_SESSION['username'];
        $id = $_SESSION['id'];
        $_SESSION['producto']=$producto;

        if(empty($id))
        {
            echo "<script>
                window.location='index.php';
              </script>
        ";
        }
}
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
    ?><br><br>
<div class="container is-max-desktop">
<div class="box contenido" >
  <div class="card public">
  
    <?php
    foreach($datos as $registro)
    $sub=$registro['precio']*$registro['cantidad'];
    $comicion = ($sub)*0.01;
    $total=($sub)+$comicion;
    $producto=$registro['fk_producto'];
    $idPersonaVende=$registro['fk_persona'];
    {
        ?>
      
        <h1 style=" margin-left: 2%;" class="is-size-2"><?php echo $registro['titulo'];?></h1>
        <img src="<?php echo $registro['ruta_archivo'];?>" alt="" style="width: 350px; height: 350px;">
        <h5 style=" margin-left: 2%;" class="is-size-4"><?php echo $registro['descripcion'];?></h5>
        <h5 style=" margin-left: 2%;" class="is-size-4">Precio unitario: <?php echo "$".$registro['precio'];?></h5>
        <h5 style=" margin-left: 2%;" class="is-size-4">Sub total: <?php echo "$".$sub;?></h5>
        <h5 style=" margin-left: 2%;" class="is-size-4">Comision: <?php echo "$".$comicion?></h5>
        <h5 style=" margin-left: 2%;" class="is-size-4">total: <?php echo "$".$total?></h5>
        <form action="" method="post">
        <div style="width: 350px;"><button class="button is-dark is-fullwidth is-rounded is-responsive is-medium" type="submit">Confirmar compra</button></div>
        </form>
        <?php
    }
    ?>   
    </div>
        <br>
        <div class="card public">
            <form action="alta-comentario.php" method="post">
            <lable class="lable" style=" margin-left: 2%;">Escribe un comentario</lable>
            <input class="textarea" name="comentario" id="comentario">
            <button class="button is-dark is-fullwidth is-rounded is-responsive is-medium" type="submit">Enviar comentario</button>
            </form>
        </div>  <br><br>
        <h1 class="is-size-2">Comentarios realizados</h1>
        <?php
        if (empty($datosComentarios)) 
        {
            echo"<h1 class='is-size-5'>Sin comentarios </h1>";
        }
        foreach($datosComentarios as $coment)
        {
            ?>
        <div class="card public">
            <h5 class="is-size-5" style=" margin-left: 2%;"><b><?php echo $coment['nombre'];?></b></h5>
            <h5 class="is-size-6" style=" margin-left: 2%;"><?php echo $coment['contenido'];?></h5>
        </div> <br>
            <?php
        }
        ?>    
        
    </div> 
    </div> 
    <?php

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            date_default_timezone_set('America/Mazatlan');    
            $fecha = date('Y-m-d');  
            $publicacion = $registro['pk_publicacion'];
          

             //Query para insertar los datos
             $sentencia = $mysqli->prepare("INSERT INTO venta (fk_producto,fecha_compra,fk_persona,fk_persona_vende,comision) VALUES (?,?,?,?,?)");

            // Query para actualizar la publicacion y no mostrarla 
             $update ="UPDATE `publicacion` SET `estado` = '1' WHERE `publicacion`.`pk_publicacion` = $publicacion"; 

             $mysqli->query($update);

             $sentencia->bind_param("isiis", $producto,$fecha,$id,$idPersonaVende,$comicion);
 
             //ejecutamos la consulta
             if($sentencia->execute()){
                 echo '<script>
                         alert("Comprado exitosamente");
                     </script>';
             }else{
                 echo '<script>
                         alert("Error al realizar la compra");
                     </script>';
             }
        }
        ?>
</body>
</html>