<?php
  session_start();

  $erro = false;
  $sucesso = false;
  $camposObrigatorios = ['nome', 'cargo', 'departamento', 'admissao', 'cep', 'endereco', 'numero', 'bairro', 'cidade', 'estado', 'tel', 'email'];

  if (isset($_POST['limpar'])) {
    unset($_SESSION['funcionario_form']);
  } elseif (!empty($_POST)) {
    foreach ($camposObrigatorios as $campo) {
      if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
        $erro = true;
        break;
      }
    }

    if ($erro) {
      $_SESSION['funcionario_form'] = $_POST;
    } else {
      unset($_SESSION['funcionario_form']);
      $sucesso = true;
      $registro = array($_POST['nome'], ", ", $_POST['cargo'], ", ", $_POST['departamento'], ", ", $_POST['admissao'], ", ", $_POST['cep'], ", ", $_POST['endereco'], ", ", $_POST['numero'], ", ", $_POST['complemento'], ", ", $_POST['bairro'], ", ", $_POST['cidade'], ", ", $_POST['estado'], ", ", $_POST['tel'], ", ", $_POST['email'], ";", "\n");

      $dir = "../Dados/funcionario.txt";

      file_put_contents($dir, $registro, FILE_APPEND | LOCK_EX);
    }
  }

  $dadosFormulario = $_SESSION['funcionario_form'] ?? [];
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
    <title>Cadastro de Funcionário</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header class="topo">
        <a href="../../menu.php" class="seta" title="Voltar" aria-label="Voltar">←</a>
        <h1>Cadastro Funcionario</h1>
        <a href="../Consulta/Funcionario_Consulta.php" class="seta" title="Consultar dados" aria-label="Consultar dados">→</a>
    </header>

    <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <form action="#" method="POST" class="needs-validation form-carta" novalidate>
            <div class="campo campo-full">
                <label class="form-label">Nome: </label>
                <input class="form-control" type="text" id="nome" name="nome" value="<?= esc($dadosFormulario['nome'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Cargo: </label>
                <input class="form-control" type="text" id="cargo" name="cargo" value="<?= esc($dadosFormulario['cargo'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Departamento: </label>
                <input class="form-control" type="text" id="departamento" name="departamento" value="<?= esc($dadosFormulario['departamento'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Data de Admissão: </label>
                <input class="form-control" type="date" id="admissao" name="admissao" value="<?= esc($dadosFormulario['admissao'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">CEP: </label>
                <input class="form-control" type="text" id="cep" name="cep" value="<?= esc($dadosFormulario['cep'] ?? '') ?>" maxlength="8" placeholder="00000000" required>
            </div>
            <div class="campo campo-2">
                <label class="form-label">Endereço: </label>
                <input class="form-control" type="text" id="endereco" name="endereco" value="<?= esc($dadosFormulario['endereco'] ?? '') ?>" readonly required>
            </div>
            <div class="campo">
                <label class="form-label">Número: </label>
                <input class="form-control" type="number" id="numero" name="numero" value="<?= esc($dadosFormulario['numero'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Complemento: </label>
                <input class="form-control" type="text" id="complemento" name="complemento" value="<?= esc($dadosFormulario['complemento'] ?? '') ?>">
            </div>
            <div class="campo">
                <label class="form-label">Bairro: </label>
                <input class="form-control" type="text" id="bairro" name="bairro" value="<?= esc($dadosFormulario['bairro'] ?? '') ?>" readonly required>
            </div>
            <div class="campo">
                <label class="form-label">Cidade: </label>
                <input class="form-control" type="text" id="cidade" name="cidade" value="<?= esc($dadosFormulario['cidade'] ?? '') ?>" readonly required>
            </div>
            <div class="campo">
                <label class="form-label">Estado: </label>
                <input class="form-control" type="text" id="estado" name="estado" value="<?= esc($dadosFormulario['estado'] ?? '') ?>" readonly required>
            </div>
            <div class="campo">
                <label class="form-label">Telefone: </label>
                <input class="form-control" type="number" id="tel" name="tel" value="<?= esc($dadosFormulario['tel'] ?? '') ?>" required>
            </div>
            <div class="campo campo-2">
                <label class="form-label">Email: </label>
                <input class="form-control" type="email" id="email" name="email" value="<?= esc($dadosFormulario['email'] ?? '') ?>" required>
            </div>
            <div class="botoes">
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

      const clearAddressFields = () => {
        document.getElementById('endereco').value = '';
        document.getElementById('bairro').value = '';
        document.getElementById('cidade').value = '';
        document.getElementById('estado').value = '';
      };

      // Ao digitar o CEP (8 dígitos), busca o endereço no ViaCEP e preenche os campos
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