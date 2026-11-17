<?php

$imagem = "";
$extensao = "";
$caminho = "";
$novoNome = "";
$erro = "";
$mensagem = "";
$upado = false;
$pasta = 'imagens/';

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK)
{

    date_default_timezone_set('America/Sao_Paulo');
    $temp_name = date('Y-m-d-H-i-s');

    // recupera o arquivo enviado
    $imagem = $_FILES['imagem'];
    $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

    if ($extensao != 'jpg' && $extensao != 'jpeg' && $extensao != 'png' && $extensao != 'gif' && $extensao != 'webp')
    {
        $erro = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
    }

    else
    {
        $tamanhoMaximo = 2 * 1024 * 1024; 

        if ($imagem['size'] > $tamanhoMaximo) {
            $erro = "A imagem é muito grande! O tamanho máximo permitido é de 2 MB.";
        }
        else
        {

            // pasta onde a imagem será salva
            // cria a pasta caso ela não exista
            if (!is_dir($pasta))
            {
                mkdir($pasta, 0755, true);
            }

            $novoNome = $temp_name . '.' . $extensao;

            // cria o caminho completo da imagem
            $caminho = $pasta . $novoNome;

            // move a imagem temporária para a pasta
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho))
            {
                $mensagem = "<p>Imagem salva em: " . $caminho . "</p>";
                $upado = true;
            }

            else {
                $erro = "Erro ao enviar imagem.";
                $upado = false;
            }
        }
    }
}

$imagensGaleria = is_dir($pasta) ? (glob($pasta . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE) ?: []) : [];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/png" href="./caminho-da-sua-imagem.png">
    <link rel="stylesheet" href="style.css">
</head>

<body class="corpo-pagina">
    <input type="radio" name="navegacao" id="tab-1" checked>
    <input type="radio" name="navegacao" id="tab-2">
    <input type="radio" name="navegacao" id="tab-3">

    <aside class="menu-lateral">
        <div class="organizacao-menu">
            <button onclick="window.history.back()" style="background: none; border: none; width: 80px; display: flex;"> 
                    <p style="font-size: 24px;"> ← </p>
            </button>
                <div class="logo">Seja bem vindo a sua galeria</div>
                <label for="tab-1" class="lbl-1">Upload de arquivos</label>
                <label for="tab-2" class="lbl-2">Galeria</label>
                <label for="tab-3" class="lbl-3">Como usar</label>
        </div>
    </aside>
    
    <main class="conteudo-principal">
        <section class="panel p-1">
            <div class="area-centralizada">
                <div class="painel-galeria">
                    <header class="cabecalho-galeria"><p>Enviar imagem</p></header>
                    <div class="colunas-galeria">
                        <div class="coluna-formulario">
                            <div class="fundo-formulario">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <label>Área de upload</label><br>
                                    <label id="drop-area" class="drop-area" for="fileInput">
                                        <p id="drop-text">Arraste e solte o arquivo aqui ou clique para selecionar</p>
                                        <input type="file" id="fileInput" name="imagem" accept="image/jpeg,image/png,image/gif" hidden>
                                    </label>
                                    <br>
                                    <input class="botao-cadastrar" type="submit" value="Cadastrar">
                                </form>
                            </div>
                        </div>
                        <div class="coluna-previa">
                            <div class="painel-previa">
                                <div class="quadro-imagem">
                                    <img id="imagem-previa" alt="Prévia da imagem selecionada" class="imagem-enviada">
                                </div>
                                <div class="quadro-informacoes">
                                    <p>Detalhes do upload:</p>
                                    <?php
                                        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK)
                                        {
                                            echo "Nome: " . htmlspecialchars($temp_name, ENT_QUOTES, 'UTF-8') . "<br>";
                                            echo "Extensão: " . htmlspecialchars($extensao, ENT_QUOTES, 'UTF-8') . "<br>";
                                            echo "Caminho: " . htmlspecialchars($caminho, ENT_QUOTES, 'UTF-8') . "<br>";
                                            echo "Erro: " . htmlspecialchars($erro ?: "Nenhum", ENT_QUOTES, 'UTF-8') . "<br>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="panel p-2">
            <div class="area-centralizada">
                <div class="painel-galeria">
                    <header class="cabecalho-galeria"><p>Imagens da galeria</p></header>
                    <div class="conteudo-galeria">
                        <?php if ($imagensGaleria): ?>
                            <div class="grade-imagens">
                                <?php foreach ($imagensGaleria as $imagemGaleria): ?>
                                    <article class="card-imagem">
                                        <img src="<?php echo htmlspecialchars($imagemGaleria, ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem da galeria">
                                        <p><?php echo htmlspecialchars(basename($imagemGaleria), ENT_QUOTES, 'UTF-8'); ?></p>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="galeria-vazia">Ainda não há imagens salvas na galeria.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="panel p-3">
            <div class="area-centralizada">
                <div class="painel-galeria">
                    <header class="cabecalho-galeria"><p>Como usar</p></header>
                    <div class="conteudo-galeria">
                        <p>Selecione a aba Upload de arquivos para escolher ou arrastar uma imagem. Depois, envie o arquivo para salvá-lo e veja as imagens enviadas na aba Galeria.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>

    </footer>
    <script src="script.js"> </script>
</body>
</html>