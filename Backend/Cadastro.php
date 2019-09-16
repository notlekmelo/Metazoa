<?php
require_once "Pessoa.php";
require_once "Instituicao.php";
require_once "BancoDados.php";
session_start();

$bd = new BancoDados();

if(isset($_POST["nomePessoa"])) {
    $person = new Pessoa($_POST["nomePessoa"], $_POST["telefone"], $_POST["email"], $_POST["estado"], $_POST["senha"], $_POST["cidade"], $_POST["rua"], $_POST["numeroCasa"] . " - " . $_POST["complemento"], $_POST["bairro"]);
    $bd->inserirPessoa($person);
    header('Location: ../Pages/login.html');

} else if (isset($_POST["nomeCanil"])) {
    $canil = new Instituicao($_POST["nomeCanil"], $_POST["telCanil"], $_POST["emailCanil"], $_POST["estado"], $_POST["senhaCanil"], $_POST["cidadeCanil"], $_POST["ruaCanil"], $_POST["numeroCanil"] . " - " . $_POST["complemento"], $_POST["bairroCanil"], $_POST["cnpjCanil"], $_POST["bancoInput"] . " " . $_POST["agenciaInput"] . "/" . $_POST["contaInput"]);
    $bd->inserirCanil($canil);
    header('Location: ../Pages/login.html');
} else if (isset($_POST["campoInput"])){
    $bd->updateCampo($_SESSION['tipo'],$_POST["campoInput"],$_POST["valorInput"],$_SESSION['logado']);
    header('Location: ../Pages/perfil.php');
}

