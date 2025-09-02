<?php
session_start();
require "Menu.php";

if (!isset($_SESSION['login'])) {
    echo '<h2>Login</h2>';
    echo '<form method="post" action="Logar.php">
            <label>Email:</label><br>
            <input type="email" name="email" required><br>
            <label>Senha:</label><br>
            <input type="password" name="senha" required><br><br>
            <input type="submit" value="Entrar">
          </form>';
} else {
    echo "<p>Você já está logado como <b>{$_SESSION['login']}</b>.</p>";
}
?>