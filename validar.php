<?php
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contra"];

    session_start();
    $_SESSION['usuario']=$usuario;

    include('conexion.php');

    $consulta = "SELECT * FROM persona where correo='$usuario' and contrasena='$contrasenia'";

    $resultado = mysqli_query($mysqli,$consulta);
    
    $filas = mysqli_num_rows($resultado);

    if($filas)
    {
        ?>
         <script>
           window.location="principal.php";
         </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert("Los datos son incorrectos");
            window.location="index.php";
        </script>
        <?php

    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);

?>