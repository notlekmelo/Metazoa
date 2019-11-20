<?php
require_once "../model/Pessoa.php";
require_once "../model/Instituicao.php";
require_once "../model/Animal.php";
require_once "../model/Evento.php";
require_once "../repository/Database.php";
session_start();

$bd = new Database();

if (isset($_POST["nomePessoa"])) {
    $person = new Pessoa($_POST["nomePessoa"], $_POST["telefone"], $_POST["email"], $_POST["estado"], $_POST["senha"], $_POST["cidade"], $_POST["rua"], $_POST["numeroCasa"] . " - " . $_POST["complemento"], $_POST["bairro"]);
    $bd->inserirPessoa($person);
    header('Location: ../view/page/login.html');

} else if (isset($_POST["nomeCanil"])) {
    $canil = new Instituicao($_POST["nomeCanil"], $_POST["telCanil"], $_POST["emailCanil"], $_POST["estado"], $_POST["senhaCanil"], $_POST["cidadeCanil"], $_POST["ruaCanil"], $_POST["numeroCanil"] . " - " . $_POST["complemento"], $_POST["bairroCanil"], $_POST["cnpjCanil"], $_POST["bancoInput"] . " " . $_POST["agenciaInput"] . "/" . $_POST["contaInput"]);
    $bd->inserirCanil($canil);
    header('Location: ../view/page/login.html');

} else if(isset($_POST['nomeAnimal'])){
    $msg = false;
     if (isset($_FILES['arquivo'])) {
         $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));//substr() pega o arquivo e corta ele em um pedaço menor
         $novo_nome = md5(time()).$extensao;//time() retorna a hora atual e md5() criptografa a informação
         $diretorio = "C:/xampp/htdocs/Metazoa/repository/uploadedImages/";

         move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);//Quando o php recebe um arquivo, ele é automaticamente enviado para uma pasta temporária que existe dentro dos arquivos de sistema do php. Para acessar esta pasta, é usada a função move_uploaded_file().

    
    $animal = new Animal($_POST['nomeAnimal'],$_SESSION['logado'],$_POST['sexo'],$_POST['especAnimal'],$_POST['descAnimal'],$_POST['objetivoAnimal'],$_POST['idadeAnimal'],$_POST['racaAnimal']);
    $bd->inserirAnimal($animal,$novo_nome);
    header('Location: ../view/page/perfil.html');
    }
}else if(isset($_POST['EspecieInteresse'])){
    $animal = new Animal('',$_SESSION['logado'],$_POST['sexo'],$_POST['EspecieInteresse'],$_POST['descAnimal'],$_POST['objetivoAnimal'],$_POST['idadeAnimal'],$_POST['racaAnimal']);
    $bd->inserirInteresse($animal);
}else if(isset($_POST['nomeEvento'])){
    $evento = new Evento($_POST['nomeEvento'],$_POST['descEvento'],$_POST['dataEvento'],$_POST['horaEvento'],$_SESSION['logado'],$_POST['localEvento']);
    $bd->inserirEvento($evento);
    header('Location: ../view/page/feed.html');
}else if(isset($_POST['mensagem'])){
    $bd->inserirMensagem($_SESSION['logado'], $_POST['destinatario'], $_POST['conteudo']);
}else if(isset($_POST['destinatario'])){
    $bd->inserirSolicitacao($_SESSION['logado'], $_POST['destinatario']);
    header('Location: ../view/page/perfilDe.html');
}
?>