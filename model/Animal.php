<?php
class Animal
{
    private $nome, $dono, $sexo, $especie, $desc, $objetivo, $idade, $raca;

    function __construct($nome, $dono, $sexo, $especie, $desc, $objetivo, $idade, $raca)
    {
        $this->nome = $nome;
        $this->dono = $dono;
        $this->sexo = $sexo;
        $this->especie = $especie;
        $this->raca = $raca;
        $this->idade = $idade;
        $this->desc = $desc;
        $this->objetivo = $objetivo;
    }

    function getNome()
    {
        return $this->nome;
    }
    function getDono()
    {
        return $this->dono;
    }
    function getSexo()
    {
        return $this->sexo;
    }
    function getDesc()
    {
        return $this->desc;
    }
    function getObjetivo()
    {
        return $this->objetivo;
    }
    function getRaca()
    {
        return $this->raca;
    }
    function getIdade()
    {
        return $this->idade;
    }
}
