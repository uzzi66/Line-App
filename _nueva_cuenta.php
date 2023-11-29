<html>
    <head>
        <title>
            Crear cuenta
        </title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            function validar(){
                var nombre      =$('#nombre').val();
                var correo      =$('#correo').val();
                var pass        =$('#pass').val();
                if(nombre && correo && pass  > 0){
                    document.forma01.method = 'post'
                    document.forma01.action = '_clientes_salva.php'
                    document.forma01.submit();

                }else{
                    $('#mensaje').html('Faltan campos por llenar');
                }
            }


        </script>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            }

            h1 {
                text-align: center;
            }

            form {
                width: 300px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            input[type="text"] {
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

            input[type="submit"]:hover {
                background-color: #0056b3;
            }

            #mensaje {
                color: red;
                font-weight: bold;
                text-align: center;
            }
        </style>
    </head>
<body>
    <h1>Nueva Cuenta</h1>
    <form name="Form" id="Form" method="post" action="_clientes_salva.php">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo"/><br>
        <input type="text" name="correo" id="correo" placeholder="Correo"/><br>
        <input type="text" name="pass" id="pass" placeholder="Contraseña" /><br>
    
    <input type="submit" onclick="validar(); return false;" value="Enviar" /><br>
    </form>
</body>
</html>