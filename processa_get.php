<?php
$nome = $_GET['nome'] ?? '';
$idade = $_GET['idade'] ?? '';

echo "<h2>Dados Recebidos via GET</h2>";
echo "Nome: " . htmlspecialchars($nome) . "<br>";
echo "Idade: " . htmlspecialchars($idade);
?>
