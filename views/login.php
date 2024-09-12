<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/listagens.css">
    <script src="../scripts/script.js"></script>
    <title>Login</title>
</head>
<body>
<main>
    <h1>Login</h1>
    <section>
        <form action="../controller/PessoaController.php" method="post">
            <p>
                <label for="email">Email: </label>
                <input type="text" name="email" id="email">
            </p>
            <p>
                <label for="senha">Senha: </label>
                <input type="password" name="senha" id="senha">
            </p>
            <p>
                <button type="submit" id="entrar" name="entrar" value="Entrar">Entrar</button>
            </p>
        </form>
    </section>
</main>
</body>
</html>