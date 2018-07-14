<?PHP

$nome = "felipe";

function Teste()
{
    global $nome;
    echo $nome;
}

function Teste2()
{
    global $nome;
    echo '<br>'. $nome . ' agora no Teste 2';
}

Teste();
Teste2();
?>