<?php
   Class Pessoa{
       private $pessoa_id;
       private $nome;
       private $nascimento;
       private $email;
       private $genero;
       private $nacionalidade;
       private $senha;
       private $cpf;
       private $imagem;

       public function getPessoaId()
       {
           return $this->pessoa_id;
       }

       public function setPessoaId($pessoa_id)
       {
           $this->pessoa_id = $pessoa_id;
       }

       public function getNome()
       {
           return $this->nome;
       }

       public function setNome($nome)
       {
           $this->nome = $nome;
       }

       public function getNascimento()
       {
           return $this->nascimento;
       }

       public function setNascimento($nascimento)
       {
           $this->nascimento = $nascimento;
       }

       public function getEmail()
       {
           return $this->email;
       }

       public function setEmail($email)
       {
           $this->email = $email;
       }

       public function getGenero()
       {
           return $this->genero;
       }

       public function setGenero($genero)
       {
           $this->genero = $genero;
       }

       public function getNacionalidade()
       {
           return $this->nacionalidade;
       }

       public function setNacionalidade($nacionalidade)
       {
           $this->nacionalidade = $nacionalidade;
       }

       public function getSenha()
       {
           return $this->senha;
       }

       public function setSenha($senha)
       {
           $this->senha = $senha;
       }

       public function getCpf()
       {
           return $this->cpf;
       }

       public function setCpf($cpf)
       {
           $this->cpf = $cpf;
       }
       public function getImagem()
       {
           return $this->imagem;
       }
       public function setImagem($imagem)
       {
           $this->imagem = $imagem;
       }
}
?>