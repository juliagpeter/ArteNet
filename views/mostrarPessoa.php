<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/mostrarPessoa.css">
    <script src="../scripts/script.js"></script>
    <title>Mostrar Usuário</title>
    <?php
    include_once('../componentes/cabecalho.php');
    ?>
</head>
<body>
<header>
    <nav class="navbar">
        <button class="menu-toggle" onclick="toggleMenu()">☰ Menu</button>
        <ul class="nav-list">
            <li><a href="../views/index.php">Página Inicial</a></li>
            <li><a href="../views/cadastrarPessoa.php">Adicionar Pessoa</a></li>
            <li><a href="../views/pesquisarPessoa.php">Pesquisar Pessoa</a></li>
            <li><a href="../views/listarPessoas.php">Listar Pessoas</a></li>
            <li><a href="../views/cadastrarProduto.php">Adicionar Produto</a></li>
            <li><a href="../views/listarProdutos.php">Listar Produto</a></li>
            <li><a href="../views/gerenciarLances.php">Gerenciar Lances</a></li>
            <li>
                <form method="POST" action="../controller/PessoaController.php">
                    <button type="submit" name="sair">Sair</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
<main>
    <h2>Pesquisa de Usuários</h2>
    <h3>Usuário Logado: <?php echo $_SESSION['nome']; ?></h3>
    <?php
    if (empty($retorno)) {
        echo "<section><p>Não há usuários cadastrados.</p></section>";
    } else {
        foreach ($retorno as $pessoa) {
            ?>
            <section class="user-card">
                <p>Imagem: <img src="../imagens/<?php echo $pessoa['imagem']; ?>" class="user-image" alt="Imagem do usuário"/></p>
                <p>Nome: <?php echo $pessoa['nome']; ?></p>
                <p>Nascimento: <?php echo $pessoa['nascimento']; ?></p>
                <p>E-mail: <?php echo $pessoa['email']; ?></p>
                <p>Gênero: <?php echo $pessoa['genero']; ?></p>
                <p>Senha: <?php echo $pessoa['senha']; ?></p>
                <p>CPF: <?php echo $pessoa['cpf']; ?></p>

                <form action="../controller/PessoaController.php" method="post" class="user-actions">
                    <button type="submit" name="editar" value="<?php echo $pessoa['pessoa_id']; ?>" class="acao-button editar">Editar</button>
                    <button type="submit" name="deletar" value="<?php echo $pessoa['pessoa_id']; ?>" class="acao-button deletar" onclick="return confirma_excluir()">Deletar</button>
                </form>
            </section>
            <?php
        }
    }
    ?>
</main>
</body>
</html>
