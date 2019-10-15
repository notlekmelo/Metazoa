<?php
require_once "../repository/Database.php";
$query = "SELECT imagemAnimal FROM animal WHERE Codigo = $_POST['codAnimal'] ";
$result = mysqli_query($query);
$r = mysqli_fetch_array($result);
// echo $r['arquivo'];
if ($res = $result->fetch()) {
    echo $diretorio = "C:/xampp/htdocs/Metazoa/repository/uploadedImages/".$r['imagemAnimal'];
   // echo "Dados encontrados no banco de dados!";
}
else
    echo "Erro";
Header( "Content-type: image/jpg");
echo $imagem->conteudo;
?>