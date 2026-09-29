<?php
  include 'funções.php';

  $campos = ['nome', 'cpf', 'rg', 'dt', 'cep', 'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'tel', 'email'];
  $obrigatorios = array_diff($campos, ['complemento']);

  $enviado  = !empty($_POST);$faltando = false;
  $erro     = null;

  if ($enviado) {

    $cliente = array($_POST['nome'], ", ", $_POST['cpf'], ", ", $_POST['rg'], ", ", $_POST['dt'], ", ", $_POST['cep'], ", ", $_POST['endereco'], ", ", $_POST['numero'], ", ", $_POST['complemento'], ", ", $_POST['bairro'], ", ", $_POST['cidade'], ", ", $_POST['estado'], ", ", $_POST['tel'], ", ", $_POST['email'], ";", "\n");

    $dir = "../Dados/cliente.txt";

    file_put_contents($dir,$cliente,  FILE_APPEND | LOCK_EX);

    foreach ($obrigatorios as $c) {
      if (!isset($_POST[$c]) || trim($_POST[$c]) === '') {
        $faltando = true;
        break;
      }
    }

    if (!$faltando) {
      $erro = validarCPF($_POST['cpf']);
    }
  }

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
    <title>Envie sua carta</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

    <header class="topo">
        <a href="../../menu.php" class="seta" title="Voltar" aria-label="Voltar">←</a>
        <h1>Envie sua carta</h1>
        <a href="../Consulta/Cliente_Consulta.php" class="seta" title="Consultar dados" aria-label="Consultar dados">→</a>
    </header>

    <main style="height: 100vh;">
        <section style="margin: 0px 100px 0px 100px; display: grid; justify-content: center; align-items: center; height: 100vh;">

            <article class="carta-background">

                <section class="carta-form">
                    <h1>Destinatário</h1>

                    <form action="#" method="POST" class="needs-validation form-carta" novalidate>
                        <div class="campo campo-full">
                            <label class="form-label">Nome: </label>
                            <input class="form-control" type="text" id="nome" name="nome" required>
                        </div>

                        <div class="campo">
                            <label class="form-label">CPF: </label>
                            <input class="form-control" type="number" id="cpf" name="cpf" placeholder="000000000/00" required>
                        </div>
                        <div class="campo">
                            <label class="form-label">RG: </label>
                            <input class="form-control" type="number" id="rg" name="rg" placeholder="00.000.000-0" required>
                        </div>
                        <div class="campo">
                            <label class="form-label">Data Nascimento: </label>
                            <input class="form-control" type="date" id="dt" name="dt" required>
                        </div>

                        <div class="campo">
                            <label class="form-label">CEP: </label>
                            <input class="form-control" type="text" id="cep" name="cep" maxlength="8" placeholder="00000000" required>
                        </div>
                        <div class="campo campo-2">
                            <label class="form-label">Endereço: </label>
                            <input class="form-control" type="text" id="endereco" name="endereco" readonly required>
                        </div>

                        <div class="campo">
                            <label class="form-label">Número: </label>
                            <input class="form-control" type="number" id="numero" name="numero" placeholder="000000" required>
                        </div>
                        <div class="campo">
                            <label class="form-label">Complemento: </label>
                            <input class="form-control" type="text" id="complemento" name="complemento">
                        </div>
                        <div class="campo">
                            <label class="form-label">Bairro: </label>
                            <input class="form-control" type="text" id="bairro" name="bairro" readonly required>
                        </div>

                        <div class="campo">
                            <label class="form-label">Cidade: </label>
                            <input class="form-control" type="text" id="cidade" name="cidade" readonly required>
                        </div>
                        <div class="campo">
                            <label class="form-label">Estado: </label>
                            <input class="form-control" type="text" id="estado" name="estado" readonly required>
                        </div>
                        <div class="campo">
                            <label class="form-label">Telefone: </label>
                            <input class="form-control" type="number" id="tel" name="tel" required>
                        </div>

                        <div class="campo campo-2">
                            <label class="form-label">Email: </label>
                            <input class="form-control" type="email" id="email" name="email" required>
                        </div>
                        <div class="botoes">
                            <input type="submit" value="Cadastrar" class="btn btn-primary">
                            <input type="reset" value="Limpar" class="btn btn-warning">
                        </div>
                    </form>
                </section>

                <aside class="carta-selos">
                    <div class="selos">
                        <img src="../../img/Selo-Postal.png" class="selo-postal">
                        <img src="../../img/Selo-Carta.png" class="selo-carta">
                    </div>
                    <img src="../../img/Foto-catnap.png" class="foto-polaroid">
                </aside>

            </article>

        </section>
    </main>

    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
      const form = document.querySelector('form');

      if (document.querySelector('.card-header.bg-success')) {
        form.reset();
      }

      const resultado = document.getElementById('resultado');
      if (resultado) {
        resultado.scrollIntoView({ behavior: 'smooth' });
      }

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