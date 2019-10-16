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

    function inserirAnimal($animal){
        $this->connect();
        $this->query = "insert into animal (NomeAnimal,Especie,Raca,Sexo,Descricao,Objetivo,Idade,Dono) values ('" . $animal->getNome() . "','" . $animal->getEspecie() . "','" . $animal->getRaca() . "','" . $animal->getSexo() . "','" . $animal->getDesc() . "','" . $animal->getObjetivo() . "','" . $animal->getIdade() ."','" . $animal->getDono(). "')";
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

    function inserirMensagem($from, $for, $conteudo){
        $this->connect();
        $this->query = "insert into mensagem (idPessoa, idInstituicao, conteudo) values ( $from, $for, $conteudo) ";
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

    function inserirEvento($evento){
        $this->connect();
        $this->query = "insert into evento (NomeEvento, Data, Horario,Descricao,Local,Instituicao) values ('" .$evento->getNome()."','". $evento->getData()."','". $evento->getHora()."','".$evento->getDesc()."','".$evento->getLocal()."','".$evento->getCanil()."') ";
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

    function updateAnimal($campo,$valor,$id){
        $this->connect();
        $this->query = "Update animal set " . $campo ." = '".$valor."' where Codigo = '" . $id ."';";
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

    function updateEvento($campo,$valor,$id){
        $this->connect();
        $this->query = "Update evento set " . $campo ." = '".$valor."' where Codigo = '" . $id ."';";
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

    function excluirAnimal($codAnimal){
        $this->connect();
              $this->query = "Delete from animal where Codigo= '".$codAnimal."';";
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
    
    function excluirEvento($codEvento){
        $this->connect();
        $this->query = "Delete from evento where Codigo= '".$codEvento."';";
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
