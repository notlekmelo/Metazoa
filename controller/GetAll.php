<?php
require_once "../repository/Database.php";
header("Content-Type:application/json");
session_start();

if (isset($_GET['animaisLocal'])) {
    $db = new Database();
    $con = $db->connect();
    $logado = $_SESSION['logado'];
    $AnimaisJson = "[";
    $local = $_GET['animaisLocal'];
    $result = mysqli_query($con, "SELECT animal.*, pessoa.Nome, pessoa.Cidade FROM `animal` INNER JOIN `pessoa` ON animal.Dono = pessoa.Email WHERE pessoa.Estado='$local' and pessoa.Email <> '$logado'");
    $numResults = mysqli_num_rows($result);
    $resultInst = mysqli_query($con, "SELECT animal.*, instituicao.Nome, instituicao.Cidade FROM `animal` INNER JOIN instituicao ON animal.Dono = instituicao.Email WHERE instituicao.Estado = '$local' and instituicao.Email <> '$logado'");
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
        $img = $row['imagemAnimal'];
        if($numResults - 1 > 0 || $qtd != 0)
            $AnimaisJson = $AnimaisJson . responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade, $img) . ",";
        else $AnimaisJson = $AnimaisJson . responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade, $img);
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
        $img = $row['imagemAnimal'];
        if($qtd - 1 > 0)
            $AnimaisJson = $AnimaisJson . responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade, $img) . ",";
        else $AnimaisJson = $AnimaisJson . responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade, $img);
        $qtd = $qtd - 1;
    }
    mysqli_close($con);
    $AnimaisJson = $AnimaisJson . "]";
    echo $AnimaisJson;
} else if (isset($_GET['solicitacaoPessoal'])) {
    $db = new Database();
    $con = $db->connect();
    $logado = $_SESSION['logado'];
    $SolicitacaoJson = "[";
    $local = $_GET['animaisLocal'];
    $result = mysqli_query($con, "SELECT idInteressado, Nome, Cidade, Estado FROM `solicitacao` INNER JOIN `pessoa` ON solicitacao.IdReceptor = pessoa.Email WHERE idReceptor='$logado'");
    $numResults = mysqli_num_rows($result);
    while ($numResults > 0) {
        $row = mysqli_fetch_array($result);
        $solicitante = $row['idInteressado'];
        $nome = $row['Nome'];
        $cidade = $row['Cidade'];
        $estado = $row['Estado'];
        if($numResults - 1 > 0)
            $SolicitacaoJson = $SolicitacaoJson . responseSolicitacao($solicitante,$nome,$cidade,$estado) . ",";
        else $SolicitacaoJson = $SolicitacaoJson . responseSolicitacao($solicitante,$nome,$cidade,$estado);
        $numResults = $numResults - 1;
    }
    mysqli_close($con);
    $SolicitacaoJson = $SolicitacaoJson . "]";
    echo $SolicitacaoJson;
}else if (isset($_GET['eventosLocal'])) {
    $db = new Database();
    $con = $db->connect();
    $logado = $_SESSION['logado'];
    $EventosJson = "[";
    $local = $_GET['eventosLocal'];
    $resultInst = mysqli_query($con, "SELECT evento.*, instituicao.Nome, instituicao.Email ,instituicao.CNPJ FROM `evento` INNER JOIN instituicao ON evento.Instituicao = instituicao.Email WHERE instituicao.Estado = '$local' and instituicao.Email <> '$logado'");
    $qtd = mysqli_num_rows($resultInst);
    while ($qtd > 0) {
        $row = mysqli_fetch_array($resultInst);
        $nomeEv = $row['NomeEvento'];
        $dono = $row['Nome'];
        $cnpj = $row['CNPJ'];
        $email = $row['Email'];
        $Desc = $row['Descricao'];
        $data = $row['Data'];
        $hora = $row['Horario'];
        $local = $row['Local'];
        if($qtd - 1 > 0)
            $EventosJson = $EventosJson . responseEventos($nomeEv,$dono,$cnpj,$Desc,$data, $local, $hora, $email) . ",";
        else $EventosJson = $EventosJson . responseEventos($nomeEv,$dono,$cnpj,$Desc,$data, $local, $hora, $email);
        $qtd = $qtd - 1;
    }
    mysqli_close($con);
    $EventosJson = $EventosJson . "]";
    echo $EventosJson;
    }else {
    responseErro("Requisição inválida.");
}


function responseAnimais($nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo,$idade,$dono,$nomeDono,$cidade, $img)
{
    $response['nome'] = $nomeAn;
    $response['imagem'] = $img;
    $response['especie'] = $Especie;
    $response['raca'] = $Raca;
    $response['descricao'] = $Desc;
    $response['objetivo'] = $objetivo;
    $response['sexo'] = $Sexo;
    $response['idade'] = $idade;
    $response['contato']= $dono;
    $response['dono'] = $nomeDono;
    $response['cidade'] = $cidade;

    $json_response = json_encode($response);
    return $json_response;
}

function responseSolicitacao($solicitante,$nome,$cidade,$estado){
    $response['nome'] = $nome;
    $response['solicitante'] = $solicitante;
    $response['estado'] = $estado;
    $response['cidade'] = $cidade;

    $json_response = json_encode($response);
    return $json_response;
}

function responseEventos($nomeEv,$dono,$cnpj,$Desc,$data, $local, $hora, $email)
{
    
    $response['nome do Evento'] = $nomeEv;
    $response['responsável'] = $dono;
    $response['cNPJ'] = $cnpj;
    $response['contato'] = $email;
    $response['descricao'] = $Desc;
    $response['data'] = $data;
    $response['horario'] = $hora;
    $response['local'] = $local;

    $json_response = json_encode($response);
    return $json_response;
}
?>