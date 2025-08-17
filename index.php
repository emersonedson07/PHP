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
    ],

    'numero' => [
        "10",
        "20",
        "30",
        "40",
        "100.75",
        "55,97",
        "10.00",
    ]
];


echo "<pre>";
print_r ($object);
echo "</pre>"

echo <hr> <h2> Gerar Json </h2>;

$json = json.enconde(array, json_pretty_print|
                            json_unescaped_unicode |
                            json_unescaped_sclashes |
                            json_hey_tag |
                            json_hex_quot |
                            jason_hex_amp |
                            json_hex_apost |
                            json_force_objct |
                            json_numeric_check |
                            json_preverse_zero_fraction );

echo "<pre>"
print_r (json)
echo "</pre>"

echo <hr> <h2>  Consumir Json <\<h2>

$decode = json_decode ($json, true);

echo "<pre>"
print_r ($decode)
echo "</pre>"





