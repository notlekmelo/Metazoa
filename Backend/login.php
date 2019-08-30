<?php
require_once "BancoDados.php";
session_start();

$bd = new BancoDados();
$bd->login($_POST["emailInput"],$_POST["senhaInput"],$_POST["opcaoLogin"]);
$_SESSION['logado'] = $_POST["emailInput"];

header('Location: ../index.html');

?>