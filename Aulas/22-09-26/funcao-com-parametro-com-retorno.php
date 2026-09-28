<?php

function hipotenusa($a,$c)
{
    $h = sqrt(pow($a,2) + pow($c,2));

    return $h;
}

echo "A hipotenusa com catetos 3 e 4 é: " .hipotenusa(3,4) ."<br>";

?>