<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="bg-primary text-white text-center">Cadastro de Produto</h1>
    <div class="container">
      <div class="row">
        <div class="col"></div>
        <div class="col-lg-8">
          <form action="#" method="POST" class="needs-validation" novalidate>
            <label class="form-label">Nome do Produto:</label>
            <input class="form-control" type="text" id="nome" name="nome" required>

            <label class="form-label">Código:</label>
            <input class="form-control" type="text" id="codigo" name="codigo" required>

            <label class="form-label">Categoria:</label>
            <input class="form-control" type="text" id="categoria" name="categoria" required>

            <label class="form-label">Preço:</label>
            <input class="form-control" type="number" step="0.01" id="preco" name="preco" required>

            <label class="form-label">Quantidade em Estoque:</label>
            <input class="form-control" type="number" id="quantidade" name="quantidade" required>

            <label class="form-label">Data de Validade:</label>
            <input class="form-control" type="date" id="validade" name="validade">

            <label class="form-label">Fornecedor:</label>
            <input class="form-control" type="text" id="fornecedor" name="fornecedor" required>

            <div class="mt-3">
              <input type="submit" value="Cadastrar" class="btn btn-primary">
              <input type="reset" value="Limpar" class="btn btn-warning">
            </div>
          </form>
        </div>
        <div class="col"></div>
      </div>
    </div>

    <?php
      if (!empty($_POST)) {
        $produto = array(
          $_POST['nome'],
          $_POST['codigo'],
          $_POST['categoria'],
          $_POST['preco'],
          $_POST['quantidade'],
          $_POST['validade'],
          $_POST['fornecedor']
        );
      }
    ?>

    <?php if (!empty($_POST)): ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col"></div>
        <div class="col-lg-8">
          <div class="card shadow">
            <div class="card-header bg-success text-white">
              <h5 class="mb-0">✓ Dados do Produto Cadastrado</h5>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-6">
                  <p><strong>Nome do Produto:</strong> <?= htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>Código:</strong> <?= htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>Categoria:</strong> <?= htmlspecialchars($_POST['categoria'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div class="col-md-6">
                  <p><strong>Preço:</strong> R$ <?= number_format((float)$_POST['preco'], 2, ',', '.') ?></p>
                  <p><strong>Quantidade:</strong> <?= htmlspecialchars($_POST['quantidade'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>Fornecedor:</strong> <?= htmlspecialchars($_POST['fornecedor'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
              </div>
              <?php if (!empty($_POST['validade'])): ?>
              <hr>
              <p><strong>Data de Validade:</strong> <?= htmlspecialchars($_POST['validade'], ENT_QUOTES, 'UTF-8') ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
      const form = document.querySelector('form');
      form.addEventListener('submit', function(event) {
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
