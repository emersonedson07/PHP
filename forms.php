<html>
<body>

<h1>Formulário</h1>
    <form action="processa_get.php" method="get">
        Nome: <input type="text" name="nome"><br><br>
        Idade: <input type="number" name="idade"><br><br>
        Email: <input type="email" name="email"><br><br>
        Faixa Etária:
        <select name="faixa_etaria">
            <option value="bebe">Bebê</option>
            <option value="crianca">Criança</option>
            <option value="adolescente">Adolescente</option>
            <option value="adulto">Adulto</option>
        </select><br><br>
        <input type="submit" value="Enviar">
    </form>
</form>

</body>
</html>