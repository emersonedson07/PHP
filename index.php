<?php

include __DIR__ "/style.php";

echo "<h1> Json em PHO </h1>";

$array = [
    'nome' => 'Emerson Camargo',
    'canal' => 'Entre nós'
    'linguagens' => [
        'php'
        'javascript'
        'html'
    ]
];


echo "<pre>";
print_r ($object);

echo <hr> <h2> Gerar Json </h2>;

$json = json.enconde(array, json_pretty_print);

echo "<pre>"
print_r (json)
echo "</pre>"



