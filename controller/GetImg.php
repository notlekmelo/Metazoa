<?php
Header( "Content-type: image/jpg");
require_once "../repository/Database.php";
$db = new Database();
$con = $db->connect();
$query = "SELECT imagemAnimal FROM animal WHERE Codigo = " . $_GET['codAnimal'] ;
$result = mysqli_query($con, $query);
$r = mysqli_fetch_array($result);
// echo $r['arquivo'];
if ($result->fetch_assoc()) {
    echo $diretorio = "C:/xampp/htdocs/Metazoa/repository/uploadedImages/".$r['imagemAnimal'];
   // echo "Dados encontrados no banco de dados!";
}
else
    echo "Erro";
echo $imagem->conteudo;
?>