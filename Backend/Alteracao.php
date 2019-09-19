<?php
require_once "Pessoa.php";
require_once "Instituicao.php";
require_once "BancoDados.php";
session_start();

$bd = new BancoDados();

if (isset($_POST["alteracaoUsuario"])){
    $bd->updateCampo($_SESSION['tipo'],$_POST["campoInput"],$_POST["valorInput"],$_SESSION['logado']);
    header('Location: ../Pages/perfil.php');
} 

?>