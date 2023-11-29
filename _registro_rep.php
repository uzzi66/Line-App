<?php 
//empleados_salva.cpp
require "conecta.php";
$con = conecta();

//recibe
$producto   =$_REQUEST['producto'];


$sql        ="INSERT INTO reparacion
              (Producto)
              VALUES ('$producto')";
$res = $con->query($sql);
header("Location: _sesion_tecnico.php");
?>