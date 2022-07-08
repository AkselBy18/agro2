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
    <h2>Alta de productos</h2>
    <form action="" method="post">
        <label for="">Titulo</label>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="">Descripcion</label>
        <input type="text" name="desc" id="desc" required><br>
        <label for="">Foto del producto</label>
        <input type="file" name="foto" id="foto" required><br>
        <label for="">Producto</label>
        <select name="ciudad" id="ciudad">
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
        
    ?>
</body>
</html>