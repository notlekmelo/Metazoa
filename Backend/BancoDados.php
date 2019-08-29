<?php
class BancoDados
{
    var $host = "localhost:3306";
    var $user = "root";
    var $password = "";
    var $database = "Metazoa";
    var $query;
    var $link;
    var $result;

    function __constructor()
    { }

    function connect()
    {
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->link) {
            echo "Falha na conexao com o Banco de Dados!<br />";
            echo "Erro: " . mysqli_error($this->link);
            die();
        } elseif (!mysqli_select_db($this->link, $this->database)) {
            echo "O Banco de Dados solicitado não pode ser aberto!<br />";
            echo "Erro: " . mysqli_error($this->link);
            die();
        }
    }

    function inserirCanil($canil)
    {
        $this->connect();
        $this->query = "insert into Instituicao (Nome,CNPJ,Conta,Email,Senha,Telefone,Estado,Cidade,Rua,Bairro) values ('" . $canil->getNome() . "','" . $canil->getCnpj() . "','" . $canil->getConta() . "','" . $canil->getEmail() . "','" . $canil->getSenha() . "','" . $canil->getTel() . "','" . $canil->getEstado() . "','" . $canil->getCidade() . "','" . $canil->getRua() . "' - '" . $canil->getNumero() . "','" . $canil->getBairro() . "')";
        if ($this->result = mysqli_query($this->link, $this->query)) {
            $this->disconnect();
            return $this->result;
        } else {
            echo "Ocorreu um erro na execução da SQL";
            echo "Erro :" . mysqli_error($this->link);
            echo "SQL: " . $this->query;
            die();
            disconnect();
        }
    }

    function inserirPessoa($person)
    {
        $this->connect();
        $this->query = "insert into Pessoa (Nome,Email,Senha,Telefone,Estado,Cidade,Rua,Bairro) values ('" . $person->getNome() . "','" . $person->getEmail() . "','" . $person->getSenha() . "','" . $person->getTel() . "','" . $person->getEstado() . "','" . $person->getCidade() . "','" . $person->getRua() . "' - '" . $person->getNumero() . "','" . $person->getBairro() . "')";
        if ($this->result = mysqli_query($this->link, $this->query)) {
            $this->disconnect();
            return $this->result;
        } else {
            echo "Ocorreu um erro na execução da SQL";
            echo "Erro :" . mysqli_error($this->link);
            echo "SQL: " . $this->query;
            die();
            disconnect();
        }
    }

    function disconnect()
    {
        return mysqli_close($this->link);
    }
}
