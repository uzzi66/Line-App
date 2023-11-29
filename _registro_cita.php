<?php
//empleados_salva.php
require "conecta.php";
$con = conecta();

// Recibe la fecha y el ID del cliente
$fecha = $_POST['fecha'];
$id_cliente = $_POST['id_cliente'];

// Consulta SQL para obtener la Foranea del cliente
$sql = "SELECT Foranea FROM usuarios WHERE id_usuario = $id_cliente";
$resultado = $con->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $cliente = $resultado->fetch_assoc()['Foranea'];

    // Consulta SQL para insertar la cita
    $sql2 = "INSERT INTO cita (fecha, Cliente) VALUES ('$fecha', '$cliente')";
    if ($con->query($sql2)) {
        echo "Se registró su cita para el $fecha";

        echo "<script>
            setTimeout(function() {
                window.location.href = '_sesion_cliente.php';
            }, 2000); 
        </script>";
    } else {
        echo "Error al registrar la cita.";
    }
} else {
    echo "Error al obtener la información del cliente.";
}
?>