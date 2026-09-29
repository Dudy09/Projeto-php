<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consulta de Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <h1 class="bg-primary text-white text-center py-3">Consulta de cliente</h1>

  <div class="container mb-5">
    <a href="../Cadastro/Cliente.php" class="btn btn-outline-primary mb-4">← Voltar ao cadastro</a>

    <?php
      $dir = "../Dados/cliente.txt";

      $rotulos = ['Nome', 'CPF', 'RG', 'Data Nasc.', 'CEP', 'Endereço', 'Número', 'Complem.', 'Bairro', 'Cidade', 'Estado', 'Telefone', 'E-mail'];

      if (file_exists($dir)) {
          $linhas = file($dir, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

          echo "<h3>Clientes cadastrados (" . count($linhas) . ")</h3>";

          foreach ($linhas as $i => $linha) {
              $linha = rtrim(trim($linha), ';');

              $dados = explode(", ", $linha);

              echo '<div class="card shadow-sm mb-3"><div class="card-body">';
              echo '<h5 class="card-title">Cliente ' . ($i + 1) . '</h5>';

              foreach ($rotulos as $n => $rotulo) {
                  echo "<p class='mb-1'><strong>$rotulo:</strong> " . htmlspecialchars($dados[$n] ?? '') . "</p>";
              }

              echo '</div></div>';
          }
      } else {
          echo '<p class="aviso">Arquivo não encontrado.</p>';
      }
    ?>
  </div>
</body>
</html>