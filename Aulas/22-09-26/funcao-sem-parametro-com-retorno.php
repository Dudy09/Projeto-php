<?php

//Função sem parâmetro e com retorno

function data()
{
    $dia = date("d");
    return $dia;
}

echo "Hoje é dia ".data();

?>