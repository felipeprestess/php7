<?php

$con = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

$stmt = $con->prepare("INSERT INTO tb_usuario (login,senha) VALUES (:LOGIN,:PASSWORD)");

$login = "louro";
$password = "1234";

$stmt->bindParam(":LOGIN",$login);
$stmt->bindParam(":PASSWORD",$password);

$stmt->execute();

echo "Dados inseridos com sucesso!";
?>