<?php

function faixa_por_idade(int $idade): string {
  if ($idade <= 3)  return 'Bebê';
  if ($idade <= 12) return 'Criança';
  if ($idade <= 17) return 'Adolescente';
  return 'Adulto';
}


function validar_faixa(?string $faixa, int $idade): ?string {
  $permitidas = ['Bebê','Criança','Adolescente','Adulto'];

  if (!$faixa || !in_array($faixa, $permitidas, true)) {
    return 'Faixa etária inválida.';
  }

  $esperada = faixa_por_idade($idade);
  if ($faixa !== $esperada) {
    return "Faixa etária incompatível com a idade ($idade). O correto seria: $esperada.";
  }

  return null;
}