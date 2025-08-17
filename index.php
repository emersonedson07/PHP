<?php

include __DIR__ . "/style.php";

echo "<h1>Json em PHP</h1>";

$array = [
    'nome' => 'Emerson Camargo',
    'canal' => 'Entre nós',
    'HTML' => '<title>entre nos</title>',
    'categoria' => 'programação/desenvolvimento',
    'caracters' => '\\ teste\\\' & \"teste\"',
    'linguagens' => [
        'php',
        'javascript',
        'html'
    ],
    'filtros' => [
        'php' => 'linguagem php',
        'atom' => 'editor atom',
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
print_r($array);
echo "</pre>";

echo "<hr><h2>Gerar JSON</h2>";

$json = json_encode($array, JSON_PRETTY_PRINT |
                            JSON_UNESCAPED_UNICODE |
                            JSON_UNESCAPED_SLASHES |
                            JSON_HEX_TAG |
                            JSON_HEX_QUOT |
                            JSON_HEX_AMP |
                            JSON_HEX_APOS |
                            JSON_FORCE_OBJECT |
                            JSON_NUMERIC_CHECK |
                            JSON_PRESERVE_ZERO_FRACTION);

echo "<pre>";
print_r($json);
echo "</pre>";

echo "<hr><h2>Consumir JSON</h2>";

$decode = json_decode($json, true);

echo "<pre>";
print_r($decode);
echo "</pre>";

echo "<hr><h2>Last Error</h2>";

$lasterror = json_last_error();
$lasterrorMsg = json_last_error_msg();

echo "<pre>";
echo "Código do erro: $lasterror\n";
echo "Mensagem: $lasterrorMsg\n";
echo "</pre>";

// Lista de todos os erros possíveis
$jsonErrors = [
    JSON_ERROR_NONE => 'Nenhum erro',
    JSON_ERROR_DEPTH => 'Profundidade máxima excedida',
    JSON_ERROR_STATE_MISMATCH => 'JSON inválido ou mal formado',
    JSON_ERROR_CTRL_CHAR => 'Caractere de controle inesperado encontrado',
    JSON_ERROR_SYNTAX => 'Erro de sintaxe',
    JSON_ERROR_UTF8 => 'Caracteres UTF-8 malformados, possível codificação incorreta',
    JSON_ERROR_RECURSION => 'Uma ou mais referências recursivas na estrutura',
    JSON_ERROR_INF_OR_NAN => 'NAN ou INF em um valor flutuante',
    JSON_ERROR_UNSUPPORTED_TYPE => 'Tipo de dado não suportado',
    JSON_ERROR_INVALID_PROPERTY_NAME => 'Nome de propriedade inválido',
    JSON_ERROR_UTF16 => 'Caracteres UTF-16 malformados, possível codificação incorreta'
];

echo "<hr><h2>Lista de Erros JSON</h2>";
echo "<pre>";
foreach ($jsonErrors as $code => $message) {
    echo "[$code] => $message\n";
}
echo "</pre>";
?>




