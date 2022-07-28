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
    <h2 class="is-size-2">Realice una nueva publicación</h2>
    </div>
<div class="container is-max-desktop">
  <div class="notification contenido">
    <form action="" method="post" enctype="multipart/form-data">
        <label class="label" for="">Titulo</label>
        <input class="input" type="text" name="titulo" id="titulo" required><br>
        <label class="label" for="">Descripcion</label>
        <input class="input" type="text" name="desc" id="desc" required><br>
        <label class="label" for="">Foto del producto</label>
        <input class="input" type="file" name="archivo" id="archivo" required><br>
        <label class="label" for="">Producto</label>
    <div class="select">  
        <select name="producto" id="producto">
            <option value="">Seleccione...</option>
            <?php   
                $consulta = "SELECT pk_producto, CONCAT(nombre_producto,' - ',descripcion) as 'producto' from producto";
                $resultado = mysqli_query($mysqli, $consulta);

                foreach ($resultado as $result => $values) {
                    echo ' <option value="'.$values['pk_producto'].'">'.$values['producto'].'</option>';
                }
            ?>
        </select>    
    </div>
    <br><br><b></b>
<div class="field is-grouped">
  <div class="control">
    <button class="button is-dark is-rounded is-responsive is-medium" type="submit">Guardar </button>
  </div>
  <div class="control">
    <button class="button is-light is-rounded is-responsive is-medium" type="reset">Cancel</button>
  </div>
</div>
 </div>
</div>
    <?php

         if($_SERVER['REQUEST_METHOD']=='POST')
         {
         //Variables para la mover la imagen   
         $archivoTemp = $_FILES['archivo']['tmp_name'];
         $archivoReal = $_FILES['archivo']['name'];
         $tipoArchivo = $_FILES['archivo']['type'];  
         $tamanio = $_FILES['archivo']['size'];
         
         //Variables para los datos
         $titulo = $_POST['titulo'];
         $desc = $_POST['desc'];
         $produto = $_POST['producto'];

         date_default_timezone_set('America/Mazatlan');    
         $fecha = date('Y-m-d');  

         $persona = $id;
         // Mover la imgen a la carpeta 
         $ruta="img/".$archivoReal;
         move_uploaded_file($archivoTemp,$ruta);
         
          //Query para insertar los datos
          $sentencia = $mysqli->prepare("INSERT INTO publicacion (titulo,descripcion,ruta_archivo,fecha_publicacion,fk_persona,fk_producto) VALUES (?,?,?,?,?,?)");

          $sentencia->bind_param("ssssii", $titulo,$desc,$ruta,$fecha,$persona,$produto);

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
    <?php
        
    ?>