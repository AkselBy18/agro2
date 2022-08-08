<?php
$host = "localhost"; //servidor
$usuario = "root"; //usuario en phpmyadmin
$contrasenia = ""; //contraseña
$base_datos = "agro"; //base de datos

//delcaramos una variable conexion
$mysqli = mysqli_connect($host, $usuario, $contrasenia, $base_datos);
//si hay error en la conexion mostramos el error
$conexion = mysqli_connect("localhost","root","","agro");
if(mysqli_connect_errno())
{
    echo "Error en la conexion ".mysqli_connect_error();
    exit();
}

// comentario