<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consulta de Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    /* Reset básico: Garante que margens e tamanhos fiquem uniformes em qualquer navegador */
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f0e6d2; /* Cor de fundo num tom bege vintage */
      font-family: sans-serif;
    }

    .envelope-area {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      padding: 260px 20px 100px;
      min-height: 100vh;
    }

    /* Esconde o controle do checkbox sem desativar sua funcionalidade no HTML */
    #card-toggle {
      display: none;
    }

    /* Envoltório externo que funciona como o botão de clique (Label) */
    .envelope-wrapper {
      position: relative;
      cursor: pointer;
      display: block;
    }

    /* A base/corpo do envelope */
    .envelope {
      position: relative;
      width: 460px;
      height: 260px;
      background-color: #d9a05b;
      border-radius: 0 0 10px 10px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* Aba Superior do Envelope (Triângulo que abre para cima) */
    .envelope::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 0;
      height: 0;
      border-left: 230px solid transparent;
      border-right: 230px solid transparent;
      border-top: 150px solid #bc8342;
      transform-origin: top;
      transition: transform 0.4s ease-in-out 0.2s, z-index 0.2s;
      z-index: 3;
    }

    /* Dobras Laterais e Inferior (Efeito de bolso do envelope) */
    .pocket {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 0;
      border-left: 230px solid #ce934d;
      border-right: 230px solid #ce934d;
      border-bottom: 130px solid #b27b3b;
      border-radius: 0 0 10px 10px;
      z-index: 3;
    }

    /* O papel interno (A mensagem com os dados do cliente) */
    /* Fica invisível e "recolhido" enquanto o envelope está fechado */
    .letter {
      position: absolute;
      bottom: 10px;
      left: 15px;
      width: 430px;
      max-height: 320px;
      overflow-y: auto;
      background: #ffffff;
      border-radius: 6px;
      padding: 26px 30px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      transition: transform 0.5s ease-in-out, opacity 0.35s ease-in-out;
      transform-origin: bottom center;
      transform: translateY(0) scale(0.92);
      opacity: 0;
      pointer-events: none;
      z-index: 2;
      text-align: left;
    }

    /* Estilo discreto da barra de rolagem do papel */
    .letter::-webkit-scrollbar {
      width: 8px;
    }
    .letter::-webkit-scrollbar-track {
      background: transparent;
    }
    .letter::-webkit-scrollbar-thumb {
      background-color: #d9a05b;
      border-radius: 4px;
    }

    .letter h3 {
      font-size: 16px;
      color: #900C3F;
      border-bottom: 1px solid #eee;
      padding-bottom: 8px;
      margin-bottom: 12px;
      text-align: center;
    }

    .letter p {
      color: #333;
      font-size: 13px;
      line-height: 1.6;
      margin-bottom: 4px;
    }

    .letter p strong {
      color: #6b4a2b;
    }

    .letter .aviso {
      text-align: center;
      color: #a33;
      font-size: 13px;
    }

    /* O Selo de Cera vermelho com ícone */
    .wax-seal {
      position: absolute;
      top: 120px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 50px;
      background-color: #900C3F;
      border-radius: 50%;
      border: 3px solid #720931;
      box-shadow: 0 4px 6px rgba(0,0,0,0.3);
      display: flex;
      justify-content: center;
      align-items: center;
      color: #FFD700;
      font-weight: bold;
      font-size: 20px;
      z-index: 4;
      transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .dica-clique {
      text-align: center;
      margin-bottom: 16px;
      color: #7a5c33;
      font-size: 14px;
    }

    /* ======================================================
       ESTADOS DE ANIMAÇÃO AO CLICAR (SELETOR :checked)
       ====================================================== */

    /* 1. Animação do Selo: Fica transparente e diminui de tamanho */
    #card-toggle:checked + .envelope-wrapper .wax-seal {
      opacity: 0;
      transform: translateX(-50%) scale(0.5);
    }

    /* 2. Animação da Aba: Gira 180 graus no eixo X (abre para cima) */
    #card-toggle:checked + .envelope-wrapper .envelope::before {
      transform: rotateX(180deg);
      z-index: 1;
      transition: transform 0.4s ease-in-out, z-index 0.1s 0.2s;
    }

    /* 3. Animação do Papel: fica visível e sobe um pouco para fora do envelope */
    #card-toggle:checked + .envelope-wrapper .letter {
      transform: translateY(-30px) scale(1);
      opacity: 1;
      pointer-events: auto;
      z-index: 2;
      transition: transform 0.5s ease-in-out 0.3s, opacity 0.5s ease-in-out 0.3s;
    }
  </style>
</head>

<body>
  <h1 class="bg-primary text-white text-center py-3">Consulta de cliente</h1>

  <div class="envelope-area">
    <div>
      <p class="dica-clique">Clique no envelope para abrir a carta 💌</p>

      <!-- Checkbox oculto que controla o estado clicado/não clicado -->
      <input type="checkbox" id="card-toggle">

      <!-- O Label vincula o clique da área do envelope ao checkbox acima -->
      <label for="card-toggle" class="envelope-wrapper">
        <div class="envelope">
          <div class="letter">
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
          <div class="pocket"></div>
          <div class="wax-seal">★</div>
        </div>
      </label>
    </div>
  </div>
</body>
</html>