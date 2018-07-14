<?PHP

$json = '[
    {
    "nome": "felipe",
    "idade": "23"
    },
    {
    "nome": "mylena",
    "idade": "22"
    }
]';

$data = json_decode($json, true);

var_dump($data);

?>