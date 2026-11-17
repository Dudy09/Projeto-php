<?php

    function exibirBannerTopo() {
    echo "<div class='banner-topo'>";
    echo "    <h1>LOGIEXPRESS - MÓDULO DO MOTORISTA</h1>";
    echo "</div>";
    }

    function exibirAlerta($mensagem) {
    echo "<div class='alerta-sistema'>";
    echo "    <strong>Aviso:</strong> " . htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8');
    echo "</div>";
    }

    exibirAlerta("Rota alterada devido a condições de tráfego.");

    function obterMensagemDoDia() {
    $mensagemRH = "Dirija com segurança e mantenha os prazos sob controle!";
    return $mensagemRH;
    }

    // Exemplo de uso:
    $msgDoDia = obterMensagemDoDia();
    echo "<div class='card-rh'><p>{$msgDoDia}</p></div>";

    function formatarNomeMotorista($nomeBruto) {
    $nomeLimpo = strtolower(trim($nomeBruto));
    $nomePadronizado = ucwords($nomeLimpo);
    return htmlspecialchars($nomePadronizado, ENT_QUOTES, 'UTF-8');
    }

    $nomeExibicao = formatarNomeMotorista("arthur almeida");
    echo "<h2>Bem-vindo de volta, {$nomeExibicao}!</h2>";

    function registrarMomentoAcao() {
    date_default_timezone_set('America/Sao_Paulo');
    return date('d/m/Y H:i:s');
    }

    $timestampAuditoria = registrarMomentoAcao();
    echo "<small>Ação registrada em: {$timestampAuditoria}</small>";

?>