<?php
Class PessoaDAO{
    private $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=localhost; dbname=artenet; charset=utf8", "root","");
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function inserirPessoa($pessoa){
        try {
            $query = $this->conexao->prepare("insert into pessoa (nome, nascimento, email, genero, senha, cpf, imagem) values (:nome, :nascimento, :email, :genero, :senha, :cpf, :imagem)");

            $resultado = $query->execute(['nome' => $pessoa->getnome(), 'nascimento' => $pessoa->getNascimento(),
                'email' => $pessoa->getemail(), 'genero' => $pessoa->getGenero(), 'senha' => $pessoa->getsenha(),
                'cpf' => $pessoa->getcpf(),'imagem' => $pessoa->getimagem()]);
            return $resultado;

        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    function alterarPessoa($pessoa){
        try {
            $query = $this->conexao->prepare("update pessoa set nome= :nome, nascimento= :nascimento, email = :email, 
                                                    genero= :genero, senha= :senha, cpf= :cpf, imagem= :imagem 
                                                     where pessoa_id = :pessoa_id");
            $resultado = $query->execute(['nome' => $pessoa->getnome(), 'nascimento' => $pessoa->getNascimento(),
                'email' => $pessoa->getemail(), 'genero' => $pessoa->getGenero(),'senha' => $pessoa->getsenha(),
                'cpf' => $pessoa->getcpf(),'pessoa_id' => $pessoa->getPessoaid(), 'imagem' => $pessoa->getimagem()]);
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function deletarPessoa($pessoa) {
        try {
            $query = $this->conexao->prepare("DELETE FROM pessoa WHERE pessoa_id = :pessoa_id");
            $resultado = $query->execute(['pessoa_id' => $pessoa->getPessoaid()]);
            return $resultado;
        } catch (PDOException $e) {
            // Log da mensagem de erro em um arquivo ou base de dados
            error_log('Error: ' . $e->getMessage(), 3, '/path/to/error.log');
            // Mensagem amigável para o usuário (opcional)
            echo 'Erro ao deletar a pessoa. Por favor, tente novamente mais tarde.';
            return false;
        }
    }


    function listarPessoa(){
        try {
            $query = $this->conexao->prepare("select * from pessoa");
            $query->execute();
            $pessoas = $query->fetchAll();
            return $pessoas;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    function buscarPessoa($pessoa){
        try {
            $query = $this->conexao->prepare("select * from pessoa where pessoa_id=:pessoa_id");
            if($query->execute(['pessoa_id' => $pessoa->getPessoaid()])){
                $pessoa = $query->fetch(); //coloca os dados num array $usuario
                return $pessoa;
            }
            else{
                return false;
            }
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function acessarPessoa($pessoa){
        try {
            $query = $this->conexao->prepare("select * from pessoa where email=:email and senha=:senha");
            if($query->execute(['email' => $pessoa->getemail(), 'senha' => $pessoa->getsenha()])){
                $pessoa = $query->fetch(); //coloca os dados num array $pessoa
                if ($pessoa)
                {
                    return $pessoa;
                }
                else
                {
                    return false;
                }
            }
            else{
                return false;
            }
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function pesquisarPessoa($pessoa){
        try {
            $query = $this->conexao->prepare("select * from pessoa where upper(nome) like :nome");
            if($query->execute(['nome' => $pessoa->getnome()])){
                $pessoas = $query->fetchAll(); //coloca os dados num array $pessoa
                if ($pessoas)
                {
                    return $pessoas;
                }
                else
                {
                    return false;
                }
            }
            else{
                return false;
            }
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}
?>