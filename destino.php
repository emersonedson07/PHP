<?php

$nome = $_POST["nome"];
$email = $_POST["email"];

$idade = 2025 - $_POST["nasc"];

echo "Seja bem-vindo $nome ! Sua idade é $idade";

?>