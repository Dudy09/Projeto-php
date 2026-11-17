<?php
session_start();
date_default_timezone_set("America/Sao_Paulo");

function exibir()
{ 
	$modulo = "<p class='modulo'>LogiExpress - Módulo do Motorista</p>";

	return $modulo;
}

function nome_motorista($nome)
{
	if (is_string($nome))
	{
		$palavras = explode(" ", $nome);
		$qt_palavras = count($palavras);
		if ($qt_palavras > 3)
		{
			$nome = $palavras[0]." ". end($palavras);
		}
		return ucwords(strtolower($nome));
	}
	return $nome;
}

function mensagem_motivacional()
{
	$mensagens = 
	[
		"Acredite em você!",
		"Cada dia é uma nova oportunidade.",
		"Não desista dos seus objetivos.",
		"Pequenos passos também levam longe.",
		"Seu esforço de hoje constrói seu amanhã."
	];

	if(!isset($_SESSION['mensagem']) || time() - $_SESSION['horario'] >= 86400)
	{
		$_SESSION['mensagem'] = $mensagens[array_rand($mensagens)];
		$_SESSION['horario'] = time();
	}
	return $_SESSION['mensagem'];
}

function formatar_tempo($tempo_criacao)
{
	return date("d/m/Y - H:i:s", $tempo_criacao);
}

function notificacoes()
{
	if (!isset($_SESSION['notificacoes']))
	{
		$_SESSION['notificacoes'] = [
			[
				"mensagem" => "Data prevista para a entrega ENT-0042",
				"criacao" => time()
			],
			[
				"mensagem" => "A entrega ENT-0067 foi enviada",
				"criacao" => time() - 3600
			],
			[
				"mensagem" => "A entrega ENT-0682 foi concluída",
				"criacao" => time() - 86400
			]
		];
	}

	$html = "";

	foreach ($_SESSION['notificacoes'] as $notificacao)
	{
		$mensagem = htmlspecialchars($notificacao['mensagem']);
		$tempo = formatar_tempo($notificacao['criacao']);

		$html .= '
		<div class="cartao-entrega">
			<div class="cartao-entrega-texto">
				<h2 class="entrega-endereco">' . $mensagem . '</h2>
				<p class="entrega-data">' . $tempo . '</p>
			</div>
		</div>
		';
	}

	return $html;
}

function acoes($endereco, $horario)
{
	if (!isset($_SESSION['acoes']))
	{
		$_SESSION['acoes'] = [];
	}

	$_SESSION['acoes'][] = [
		"endereco" => $endereco,
		"horario" => $horario
	];
}

function exibir_acoes()
{
	if (!isset($_SESSION['acoes']))
	{
		return "";
	}

	$html = "";

	foreach ($_SESSION['acoes'] as $acao)
	{
		$endereco = htmlspecialchars($acao['endereco']);
		$horario = formatar_tempo($acao['horario']);

		$html .= '
		<div class="cartao-entrega">
			<div class="cartao-entrega-texto">
				<p class="entrega-endereco">Entrega realizada em ' . $endereco . '</p>
				<p class="entrega-data">' . $horario . '</p>
			</div>
			<div class="faixa-status faixa-entregue"></div>
		</div>
		';
	}

	return $html;
}

if (!isset($_SESSION['acoes']))
{
	acoes("Rua Campos Novos, 42 - Vila Lúcia, São Paulo - SP", time());
	acoes("Rua Poá, 59 - Vila Prudente, São Paulo - SP", time() - 3600);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LogiExpress</title>
	<link rel="icon" type="image/png" href="./caminho-da-sua-imagem.png">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<main class="fundo-principal Vh-1 Vw-1">

		<aside class="barra-lateral Vh-1 Vw15">
			<div class="Vh-2 Vw15">
				<div>
					<div class="logo-caixa">
						<span> <?php echo exibir()?></span>
					</div>
					<nav class="menu Vw15">
						<label class="ativo">Home</label>
						<label>Perfil</label>
						<label>Configurações</label>
						<label>Sair</label>
					</nav>
				</div>

				<div class="perfil-card">
					<div class="perfil-avatar">
						<span>MT</span>
					</div>
					<div class="perfil-info">
						<strong><?php echo nome_motorista("Marcelo da silva bastos"); ?></strong>
						<span>Motorista</span>
					</div>
					<a href="#" class="perfil-sair" aria-label="Sair">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
							<polyline points="16 17 21 12 16 7"/>
							<line x1="21" y1="12" x2="9" y2="12"/>
						</svg>
					</a>
				</div>
			</div>
		</aside>

		<section class="conteudo Vh-1">
			<div class="painel Vh-1 Sombra25">
				<header>
					<div class="cabecalho-linha">
						<div class="cabecalho-texto">
							<h1>Olá, <?php echo nome_motorista("Marcelo da Silva bastos"); ?></h1>
							<p><?php echo mensagem_motivacional();?></p>
						</div>
						<div class="cabecalho-acoes">
							<button class="botao-notificacoes Sombra5" id="openBtn">
								Notificações
							</button>

							<div id="modalOverlay" class="modal-overlay">
								<div class="modal-content">
									<span id="closeBtn" class="close-btn">&times;</span>
									<h2>Notificações recentes</h2>
									<div class="lista-entregas Vh-2">
										<div class="lista-entregas-interna">
											<?php echo notificacoes(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</header>
				<hr>
				<article class="lista-entregas Vh-2">
					<div class="lista-entregas-interna">
						<?php echo exibir_acoes(); ?>
					</div>
				</article>
			</div>
		</section>

	</main>
<!-- 
	Feito por:
		Arthur de Gois Carramão Almeida
		Mike Rezende
-->
	<script src="script.js"></script>

</body>
</html>