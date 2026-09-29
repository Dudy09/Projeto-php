<?php
// Array que Alimenta o Check
$idiomas =[
    "Inglês",
    "Espanhol",
    "Francês",
    "Alemão",
    "Italiano"
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
                foreach($idiomas as $idioma){
                    echo "<input type='checkbox' name='idioma[]' value='$idioma'>$idioma<br>";
                }
            ?>
        </fieldset><br>
        <input type="submit" value="Escolher">
    </form>

    <?php
        if($_SERVER['REQUEST_METHOD']==="POST"){

            $languages = $_POST["idioma"];
            echo "Idioma selecionado";

            echo "<ul>";
            foreach($languages as $l){
                echo "<li>" . $l . "</li>";
            }
        }
    ?>
</body>
</html>