<?php
$nome = $_POST['nome'] ?? '';
$idade = $_POST['idade'] ?? '';
$faixa = $_POST['faixa'] ?? '';

echo "<h2>Validação dos Dados</h2>";

$erros = false;

if (empty($nome)) {
    echo "Nome não foi preenchido.<br>";
    $erros = true;
} else {
    echo "Nome: " . htmlspecialchars($nome) . "<br>";
}

if (empty($idade)) {
    echo "Idade não foi preenchida.<br>";
    $erros = true;
} else {
    echo "Idade: " . htmlspecialchars($idade) . "<br>";
}

if (empty($faixa)) {
    echo "Faixa etária não foi selecionada.<br>";
    $erros = true;
} else {
    echo "Faixa Etária Selecionada: " . htmlspecialchars($faixa) . "<br>";
}

if (!$erros) {
    echo "<br><a href='processa_idade.php?idade=" . urlencode($idade) . "&faixa=" . urlencode($faixa) . "'>Verificar Faixa Etária</a>";
}
?>
