<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Metazoa | Feed</title>
    <link rel="stylesheet" href="../style/main.css">
</head>

<body>
    <div id="menu">

        <div id="logo">
            <a href="../../index.html">
                <img src="../image/logo.png">
            </a>
        </div>

        <ul>
            <li>
                <a href="#" selected>
                    <img src="../image/pet.png">
                    <span>Feed</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="../image/mundo.png">
                    <span>Explorar</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="../image/email.png">
                    <span>Convites</span>
                </a>
            </li>
            <li>
                <a href="perfil.html">
                    <img src="../image/face.png">
                    <span>Perfil</span>
                </a>
            </li>
        </ul>
        <div id="footer">
            <p>Todos os direitos reservados ® 2019.</p>
        </div>
    </div>
    <div id="corpo">
        <div id="container">
            <?php
            require_once "../../repository/Database.php";
            $bd = new Database();

            session_start();
            $nome = $bd->getColumn($_SESSION['logado'], $_SESSION['tipo'], "Nome");
            echo  "Bem vindo " . $nome . "<br/><br/>";

            $lista = $bd->getAllState($bd->getColumn($_SESSION['logado'], $_SESSION['tipo'], "Estado"));
            $tam = count($lista);
            while ($tam > -1) {
                if (array_key_exists($tam, $lista)) {
                    echo $lista[$tam]['Nome'] . "<hr/>";
                }
                $tam = $tam - 1;
            }
            ?>
        </div>
    </div>

</body>

</html>