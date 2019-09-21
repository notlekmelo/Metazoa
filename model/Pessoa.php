<?php
class Pessoa
{
    private $nome, $telefone, $email, $senha, $estado, $cidade, $rua, $numRes, $bairro;

    function __construct($nome, $telefone, $email, $estado, $senha, $cidade, $rua, $numRes, $bairro)
    {
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
        $this->cidade = $cidade;
        $this->rua = $rua;
        $this->numRes = $numRes;
        $this->estado = $estado;
        $this->bairro = $bairro;
    }


    function getNome()
    {
        return $this->nome;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getRua()
    {
        return $this->rua;
    }

    function getBairro()
    {
        return $this->bairro;
    }

    function getCidade()
    {
        return $this->cidade;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getTel()
    {
        return $this->telefone;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getNumero()
    {
        return $this->numRes;
    }
}
