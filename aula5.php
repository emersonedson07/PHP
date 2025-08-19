<?php
include "funcoes.php";
// Chamando a função várias vezes com diferentes valores
somar(10,23);
somar(10,23);
somar(11,2);

$r = somarRet(11,21);

echo "A Soma de 11 e 21 é igual $r<br>";
?>