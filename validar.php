<?php
    session_start();
    $user = $_POST['name'];
    $clave = $_POST['pass'];

    include("conexion.php");
    $q = "SELECT COUNT(*) as 'contar',pk_persona FROM persona where correo = '$user' and contrasena = '$clave'";
    $consulta = mysqli_query($conexion,$q);

    $array = mysqli_fetch_array($consulta);
    if($array['contar']>0)
    {
        $_SESSION['username']=$user;
        $_SESSION['contra']=$clave;
        $_SESSION['id']=$array['pk_persona'];
        header("location: principal.php");
    }
    else
    {
        echo "<script>
                alert('Datos incorrectos');
                window.location='index.php';
              </script>
        ";
    }
?>