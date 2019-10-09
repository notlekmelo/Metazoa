<?php
require_once "../repository/Database.php";
header("Content-Type:application/json");
if (isset($_GET['animaisLocal'])) {
    $db = new Database();
    $con = $db->connect();
    $AnimaisJson = "[";
    $local = $_GET['animaisLocal'];
    $result = mysqli_query($con, "SELECT animal.*, pessoa.Nome, pessoa.Cidade, pessoa.Rua  FROM `animal` INNER JOIN `pessoa` ON animal.Dono = pessoa.Email WHERE pessoa.Estado='$local'");
    $numResults = mysqli_num_rows($result);
    $resultInst = mysqli_query($con, "SELECT animal.*, instituicao.Nome, instituicao.Cidade, instituicao.Rua  FROM `animal` INNER JOIN instituicao ON animal.Dono = instituicao.Email WHERE instituicao.Estado = '$local'");
    $qtd = mysqli_num_rows($resultInst);
    while ($numResults > 0) {
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
        if($numResults - 1 > 0 || $qtd != 0)
            $AnimaisJson = $AnimaisJson . responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua) . ",";
        else $AnimaisJson = $AnimaisJson . responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua);
        $numResults = $numResults - 1;
    }
    while ($qtd > 0) {
        $row = mysqli_fetch_array($resultInst);
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
        if($qtd - 1 > 0)
            $AnimaisJson = $AnimaisJson . responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua) . ",";
        else $AnimaisJson = $AnimaisJson . responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua);
        $qtd = $qtd - 1;
    }
    mysqli_close($con);
    $AnimaisJson = $AnimaisJson . "]";
    echo $AnimaisJson;
} else {
    responseErro("Requisição inválida.");
}


function responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade,$rua)
{
    $response['nome'] = $nomeAn;
    $response['especie'] = $Especie;
    $response['raca'] = $Raca;
    $response['descricao'] = $Desc;
    $response['objetivo'] = $objetivo;
    $response['sexo'] = $Sexo;
    $response['idade'] = $idade;
    $response['contato']= $dono;
    $response['dono'] = $nomeDono;
    $response['cidade'] = $cidade;
    $response['rua'] = $rua;

    $json_response = json_encode($response);
    return $json_response;
}
?>