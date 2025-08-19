<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Frutas</title>
</head>
<body>
    <p>Está funcionando</p>

    <?php
    $listaFrutas = ["uva", "morango", "banana", "pera"];
    $tamanhoDaLista = count($listaFrutas);

    for ($contadorFrutas = 0; $contadorFrutas < $tamanhoDaLista; $contadorFrutas++) {
        echo "<br>Essa é a fruta: " . $listaFrutas[$contadorFrutas];
    }

    foreach ($listaFrutas as $index => $fruta){
        echo "<br>Com foreach essa é a fruta: na posição $index o nome é $fruta <br>";
    }

    function exibirmensagem($mensagem = "exiba uma mensagem") {
        echo "<br>$mensagem<br>";
    }

    exibirmensagem();
    $valorparafuncaodemensagem = "valor passado: 50";
    exibirmensagem($valorparafuncaodemensagem);
    ?>
    
</body>
</html>