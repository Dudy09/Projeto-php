<?php
  session_start();
  include __DIR__ . '/funções.php';

  $erro = false;
  $erroFoto = null;
  $sucesso = false;
  $camposObrigatorios = ['nome', 'codigo', 'categoria', 'marca', 'fornecedor', 'preco', 'quantidade', 'peso', 'unidade', 'descricao'];
  $categorias = ['Alimentos', 'Bebidas', 'Limpeza', 'Higiene', 'Eletrônicos', 'Vestuário', 'Outros'];
  $unidades = ['Unidade', 'Kg', 'Litro', 'Caixa'];
  $caracteristicasValidas = ['Perecível', 'Frágil', 'Em promoção', 'Importado'];

  if (isset($_POST['limpar'])) {
    unset($_SESSION['produto_form']);
  } elseif (!empty($_POST)) {
    foreach ($camposObrigatorios as $campo) {
      if (!isset($_POST[$campo]) || !is_string($_POST[$campo]) || trim($_POST[$campo]) === '') {
        $erro = true;
        break;
      }
    }

    $caracteristicas = $_POST['caracteristicas'] ?? [];
    if (!is_array($caracteristicas) || array_diff($caracteristicas, $caracteristicasValidas)) {
      $erro = true;
      $caracteristicas = [];
    }

    if (!$erro) {
      if (!in_array($_POST['categoria'], $categorias, true) || !in_array($_POST['unidade'], $unidades, true)) {
        $erro = true;
      }

      foreach (['preco', 'quantidade', 'peso'] as $campo) {
        if (!is_numeric($_POST[$campo]) || $_POST[$campo] < 0) {
          $erro = true;
        }
      }
    }

    if (!$erro) {
      list($foto, $erroFoto) = enviarImagem('foto', __DIR__ . '/../Uploads/produtos/');
    }

    if ($erro || $erroFoto) {
      $_SESSION['produto_form'] = $_POST;
    } else {
      unset($_SESSION['produto_form']);
      $sucesso = true;

      $produto = array(
        'nome' => limparCampo($_POST['nome']),
        'codigo' => limparCampo($_POST['codigo']),
        'categoria' => limparCampo($_POST['categoria']),
        'marca' => limparCampo($_POST['marca']),
        'fornecedor' => limparCampo($_POST['fornecedor']),
        'preco' => limparCampo($_POST['preco']),
        'quantidade' => limparCampo($_POST['quantidade']),
        'peso' => limparCampo($_POST['peso']),
        'validade' => limparCampo($_POST['validade'] ?? ''),
        'unidade' => limparCampo($_POST['unidade']),
        'caracteristicas' => implode(' / ', $caracteristicas),
        'descricao' => limparCampo($_POST['descricao']),
        'foto' => $foto
      );

      $dir = "../Dados/produto.txt";

      file_put_contents($dir, implode(", ", $produto) . ";\n", FILE_APPEND | LOCK_EX);
    }
  }

  $dadosFormulario = $_SESSION['produto_form'] ?? [];
  if (!function_exists('esc')) {
    function esc($v) {
      return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }
  }
  $caracteristicasMarcadas = (isset($dadosFormulario['caracteristicas']) && is_array($dadosFormulario['caracteristicas'])) ? $dadosFormulario['caracteristicas'] : [];
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
          <form action="#" method="POST" class="needs-validation form-carta" enctype="multipart/form-data" novalidate>
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
                <select class="form-select" id="categoria" name="categoria" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($categorias as $cat): ?>
                    <option value="<?= esc($cat) ?>" <?= (($dadosFormulario['categoria'] ?? '') === $cat) ? 'selected' : '' ?>><?= esc($cat) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="campo">
                <label class="form-label">Marca: </label>
                <input class="form-control" type="text" id="marca" name="marca" value="<?= esc($dadosFormulario['marca'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Fornecedor: </label>
                <input class="form-control" type="text" id="fornecedor" name="fornecedor" value="<?= esc($dadosFormulario['fornecedor'] ?? '') ?>" required>
            </div>
            <div class="campo">
                <label class="form-label">Preço: </label>
                <input class="form-control" type="number" id="preco" name="preco" value="<?= esc($dadosFormulario['preco'] ?? '') ?>" step="0.01" min="0" required>
            </div>
            <div class="campo">
                <label class="form-label">Quantidade em Estoque: </label>
                <input class="form-control" type="number" id="quantidade" name="quantidade" value="<?= esc($dadosFormulario['quantidade'] ?? '') ?>" min="0" required>
            </div>
            <div class="campo">
                <label class="form-label">Peso (kg): </label>
                <input class="form-control" type="number" id="peso" name="peso" value="<?= esc($dadosFormulario['peso'] ?? '') ?>" step="0.001" min="0" required>
            </div>
            <div class="campo">
                <label class="form-label">Data de Validade: </label>
                <input class="form-control" type="date" id="validade" name="validade" value="<?= esc($dadosFormulario['validade'] ?? '') ?>">
            </div>
            <div class="campo">
                <label class="form-label d-block">Unidade de venda: </label>
                <div class="grupo-opcoes">
                    <?php foreach ($unidades as $i => $un): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="unidade" id="unidade<?= $i ?>" value="<?= esc($un) ?>" <?= (($dadosFormulario['unidade'] ?? '') === $un) ? 'checked' : '' ?> required>
                        <label class="form-check-label" for="unidade<?= $i ?>"><?= esc($un) ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="campo campo-2">
                <label class="form-label d-block">Características: </label>
                <div class="grupo-opcoes">
                    <?php foreach ($caracteristicasValidas as $i => $car): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" id="car<?= $i ?>" value="<?= esc($car) ?>" <?= in_array($car, $caracteristicasMarcadas, true) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="car<?= $i ?>"><?= esc($car) ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="campo campo-full">
                <label class="form-label">Descrição: </label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?= esc($dadosFormulario['descricao'] ?? '') ?></textarea>
            </div>
            <?php if ($erroFoto): ?>
            <div class="campo-full"><div class="alert alert-danger" role="alert"><?= esc($erroFoto) ?></div></div>
            <?php endif; ?>
            <div class="campo campo-2">
                <label class="form-label">Foto (JPG, PNG, GIF ou WEBP, até 2 MB): </label>
                <input class="form-control" type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/gif,image/webp" required>
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
      <div class="alert alert-danger" role="alert">Preencha todos os campos obrigatórios corretamente.</div>
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
    <script>
      const campoFoto = document.getElementById('foto');
      campoFoto.addEventListener('change', function () {
        const arq = this.files[0];
        if (arq && arq.size > 2 * 1024 * 1024) {
          alert('A imagem deve ter no máximo 2 MB.');
          this.value = '';
        }
      });
    </script>
</body>
</html>