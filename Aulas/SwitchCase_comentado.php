Bloco 1: Comparação Numérica (Inteiro)
<?php // Início do script PHP

$valor = 1; // Declara a variável $valor e atribui o número inteiro 1
switch($valor) // Inicia a estrutura de decisão comparando o conteúdo de $valor
{
    case 1: // Se o valor for igual a 1...
        echo "Opção 1"; // Exibe o texto "Opção 1" na tela
    break; // Interrompe a execução do switch para não executar os próximos casos

    case 2: // Se o valor for igual a 2...
        echo "Opção 2"; // Exibe "Opção 2"
    break; // Sai do switch

    case 3: // Se o valor for igual a 3...
        echo "Opção 3"; // Exibe "Opção 3"
    break; // Sai do switch

    default: // Caso o valor não seja nenhum dos anteriores (1, 2 ou 3)
        echo "Opção inválida"; // Exibe a mensagem de erro
    break; // Finaliza o bloco default
}
//fim do script php
?>

Bloco 2: Comparação de Caractere (Char)
<?php

$valor = 'B'; // Atribui o caractere único 'B' à variável $valor
switch($valor) // Avalia a variável $valor
{
    case 'A': // Caso o caractere seja 'A'...
        echo "Opção A"; // Exibe "Opção A"
    break; // Sai do switch

    case 'B': // Caso o caractere seja 'B' (este será o executado)
        echo "Opção B"; // Exibe "Opção B"
    break; // Sai do switch

    case 'C': // Caso o caractere seja 'C'...
        echo "Opção C"; // Exibe "Opção C"
    break; // Sai do switch

    default: // Caso não seja A, B ou C
        echo "Opção inválida";
    break;
}
?>


Bloco 3: Comparação de Texto (String)
<?php

$valor = "INFORMÁTICA"; // Atribui uma string (texto) à variável $valor
switch($valor) // Avalia o texto contido na variável
{
    case "ADMINISTRAÇÃO": // Se o texto for exatamente "ADMINISTRAÇÃO"...
        echo "CURSO 1"; // Exibe "CURSO 1"
    break;

    case "CONTABILIDADE": // Se o texto for "CONTABILIDADE"...
        echo "CURSO 2"; // Exibe "CURSO 2"
    break;

    case "INFORMÁTICA": // Se o texto for "INFORMÁTICA" (este será o executado)
        echo "CURSO 3"; // Exibe "CURSO 3"
    break;

    default: // Se não houver correspondência exata
        echo "Opção inválida";
    break;
}
?>