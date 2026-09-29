<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consulta de produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <h1 class="bg-primary text-white text-center py-3">Consulta de produto</h1>

  <div class="container mb-5">
    <a href="../Cadastro/Produto.php" class="btn btn-outline-primary mb-4">← Voltar ao cadastro</a>

    <?php
      $dir = "../Dados/produto.txt";

      $rotulos = ['Nome', 'Código', 'Categoria', 'Preço', 'Quantidade', 'Validade', 'Fornecedor'];

      if (file_exists($dir)) {
          $linhas = file($dir, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

          echo "<h3>Produtos cadastrados (" . count($linhas) . ")</h3>";

          foreach ($linhas as $i => $linha) {
              $linha = rtrim(trim($linha), ';');

              $dados = explode(", ", $linha);

              echo '<div class="card shadow-sm mb-3"><div class="card-body">';
              echo '<h5 class="card-title">Produto ' . ($i + 1) . '</h5>';

              foreach ($rotulos as $n => $rotulo) {
                  $valor = $dados[$n] ?? '';
                  if ($rotulo === 'Preço' && $valor !== '') {
                      $valor = 'R$ ' . number_format((float)$valor, 2, ',', '.');
                  }
                  echo "<p class='mb-1'><strong>$rotulo:</strong> " . htmlspecialchars($valor) . "</p>";
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