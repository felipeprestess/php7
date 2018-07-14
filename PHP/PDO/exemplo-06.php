<?php

//Deletando um registro via statement por pDO

$con = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

$con->beginTransaction();

$stmt = $con->prepare("DELETE FROM tb_usuario WHERE id = ?");

$id = 4;

$stmt->execute(array($id)); //A variável $id é de acordo com a quantidade de ? que está dentro da cláusula Delete

//volta a transação
//$con->rollBack();

//Confirma o delete na tabela
$con->commit();

echo "Dados deletados com sucesso!";
?>