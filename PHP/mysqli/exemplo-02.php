<?php

$conn = new mysqli("localhost","root","", "dbphp7");

if($conn->connect_error){
    echo "Erro: ".$conn->connect_error;
}

$resultado = $conn->query("SELECT * FROM tb_usuario ORDER BY login");

$data = array();//exemplo para criar um array de arrays

while ($row = $resultado->fetch_array()) {

    array_push($data, $row);
    var_dump($row);
}

//transforma os dados do array $data em JSON
echo json_encode($data);

?>