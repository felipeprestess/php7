<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 29/05/2018
 * Time: 19:27
 */

header("Content-Type: text/html; charset=utf-8");

require_once "../vendor/autoload.php";

$arrayGrid = array(
    "DESCRICAO" => array("Macarrão", "Feijão", "Arroz"),
    "VALOR" => array("10,00", "4,50", "3,50"),
    "QUANTIDADE" => array("5","7","19")
);

if(!empty($_REQUEST)){
    var_dump($_REQUEST);
}



?>

<!doctype html>
<html lang=pt>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learn PHP</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<div class="container">
    <div class="">

    </div>
</div>
<form method="post" action="Index.php"  >
    <table border="0">
        <?PHP
        echo "<thead><tr>";
        echo "<th><input type='checkbox' id='todos' class='marcar'/></th>";
        foreach ($arrayGrid as $key => $values){
            echo "<th>{$key}</th>";
        }
        echo "</tr>\n</thead>";

        for($i =0; $i < count($arrayGrid); $i++){
            echo '<tr><td><input class="marcar" type="checkbox" name="'.$arrayGrid["DESCRICAO"][$i].'" value="'.$arrayGrid["DESCRICAO"][$i].'"></td>';
            echo "<td>".$arrayGrid["DESCRICAO"][$i]."</td>";
            echo "<td>".$arrayGrid["VALOR"][$i]."</td>";
            echo "<td>".$arrayGrid["QUANTIDADE"][$i]."</td>";
            echo "</tr>";
        }
        ?>

    </table>
    <input type="submit" id="enviar" onclick="pegaValor();" value="Pegar" />
</form>
<script>

    function pegaValor(){

        for (var i = 0; i < document.getElementsByClassName('marcar').length; i++){
            var value = document.getElementsByClassName('marcar')[i].checked;
            if(value){
                var valorPost = document.getElementsByClassName('marcar')[i].value;
                $.post('Index.php',{
                    nome: valorPost
                },function (response) {
                    //alert(valorPost);
                });
            }
        }
    }


    $(function () {
        $("#enviar").click(function () {
            for (var i = 0; i < document.getElementsByClassName('marcar').length; i++){
                var value = document.getElementsByClassName('marcar')[i].checked;
                if(value){
                    var valorPost = document.getElementsByClassName('marcar')[i].value;
                    $.post('Resultados.php',{
                        nome: valorPost
                    },function (response) {
                        //alert(valorPost);
                    });
                }
            }
        });
    });



</script>

</body>
</html>
