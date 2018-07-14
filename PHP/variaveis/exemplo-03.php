<?PHP

    $nome = "Felipe";  
    $site = 'hcode.com.br';


    $ano = 1990;
    $salario = 5500.99;
    $bloqueado = false;
////////////////////////////////////////////
$frutas = array('abacaxi', 'manga', 'pera');

foreach ($frutas as $key => $fruta) {
     echo $fruta;
     echo '<br>';
}

$anoNascimento = new DateTime();

//var_dump($anoNascimento);
//////////////////////////////////////////

$arquivo = fopen("exemplo-03.php","r");

//var_dump($arquivo);

$nulo = NULL;
?>