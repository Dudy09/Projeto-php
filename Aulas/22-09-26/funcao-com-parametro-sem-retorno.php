<?php

//Função com parâmetro e sem retorno
function login($user, $nome) //$user -> variável local
{
    echo "Você logou como ".$user;
    echo "<br>Login: ".$nome;
}

$nome = "Aluno"; //Variável global

login("Administrador", $nome); //Chamando a função e passando os parâmetros

?>