<!DOCTYPE html>
<html>
<?php
include_once('../componentes/cabecalho.php');
include_once('../componentes/header.php');
include_once('../models/ProdutoDAO.php');

// Verifique se o produto_id foi enviado via POST
if (isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];

    $produtoDAO = new ProdutoDAO();
    $categorias = $produtoDAO->listarCategorias();
    $artistas = $produtoDAO->listarArtistas();

    $retorno = $produtoDAO->getProdutoById($produto_id);
} else {
    echo "ID do produto não especificado.";
    exit; // Termina a execução se o ID do produto não foi especificado
}
?>

<title>Editar Produto</title>
</head>
<body>

<main>
    <section>
        <form action="../controller/ProdutoController.php" method="post" enctype="multipart/form-data">
            <p><label for="nome">Nome: </label><input type="text" name="nome" id="nome" value="<?php echo $retorno['nome']; ?>" required></p>

            <!-- Campo de seleção de Artista -->
            <p>
                <label for="artista">Artista:</label>
                <select id="artista" name="artista_id" required>
                    <option value="">Selecione um Artista</option>
                    <?php foreach ($artistas as $artista): ?>
                        <option value="<?= $artista['artista_id'] ?>" <?= ($retorno['artista_id'] == $artista['artista_id']) ? 'selected' : ''; ?>><?= $artista['nome_artista'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p><label for="descricao">Descrição: </label><textarea name="descricao" id="descricao" required><?php echo $retorno['descricao']; ?></textarea></p>
            <p><label for="lance_minimo">Lance Mínimo: </label><input type="number" name="lance_minimo" id="lance_minimo" min="0" step="0.01" value="<?php echo $retorno['lance_minimo']; ?>" required></p>

            <p>
                <label for="tecnica">Técnica: </label>
                <select name="tecnica" id="tecnica" required>
                    <option value="Óleo" <?= ($retorno['tecnica'] == 'Óleo') ? 'selected' : ''; ?>>Óleo</option>
                    <option value="Acrílico" <?= ($retorno['tecnica'] == 'Acrílico') ? 'selected' : ''; ?>>Acrílico</option>
                    <option value="Aquarela" <?= ($retorno['tecnica'] == 'Aquarela') ? 'selected' : ''; ?>>Aquarela</option>
                    <option value="Grafite" <?= ($retorno['tecnica'] == 'Grafite') ? 'selected' : ''; ?>>Grafite</option>
                    <option value="Digital" <?= ($retorno['tecnica'] == 'Digital') ? 'selected' : ''; ?>>Digital</option>
                    <option value="Outros" <?= ($retorno['tecnica'] == 'Outros') ? 'selected' : ''; ?>>Outros</option>
                </select>
            </p>

            <p>
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria_id" required>
                    <option value="">Selecione uma Categoria</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['categoria_id'] ?>" <?= ($retorno['categoria_id'] == $categoria['categoria_id']) ? 'selected' : ''; ?>><?= $categoria['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p><label for="estoque">Estoque: </label><input type="number" name="estoque" id="estoque" min="0" value="<?php echo $retorno['estoque']; ?>" required></p>

            <p>
                <label for="imagem">Foto Atual:</label><br>
                <img src="imagens/<?php echo $retorno['imagem'];?>" alt="Imagem Atual" style="max-width: 150px; max-height: 150px;"><br>
                <label for="imagem">Alterar Foto: </label>
                <input type="file" name="imagem" id="imagem">
            </p>

            <input type="hidden" id='produto_id' name='produto_id' value="<?php echo $retorno['produto_id']; ?>">

            <p><input type="submit" id='alterar' name='alterar' value="Alterar"></p>
        </form>
    </section>
</main>
</body>
</html>
