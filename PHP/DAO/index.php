<?php

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuario");

echo json_encode($usuarios);*/

//Carrega um usuário
/*
$root->loadById(5);

echo $root;
*/

//Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuário buscando pelo login
//$search = Usuario::search("lo");
//echo json_encode($search);

//Carrega um usuário a partir do login e senha
//$user = new Usuario();
//$user->login("louro","12344");
//echo $user;


//Inserindo um usuário no banco de dados
//$aluno = new Usuario();
//$aluno->setLogin("aluno");
//$aluno->setSenha("@lun0");
//$aluno->insert();

//echo $aluno;


//Atualizando um usuário
/*$usuario = new Usuario();

$usuario->loadById(6);

$usuario->update("professor","senhaDoProfessor");

echo $usuario;
*/

//Deletando um registro
$usuario = new Usuario();

$usuario->loadById(6);
$usuario->delete();

echo $usuario;

?>