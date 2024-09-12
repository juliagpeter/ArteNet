<!DOCTYPE html>
<html>
<head>
    <title>Editar Lance</title>
    <?php
    include_once('../componentes/cabecalho.php');
    include_once('../componentes/header.php');
    include_once('../models/LanceDAO.php');
    include_once('../models/ProdutoDAO.php');

    $lanceDAO = new LanceDAO();
    $produtoDAO = new ProdutoDAO();

    // recupera ID lance
    $lance_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $lance = $lanceDAO->getLanceById($lance_id);

    if (!$lance) {
        echo "<p>Lance não encontrado.</p>";
        exit;
    }
    ?>
</head>
<body>

<main>
    <h2>Editar Lance</h2>

    <form action="../controller/LanceController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo ($lance['id']); ?>">

        <label for="produto_id">Produto ID:</label>
        <input type="number" id="produto_id" name="produto_id" value="<?php echo ($lance['produto_id']); ?>" min="1" required>

        <label for="pessoa_id">Pessoa ID:</label>
        <input type="number" id="pessoa_id" name="pessoa_id" value="<?php echo ($lance['pessoa_id']); ?>" min="1" required>

        <label for="valor">Valor do Lance:</label>
        <input type="number" id="valor" name="valor" value="<?php echo ($lance['valor']); ?>" min="0" step="0.01" required>

        <button type="submit" name="alterar">Atualizar Lance</button>
    </form>
</main>

</body>
</html>
