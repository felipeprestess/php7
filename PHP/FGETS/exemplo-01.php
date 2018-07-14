<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 01/06/2018
 * Time: 20:47
 */


$filename = "usuarios.csv";
//Verifica se o arquivo é existente
if(file_exists($filename)){
    //faz a leitura do arquivo
    $file = fopen($filename ,"r");
    //Pega a primeira linha formando o cabeçalho
    $headers = explode(",",fgets($file));
    //cria um array para os dados
    $data = array();

    while ($row = fgets($file)){

        $rowData = explode(",", $row);
        $linha = array();

        for ($i = 0; $i < count($headers); $i++){
            $linha[$headers[$i]] = $rowData[$i];
        }

        array_push($data, $linha);
    }
    fclose($file);

    echo json_encode($data);

}

?>