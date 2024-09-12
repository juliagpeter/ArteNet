<?php
Class Produto{
    private $produto_id;
    private $nome;
    private $descricao;
    private $lance_minimo;
    private $tecnica;
    private $categoria_id;
    private $artista_id;
    private $imagem;
    private $estoque;
    private $lance_atual;

    /**
     * @return mixed
     */
    public function getProdutoId()
    {
        return $this->produto_id;
    }

    /**
     * @param mixed $produto_id
     */
    public function setProdutoId($produto_id)
    {
        $this->produto_id = $produto_id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getLanceMinimo()
    {
        return $this->lance_minimo;
    }

    /**
     * @param mixed $lance_minimo
     */
    public function setLanceMinimo($lance_minimo)
    {
        $this->lance_minimo = $lance_minimo;
    }

    /**
     * @return mixed
     */
    public function getTecnica()
    {
        return $this->tecnica;
    }

    /**
     * @param mixed $tecnica
     */
    public function setTecnica($tecnica)
    {
        $this->tecnica = $tecnica;
    }

    /**
     * @return mixed
     */
    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    /**
     * @param mixed $categoria_id
     */
    public function setCategoriaId($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }

    /**
     * @return mixed
     */
    public function getArtistaId()
    {
        return $this->artista_id;
    }

    /**
     * @param mixed $artista_id
     */
    public function setArtistaId($artista_id)
    {
        $this->artista_id = $artista_id;
    }

    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    /**
     * @return mixed
     */
    public function getEstoque()
    {
        return $this->estoque;
    }

    /**
     * @param mixed $estoque
     */
    public function setEstoque($estoque)
    {
        $this->estoque = $estoque;
    }

    /**
     * @return mixed
     */
    public function getLanceAtual()
    {
        return $this->lance_atual;
    }

    /**
     * @param mixed $lance_atual
     */
    public function setLanceAtual($lance_atual)
    {
        $this->lance_atual = $lance_atual;
    }


}
?>