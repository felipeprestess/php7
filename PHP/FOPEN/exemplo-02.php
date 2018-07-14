<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 01/06/2018
 * Time: 19:56
 */

require_once ("config.php");

$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuario ORDER BY login");

$headers = array();

//Percorre as colunas de cabeçalho
foreach ($usuarios[0] as $key => $value){
    array_push($headers, ucfirst($key));
}

$file = fopen("usuarios.csv","w+");

fwrite($file, implode(",", $headers). "\r\n");
//Linha de registro
foreach ($usuarios as $row){
    $data = array();
    //Coluna de registro
    foreach ($row as $key => $value){
        array_push($data, $value);
    }
    fwrite($file, implode(",",$data) . "\r\n");
}

fclose($file);

echo "Arquivo CSV gerado com sucesso!";

?>