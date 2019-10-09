<?php
require_once "../repository/Database.php";

$db = new Database();
$id_imagem = $_GET['codigo'];
$con = $db->connect();
$querySelecionaPorCodigo = "SELECT imagemAnimal FROM animal WHERE Codigo = $id_imagem";
$resultado = mysqli_query($con,$querySelecionaPorCodigo);
$imagem = mysqli_fetch_object($resultado);
Header( "Content-type: image/jpg");
echo $imagem->conteudo;
?>