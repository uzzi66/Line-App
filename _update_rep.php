<?php 
//empleados_salva.cpp
require "conecta.php";
$con = conecta();

//recibe
$id    =$_REQUEST['id_rep'];
$estatus     =$_REQUEST['estatus'];
$fecha       =$_REQUEST['fecha'];
$insumos     =$_REQUEST['insumos'];
$MO          =$_REQUEST['MO'];

$sql = "UPDATE reparacion SET
        Estatus_R='$estatus', Fecha_F='$fecha', Insumos='$insumos', MO='$MO'
        WHERE Id_Rep='$id'";
$res = $con->query($sql);
header("Location: _sesion_tecnico.php");
?>