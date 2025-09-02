<?php
session_start();
require "Menu.php";

if (!isset($_SESSION['login'])) {
    header("Location: Index.php");
    exit;
}
?>

<h2>Área Restrita</h2>
<p>Bem-vindo, <?php echo $_SESSION['login']; ?>! Você acessou a área restrita.</p>