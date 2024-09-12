<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/listagens.css">
    <script src="../scripts/script.js"></script>
    <title>Listar Produtos</title>

    <?php
    include_once('../componentes/cabecalho.php');
    include_once('../models/ProdutoDAO.php');
    include_once('../models/LanceDAO.php');
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
    <h2>Listagem de Produtos</h2>
    <h3>Usuário Logado: <?php echo($_SESSION['nome']); ?></h3>
    <div class="produto-container">
        <?php
        $produtosDAO = new ProdutoDAO();
        $produtos = $produtosDAO->listarProduto();
        if (empty($produtos)) {
            ?>
            <section>
                <p>Não há produtos cadastrados.</p>
            </section>
            <?php
        } else {
            foreach ($produtos as $produto) {
                ?>
                <div class="produto-card">
                    <img src="../imagens/<?php echo ($produto['imagem']); ?>" alt="Imagem do Produto" class="produto-imagem"/>
                    <div class="produto-info">
                        <p><strong>Nome:</strong> <?php echo ($produto['nome']); ?></p>
                        <p><strong>Artista:</strong> <?php echo ($produto['nome_artista']); ?></p>
                        <p><strong>Descrição:</strong> <?php echo ($produto['descricao']); ?></p>
                        <p><strong>Lance mínimo:</strong> R$ <?php echo ($produto['lance_minimo']); ?></p>
                        <p><strong>Técnica:</strong> <?php echo ($produto['tecnica']); ?></p>
                        <p><strong>Categoria:</strong> <?php echo ($produto['categoria']); ?></p>
                        <p><strong>Estoque:</strong> <?php echo ($produto['estoque']); ?></p>
                        <p><strong>Lance atual:</strong> R$ <?php echo ($produto['lance_atual']); ?></p>

                        <form action="../controller/LanceController.php" method="POST" class="lance-form">
                            <input type="hidden" name="produto_id" value="<?php echo ($produto['produto_id']); ?>">
                            <input type="hidden" name="pessoa_id" value="<?php echo ($_SESSION['pessoa_id']); ?>">

                            <label for="valor_<?php echo ($produto['produto_id']); ?>">Valor do Lance:</label>
                            <input type="number" id="valor_<?php echo ($produto['produto_id']); ?>" name="valor" min="0" step="0.01" required>

                            <button type="submit" name="cadastrar">Enviar Lance</button>
                        </form>

                        <form action="alterarProduto.php" method="POST" class="acao-form">
                            <input type="hidden" name="produto_id" value="<?php echo $produto['produto_id']; ?>">
                            <button type="submit" name="editar" class="acao-button editar">Editar</button>
                        </form>

                        <form action="deletar_produto.php" method="POST" onsubmit="return confirma_excluir();" class="acao-form">
                            <input type="hidden" name="produto_id" value="<?php echo ($produto['produto_id']); ?>">
                            <button type="submit" name="deletar" class="acao-button deletar">Deletar</button>
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
