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

if($_SERVER['REQUEST_METHOD']=='GET')
{
    $venta = $_GET['venta'];
    $producto = $_GET['producto'];

}

//consulta para obtener el id de la ciudad
$ciudad = $mysqli->query("SELECT ciudad FROM persona WHERE pk_persona = $id");
$pkCiudad = $ciudad->fetch_all(MYSQLI_ASSOC);

foreach ($pkCiudad as  $valor) {
    $idCiudad = $valor['ciudad'];
}

//consulta para validar que la factura no exista
$factura = $mysqli->query("SELECT fk_producto,fk_ciudad,fk_venta FROM factura WHERE fk_producto=$producto and fk_ciudad=$idCiudad and fk_venta=$venta");
$datosFactura = $factura->fetch_all(MYSQLI_ASSOC);

if (empty($datosFactura)) 
{
    // obtener la fecha 
    date_default_timezone_set('America/Mazatlan');    
    $fecha = date('Y-m-d');  

    //Query para insertar los datos en la tabla de factura
    $sentencia = $mysqli->prepare("INSERT INTO factura (fecha_factura,fk_producto,fk_ciudad,fk_venta) VALUES (?,?,?,?)");
    $sentencia->bind_param("siii", $fecha,$producto,$idCiudad,$venta);

    //ejecutamos la consulta
    if($sentencia->execute()){
        echo '<script>
        alert("Factura almacenada");
    </script>';
    }else{
        echo '<script>
                alert("Error al guardar los datos");
            </script>';
    }
}
else
{
    
}


//consulta para optener los datos de las facturas
$mostrarFactura = $mysqli->query("SELECT pk_factura,nombre_producto,factura.fk_producto,fecha_factura, ciudad.nombre, estado, direccion,municipio, codigo_postal, CONCAT(persona.nombre,' ',apellido_paterno,' ',apeelido_materno) as 'vendedor', producto.nombre_producto,producto.descripcion, cantidad,precio,comision
FROM producto, ciudad, factura, venta,persona
WHERE pk_producto=factura.fk_producto AND pk_ciudad=fk_ciudad AND pk_venta=fk_venta AND venta.fk_persona_vende=pk_persona and factura.fk_producto=$producto and fk_ciudad=$idCiudad and fk_venta=$venta");
$mostrarDatosFactura = $mostrarFactura->fetch_all(MYSQLI_ASSOC);

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
    <link rel="icon" href="img/AGRO-LOGO.png">
</head>
<body>
    <br><br>
    <div class="container is-max-desktop">
        <div class="box" style="height:auto; background-color:#E9EFC0; border-color: #83BD75;">
        <h1 class="title is-1">Factura</h1>
        <figure class="image is-128x128">
        <img src="img/AGRO-LOGO.png">
        </figure>
        <?php
        foreach ($mostrarDatosFactura as $valores) {
            $total = $valores['cantidad']*$valores['precio']+$valores['comision'];
            ?>
                <p style="text-transform:capitalize;"><?php echo $valores['vendedor']?></p>
                <p style="text-transform:capitalize;"><?php echo $valores['nombre']." ".$valores['municipio']." ".$valores['estado']." ".$valores['codigo_postal']?></p>
                <p style="text-transform:capitalize;">Calle: <?php echo $valores['direccion']?></p>
                <table>
                    <tr>
                        <td><b>No. de factura: </b></td>
                        <td><?php echo $valores['pk_factura']?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha de factura: </b></td>
                        <td><?php echo $valores['fecha_factura']?></td>
                    </tr>
                </table>
                <div class="table-container table is-striped"  style="background-color:#E9EFC0; border-color: #83BD75">
               <center> <table class="table" style="background-color:#E9EFC0; border-color: #83BD75">
                    <thead>
                        <tr>
                            <th>Id prodcuto</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>KG</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><?php echo $valores['fk_producto']?></th>
                            <th><?php echo $valores['nombre_producto']?></th>
                            <th><?php echo $valores['descripcion']?></th>
                            <th><?php echo $valores['cantidad']?></th>
                            <th><?php echo "$".$valores['precio']?></th>
                        </tr>
                    </tbody>
                </table>
                <div align="right" style="margin-right: 11rem;">
                <p><b>Subtotal:</b> <?php echo $valores['cantidad']*$valores['precio']?></p>
                <p><b>Comision 1%:</b> <?php echo $valores['comision']?></p>
                <p><b>Total:</b> <?php echo $total?></p>
                </div>
            </center>
                </div>
            <?php
        }
        ?>
        </div>
        <button class="button is-success is-outlined" id="imprimir"><b>Imprimir</b></button>
        <a href="principal.php"><button class="button is-dark is-outlined"><b>Regresar</b></button></a>
    </div>
    <script>
    const $boton = document.getElementById("imprimir");
    function Imprimir()
    {
    window.print();
    }
    $boton.addEventListener("click",Imprimir);
</script>
</body>
</html>