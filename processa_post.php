<?php
require_once 'valida_campos.php';
require_once 'valida_idade.php';
require_once 'valida_faixa.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo 'Método não permitido. Envie o formulário via POST.';
  exit;
}

$dados = $_POST;


$erros = validar_campos($dados);


if ($msg = validar_idade($dados['idade'] ?? null)) {
  $erros[] = $msg;
}
$idadeInt = isset($dados['idade']) && is_numeric($dados['idade']) ? (int)$dados['idade'] : null;

if ($idadeInt !== null) {
  if ($msg = validar_faixa($dados['faixa'] ?? null, $idadeInt)) {
    $erros[] = $msg;
  }
}

if ($erros) {
  echo "<h3>Erros encontrados (POST):</h3><ul>";
  foreach ($erros as $e) {
    echo '<li>' . htmlspecialchars($e, ENT_QUOTES, 'UTF-8') . '</li>';
  }
  echo "</ul><p><a href='forms.html'>&larr; Voltar</a></p>";
  exit;
}

$nome  = htmlspecialchars($dados['nome'],  ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($dados['email'], ENT_QUOTES, 'UTF-8');
$faixa = htmlspecialchars($dados['faixa'], ENT_QUOTES, 'UTF-8');
$idade = $idadeInt;

echo "<h3>Dados recebidos (POST) com sucesso!</h3>";
echo "Nome: {$nome}<br>";
echo "Email: {$email}<br>";
echo "Idade: {$idade}<br>";
echo "Faixa Etária: {$faixa}<br>";
echo "<p><a href='forms.html'>&larr; Voltar</a></p>";