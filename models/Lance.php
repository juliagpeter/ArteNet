<?php
Class Lance{
  private $id;
    private $produto_id;
    private $pessoa_id;
    private $valor;
    private $data_hora;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
    public function getPessoaId()
    {
        return $this->pessoa_id;
    }

    /**
     * @param mixed $pessoa_id
     */
    public function setPessoaId($pessoa_id)
    {
        $this->pessoa_id = $pessoa_id;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return mixed
     */
    public function getDataHora()
    {
        return $this->data_hora;
    }

    /**
     * @param mixed $data_hora
     */
    public function setDataHora($data_hora)
    {
        $this->data_hora = $data_hora;
    }

}
?>