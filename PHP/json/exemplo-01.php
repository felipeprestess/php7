<?PHP

$pessoas = array();

array_push($pessoas, array('nome'=>'felipe', 'idade'=>'23'));

array_push($pessoas, array('nome'=>'mylena', 'idade'=>'22'));


echo json_encode($pessoas);

?>