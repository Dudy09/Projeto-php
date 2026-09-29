<?php

if(!empty($_POST))
{
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if(($usuario == 'Alessandro' && $senha == 'Alessandro') || (($usuario == 'RM' || $usuario == 'rm' || $usuario == 'Rm') && ($senha == '250533')))
    {
        header('location: menu.php');
    }

    else
    {
        echo "<script>alert('Usuário ou senha incorretos!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Papers Please Login</title>

    <link rel="stylesheet" href="css/style-login.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="img/logo PP.png" alt="Logo" class="logo" style="width: 52px;">
                <div class="ms-2">
                    <div class="fw-bold">Papers Please</div>
                    <small>Ministry of Admission</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>
                <a class="btn btn-outline-light ms-lg-3 mt-2 mt-lg-0" href="#">Suporte</a>
            </div>
        </div>
    </nav>

    <div class="papers-container">

        <img src="img/Esquerda.png" alt="Painel lateral" class="left-panel">

        <section class="balcao-section">

            <form class="papers-form animate" action="#" method="post">

                <h2>MINISTRY OF ADMISSION</h2>
                <div class="container">

                    <label for="uname"> <b>USUARIO</b> </label>
                    <input type="text" placeholder="Digite o usuário" name="usuario" required>
                    <label for="psw"> <b>SENHA</b> </label>
                    <input type="password" placeholder="Digite a senha" name="senha" required>

                    <button type="submit"> ENTRAR </button>

                </div>
            </form>
        </section>
    </div>

<script>
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
