<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido técnico</title>
    <style>
        
        #formulario_prod,
        #formulario_rep,
        #formulario_sta,
        #formulario_insumo,
        #consulta_rep,
        #consulta_prod,
        #consulta_ins {
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
        
        form {
            text-align: left;
        }

        input[type="text"],
        select,
        input[type="date"],
        input[type="number"] {
            width: 90%;
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
</head>
<body>
    <div id="inicio">
        <h1>Bienvenido, seleccione una opción</h1>
        <button type="button" onclick="mostrarFormulario_prod()">Registrar Producto</button>
        <button type="button" onclick="mostrarFormulario_rep()">Registrar Reparación</button>
        <button type="button" onclick="mostrarFormulario_update()">Actualizar estatus Reparación</button>
        <button type="button" onclick="mostrarFormulario_insumos()">Registrar Insumos</button>
        <button type="button" onclick="consulta_rep()">Lista de reparaciones</button>
        <button type="button" onclick="consulta_prod()">Lista de Productos</button>
        <button type="button" onclick="consulta_ins()">Lista de Insumos</button>
    </div>

    <div id="formularios">

        <form name="formulario_prod" id="formulario_prod" method="post" action="_registro_prod.php">
            <input type="text" name="tipo" id="tipo" placeholder="Tipo de producto"/><br>
            <input type="text" name="color" id="color" placeholder="Color del producto"/><br>
            <input type="text" name="marca" id="marca" placeholder="Marca del producto" /><br>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del cliente" /><br>
            <input type="submit" value="Enviar" /><br><br>
            <button type="button" onclick="mostrarInicio()">Regresar</button>
        </form>

        <form name="formulario_rep" id="formulario_rep" method="post" action="_registro_rep.php">
            <input type="text" name="producto" id="producto" placeholder="ID de producto"/><br>
            <input type="submit" value="Enviar" /><br><br>
            <button type="button" onclick="mostrarInicio()">Regresar</button>
        </form>

        <form name="formulario_sta" id="formulario_sta" method="post" action="_update_rep.php">
            <input type="text" name="id_rep" id="id_rep" placeholder="Id de la Reparación"/><br>
            <select name="estatus" id="estatus">
                <option value="0">Estatus </option>
                <option value="1">Iniciada </option>
                <option value="2">En proceso </option>
                <option value="3">Finalizada </option>
            </select><br>
            <input type="date" name="fecha" id="fecha" placeholder="Fecha de terminación" /><br>
            <input type="text" name="insumos" id="insumos" placeholder="Insumos"/><br>
            <input type="text" name="MO" id="MO" placeholder="Mano de obra"/><br>
            <input type="submit" value="Enviar" /><br><br>
            <button type="button" onclick="mostrarInicio()">Regresar</button>
        </form>

        <form name="formulario_insumo" id="formulario_insumo"method="post" action="_registro_insumo.php">
            <input type="text" name="nombre_i" id="nombre_i" placeholder="Nombre del insumo"/><br>
            <label for="precio">Precio del Insumo:</label>
            <input type="number" id="precio" name="precio" min="0" step="0.01" required><br>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="0" step="1" required>
            <input type="submit" value="Enviar" /><br><br>
            <button type="button" onclick="mostrarInicio()">Regresar</button>
        </form>
    </div>
    <?php
    require "conecta.php";
    $con = conecta();
    ?>
    <div id="consultas">

        <div id="consulta_prod">
            <?php

            $sql = "SELECT * FROM producto";
            $res = $con->query($sql);

            if ($res->num_rows > 0) {
                echo "<h2>Lista de productos:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Id</th><th>Tipo</th><th>Color</th><th>Marca</th><th>Cliente</th></tr>";
            
                while ($fila = $res->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila['Id_Producto'] . "</td>";
                    echo "<td>" . $fila['Tipo'] . "</td>";
                    echo "<td>" . $fila['Color'] . "</td>";
                    echo "<td>" . $fila['Marca'] . "</td>";
                    echo "<td>" . $fila['Cliente'] . "</td>";
                    echo "</tr>";
                }
            
                echo "</table>";
            } else {
                echo "No tienes productos registrados.";
            }
            ?>
            <br>
            <button type="button" onclick="mostrarInicio()">Regresar</button>
        </div>

        <div id="consulta_rep">
        <?php

            $sql = "SELECT * FROM reparacion";
            $res = $con->query($sql);

            if ($res->num_rows > 0) {
                echo "<h2>Lista de reparaciones:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Id</th><th>Id Producto</th><th>Estatus</th><th>Fecha Final</th><th>Total</th><th>Insumos</th><th>MO</th></tr>";
            
                while ($fila = $res->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila['Id_Rep'] . "</td>";
                    echo "<td>" . $fila['Producto'] . "</td>";
                    echo "<td>" . $fila['Estatus_R'] . "</td>";
                    echo "<td>" . $fila['Fecha_F'] . "</td>";
                    echo "<td>" . $fila['Total'] . "</td>";
                    echo "<td>" . $fila['Insumos'] . "</td>";
                    echo "<td>" . $fila['MO'] . "</td>";
                    echo "</tr>";
                }
            
                echo "</table>";
            } else {
                echo "No tienes reparaciones registradas.";
            }
            ?>
            <br>
            <button type="button" onclick="mostrarInicio()">Regresar</button>
        </div>
        
        <div id="consulta_ins">
        <?php

            $sql = "SELECT * FROM insumos";
            $res = $con->query($sql);

            if ($res->num_rows > 0) {
                echo "<h2>Lista de insumos:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Id</th><th>Nombre</th><th>Precio</th><th>Stock</th></tr>";
            
                while ($fila = $res->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_Insumo'] . "</td>";
                    echo "<td>" . $fila['Nombre_I'] . "</td>";
                    echo "<td>" . $fila['Precio'] . "</td>";
                    echo "<td>" . $fila['Stock'] . "</td>";
                    echo "</tr>";
                }
            
                echo "</table>";
            } else {
                echo "No tienes reparaciones registradas.";
            }
            ?>
            <br>
            <button type="button" onclick="mostrarInicio()">Regresar</button>
        </div>
    </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function mostrarFormulario_prod() {
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('formulario_prod').style.display = 'block';
        }

        function mostrarFormulario_rep() {
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('formulario_rep').style.display = 'block';
        }

        function mostrarFormulario_update() {
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('formulario_sta').style.display = 'block';
        }

        function mostrarInicio() {
            document.getElementById('inicio').style.display = 'block';
            document.getElementById('formulario_prod').style.display = 'none';
            document.getElementById('formulario_rep').style.display = 'none';
            document.getElementById('formulario_sta').style.display = 'none';
            document.getElementById('formulario_insumo').style.display = 'none';
            document.getElementById('consultas').style.display = 'none';
        }

        function mostrarFormulario_insumos() {
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('formulario_insumo').style.display = 'block';
        }

        function consulta_rep(){
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('consulta_rep').style.display = 'block';
        }

        function consulta_prod(){
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('consulta_prod').style.display = 'block';
        }

        function consulta_ins(){
            document.getElementById('inicio').style.display = 'none';
            document.getElementById('consulta_ins').style.display = 'block';
        }
    </script>
</body>
</html>