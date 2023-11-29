<?php 
require "conecta.php";
$con = conecta();

//recibe
$id   =$_REQUEST['usuario'];
$pass   =$_REQUEST['contrasena'];

$sql        ="SELECT * FROM usuarios
              WHERE id_usuario=$id AND contraseña=$pass";
$res = $con->query($sql);



if ($res->num_rows > 0) {
    // Las credenciales son correctas, obtén el rol del usuario
    $sql2 = "SELECT rol FROM usuarios WHERE id_usuario = $id AND contraseña = '$pass'";
    $rol = $con->query($sql2)->fetch_assoc()['rol'];

    if ($rol === '1') {
        // Redirige a la página del cliente
        header("Location: _sesion_cliente.php?id=$id");
        exit(); 
    } elseif ($rol === '2') {
        // Redirige a la página del técnico
        header("Location: _sesion_tecnico.php");
        exit();
    } else {
        // El rol no es válido
        echo "Rol de usuario no válido.";
    }
}
else {
    echo "Usuario o contraseña incorrectos.";
    echo "<script>
        setTimeout(function() {
            window.location.href = '_login.php';
        }, 2000); 
    </script>";
}
?>