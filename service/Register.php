<?php
require_once "../model/Pessoa.php";
require_once "../model/Instituicao.php";
require_once "../model/Animal.php";
require_once "../repository/Database.php";
session_start();

$bd = new Database();

if (isset($_POST["nomePessoa"])) {
    $person = new Pessoa($_POST["nomePessoa"], $_POST["telefone"], $_POST["email"], $_POST["estado"], $_POST["senha"], $_POST["cidade"], $_POST["rua"], $_POST["numeroCasa"] . " - " . $_POST["complemento"], $_POST["bairro"]);
    $bd->inserirPessoa($person);
    header('Location: ../view/page/login.html');

} else if (isset($_POST["nomeCanil"])) {
    $canil = new Instituicao($_POST["nomeCanil"], $_POST["telCanil"], $_POST["emailCanil"], $_POST["estado"], $_POST["senhaCanil"], $_POST["cidadeCanil"], $_POST["ruaCanil"], $_POST["numeroCanil"] . " - " . $_POST["complemento"], $_POST["bairroCanil"], $_POST["cnpjCanil"], $_POST["bancoInput"] . " " . $_POST["agenciaInput"] . "/" . $_POST["contaInput"]);
    $bd->inserirCanil($canil);
    header('Location: ../view/page/login.html');

} else if(isset($_POST['nomeAnimal'])){
    $animal = new Animal($_POST['nomeAnimal'],$_POST['dono'],$_POST['sexo'],$_POST['especie'],$_POST['desc'],$_POST['objetivo'],$_POST['idade'],$_POST['raca']);
    $bd->inserirAnimal($animal);
    header('Location: ../view/page/perfil.html');
}
