<?php
        session_start();
        $usuario = $_SESSION['username'];
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
    include_once("menu.php");
    ?>

    <div class="borde">
    <?php
        echo"<h1>Bienvenido $usuario con id: $id</h1>";
    ?>
        
    </div>
</body>
</html>

