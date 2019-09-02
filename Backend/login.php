<?php
require_once "BancoDados.php";
session_start();

$bd = new BancoDados();
if($bd->login($_POST["emailInput"],$_POST["senhaInput"],$_POST["opcaoLogin"])){
    $_SESSION['logado'] = $_POST["emailInput"];
    header('Location: ../Pages/feed.html');
}
else{
    header('Location: ../Pages/login.html');
}
?>