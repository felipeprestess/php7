<?php

$conn = new mysqli("localhost","root","", "dbphp7");

if($conn->connect_error){
    echo "Erro: ".$conn->connect_error;
}

/*$stmt = $conn->prepare("INSERT INTO tb_usuario (login,senha) VALUES (?,?)");

$stmt->bind_param("ss",$login,$pass);

$login = "user";
$pass = "12345";

$stmt->execute();*/
?>