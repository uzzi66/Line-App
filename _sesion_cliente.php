<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido Cliente</title>
    <style>
        #pedir_cita,
        #consultar {
            display: none;
            width: 400px;
            margin: 5px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #inicio {
            text-align: center;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
        }

        input[type="text"],
        select,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button {
            width: 100px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function mostrarInicio() {
            document.getElementById('inicio').style.display = 'block';
            document.getElementById('pedir_cita').style.display = 'none';
            document.getElementById('consultar').style.display = 'none';
        }
        function pedirCita() {
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('pedir_cita').style.display = 'block';
        }
        function consultarCitas() {
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('consultar').style.display = 'block';
        }
    </script>
</head>
<body>
    <div id="inicio">
        <h1>Bienvenido, seleccione una opción</h1>
        <button type="button" onclick="pedirCita()">Hacer una cita</button>
        <button type="button" onclick="consultarCitas()">Consultar mis citas</button>
    </div>

    <?php
        $id = isset($_GET['id']) ? $_GET['id'] : '';
    ?>

    <div id="pedir_cita">
        <h1>Seleccione el día para la cita</h1>
        <form name="cita" id="cita" method="post" action="_registro_cita.php">
            <input type="date" name="fecha" id="fecha" placeholder="Fecha de la cita" /><br>
            <input type="hidden" name="id_cliente" value="<?php echo $id; ?>">
            <input type="submit" value="Enviar" /><br><br>
            <button type="button" onclick="mostrarInicio()">Regresar</button>
        </form>
    </div>

    <div id="consultar">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        require "conecta.php";
        $con = conecta();

        // Consulta SQL para obtener las citas del cliente
        $id = $con->real_escape_string($_GET['id']);
        $sql = "SELECT Foranea FROM usuarios WHERE id_usuario = $id";
        $resultado = $con->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $cliente = $resultado->fetch_assoc()['Foranea'];

            // Consulta SQL para obtener las citas del cliente
            $sql2 = "SELECT * FROM cita WHERE Cliente = '$cliente'";
            $res = $con->query($sql2);

            if ($res->num_rows > 0) {
                echo "<h2>Tus citas:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Id</th><th>Fecha</th><th>Cliente</th></tr>";
            
                while ($fila = $res->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila['Id_Cita'] . "</td>";
                    echo "<td>" . $fila['fecha'] . "</td>";
                    echo "<td>" . $fila['Cliente'] . "</td>";
                    echo "</tr>";
                }
            
                echo "</table>";
            } else {
                echo "No tienes citas registradas.";
            }
        } else {
            echo "Error al obtener información del cliente.";
        }
        ?>
        <br>
        <button type="button" onclick="mostrarInicio()">Regresar</button>
    </div>
</body>
</html>