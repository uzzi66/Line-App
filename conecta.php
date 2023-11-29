<?php
//funciones/conecta.php
define("HOST",'localhost');
define("BD",'agenda_line');
define("USER_BD",'root');
define("PASS_BD",'uziDB_77');

function conecta(){
    $con = new mysqli(HOST, USER_BD, PASS_BD, BD);
    return $con;
}
?>