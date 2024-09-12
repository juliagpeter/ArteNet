<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/form.css">
    <script src="../scripts/script.js" defer></script>
    <title>Pesquisar Usuário</title>
    <?php include_once('../componentes/cabecalho.php'); ?>
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
    <form action="../controller/PessoaController.php" method="post">
      <p><label for="nome">Pesquisa por nome: </label><input type="text" name="nome" id="nome"></p>
      <p><button type="submit" id='pesquisar' name='pesquisar' value="Pesquisar"> Pesquisar </button>  </p>      
    </form>
    </section>
</main>
</body>
</html>