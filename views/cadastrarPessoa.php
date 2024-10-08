<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/form.css">
    <script src="../scripts/casped.js" defer></script>
    <title>Cadastrar Usuário</title>

<?php
include_once('../componentes/cabecalho.php');
?>
<title>Cadastrar Usuário</title>
</head>

<header>
    <nav class="navbar">
        <button class="menu-toggle" onclick="toggleMenu()">☰ Menu</button>
        <ul class="nav-list">
            <li><a href="index.php">Página Inicial</a></li>
            <li><a href="cadastrarPessoa.php">Adicionar Pessoa</a></li>
            <li><a href="pesquisarPessoa.php">Pesquisar Pessoa</a></li>
            <li><a href="listarPessoas.php">Listar Pessoas</a></li>
            <li><a href="cadastrarProduto.php">Adicionar Produto</a></li>
            <li><a href="listarProdutos.php">Listar Produto</a></li>
            <li><a href="gerenciarLances.php">Gerenciar Lances</a></li>
            <li>
                <form method="POST" action="../controller/PessoaController.php">
                    <button type="submit" name="sair">Sair</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
<body>
<main>
    <section>
        <form id="formulario-cadastro" action="../controller/PessoaController.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="nome">Nome: </label>
                <input type="text" name="nome" id="nome">
                <span id="erro-nome" class="mensagem-erro"></span>
            </p>
            <p>
                <label for="nascimento">Nascimento: </label>
                <input type="date" name="nascimento" id="nascimento">
                <span id="erro-nascimento" class="mensagem-erro"></span>
            </p>
            <p>
                <label for="email">Email: </label>
                <input type="text" name="email" id="email">
                <span id="erro-email" class="mensagem-erro"></span>
            </p>
            <p>
                <label for="genero">Gênero: </label>
                <select name="genero" id="genero">
                    <option value="" disabled selected>Selecione o seu gênero</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
                <span id="erro-genero" class="mensagem-erro"></span>
            </p>
            <p>
                <label for="senha">Senha: </label>
                <input type="password" name="senha" id="senha">
                <span id="erro-senha" class="mensagem-erro"></span>
            </p>
            <p>
                <label for="cpf">CPF: </label>
                <input type="text" name="cpf" id="cpf">
                <span id="erro-cpf" class="mensagem-erro"></span>
            </p>
            <p>
                <label for="imagem">Foto: </label>
                <input type="file" name="imagem" id="imagem">
                <span id="erro-imagem" class="mensagem-erro"></span>
            </p>
            <p>
                <button type="submit" id="cadastrar" name="cadastrar" value="Cadastrar">Cadastrar</button>
            </p>
        </form>
    </section>
</main>
</body>
</html>