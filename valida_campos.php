<?php


function limpar($v) {
  return trim((string)$v);
}


function validar_campos(array $data): array {
  $erros = [];

  $nome  = limpar($data['nome']  ?? '');
  $email = limpar($data['email'] ?? '');

  if ($nome === '') {
    $erros[] = 'O campo Nome é obrigatório.';
  }

  if ($email === '') {
    $erros[] = 'O campo Email é obrigatório.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = 'O email informado não é válido.';
  }

  return $erros;
}