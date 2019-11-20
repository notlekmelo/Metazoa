<?php
require_once "../repository/Database.php";
session_start();

$bd = new Database();
if(isset($_POST['senhaInput'])){
 if($bd->login($_POST["emailInput"], $_POST["senhaInput"], $_POST["opcaoLogin"])) {

    $_SESSION['logado'] = $_POST["emailInput"];
    $_SESSION['tipo'] = $_POST["opcaoLogin"];
    header('Location: ../view/page/feed.html');
} else {
    header('Location: ../view/page/login.html');
}
}else if(isset($_GET['permissao'])){
    $con = $bd->connect();
    $for = $_GET['permissao'];
    $from = $_SESSION['logado'];
    $result = mysqli_query($con, "SELECT * FROM `solicitacao` WHERE idInteressado='$from' and idReceptor='$for'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $confirm = $row['confirmacao'];
        mysqli_close($con);
        responseSolicitacao($confirm);
    } else {
        responseErro("Nenhum registro encontrado.");
    }
} 
else {
    responseErro("Requisição inválida.");
}

function responseSolicitacao($confirm){
    $response['confirmacao'] = $confirm;
    $json_response = json_encode($response);
    echo $json_response;
}
?>