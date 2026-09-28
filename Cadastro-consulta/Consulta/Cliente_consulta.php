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
  
    <?php
      $dir = "../Dados/cliente.txt";

      if (file_exists($dir)) {
          $conteudo = file_get_contents($dir);

          // Transforma a string de volta em um array usando o " - " como separador
          $dados = explode(" - ", $conteudo);

          echo "<h3>Dados do Cliente</h3>";
          echo "<p><strong>Nome:</strong> "        . htmlspecialchars($dados[0]  ?? '') . "</p>";
          echo "<p><strong>CPF:</strong> "         . htmlspecialchars($dados[1]  ?? '') . "</p>";
          echo "<p><strong>RG:</strong> "          . htmlspecialchars($dados[2]  ?? '') . "</p>";
          echo "<p><strong>Data Nasc.:</strong> "  . htmlspecialchars($dados[3]  ?? '') . "</p>";
          echo "<p><strong>CEP:</strong> "         . htmlspecialchars($dados[4]  ?? '') . "</p>";
          echo "<p><strong>Endereço:</strong> "    . htmlspecialchars($dados[5]  ?? '') . "</p>";
          echo "<p><strong>Número:</strong> "      . htmlspecialchars($dados[6]  ?? '') . "</p>";
          echo "<p><strong>Complem.:</strong> "    . htmlspecialchars($dados[7]  ?? '') . "</p>";
          echo "<p><strong>Bairro:</strong> "      . htmlspecialchars($dados[8]  ?? '') . "</p>";
          echo "<p><strong>Cidade:</strong> "      . htmlspecialchars($dados[9]  ?? '') . "</p>";
          echo "<p><strong>Estado:</strong> "      . htmlspecialchars($dados[10] ?? '') . "</p>";
          echo "<p><strong>Telefone:</strong> "    . htmlspecialchars($dados[11] ?? '') . "</p>";
          echo "<p><strong>E-mail:</strong> "      . htmlspecialchars($dados[12] ?? '') . "</p>";
      } else {
          echo '<p class="aviso">Arquivo não encontrado.</p>';
      }
    ?>
  </div>
</body>
</html>