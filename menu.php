<?php

  $numeroSorteado = 0;

  $numeroSorteado = mt_rand(1, 3);

  switch ($numeroSorteado) {
    case 1:
      $primeira_cor="#1e3a8a";
      $segunda_cor="#3b82f6";
      $logo = "img/Steam.png";
      $largura = "width: 50px;";
      $altura = "height: 50px";
      break;

    case 2:
      $primeira_cor="#e12545";
      $segunda_cor="#E1576E";
      $logo = "img/itch_icon.webp";
      $largura = "width: 50px;";
      $altura = "height: 50px";
      break;

    case 3:
      $primeira_cor="#1f2433";
      $segunda_cor="#2477ff";
      $logo = "img/Company-Logo_Nuuvem-768x202.png";
      $largura = "width: 150px;";
      $altura = "height: 50px;";
      break;

  }

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meu menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body style="background: linear-gradient(135deg, <?= $segunda_cor ?>, <?= $primeira_cor ?>);">
  <nav class="navbar navbar-expand-lg navbar-dark custom-navbar" style="background: linear-gradient(135deg, <?= $primeira_cor ?>, <?= $segunda_cor ?>);">
    <div class="container-fluid">
      <img src="<?= $logo ?>" alt="Logo" class="logo me-2" style="<?= $largura ?> <?= $altura ?>">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Cadastros
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="Cadastro-consulta/Cadastro/Cliente.php">Cliente</a></li>
              <li><a class="dropdown-item" href="Cadastro-consulta/Cadastro/Funcionario.php">Funcionario</a></li>
              <li><a class="dropdown-item" href="Cadastro-consulta/Cadastro/Fornecedor.php">Fornecedor</a></li>
              <li><a class="dropdown-item" href="Cadastro-consulta/Cadastro/Produto.php">Produto</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Consulta
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="Cadastro-consulta/Consulta/Cliente_consulta.php">Cliente</a></li>
              <li><a class="dropdown-item" href="Cadastro-consulta/Consulta/Funcionario.php">Funcionario</a></li>
              <li><a class="dropdown-item" href="Cadastro-consulta/Consulta/Fornecedor.php">Fornecedor</a></li>
              <li><a class="dropdown-item" href="Cadastro-consulta/Consulta/Produto.php">Produto</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Atividades de todos os bimestres
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="Música/index.php">Site de música</a></li>
              <li><a class="dropdown-item" href="10-03-formulario/formulario.php">Formulario</a></li>
              <li><a class="dropdown-item" href="17-03-idade-Login/login.php">Login email</a></li>
              <li><a class="dropdown-item" href="17-03-idade-Login/Idade.php">Login idade</a></li>
              <li><a class="dropdown-item" href="24-03-verificar-nota/index.php">Verificar nota</a></li>
              <li><a class="dropdown-item" href="Switch_case/Taxa_veiculo.php">Taxa de veiculo</a></li>
              <li><a class="dropdown-item" href="Switch_case/Analise_investimento.php">Analise de investimento</a></li>
              <li><a class="dropdown-item" href="Switch_case/Triagem_hospitalar.php">Triagem hospitalar</a></li>
              <li><a class="dropdown-item" href="27-04-Laços-de-repetição/tabuada.php">tabuada</a></li>
              <li><a class="dropdown-item" href="27-04-Laços-de-repetição/senha.php">senha</a></li>
              <li><a class="dropdown-item" href="27-04-Laços-de-repetição/mega_sena.php">mega sena</a></li>
              <li><a class="dropdown-item" href="28-07-funções/index.php">Funções em php</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="hero">
    <div class="container d-flex align-items-center justify-content-between flex-wrap">

      <div class="hero-text">
        <h1>Bem-vindo ao meu site</h1>
        <p>
          Este é um site de exemplo para demonstrar o uso de PHP e Bootstrap.
          Aqui você pode encontrar várias atividades e exemplos relacionados a desenvolvimento web.
        </p>
        <p>
          Explore as opções no menu para acessar diferentes funcionalidades
          e aprender mais sobre programação em PHP.
        </p>
      </div>

      <div class="hero-img">
        <img src="img/code.png" alt="Imagem código">
      </div>

    </div>
  </section>

  <footer class="footer">
    <p>© 2026 Arthur Almeida • Todos os direitos reservados</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
