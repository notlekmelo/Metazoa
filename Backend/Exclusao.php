<?php
require_once "Pessoa.php";
require_once "Instituicao.php";
require_once "BancoDados.php";
session_start();

$bd = new BancoDados();

if(isset($_POST['exclusaoUsuario'])){
    if($bd->login($email,$_POST['exclusaoUsuario'],$_SESSION['tipo'])){
        $bd->excluir($_SESSION['logado'],$_SESSION['tipo']);
        header('Location: ../index.html');
    }
    else {
        header('Location: ../Pages/Perfil.php');
    }
}

?>