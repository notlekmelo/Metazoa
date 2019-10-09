<?php
require_once "../repository/Database.php";

$id_imagem = $_GET['codigo'];
$querySelecionaPorCodigo = "SELECT imagem FROM tabela_imagens WHERE codigo = $id_imagem";
$resultado = mysql_query($querySelecionaPorCodigo);
$imagem = mysql_fetch_object($resultado);
Header( "Content-type: image/gif");
echo $imagem->imagem;

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
    $response['cNPJ'] = $CNPJ;
    $response['telefone'] = $Telefone;
    $response['estado'] = $estado;
    $response['cidade'] = $cidade;
    $response['rua'] = $rua;
    $response['bairro'] = $bairro;
    $response['conta'] = $conta;

    $json_response = json_encode($response);
    echo $json_response;
}

function responseAnimais($cod,$nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade)
{
    $response['nome do animal'] = $nomeAn;
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
    $response['Erro'] = $erro;
    $json_response = json_encode($response);
    echo $json_response;
}