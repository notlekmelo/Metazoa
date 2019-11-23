<?php
require_once "../repository/Database.php";
header("Content-Type:application/json");
session_start();

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
}else if (isset($_GET['solicitacao'])) {
    $db = new Database();
    $con = $db->connect();
    $pessoa = $_SESSION['logado'];
    $result = mysqli_query($con, "SELECT * FROM `solicitacao` WHERE idReceptor='$pessoa' and confirmacao= 0 ");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $nome = $row['idInteressado'];
        mysqli_close($con);
        responseSolicitacao($nome);
    } else {
        responseErro("Nenhum registro encontrado.");
    }
}else if (isset($_GET['mensagem'])) {
    $db = new Database();
    $con = $db->connect();
    $instituicao_id = $_SESSION['logado'];
    $MensagensJson = "[";
    $result = mysqli_query($con, "SELECT * FROM `mensagem` WHERE idInstituicao='$instituicao_id'");
    $qtd = mysqli_num_rows($result);
    while ($qtd > 0) {
        $row = mysqli_fetch_array($result);
        $remetente = $row['idPessoa'];
        $conteudo = $row['conteudo'];
        if ($qtd - 1 > 0)
            $MensagensJson = $MensagensJson . responseMensagem($remetente, $conteudo) . ",";
        else $MensagensJson = $MensagensJson . responseMensagem($remetente, $conteudo);
        $qtd = $qtd - 1;
        mysqli_close($con);
        $MensagensJson = $MensagensJson . "]";
        echo $MensagensJson;
    } 
}else if(isset($_GET['perfil_De'])){
    $db = new Database();
    $con = $db->connect();
    $email = $_GET['perfil_De'];
    $result = mysqli_query($con, "SELECT * FROM `instituicao` WHERE Email='$email'");
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
        responseInstituicao($email, $nome, $CNPJ, $Telefone, $estado, $cidade, $rua, $bairro, $conta);
}else {
    $result = mysqli_query($con, "SELECT * FROM `pessoa` WHERE Email='$email'");
        $row = mysqli_fetch_array($result);
        $nome = $row['Nome'];
        $Telefone = $row['Telefone'];
        $estado = $row['Estado'];
        $cidade = $row['Cidade'];
        $rua = $row['Rua'];
        $bairro = $row['Bairro'];
        mysqli_close($con);
        responsePessoa($email, $nome, $Telefone, $estado, $cidade, $rua, $bairro);
}
}else if (isset($_GET['animais_de'])) {
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
        $img = $row['imagemAnimal'];
        if ($qtd - 1 > 0)
            $AnimaisJson = $AnimaisJson . responseAnimais($cod, $nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo, $idade, $img) . ",";
        else $AnimaisJson = $AnimaisJson . responseAnimais($cod, $nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo, $idade, $img);
        $qtd = $qtd - 1;
    }
    mysqli_close($con);
    $AnimaisJson = $AnimaisJson . "]";
    echo $AnimaisJson;
}else if (isset($_GET['eventos_de'])) {
    $db = new Database();
    $con = $db->connect();
    $dono = $_GET['eventos_de'];
    $EventosJson = "[";
    $result = mysqli_query($con, "SELECT * FROM `evento` WHERE Instituicao='$dono' ");
    $qtd = mysqli_num_rows($result);
    while ($qtd > 0) {
        $row = mysqli_fetch_array($result);
        $nomeEv = $row['NomeEvento'];
        $cod = $row['Codigo'];
        $desc = $row['Descricao'];
        $data = $row['Data'];
        $hora = $row['Horario'];
        $local = $row['Local'];
        if ($qtd - 1 > 0)
            $EventosJson = $EventosJson . responseEventos($nomeEv, $desc,$cod ,$data, $hora, $local) . ",";
        else $EventosJson = $EventosJson . responseEventos($nomeEv, $desc,$cod ,$data, $hora, $local);
        $qtd = $qtd - 1;
    }
    mysqli_close($con);
    $EventosJson = $EventosJson . "]";
    echo $EventosJson;
} else {
    responseErro("Requisição inválida.");
}

function responsePessoa($pessoa_id, $Nome, $Telefone, $estado, $cidade, $rua, $bairro)
{
    $response['nome'] = $Nome;
    $response['e-mail'] = $pessoa_id;
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
    $response['nome'] = $Nome;
    $response['e-mail'] = $instituicao_id;
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

function responseAnimais($cod, $nomeAn, $Especie, $Raca, $Desc, $Sexo, $objetivo, $idade,$img)
{
    $response['nome'] = $nomeAn;
    $response['codigo'] = $cod;
    $response['imagem'] = $img;
    $response['especie'] = $Especie;
    $response['raca'] = $Raca;
    $response['descricao'] = $Desc;
    $response['objetivo'] = $objetivo;
    $response['sexo'] = $Sexo;
    $response['idade'] = $idade;


    $json_response = json_encode($response);
    return $json_response;
}

function responseEventos($nomeEv,$desc,$cod, $data, $hora, $local)
{
    $response['nome'] = $nomeEv;
    $response['codigo'] = $cod;
    $response['descricao'] = $desc;
    $response['data'] = $data;
    $response['horario'] = $hora;
    $response['local'] = $local;

    $json_response = json_encode($response);
    return $json_response;
}

function responseSolicitacao($nome){
    $response['solicitacao de'] = $nome;

    $json_response = json_encode($response);
    return $json_response;
}

function responseMensagem($remetente, $conteudo){
    $response['conteudo'] = $conteudo;
    $response['remetente'] = $remetente;

    $json_response = json_encode($response);
    return $json_response;
}

function responseErro($erro)
{
    $response['erro'] = $erro;
    $json_response = json_encode($response);
    echo $json_response;
}
