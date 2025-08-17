<?php

include __DIR__ "/style.php";

echo "<h1> Json em PHO </h1>";

$object = new stdclass;
$object -> nome = "Emerson Camargo";
$object -> canal + "Entre nós";

echo "<pre>";
print_r ($object);

