<?php 
//empleados_salva.cpp
require "conecta.php";
$con = conecta();

//recibe
$tipo     =$_REQUEST['tipo'];
$color    =$_REQUEST['color'];
$marca    =$_REQUEST['marca'];
$cliente  =$_REQUEST['nombre'];

$sql        ="INSERT INTO producto
              (Tipo, Color, Marca, Cliente)
              VALUES ('$tipo','$color','$marca', '$cliente')";
$res = $con->query($sql);
header("Location: _sesion_tecnico.php");
?>