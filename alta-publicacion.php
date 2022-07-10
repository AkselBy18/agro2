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
    <h2>Realice una nueva publicacion</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Titulo</label>
        <input type="text" name="titulo" id="titulo" required><br>
        <label for="">Descripcion</label>
        <input type="text" name="desc" id="desc" required><br>
        <label for="">Foto del producto</label>
        <input type="file" name="archivo" id="archivo" required><br>
        <label for="">Producto</label>
        <select name="producto" id="producto">
            <option value="">Seleccione...</option>
            <?php   
                $consulta = "SELECT pk_producto, CONCAT(nombre_producto,' - ',descripcion) as 'producto' from producto";
                $resultado = mysqli_query($mysqli, $consulta);

                foreach ($resultado as $result => $values) {
                    echo ' <option value="'.$values['pk_producto'].'">'.$values['producto'].'</option>';
                }
            ?>
        <input type="submit" value="Guardar">
    </form>
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

         $persona = 1;
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