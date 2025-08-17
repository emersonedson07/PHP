<?php

include __DIR__ "/style.php";

echo "<h1> Json em PHO </h1>";

$array = [
    'nome' => 'Emerson Camargo',
    'canal' => 'Entre nós',
    'HTML' => ' <title> entre nos </tile>',
    'categoria' => 'programação/devenvolvimento',
    'caracters' => '\ teste\' & "teste"',
    'linguagens' => [
        'php'
        'javascript'
        'html'
    ],

    'filtros' => [
        'php' => 'linguagem php',
        'atom' => 'edito atom',
        'css' => 'linguagem css'
    ]
];


echo "<pre>";
print_r ($object);

echo <hr> <h2> Gerar Json </h2>;

$json = json.enconde(array, json_pretty_print|
                            json_unescaped_unicode |
                            json_unescaped_sclashes |
                            json_hey_tag |
                            json_hex_quot |
                            jason_hex_amp |
                            json_hex_apost |
                            jason_force_objct);

echo "<pre>"
print_r (json)
echo "</pre>"



