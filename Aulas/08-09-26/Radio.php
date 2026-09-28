<?php
// Array que Alimenta o Radio
$cursos =[
    "Informática para Internet",
    "Informática Suporte",
    "Desenvolvimento de Sistemas",
    "Redes de Computadores",
    "Administração",
    "Contabilidade"
]
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="#" method="post">
        <fieldset>
            <legeng>Cursos</legend>
            <br>
            <?php
                foreach($cursos as $c){
                    echo "<input type='radio' name='curso' value='$c'>$c<br>";
                }
            ?>
        </fieldset><br>
        <input type="submit" value="Escolher">
    </form>

    <?php
        if($_SERVER['REQUEST_METHOD']==="POST"){
            echo "Curso selecioando: <b>". $_POST["curso"]."</b>";
        }
    ?>
</body>
</html>