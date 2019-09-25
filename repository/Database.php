<?php
class Database
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
        return $this->link;
    }

    function inserirCanil($canil)
    {
        $this->connect();
        $this->query = "insert into Instituicao (Nome,CNPJ,Conta,Email,Senha,Telefone,Estado,Cidade,Rua,Bairro) values ('" . $canil->getNome() . "','" . $canil->getCnpj() . "','" . $canil->getConta() . "','" . $canil->getEmail() . "','" . $canil->getSenha() . "','" . $canil->getTel() . "','" . $canil->getEstado() . "','" . $canil->getCidade() . "','" . $canil->getRua() . " - " . $canil->getNumero() . "','" . $canil->getBairro() . "')";
        if ($this->result = mysqli_query($this->link, $this->query)) {
            $this->disconnect();
            return $this->result;
        } else {
            echo "Não foi possível cadastrar a Instituição";
            echo "Erro :" . mysqli_error($this->link);
            echo "SQL: " . $this->query;
            die();
            disconnect();
        }
    }

    function inserirPessoa($person)
    {
        $this->connect();
        $this->query = "insert into Pessoa (Nome,Email,Senha,Telefone,Estado,Cidade,Rua,Bairro) values ('" . $person->getNome() . "','" . $person->getEmail() . "','" . $person->getSenha() . "','" . $person->getTel() . "','" . $person->getEstado() . "','" . $person->getCidade() . "','" . $person->getRua() . " - " . $person->getNumero(). "','" . $person->getBairro() . "')";
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

    function login($email,$senha,$tipo){
        $this->connect();
        $this->query = "SELECT * from ".$tipo." where Email = '".$email."' and Senha = '".$senha."';";
        $this->result = mysqli_query($this->link, $this->query);
        if ($this->result->num_rows == 1) {
            $this->disconnect();
            return true;
        } else {
            return false;
            die();
            disconnect();
        }
    }

    function getColumn($email,$tabela,$coluna){
        $this->connect();
        $this->query = "SELECT ".$coluna." from ".$tabela." where Email = '".$email."';";
        $this->result = mysqli_query($this->link, $this->query);
        $resposta = mysqli_fetch_assoc($this->result);
        $this->disconnect();
        return $resposta[$coluna];
        }

    function getAllInfo($email,$tabela){
        $this->connect();
        $this->query = "SELECT * from ".$tabela." where Email = '".$email."';";
        $this->result = mysqli_query($this->link, $this->query);
        $resposta = mysqli_fetch_assoc($this->result);
        $this->disconnect();
        return $resposta;
        }


        // Essa função deve ser apromorada com join que só pega os animais cujos donos atuais estão em seu estado.
    function getAllState($estado){
        $this->connect();
        $this->query = "SELECT * from pessoa where Estado = '".$estado."';";
        $this->result = mysqli_query($this->link, $this->query);
        $total = mysqli_num_rows($this->result);
        $lista = array();
        while($total > 0){
            array_push($lista, mysqli_fetch_assoc($this->result));
            $total = $total - 1;
        }
        $this->disconnect();
        return $lista;
    }

    function updateCampo($tabela,$campo,$valor,$email){
        $this->connect();
        $this->query = "Update ".$tabela." SET ".$campo." = '".$valor."' where Email = '".$email."';";
        if($this->result = mysqli_query($this->link, $this->query)){
            $this->disconnect();
        }
        else {
            echo "Ocorreu um erro na execução da SQL";
            echo "Erro :" . mysqli_error($this->link);
            echo "SQL: " . $this->query;
            die();
            disconnect();
        }
    }

    function excluir($email,$tabela){
        $this->connect();
        $this->query = "Delete from ".$tabela." where Email = '".$email."';";
        if($this->result = mysqli_query($this->link, $this->query)){
            $this->disconnect();
        }
        else {
            echo "Ocorreu um erro na execução da SQL";
            echo "Erro :" . mysqli_error($this->link);
            echo "SQL: " . $this->query;
            die();
            disconnect();
        }
    }

    function disconnect(){
        return mysqli_close($this->link);
        }

}