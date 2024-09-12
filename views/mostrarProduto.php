<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produto</title>
    <link rel="stylesheet" href="../styles/styles.css">

<?php
include_once('../componentes/cabecalho.php');
include_once('../componentes/header.php');
include_once('../models/ProdutoDAO.php');

$produtoDAO = new ProdutoDAO();
$categorias = $produtoDAO->listarCategorias();
$artistas = $produtoDAO->listarArtistas();
?>

</head>
<body>
<body>

<main>
    <h2> Pesquisa de Produto </h2>
    <h3> Usuário Logado:  <?php echo $_SESSION['nome']; ?>  </h3>
    <?php

    if(empty($retorno)){
        ?>
        <section>
            <p>Não há produtos cadastrados.</p>
        </section>
        <?php
    }
    else
    {
        foreach($retorno as $produto){

            ?>
            <section>
                <p><label for="nome">Nome: </label><input type="text" name="nome" id="nome" value="<?php echo $produto['nome']; ?>"></p>
                <p>
                    <label for="artista">Artista:</label>
                    <select id="artista" name="artista_id" required>
                        <option value="">Selecione um Artista</option>
                        <?php foreach ($artistas as $artista): ?>
                            <option value="<?= $artista['artista_id'] ?>" <?= ($retorno['artista_id'] == $artista['artista_id']) ? 'selected' : ''; ?>><?= $artista['nome_artista'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p><label for="descricao">Descrição: </label><input type="text" name="descricao" id="descricao" value="<?php echo $produto['descricao']; ?>"></p>
                <p><label for="lance minimo">Lance Minimo: </label><input type="text" name="lance_minimo" id="lance_minimo" value="<?php echo $produto['lance_minimo']; ?>"></p>
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
                <p><label for="estoque">Estoque: </label><input type="text" name="estoque" id="estoque" value="<?php echo $produto['estoque']; ?>"></p>
                <p><label for="lance_atual">Lance atual: </label><input type="text" name="lance_atual" id="lance_atual" value="<?php echo ($produto['lance_atual']); ?>" readonly></p>
                <p>Imagem: <img src="../../imagens/<?php echo $produto['imagem'];?>" width='100px' height='100px'/></p>
                <input type="hidden" id='produto_id' name='produto_id' value="<?php echo $produto['produto_id']; ?>">

                <form action="../controller/PessoaController.php" method="post">
                    <button type="submit" name="editar" value="<?php echo $produto['produto_id']; ?>"> Editar </button>
                    <button type="submit" name="deletar" value="<?php echo $produto['produto_id']; ?>" onclick = "return confirma_excluir()"> Deletar </button>
                </form>
                <br><br>
            </section>
            <?php
        }
    }
    ?>
</main>
</body>
<script type="text/javascript">
    function confirma_excluir()
    {
        resp=confirm("Confirma Exclusão?")

        if (resp==true)
        {

            return true;
        }
        else
        {
            return false;

        }

    }

</script>
</html>