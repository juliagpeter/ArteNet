<?php
require_once('../models/Pessoa.php');
require_once('../models/PessoaDAO.php');
require_once('../componentes/config_upload.php');

#CADASTRO PESSOA
if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $genero = $_POST['genero'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $nome_arquivo=$_FILES['imagem']['name'];
    $tamanho_arquivo=$_FILES['imagem']['size'];
    $arquivo_temporario=$_FILES['imagem']['tmp_name'];
    if (!empty($nome_arquivo)){

        if($limitar_tamanho=="sim" && ($tamanho_arquivo > $tamanho_bytes))
            die("Arquivo deve ter o no máximo $tamanho_bytes bytes");

        $ext = strrchr($nome_arquivo,'.');
        if (($limitar_ext == "sim") && !in_array($ext,$extensoes_validas))
            die("Extensão de arquivo inválida para upload");

        if (move_uploaded_file($arquivo_temporario, "../imagens/$nome_arquivo")) {
            echo " Upload do arquivo: ". $nome_arquivo." foi concluído com sucesso <br>";


            $pessoa=new Pessoa();
            $pessoa->setNome($nome);
            $pessoa->setNascimento($nascimento);
            $pessoa->setemail($email);
            $pessoa->setGenero($genero);
            $pessoa->setsenha($senha);
            $pessoa->setcpf($cpf);
            $pessoa->setimagem($nome_arquivo);

            $PessoaDAO= new PessoaDAO($pessoa);



            $retorno=$PessoaDAO->inserirPessoa($pessoa);


            header('Location:../views/listarPessoas.php');
        }
    }
}
#ENTRAR
if(isset($_POST['entrar'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $pessoa=new Pessoa();
    $pessoa->setEmail($email);
    $pessoa->setSenha($senha);

    $PessoaDAO= new PessoaDAO();

    $retorno=$PessoaDAO->acessarPessoa($pessoa);

    if($retorno){
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['pessoa_id'] = $retorno['pessoa_id'];
        $_SESSION['nome'] = $retorno['nome'];
        header('Location:../views/index.php');
    }
    else{
        header('location:../views/login.php');
    }
}

#SAIR
if(isset($_POST['sair'])){
    session_start();
    session_destroy();
    header('location:../views/login.php');
}

#EDITAR PESSOA
if(isset($_POST['editar'])){

    $pessoa_id = $_POST['editar'];

    $pessoa=new Pessoa();

    $pessoa->setPessoaId($pessoa_id);

    $PessoaDAO= new PessoaDAO();

    $retorno=$PessoaDAO->buscarPessoa($pessoa);

    require_once('../views/alterarPessoa.php');
}
#ALTERAR PESSOA
if(isset($_POST['alterar'])){

    $pessoa_id = $_POST['pessoa_id'];
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $genero = $_POST['genero'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $nome_arquivo=$_FILES['imagem']['name'];
    $tamanho_arquivo=$_FILES['imagem']['size'];
    $arquivo_temporario=$_FILES['imagem']['tmp_name'];

    $pessoa=new Pessoa();
    $pessoa->setNome($nome);
    $pessoa->setNascimento($nascimento);
    $pessoa->setEmail($email);
    $pessoa->setGenero($genero);
    $pessoa->setSenha($senha);
    $pessoa->setCpf($cpf);
    $pessoa->setPessoaId($pessoa_id);
    $pessoa->setimagem($nome_arquivo);

    $PessoaDAO= new PessoaDAO();



    $retorno=$PessoaDAO->alterarPessoa($pessoa);

    header('Location:../views/listarPessoas.php');
}
#DELETAR PESSOA
if (isset($_POST['deletar'])) {
    $pessoa_id = $_POST['deletar']; 

    $pessoa = new Pessoa();

    $pessoa->setPessoaId($pessoa_id);

    $pessoaDAO = new PessoaDAO();
    
    $retorno = $pessoaDAO->deletarPessoa($pessoa); 

    if ($retorno) {
        header('Location:../views/index.php'); 
    } else {
        echo 'Erro ao deletar a pessoa. Por favor, tente novamente.'; 
    }
    header('Location:../views/listarPessoas.php');

}

#PESQUISAR PESSOA
if(isset($_POST['pesquisar'])){

    $pessoa=new Pessoa();

    $nome = "%".strtoupper($_POST['nome'])."%";

    $pessoa->setNome($nome);

    $PessoaDAO= new PessoaDAO();

    $retorno=$PessoaDAO->pesquisarPessoa($pessoa);

    require_once('../views/mostrarPessoa.php');
}
#ALTERAR PERFIL
if(isset($_POST['alterarPerfil'])){

    session_start();

    $pessoa_id = $_POST['pessoa_id'];
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $genero = $_POST['genero'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];

    $pessoa=new Pessoa();
    $pessoa->setNome($nome);
    $pessoa->setNascimento($nascimento);
    $pessoa->setEmail($email);
    $pessoa->setGenero($genero);
    $pessoa->setsenha($senha);
    $pessoa->setcpf($cpf);
    $pessoa->setPessoaId($pessoa_id);

    $PessoaDAO= new PessoaDAO();

    $retorno=$PessoaDAO->alterarPessoa($pessoa);

    $_SESSION['nome'] = $nome;
    echo $_SESSION['nome'];
    header('location:../views/alterarPerfil.php');
}
?>