<?php
    $user = $_POST["name"];
    $contra = $_POST["pass"];

    session_start();
    $_SESSION['name']=$user;

    include('conexion.php');

    $consulta = "SELECT * FROM persona where correo='$user' and contrasena='$contra'";

    $resultado = mysqli_query($mysqli,$consulta);
    
    $filas = mysqli_fetch_array($resultado);
    
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
    mysqli_close($mysqli);
?>