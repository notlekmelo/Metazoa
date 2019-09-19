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
            <a href="../index.html">
                <img src="../Imagens/logo.png">
            </a>
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
            if ($_SESSION['tipo'] === "Instituicao") {
                echo $perfil['CNPJ'] . "<hr/>" . $perfil['Conta'] ."<hr/>";
            }
            ?>
            <button id="btnAlt" class="btn" onclick="MostraCampo()">Alterar valores</button>
            <button id="btnExc" onclick="excluir()">Excluir conta</button>
            <form action="../Backend/Cadastro.php" method="POST" autocomplete="off">
            <div class="row">
                <input id="campoInput" type="text" placeholder="Campo a ser alterado" name="alteracaoUsuario" style="display:none;" required>
                </div>
                <div class="row">
                <input id="valorInput" type="text" placeholder="Novo valor" name="valorInput" style="display:none;" required>
                </div>
                <div class="row">
                <input id="buttonSubmit" class="btn" type="submit" value="Confirmar" style="display:none;">
                </div>
            </form>
            <form action="../Backend/Exclusao.php" method="POST" autocomplete="off">
            <div class="row">
                <input id="exclusaoUsuario" type="password" placeholder="Para excluir sa conta, digite sua senha" name="exclusaoUsuario" style="display:none;" required>
                </div>
                <div class="row">
                <input id="submitExc" class="btn" type="submit" value="Confirmar" style="display:none;">
                </div>
            </form>
            <button id="cancel" onclick="EscondeCampos()" style="display:none"> Cancelar </button>
            <h2>Seus animais: </h2>
        </div>
    </div>
    <script type="text/javascript">
        function MostraCampo() {
            document.getElementById("campoInput").removeAttribute("style");
            document.getElementById("valorInput").removeAttribute("style");
            document.getElementById("buttonSubmit").removeAttribute("style");
            document.getElementById("cancel").removeAttribute("style");
            document.getElementById("btnExc").setAttribute("style","display:none");
            document.getElementById("btnAlt").setAttribute("style","display:none");

        }

        function excluir(){
            document.getElementById("btnExc").setAttribute("style","display:none");
            document.getElementById("btnAlt").setAttribute("style","display:none");
            document.getElementById("submitExc").removeAttribute("style");
            document.getElementById("exclusaoUsuario").removeAttribute("style");
            document.getElementById("cancel").removeAttribute("style");

        }

        function EscondeCampos(){
            document.getElementById("btnExc").removeAttribute("style");
            document.getElementById("btnAlt").removeAttribute("style");
            document.getElementById("campoInput").setAttribute("style","display:none");
            document.getElementById("valorInput").setAttribute("style","display:none");
            document.getElementById("buttonSubmit").setAttribute("style","display:none");
            document.getElementById("submitExc").setAttribute("style","display:none");
            document.getElementById("exclusaoUsuario").setAttribute("style","display:none");
            document.getElementById("cancel").setAttribute("style","display:none");
        }
    </script>
</body>

</html>