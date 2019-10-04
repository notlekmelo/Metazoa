<?php
require_once "../repository/Database.php";
header("Content-Type:application/json");
if (isset($_GET['pessoa_id'])) {
    $db = new Database();
    $con = $db->connect();
    $pessoa_id = $_GET['pessoa_id'];
    $result = mysqli_query($con, "SELECT * FROM `pessoa` WHERE Email='$pessoa_id'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $nome = $row['Nome'];
        $Telefone = $row['Telefone'];
        $estado = $row['Estado'];
        $cidade = $row['Cidade'];
        $rua = $row['Rua'];
        $bairro = $row['Bairro'];
        mysqli_close($con);
        responsePessoa($pessoa_id, $nome, $Telefone, $estado, $cidade, $rua, $bairro);
    } else {
        responseErro("Nenhum registro encontrado.");
    }
} else if (isset($_GET['instituicao_id'])) {
    $db = new Database();
    $con = $db->connect();
    $instituicao_id = $_GET['instituicao_id'];
    $result = mysqli_query($con, "SELECT * FROM `instituicao` WHERE Email='$instituicao_id'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $nome = $row['Nome'];
        $CNPJ = $row['CNPJ'];
        $Telefone = $row['Telefone'];
        $estado = $row['Estado'];
        $cidade = $row['Cidade'];
        $rua = $row['Rua'];
        $bairro = $row['Bairro'];
        $conta = $row['Conta'];
        mysqli_close($con);
        responseInstituicao($instituicao_id, $nome, $CNPJ, $Telefone, $estado, $cidade, $rua, $bairro, $conta);
    } else {
        responseErro("Nenhum registro encontrado.");
    }
} else if (isset($_GET['animais_de'])) {
    $db = new Database();
    $con = $db->connect();
    $dono = $_GET['animais_de'];
    $AnimaisJson = "[";
    $result = mysqli_query($con, "SELECT * FROM `animal` WHERE Dono='$dono' ");
    $qtd = mysqli_num_rows($result);
    while ($qtd > 0) {
        $row = mysqli_fetch_array($result);
        $cod = $row['Codigo'];
        $nomeAn = $row['NomeAnimal'];
        $Especie = $row['Especie'];
        $Raca = $row['Raca'];
        $Desc = $row['Descricao'];
        $Sexo = $row['Sexo'];
        $objetivo = $row['Objetivo'];
        $idade = $row['Idade'];
        if ($qtd - 1 > 0)
            $AnimaisJson = $AnimaisJson . responseAnimais($cod, $nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo, $idade) . ",";
        else $AnimaisJson = $AnimaisJson . responseAnimais($cod, $nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo, $idade);
        $qtd = $qtd - 1;
    }
    mysqli_close($con);
    $AnimaisJson = $AnimaisJson . "]";
    echo $AnimaisJson;
} else {
    responseErro("Requisição inválida.");
}

function responsePessoa($pessoa_id, $Nome, $Telefone, $estado, $cidade, $rua, $bairro)
{
    $response['e-mail'] = $pessoa_id;
    $response['nome'] = $Nome;
    $response['telefone'] = $Telefone;
    $response['estado'] = $estado;
    $response['cidade'] = $cidade;
    $response['rua'] = $rua;
    $response['bairro'] = $bairro;

    $json_response = json_encode($response);
    echo $json_response;
}

function responseInstituicao($instituicao_id, $Nome, $CNPJ, $Telefone, $estado, $cidade, $rua, $bairro, $conta)
{
    $response['e-mail'] = $instituicao_id;
    $response['nome'] = $Nome;
    $response['cnpj'] = $CNPJ;
    $response['telefone'] = $Telefone;
    $response['estado'] = $estado;
    $response['cidade'] = $cidade;
    $response['rua'] = $rua;
    $response['bairro'] = $bairro;
    $response['conta'] = $conta;

    $json_response = json_encode($response);
    echo $json_response;
}

function responseAnimais($cod, $nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo, $idade)
{
    $response['nome'] = $nomeAn;
    $response['codigo'] = $cod;
    $response['especie'] = $Especie;
    $response['raca'] = $Raca;
    $response['descricao'] = $Desc;
    $response['objetivo'] = $objetivo;
    $response['sexo'] = $Sexo;
    $response['idade'] = $idade;

    $json_response = json_encode($response);
    return $json_response;
}

function responseErro($erro)
{
    $response['erro'] = $erro;
    $json_response = json_encode($response);
    echo $json_response;
}
