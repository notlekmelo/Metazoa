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
        responseErro("Nenhum registro encontrado");
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
        responseErro("Nenhum registro encontrado");
    }
} else if(isset($_GET['animais_de'])){
    $db = new Database();
    $con = $db->connect();
    $dono = $_GET['animais_de'];
    $AnimaisJson = array();
    $result = mysqli_query($con, "SELECT * FROM `animal` WHERE Dono='$dono' ");
    $qtd = mysqli_num_rows($result);
    while(qtd > 0){
        $row = mysqli_fetch_array($result);
        $nomeAn = $row['NomeAnimal'];
        $Especie = $row['Especie'];
        $Raca = $row['Raca'];
        $Desc = $row['Desc'];
        $Sexo = $row['Sexo'];
        $objetivo = $row['Objetivo'];
        $idade = $row['Idade'];
        array_push($AnimaisJson, responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade));
   } 
    mysqli_close($con);
    $jsonImprime = json_encode($AnimaisJson);
    echo $jsonImprime;
}else {
    responseErro("Requisição inválida");
}

function responsePessoa($pessoa_id, $Nome, $Telefone, $estado, $cidade, $rua, $bairro)
{
    $response['E-mail'] = $pessoa_id;
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
    $response['E-mail'] = $instituicao_id;
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

function responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua)
{
    $response['NomeAnimal'] = $nomeAn;
    $response['Especie'] = $Especie;
    $response['Raca'] = $Raca;
    $response['Desc'] = $Desc;
    $response['Objetivo'] = $objetivo;
    $response['Sexo'] = $Sexo;
    $response['Idade'] = $idade;
    $response['Contato']= $dono;
    $response['nomeDono'] = $nomeDono;
    $response['Cidade'] = $cidade;
    $response['Rua'] = $rua;

    $json_response = json_encode($response);
    return $json_response;
}

function responseErro($erro)
{
    $response['Erro'] = $erro;
    $json_response = json_encode($response);
    echo $json_response;
}