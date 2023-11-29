<?php 
require "conecta.php";
$con = conecta();

// Recibe los datos del formulario
$nombre = $_REQUEST['nombre'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$passEnc = md5($pass);

// Inserta los datos en la tabla 'cliente'
$sql = "INSERT INTO cliente (Nombre_C, Correo_C) VALUES ('$nombre', '$correo')";
$res = $con->query($sql);

// Inserta los datos en la tabla 'usuarios' y obtiene el ID generado
$sql2 = "INSERT INTO usuarios (contraseña, Foranea) VALUES ('$pass', '$nombre')";
$res = $con->query($sql2);

if ($res) {
    // Obtén el ID insertado
    $id_usuario = $con->insert_id;

    // Muestra el mensaje centrado
    echo '<h1 style="text-align: center;">Tu cuenta fue creada</h1>';
    echo "<p style='text-align: center;'>Tu ID es $id_usuario.</p>";

    // Redirige después de 5 segundos
    echo "<script>
            setTimeout(function() {
                window.location.href = '_nueva_cuenta.php';
            }, 5000); 
          </script>";
} else {
    echo "Error al crear la cuenta.";
}
?>