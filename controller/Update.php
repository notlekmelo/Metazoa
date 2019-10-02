<?php
require_once "../model/Pessoa.php";
require_once "../model/Instituicao.php";
require_once "../repository/Database.php";
session_start();

$bd = new Database();

if (isset($_POST["alteracaoUsuario"])) {
    $bd->updateCampo($_SESSION['tipo'], $_POST["alteracaoUsuario"], $_POST["valorInput"], $_SESSION['logado']);
    header('Location: ../view/page/perfil.html');
}
