<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/login.css">
    <script src="../scripts/login.js" defer></script>
    <title>Login</title>
</head>
<body>
<main>
    <h1>Bem-vindo ao ArteNet</h1>
    <section>
        <form id="formulario-login" action="../controller/PessoaController.php" method="post">
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
                <span id="erro-email" class="mensagem-erro"></span>
            </p>
            <p>
                <label for="senha">Senha: </label>
                <input type="password" name="senha" id="senha">
                <span id="erro-senha" class="mensagem-erro"></span>
            </p>
            <p>
                <button type="submit" id="entrar" name="entrar" value="Entrar">Entrar</button>
            </p>
        </form>
    </section>
</main>
</body>
</html>
