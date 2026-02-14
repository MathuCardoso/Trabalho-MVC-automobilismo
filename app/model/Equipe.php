<?php

namespace App\model;

use App\model\Categoria;

class Equipe
{

    private ?int $id;
    private ?string $nome;
    private ?string $cor1;
    private ?string $cor2;
    private ?string $sede;
    private ?Categoria $categoria;

    public function __construct()
    {
        $this->id = 0;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of cor1
     */
    public function getCor1()
    {
        return $this->cor1;
    }

    /**
     * Set the value of cor1
     *
     * @return  self
     */
    public function setCor1($cor1)
    {
        $this->cor1 = $cor1;

        return $this;
    }

    /**
     * Get the value of cor2
     */
    public function getCor2()
    {
        return $this->cor2;
    }

    /**
     * Set the value of cor2
     *
     * @return  self
     */
    public function setCor2($cor2)
    {
        $this->cor2 = $cor2;

        return $this;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of sede
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * Set the value of sede
     *
     * @return  self
     */
    public function setSede($sede)
    {
        $this->sede = $sede;

        return $this;
    }
}
