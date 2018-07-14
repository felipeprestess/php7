<?PHP

$pessoa = array(
    'nome'=>'Felipe',
    'idade'=>23
);

foreach ($pessoa as &$value) {
    echo $value .'<br>';
}

?>