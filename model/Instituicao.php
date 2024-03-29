<?php
require_once 'Pessoa.php';

class Instituicao extends Pessoa
{
    private $cnpj;
    private $contaBancaria;

    function __construct($nome, $telefone, $email, $estado, $senha, $cidade, $rua, $numRes, $bairro, $cnpj, $contaBancaria)
    {
        parent::__construct($nome, $telefone, $email, $estado, $senha, $cidade, $rua, $numRes, $bairro);
        $this->cnpj = $cnpj;
        $this->contaBancaria = $contaBancaria;
    }

    function toString()
    { }

    function getConta()
    {
        return $this->contaBancaria;
    }

    function getCnpj()
    {
        return $this->cnpj;
    }

    function getNome()
    {
        return parent::getNome();
    }

    function getEmail()
    {
        return parent::getEmail();
    }

    function getRua()
    {
        return parent::getRua();
    }

    function getBairro()
    {
        return parent::getBairro();
    }

    function getCidade()
    {
        return parent::getCidade();
    }

    function getEstado()
    {
        return parent::getEstado();
    }

    function getTel()
    {
        return parent::getTel();
    }

    function getSenha()
    {
        return parent::getSenha();
    }

    function getNumero()
    {
        return parent::getNumero();
    }
}
