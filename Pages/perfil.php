<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Metazoa | Meu Perfil</title>
    <link rel="stylesheet" href="../Css/feed.css">
</head>

<body>
    <div id="menu">

        <div id="logo">
            <span>[logotipo]</span>
        </div>

        <ul>
            <li>
                <a href="../index.html">
                    <img src="../Imagens/home.png">
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="feed.php">
                    <img src="../Imagens/pet.png">
                    <span>Feed</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="../Imagens/mundo.png">
                    <span>Explorar</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="../Imagens/email.png">
                    <span>Convites</span>
                </a>
            </li>
            <li>
                <a href="#" selected>
                    <img src="../Imagens/face.png">
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
            require_once "../Backend/BancoDados.php";
            $bd = new BancoDados();
            session_start();

            $perfil = $bd->getAllInfo($_SESSION['logado'], $_SESSION['tipo']);
            echo $perfil['Nome'] . "<hr/>" . $perfil['Email'] . "<hr/>" . $perfil['Telefone'] . "<hr/>" . $perfil['Rua'] . "<hr/>" . $perfil['Bairro'] . "<hr/>" . $perfil['Cidade'] . "<hr/>" . $perfil['Estado'] . "<hr/>";
            if ($_SESSION['tipo'] === "instituicao") {
                echo $perfil['CNPJ'] . "<hr/>" . $perfil['Conta'];
            }
            ?>
            <button onclick="MostraCampo()">Alterar valores</button>
            <form action="../Backend/Cadastro.php" method="POST" autocomplete="off">
                <input id="campoInput" type="text" placeholder="Campo a ser alterado" name="campoInput" style="display:none;" required>
                <input id="valorInput" type="text" placeholder="Novo valor" name="valorInput" style="display:none;" required>
                <input id="buttonSubmit" type="submit" value="Confirmar" style="display:none;">
            </form>
            <h2>Seus animais: </h2>
        </div>
    </div>
    <script type="text/javascript">
        function MostraCampo() {
            document.getElementById("campoInput").removeAttribute("style");
            document.getElementById("valorInput").removeAttribute("style");
            document.getElementById("buttonSubmit").removeAttribute("style");

        }
    </script>
</body>

</html>