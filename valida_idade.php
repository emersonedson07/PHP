<?php
function validar_idade($idade): ?string {
  $idade = trim((string)$idade);

  if ($idade === '')        { return 'O campo Idade é obrigatório.'; }
  if (!is_numeric($idade))  { return 'A idade deve ser um número.'; }

  $idade = (int)$idade;

  if ($idade < 0 || $idade > 120) {
    return 'A idade deve estar entre 0 e 120.';
  }

  return null; // ok
}