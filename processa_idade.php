<?php
$idade = isset($_GET['idade']) ? (int)$_GET['idade'] : null;
$faixa = $_GET['faixa'] ?? '';

echo "<h2>Verificação de Faixa Etária</h2>";

if ($idade === null || $faixa === '') {
    echo "Dados inválidos.";
    exit;
}

switch ($faixa) {
    case 'bebe':
        $correto = ($idade >= 0 && $idade <= 2);
        break;
    case 'crianca':
        $correto = ($idade >= 3 && $idade <= 12);
        break;
    case 'adolescente':
        $correto = ($idade >= 13 && $idade <= 18);
        break;
    case 'adulto':
        $correto = ($idade > 18);
        break;
    default:
        $correto = false;
}

if ($correto) {
    echo "✅ A idade de $idade anos está correta para a faixa '$faixa'.";
} else {
    echo "❌ A idade de $idade anos NÃO corresponde à faixa '$faixa'.";
}
?>
