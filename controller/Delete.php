<?php
require_once "../model/Pessoa.php";
require_once "../model/Instituicao.php";
require_once "../repository/Database.php";
session_start();

$bd = new Database();

if(isset($_POST['exclusaoUsuario'])){
    if($bd->login($email,$_POST['exclusaoUsuario'],$_SESSION['tipo'])){
        $bd->excluir($_SESSION['logado'],$_SESSION['tipo']);
        header('Location: ../index.html');
    } 
    else {
        header('Location: ../view/page/perfil.php');
    }
}
else if(isset($_POST['codAnimExc'])){
    $bd->excluirAnimal($_POST['codAnimExc']);
    header('Location: ../view/page/animais.html');
}
else if(isset($_POST['codIntExc'])){
    $bd->excluirInteresse($_POST['codIntExc']);
    header('Location: ../view/page/perfil.html');
}
else if(isset($_POST['codigoEvento'])){
    $bd->excluirEvento($_POST['codigoEvento']);
    header('Location: ../view/page/eventos.html');
}
?>
