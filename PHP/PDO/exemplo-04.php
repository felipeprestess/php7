<?php

$con = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

$stmt = $con->prepare("UPDATE tb_usuario SET login = :LOGIN, senha = :PASSWORD WHERE id = :ID");

$login = "jaozinho";
$password = "xablau";
$id = 3;

$stmt->bindParam(":LOGIN",$login);
$stmt->bindParam(":PASSWORD",$password);
$stmt->bindParam(":ID",$id);

$stmt->execute();

echo "Dados alterados com sucesso!";
?>