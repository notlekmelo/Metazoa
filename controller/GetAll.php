<?php
require_once "../repository/Database.php";
header("Content-Type:application/json");
if (isset($_GET['animaisLocal'])) {
    $db = new Database();
    $con = $db->connect();
    $AnimaisJson = array();
    $local = $_GET['animaisLocal'];
    $result = mysqli_query($con, "SELECT animal.*, pessoa.Nome, pessoa.Cidade, pessoa.Rua  FROM `animal` INNER JOIN `pessoa` ON animal.Dono = pessoa.Email WHERE pessoa.Estado='$local'");
    $numResults = mysqli_num_rows($result);
    while ($numResults >= 0) {
        $row = mysqli_fetch_array($result);
        $nomeAn = $row['NomeAnimal'];
        $Especie = $row['Especie'];
        $Raca = $row['Raca'];
        $Desc = $row['Descricao'];
        $Sexo = $row['Sexo'];
        $objetivo = $row['Objetivo'];
        $idade = $row['Idade'];
        $dono = $row['Dono'];
        $nomeDono = $row['Nome'];
        $cidade = $row['Cidade'];
        $rua = $row['Rua'];
        array_push($AnimaisJson, responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua));
        $numResults = $numResults - 1;
    }
    $result = mysqli_query($con, "SELECT animal.*, instituicao.Nome, instituicao.Cidade, instituicao.Rua  FROM `animal` INNER JOIN instituicao ON animal.Dono = instituicao.Email WHERE instituicao.Estado = '$local'");
    $numResults = mysqli_num_rows($result);
    while ($numResults >= 0) {
        $row = mysqli_fetch_array($result);
        $nomeAn = $row['NomeAnimal'];
        $Especie = $row['Especie'];
        $Raca = $row['Raca'];
        $Desc = $row['Descricao'];
        $Sexo = $row['Sexo'];
        $objetivo = $row['Objetivo'];
        $idade = $row['Idade'];
        $dono = $row['Dono'];
        $nomeDono = $row['Nome'];
        $cidade = $row['Cidade'];
        $rua = $row['Rua'];
        array_push($AnimaisJson, responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua));
        $numResults = $numResults - 1;
    }
    mysqli_close($con);
    $jsonImprime = json_encode($AnimaisJson);
    echo $jsonImprime;
} else {
    responseErro("Requisição inválida");
}


function responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua)
{
    $response['NomeAnimal'] = $nomeAn;
    $response['Especie'] = $Especie;
    $response['Raca'] = $Raca;
    $response['Descrição'] = $Desc;
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
?>