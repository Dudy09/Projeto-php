<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="bg-primary text-white text-center">Cadastro de Funcionário</h1>
    <div class="container">
      <div class="row">
        <div class="col"></div>
        <div class="col-lg-8">
          <form action="#" method="POST" class="needs-validation" novalidate>
            <label class="form-label">Nome:</label>
            <input class="form-control" type="text" id="nome" name="nome" required>

            <label class="form-label">Cargo:</label>
            <input class="form-control" type="text" id="cargo" name="cargo" required>

            <label class="form-label">Departamento:</label>
            <input class="form-control" type="text" id="departamento" name="departamento" required>

            <label class="form-label">Data de Admissão:</label>
            <input class="form-control" type="date" id="admissao" name="admissao" required>

            <label class="form-label">CEP:</label>
            <input class="form-control" type="text" id="cep" name="cep" maxlength="8" placeholder="00000000" required>

            <label class="form-label">Endereço:</label>
            <input class="form-control" type="text" id="endereco" name="endereco" readonly required>

            <label class="form-label">Número:</label>
            <input class="form-control" type="text" id="numero" name="numero" required>

            <label class="form-label">Complemento:</label>
            <input class="form-control" type="text" id="complemento" name="complemento">

            <label class="form-label">Bairro:</label>
            <input class="form-control" type="text" id="bairro" name="bairro" readonly required>

            <label class="form-label">Cidade:</label>
            <input class="form-control" type="text" id="cidade" name="cidade" readonly required>

            <label class="form-label">Estado:</label>
            <input class="form-control" type="text" id="estado" name="estado" readonly required>

            <label class="form-label">Telefone:</label>
            <input class="form-control" type="tel" id="tel" name="tel" required>

            <label class="form-label">Email:</label>
            <input class="form-control" type="email" id="email" name="email" required>

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
        $funcionario = array(
          $_POST['nome'],
          $_POST['cargo'],
          $_POST['departamento'],
          $_POST['admissao'],
          $_POST['cep'],
          $_POST['endereco'],
          $_POST['numero'],
          $_POST['complemento'],
          $_POST['bairro'],
          $_POST['cidade'],
          $_POST['estado'],
          $_POST['tel'],
          $_POST['email']
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
              <h5 class="mb-0">✓ Dados do Funcionário Cadastrado</h5>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-6">
                  <p><strong>Nome:</strong> <?= htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>Cargo:</strong> <?= htmlspecialchars($_POST['cargo'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>Departamento:</strong> <?= htmlspecialchars($_POST['departamento'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div class="col-md-6">
                  <p><strong>Data de Admissão:</strong> <?= htmlspecialchars($_POST['admissao'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>Telefone:</strong> <?= htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>Email:</strong> <?= htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
              </div>
              <hr>
              <h6 class="fw-bold mb-3">Endereço</h6>
              <div class="row">
                <div class="col-md-8">
                  <p><strong>Rua:</strong> <?= htmlspecialchars($_POST['endereco'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>Bairro:</strong> <?= htmlspecialchars($_POST['bairro'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div class="col-md-4">
                  <p><strong>Nº:</strong> <?= htmlspecialchars($_POST['numero'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p><strong>CEP:</strong> <?= htmlspecialchars($_POST['cep'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Complemento:</strong> <?= htmlspecialchars($_POST['complemento'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div class="col-md-3">
                  <p><strong>Cidade:</strong> <?= htmlspecialchars($_POST['cidade'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div class="col-md-3">
                  <p><strong>Estado:</strong> <?= htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
              </div>
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

      const clearAddressFields = () => {
        document.getElementById('endereco').value = '';
        document.getElementById('bairro').value = '';
        document.getElementById('cidade').value = '';
        document.getElementById('estado').value = '';
      };

      document.getElementById('cep').addEventListener('input', function() {
        const cep = this.value.replace(/\D/g, '');

        if (cep.length === 8) {
          fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
              if (!data.erro) {
                document.getElementById('endereco').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
              } else {
                clearAddressFields();
                alert('CEP não encontrado!');
              }
            })
            .catch(error => {
              console.error('Erro ao buscar CEP:', error);
              clearAddressFields();
              alert('Erro ao buscar CEP. Verifique sua conexão!');
            });
        } else {
          clearAddressFields();
        }
      });
    </script>
  </body>
</html>
