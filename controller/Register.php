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
    $imagem = $_FILES['imagemInput']['tmp_name'];
    $tamanho = $_FILES['imagemInput']['size'];
    $tipo = $_FILES['imagemInput']['type'];
    $nome = $_FILES['imagemInput']['name'];
  
    if ( $imagem != "none" ){
        $fp = fopen($imagem, "rb");
        $conteudo = fread($fp, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($fp);
  
    $animal = new Animal($_POST['nomeAnimal'],$_SESSION['logado'],$_POST['sexo'],$_POST['especAnimal'],$_POST['descAnimal'],$_POST['objetivoAnimal'],$_POST['idadeAnimal'],$_POST['racaAnimal']);
    $bd->inserirAnimal($animal, $conteudo);
    header('Location: ../view/page/perfil.html');
}
