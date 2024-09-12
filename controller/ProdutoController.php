<?php
require_once('../models/Produto.php');
require_once('../models/ProdutoDAO.php');
require_once('../componentes/config_upload.php');

$produtoDAO = new ProdutoDAO();

#CADASTRO PRODUTO
if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $lance_minimo = $_POST['lance_minimo'];
    $tecnica = $_POST['tecnica'];
    $categoria_id = $_POST['categoria_id'];
    $artista_id = $_POST['artista_id'];
    $nome_arquivo=$_FILES['imagem']['name'];
    $tamanho_arquivo=$_FILES['imagem']['size'];
    $arquivo_temporario=$_FILES['imagem']['tmp_name'];
    $estoque = $_POST['estoque'];
    $lance_atual = $_POST['lance_atual'];
    if (!empty($nome_arquivo)){

        if($sobrescrever=="não" && file_exists("$caminho/$nome_arquivo"))
            die("Arquivo já existe");

        if($limitar_tamanho=="sim" && ($tamanho_arquivo > $tamanho_bytes))
            die("Arquivo deve ter o no máximo $tamanho_bytes bytes");

        $ext = strrchr($nome_arquivo,'.');
        if (($limitar_ext == "sim") && !in_array($ext,$extensoes_validas))
            die("Extensão de arquivo inválida para upload");

        if (move_uploaded_file($arquivo_temporario, "../imagens/$nome_arquivo")) {
            echo " Upload do arquivo: ". $nome_arquivo." foi concluído com sucesso <br>";


            $produto=new Produto();
            $produto->setNome($nome);
            $produto->setDescricao($descricao);
            $produto->setLanceMinimo($lance_minimo);
            $produto->setTecnica($tecnica);
            $produto->setCategoriaId($categoria_id);
            $produto->setArtistaId($artista_id);
            $produto->setimagem($nome_arquivo);
            $produto->setEstoque($estoque);
            $produto->setLanceAtual($lance_atual);

            $ProdutoDAO= new ProdutoDAO($produto);



            $retorno=$ProdutoDAO->inserirProduto($produto);


            header('location:../views/index.php');
        }
    }
}

#EDITAR PRODUTO
if(isset($_POST['editar'])){

    $produto_id = $_POST['editar'];

    $produto=new Produto();

    $produto->setProdutoId($produto_id);

    $ProdutoDAO= new ProdutoDAO();

    $retorno=$ProdutoDAO->buscarProduto($produto);

    require_once('../views/alterarProduto.php');
}
#ALTERAR PRODUTO
if(isset($_POST['alterar'])){

    $produto_id = $_POST['produto_id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $lance_minimo = $_POST['lance_minimo'];
    $tecnica = $_POST['tecnica'];
    $categoria_id = $_POST['categoria_id'];
    $artista_id = $_POST['artista_id'];
    $estoque = $_POST['estoque'];

    $produto=new Produto();
    $produto->setNome($nome);
    $produto->setDescricao($descricao);
    $produto->setLanceMinimo($lance_minimo);
    $produto->setTecnica($tecnica);
    $produto->setCategoriaId($categoria_id);
    $produto->setArtistaId($artista_id);
    $produto->setEstoque($estoque);
    $produto->setLanceAtual($lance_atual);
    $produto->setProdutoId($produto_id);

    $ProdutoDAO= new ProdutoDAO();



    $retorno=$ProdutoDAO->alterarProduto($produto);

    header('location:../views/index.php');
}
#DELETAR PRODUTO
if(isset($_POST['deletar'])){
    $codpessoa = $_POST['deletar'];

    $produto=new Produto();

    $produto->setProdutoId($produto_id);

    $ProdutoDAO= new ProdutoDAO();

    $retorno=$ProdutoDAO->deletarProduto($produto);


    header('Location:../views/index.php');
}

#PESQUISAR PRODUTO
if(isset($_POST['pesquisar'])){

    $produto=new Produto();

    $nome = "%".strtoupper($_POST['nome'])."%";

    $produto->setNome($nome);

    $ProdutoDAO= new ProdutoDAO();

    $retorno=$ProdutoDAO->pesquisarProduto($produto);

    require_once('../views/mostrarProduto.php');
}
?>