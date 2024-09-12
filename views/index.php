<?php
include_once('../componentes/cabecalho.php');
include_once('../models/ProdutoDAO.php');
include_once('../models/LanceDAO.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/listagens.css">
    <script src="../scripts/script.js" defer></script>
    <title>ArteNet</title>
</head>
<body>
<header>
    <nav class="navbar">
        <ul class="nav-list">
            <li><a href="index.php">Página Inicial</a></li>
            <li><a href="cadastrarPessoa.php">Adicionar Pessoa</a></li>
            <li><a href="pesquisarPessoa.php">Pesquisar Pessoa</a></li>
            <li><a href="listarPessoas.php">Listar Pessoas</a></li>
            <li><a href="cadastrarProduto.php">Adicionar Produto</a></li>
            <li><a href="listarProdutos.php">Listar Produto</a></li>
            <li><a href="gerenciarLances.php">Gerenciar Lances</a></li>
            <form method="POST" action="../controller/PessoaController.php">
                <button type="submit" name="sair">Sair</button>
            </form>
        </ul>
    </nav>
</header>
<main>
    <h2>Listagem de Produtos</h2>
    <h3>Usuário Logado: <?php echo ($_SESSION['nome']); ?></h3>
    <button class="geolocation-button" onclick="obterLocalizacao()">Obter Localização</button>
    <p class="geolocation-result" id="resultado">Você está em: </p>

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
        echo '<div class="produto-container">';
        foreach ($produtos as $produto) {
            ?>
            <section class="produto-card">
                <img src="../imagens/<?php echo ($produto['imagem']); ?>" alt="<?php echo ($produto['nome']); ?>" class="produto-imagem" />
                <div class="produto-info">
                    <h4><?php echo ($produto['nome']); ?></h4>
                    <p><strong>Artista:</strong> <?php echo ($produto['nome_artista']); ?></p>
                    <p><strong>Descrição:</strong> <?php echo ($produto['descricao']); ?></p>
                    <p><strong>Lance mínimo:</strong> <?php echo ($produto['lance_minimo']); ?></p>
                    <p><strong>Técnica:</strong> <?php echo ($produto['tecnica']); ?></p>
                    <p><strong>Categoria:</strong> <?php echo ($produto['categoria']); ?></p>
                    <p><strong>Estoque:</strong> <?php echo ($produto['estoque']); ?></p>
                    <p><strong>Lance atual:</strong> <?php echo ($produto['lance_atual']); ?></p>

                    <form action="../controller/LanceController.php" method="POST" class="produto-form">
                        <input type="hidden" name="produto_id" value="<?php echo ($produto['produto_id']); ?>">
                        <input type="hidden" name="pessoa_id" value="<?php echo ($_SESSION['pessoa_id']); ?>">

                        <label for="valor_<?php echo ($produto['produto_id']); ?>">Valor do Lance:</label>
                        <input type="number" id="valor_<?php echo ($produto['produto_id']); ?>" name="valor" min="0" step="0.01" required>

                        <button type="submit" name="cadastrar">Enviar Lance</button>
                    </form>
                </div>
            </section>
            <?php
        }
        echo '</div>';
    }
    ?>
</main>

<script type="text/javascript">
    function confirma_excluir() {
        return confirm("Confirma Exclusão?");
    }
</script>

</body>
</html>