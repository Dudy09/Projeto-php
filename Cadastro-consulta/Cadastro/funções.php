<?php

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    $tamanho = strlen($cpf);
    
    if($tamanho != 11 || preg_match('/^(\d)\1{10}$/', $cpf))
    {
        $valor = true;
        return $valor;
    }
    else
    {
        $n[1] = substr($cpf, 0, 1);
        $n[2] = substr($cpf, 1, 1);
        $n[3] = substr($cpf, 2, 1);
        $n[4] = substr($cpf, 3, 1);
        $n[5] = substr($cpf, 4, 1);
        $n[6] = substr($cpf, 5, 1);
        $n[7] = substr($cpf, 6, 1);
        $n[8] = substr($cpf, 7, 1);
        $n[9] = substr($cpf, 8, 1);
        $n[10] = substr($cpf, 9, 1);
        $n[11] = substr($cpf, 10, 1);

        $soma1=($n[1]*10)+($n[2]*9)+($n[3]*8)+($n[4]*7)+($n[5]*6)+($n[6]*5)+($n[7]*4)+($n[8]*3)+($n[9]*2);
        $dgt1 = 11 - ($soma1 % 11);
        
        if($dgt1 == 10 || $dgt1 == 11)
        {
            $dgt1 = 0;
        }

        $soma2=($n[1]*11)+($n[2]*10)+($n[3]*9)+($n[4]*8)+($n[5]*7)+($n[6]*6)+($n[7]*5)+($n[8]*4)+($n[9]*3)+($dgt1*2);
        $dgt2 = 11 - ($soma2 % 11);

        if($dgt2 == 10 || $dgt2 == 11)
        {
            $dgt2 = 0;
        }

        if($dgt1 != $n[10] || $dgt2 != $n[11])
        {
            $valor = true;
        }
        
        else
        {
            $valor = false;
        }

        return $valor;
    }
}

function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    if (strlen($cnpj) !== 14 || preg_match('/^(\d)\1+$/', $cnpj)) return false;

    $tamanho = strlen($cnpj) - 2;
    $numeros = substr($cnpj, 0, $tamanho);
    $digitos = substr($cnpj, $tamanho);
    $soma = 0;
    $pos = $tamanho - 7;

    for ($i = $tamanho; $i >= 1; $i--) {
        $soma += substr($numeros, $tamanho - $i, 1) * $pos--;
        if ($pos < 2) $pos = 9;
    }

    $resultado = $soma % 11 < 2 ? 0 : 11 - ($soma % 11);
    if ($resultado != substr($digitos, 0, 1)) return false;

    $tamanho = $tamanho + 1;
    $numeros = substr($cnpj, 0, $tamanho);
    $soma = 0;
    $pos = $tamanho - 7;

    for ($i = $tamanho; $i >= 1; $i--) {
        $soma += substr($numeros, $tamanho - $i, 1) * $pos--;
        if ($pos < 2) $pos = 9;
    }

    $resultado = $soma % 11 < 2 ? 0 : 11 - ($soma % 11);
    if ($resultado != substr($digitos, 1, 1)) return false;

    return true;
}

function limparCampo($valor) {
    // Tira quebras de linha e vírgula+espaço, que são usados como separador no .txt
    $valor = trim((string)$valor);
    $valor = preg_replace('/\s+/', ' ', $valor);
    return str_replace(', ', ',', $valor);
}

function enviarImagem($campo, $pasta) {
    // Retorna array: [nome do arquivo salvo, mensagem de erro]
    $tamanhoMaximo = 2 * 1024 * 1024; // 2 MB
    $tiposPermitidos = array(
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/webp' => 'webp'
    );

    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] === UPLOAD_ERR_NO_FILE) {
        return array(null, 'Selecione uma imagem.');
    }

    $arquivo = $_FILES[$campo];

    if ($arquivo['error'] === UPLOAD_ERR_INI_SIZE || $arquivo['error'] === UPLOAD_ERR_FORM_SIZE) {
        return array(null, 'A imagem é muito grande! O tamanho máximo permitido é de 2 MB.');
    }

    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        return array(null, 'Erro ao enviar a imagem.');
    }

    if ($arquivo['size'] > $tamanhoMaximo) {
        return array(null, 'A imagem é muito grande! O tamanho máximo permitido é de 2 MB.');
    }

    if (!is_uploaded_file($arquivo['tmp_name'])) {
        return array(null, 'Erro ao enviar a imagem.');
    }

    // getimagesize só retorna dados se o conteúdo for realmente uma imagem
    $info = @getimagesize($arquivo['tmp_name']);
    if ($info === false) {
        return array(null, 'O arquivo enviado não é uma imagem válida.');
    }

    if (!isset($tiposPermitidos[$info['mime']])) {
        return array(null, 'Apenas imagens JPG, PNG, GIF ou WEBP são permitidas.');
    }

    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    // Nome novo (data + código aleatório) para nunca sobrescrever outro arquivo
    // A extensão vem do tipo real da imagem, não do nome enviado pelo usuário
    $novoNome = date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $tiposPermitidos[$info['mime']];

    if (!move_uploaded_file($arquivo['tmp_name'], rtrim($pasta, '/\\') . '/' . $novoNome)) {
        return array(null, 'Erro ao salvar a imagem.');
    }

    return array($novoNome, null);
}

?>