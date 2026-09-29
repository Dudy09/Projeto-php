<?php
  session_start();

  $erro = false;
  $sucesso = false;
  $camposObrigatorios = ['nome', 'codigo', 'categoria', 'preco', 'quantidade', 'fornecedor'];

  if (isset($_POST['limpar'])) {
    unset($_SESSION['produto_form']);
  } elseif (!empty($_POST)) {
    foreach ($camposObrigatorios as $campo) {
      if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
        $erro = true;
        break;
      }
    }

    if ($erro) {
      $_SESSION['produto_form'] = $_POST;
    } else {
      unset($_SESSION['produto_form']);
      $sucesso = true;
      $produto = array(
        'nome' => $_POST['nome'],
        'codigo' => $_POST['codigo'],
        'categoria' => $_POST['categoria'],
        'preco' => $_POST['preco'],
        'quantidade' => $_POST['quantidade'],
        'validade' => $_POST['validade'] ?? '',
        'fornecedor' => $_POST['fornecedor']
      );

      $registro = array($_POST['nome'], ", ", $_POST['codigo'], ", ", $_POST['categoria'], ", ", $_POST['preco'], ", ", $_POST['quantidade'], ", ", $_POST['validade'] ?? '', ", ", $_POST['fornecedor'], ";", "\n");

      $dir = "../Dados/produto.txt";

      file_put_contents($dir, $registro, FILE_APPEND | LOCK_EX);
    }
  }

  $dadosFormulario = $_SESSION['produto_form'] ?? [];
  if (!function_exists('esc')) {
    function esc($v) {
      return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header class="topo">
        <a href="../../menu.php" class="seta" title="Voltar" aria-label="Voltar">←</a>
        <h1>Cadastro Produto</h1>
        <a href="../Consulta/Produto_Consulta.php" class="seta" title="Consultar dados" aria-label="Consultar dados">→</a>
    </header>

    <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <form action="#" method="POST" class="needs-validation form-carta" novalidate>
            <div class="campo campo-full">
                <label class="form-label">Nome do Produto: </label>
                <input class="form-control" type="text" id="nome" name="nome" value="<?= esc($dadosFormulario['nome'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Código: </label>
                <input class="form-control" type="text" id="codigo" name="codigo" value="<?= esc($dadosFormulario['codigo'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Categoria: </label>
                <input class="form-control" type="text" id="categoria" name="categoria" value="<?= esc($dadosFormulario['categoria'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Fornecedor: </label>
                <input class="form-control" type="text" id="fornecedor" name="fornecedor" value="<?= esc($dadosFormulario['fornecedor'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Preço: </label>
                <input class="form-control" type="number" id="preco" name="preco" value="<?= esc($dadosFormulario['preco'] ?? '') ?>" step="0.01" required>
            </div>
            <div class="campo">
                <label class="form-label">Quantidade em Estoque: </label>
                <input class="form-control" type="number" id="quantidade" name="quantidade" value="<?= esc($dadosFormulario['quantidade'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Data de Validade: </label>
                <input class="form-control" type="date" id="validade" name="validade" value="<?= esc($dadosFormulario['validade'] ?? '') ?>">
            </div>
            <div class="campo-full botoes">
                <input type="submit" value="Cadastrar" class="btn btn-primary">
                <button type="submit" name="limpar" value="1" class="btn btn-warning">Limpar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php if ($erro): ?>
    <div class="container mt-3">
      <div class="alert alert-danger" role="alert">Preencha todos os campos obrigatórios.</div>
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
      const form = document.querySelector('form');
      form.addEventListener('submit', function(event) {
        if (event.submitter && event.submitter.name === 'limpar') {
          return;
        }

        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
          form.classList.add('was-validated');
          alert('Preencha todos os campos obrigatórios antes de enviar.');
        }
      });
    </script>
</body>
</html>