<?php
//criar conexao
    $server = "localhost";
    $user = "****";
    $password = "*********";
    $db = "aula_sql";
    $conn = mysqli_connect($server,$user,$password,$db);
//testar
    if(mysqli_connect_errno()){
        die("Conexão falhou: ".mysqli_connect_errno());
    }
?>