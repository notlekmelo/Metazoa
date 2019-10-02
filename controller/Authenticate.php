<?php
require_once "../repository/Database.php";
session_start();

$bd = new Database();
if ($bd->login($_POST["emailInput"], $_POST["senhaInput"], $_POST["opcaoLogin"])) {

    $_SESSION['logado'] = $_POST["emailInput"];
    $_SESSION['tipo'] = $_POST["opcaoLogin"];
    header('Location: ../view/page/feed.html');
} else {
    header('Location: ../view/page/login.html');
}
?>