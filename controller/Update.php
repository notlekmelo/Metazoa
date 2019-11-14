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
else if(isset($_POST["alteracaoAnimal"])){
    $bd->updateAnimal($_POST['alteracaoAnimal'],$_POST["novoValor"],$_POST["codigo"]);
    header('Location: ../view/page/animais.html');
} else if(isset($_POST['alteracaoEvento'])){
    $bd->updateEvento($_POST['alteracaoEvento'],$_POST["novoValor"],$_POST["codigoEvento"]);
    header('Location: ../view/page/eventos.html');
}else if(isset($_POST['confirmarSolicitacao'])){
    $bd->updateSolicitacao($_POST['destinatario'], $_SESSION['logado']);
}
?>