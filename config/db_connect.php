<?php
//Conexão com banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "etapa2";

$connect = mysqli_connect($servername, $username, $password, $db_name);
mysqli_set_charset($connect, "utf8");

if(mysqli_connect_error()):
    echo "Erro de conexão com o banco de dados. Erro: ".mysqli_connect_error();
// else:
//     echo "Conectado com sucesso!";
endif;