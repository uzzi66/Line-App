<?php 
require "conecta.php";
$con = conecta();

//recibe
$nombre   =$_REQUEST['nombre_i'];
$precio   =$_REQUEST['precio'];
$cantidad =$_REQUEST['cantidad'];


$sql        ="INSERT INTO insumos
              (Nombre_I, Precio, Stock)
              VALUES ('$nombre', '$precio', '$cantidad')";
$res = $con->query($sql);
header("Location: _sesion_tecnico.php");
?>