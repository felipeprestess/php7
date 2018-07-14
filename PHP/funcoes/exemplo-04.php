<?PHP

function hello(){
    $argumentos = func_get_args();

    return $argumentos;
}



 var_dump(hello("Bom dia",10));

?>