<?php
require_once "../repository/Database.php";
header("Content-Type:application/json");
if (isset($_GET['pessoa_id'])) {
    $db = new Database();
    $con = $db->connect();
    $pessoa_id = $_GET['pessoa_id'];
    $result = mysqli_query($con, "SELECT * FROM `pessoa` WHERE Email=$pessoa_id");
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
        responseErro("Nenhum registro encontrado");
    }
} else if (isset($_GET['instituicao_id'])) {
    $db = new Database();
    $con = $db->connect();
    $instituicao_id = $_GET['instituicao_id'];
    $result = mysqli_query($con, "SELECT * FROM `intituicao` WHERE Email=$instituicao_id");
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
        responseErro("Nenhum registro encontrado");
    }
} else {
    responseErro("Requisição inválida");
}

function responsePessoa($pessoa_id, $Nome, $Telefone, $estado, $cidade, $rua, $bairro)
{
    $response['pessoa_id'] = $pessoa_id;
    $response['Nome'] = $Nome;
    $response['Telefone'] = $Telefone;
    $response['Estado'] = $estado;
    $response['Cidade'] = $cidade;
    $response['Rua'] = $rua;
    $response['Bairro'] = $bairro;

    $json_response = json_encode($response);
    echo $json_response;
}

function responseInstituicao($instituicao_id, $Nome, $CNPJ, $Telefone, $estado, $cidade, $rua, $bairro, $conta)
{
    $response['pessoa_id'] = $instituicao_id;
    $response['Nome'] = $Nome;
    $response['CNPJ'] = $CNPJ;
    $response['Telefone'] = $Telefone;
    $response['Estado'] = $estado;
    $response['Cidade'] = $cidade;
    $response['Rua'] = $rua;
    $response['Bairro'] = $bairro;
    $response['Conta'] = $conta;

    $json_response = json_encode($response);
    echo $json_response;
}

function responseErro($erro)
{
    $response['Erro'] = $erro;
    $json_response = json_encode($response);
    echo $json_response;
}
