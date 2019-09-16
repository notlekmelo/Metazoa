<?php
require_once "BancoDados.php";
session_start();

$bd = new BancoDados();
if($bd->login($_POST["emailInput"],$_POST["senhaInput"],$_POST["opcaoLogin"])){
    $_SESSION['logado'] = $_POST["emailInput"];
    $_SESSION['tipo'] = $_POST["opcaoLogin"];
    header('Location: ../Pages/feed.php');
}
else{
    header('Location: ../Pages/login.html');
}
?>