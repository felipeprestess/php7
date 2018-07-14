<?php

//Deletando um registro via statement por pDO

$con = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

$stmt = $con->prepare("DELETE FROM tb_usuario WHERE id = :ID");

$id = 3;

$stmt->bindParam(":ID",$id);

$stmt->execute();

echo "Dados deletados com sucesso!";
?>