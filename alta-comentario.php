<?php
include("conexion.php");
session_start();
        $usuario = $_SESSION['username'];
        $id = $_SESSION['id'];
        $p = $_SESSION['producto'];

        if(empty($id))
        {
            echo "<script>
                window.location='index.php';
              </script>
        ";
        }

            $comentario=$_POST["comentario"];
            
            if($comentario!="")
            {
            // Query para dar de alta un comentario
             $coment = $mysqli->prepare("INSERT INTO comentario (contenido) VALUES (?)");
             $coment->bind_param("s", $comentario);

           

            //  comprobamos que se mande el comentario
             if($coment->execute()){
            //   header("location: publicacion.php?producto=$p");
             echo '<script>
                          alert("Comentario realizado");
                      </script>';
              }else{
                  echo '<script>
                          alert("Error al realizar el comentario");
                      </script>';
              }

        // consulta para obtenere toda la información de la tabla
        $resultados = $mysqli->query("SELECT * FROM comentario WHERE contenido = '$comentario'");

        $datos = $resultados->fetch_all(MYSQLI_ASSOC);

        foreach ($datos as $key => $valores)
        {
            $idComentario = $valores['pk_comentario'];
        }
        
         // Query para dar de alta el comentario en la publicacion
         $publicacion = $mysqli->prepare("INSERT INTO comentario_publicacion (fk_publicacion,fk_persona,fk_comentario) VALUES (?,?,?)");
         $publicacion->bind_param("iii", $p, $id, $idComentario);
         
         //comprobamos que se mande el comentario
         if($publicacion->execute()){
            header("location: publicacion.php?producto=$p");
             }else{
                 echo '<script>
                         alert("Ocurrio un error");
                     </script>';
             }
            }
            else{
                echo '<script>
                alert("Debe de intriducir contenido al comentario");
            </script>'; 
            header("location: publicacion.php?producto=$p");
            }
?>