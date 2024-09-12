<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" href="../styles/form.css">
    <script src="../scripts/script.js" defer></script>
    <title>Cadastrar Produto</title>
    <?php
    include_once('../componentes/cabecalho.php');
    include_once('../models/ProdutoDAO.php');

    $produtoDAO = new ProdutoDAO();
    $categorias = $produtoDAO->listarCategorias();
    $artistas = $produtoDAO->listarArtistas();
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
    <section>
        <form action="../controller/ProdutoController.php" method="post" enctype="multipart/form-data">
            <p><label for="nome">Nome: </label><input type="text" name="nome" id="nome" required></p>
            <p><label for="descricao">Descrição: </label><input type="text" name="descricao" id="descricao" required></p>
            <p><label for="lance_minimo">Lance mínimo: </label><input type="number" step="0.01" name="lance_minimo" id="lance_minimo" required></p>
            <p>
                <label for="tecnica">Técnica: </label>
                <select name="tecnica" id="tecnica" required>
                    <option value="Óleo">Óleo</option>
                    <option value="Acrílico">Acrílico</option>
                    <option value="Aquarela">Aquarela</option>
                    <option value="Grafite">Grafite</option>
                    <option value="Digital">Digital</option>
                    <option value="Outros">Outros</option>
                </select>
            </p>
            <p><label for="estoque">Estoque: </label><input type="number" name="estoque" id="estoque" required></p>
            <p>
                <label for="categoria">Categoria: </label>
                <select id="categoria" name="categoria_id" required>
                    <option value="">Selecione uma Categoria</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['categoria_id'] ?>"><?= $categoria['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="artista">Artista: </label>
                <select id="artista" name="artista_id" required>
                    <option value="">Selecione um Artista</option>
                    <?php foreach ($artistas as $artista): ?>
                        <option value="<?= $artista['artista_id'] ?>"><?= $artista['nome_artista'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p><label for="imagem">Foto: </label><input type="file" name="imagem" id="imagem" required></p>
            <p><button class="form-button" type="submit" id='cadastrar' name='cadastrar' value="Cadastrar">Cadastrar</button></p>
        </form>
    </section>
</main>
</body>
</html>