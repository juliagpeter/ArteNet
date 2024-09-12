<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/listagens.css">
    <script src="../scripts/script.js"></script>
    <title>Listar Usuários</title>
    <?php
    include_once('../componentes/cabecalho.php');
    include_once('../models/PessoaDAO.php');
    ?>
</head>
<body>
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

<main>
    <h2>Listagem de Usuários</h2>
    <h3>Usuário Logado: <?php echo $_SESSION['nome']; ?></h3>
    <div class="produto-container">
        <?php
        $pessoasDAO = new PessoaDAO();
        $pessoas = $pessoasDAO->listarPessoa();
        if (empty($pessoas)) {
            ?>
            <section>
                <p>Não há usuários cadastrados.</p>
            </section>
            <?php
        } else {
            foreach ($pessoas as $pessoa) {
                ?>
                <div class="produto-card">
                    <img src="../imagens/<?php echo $pessoa['imagem']; ?>" alt="Imagem do Usuário" class="produto-imagem"/>
                    <div class="produto-info">
                        <p><strong>Nome:</strong> <?php echo $pessoa['nome']; ?></p>
                        <p><strong>Nascimento:</strong> <?php echo $pessoa['nascimento']; ?></p>
                        <p><strong>E-mail:</strong> <?php echo $pessoa['email']; ?></p>
                        <p><strong>Gênero:</strong> <?php echo $pessoa['genero']; ?></p>
                        <p><strong>Senha:</strong> <?php echo $pessoa['senha']; ?></p>
                        <p><strong>CPF:</strong> <?php echo $pessoa['cpf']; ?></p>

                        <form action="../controller/PessoaController.php" method="post" class="acao-form">
                            <input type="hidden" name="pessoa_id" value="<?php echo $pessoa['pessoa_id']; ?>">
                            <p><button type="submit" id='editar' name='editar' value="editar"> Editar </button></p>
                            <button type="submit" id='deletar' name="deletar" value="deletar" onclick="return confirma_excluir();">Deletar</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</main>
</body>
</html>
