<?php 
    function calcular_multiplos(int $n){ 
        return array_sum(
            array_filter((range(1,$n -1)), function($i){
                return($i % 3 == 0 || $i % 5 == 0);
            }));
    }



    function invertir_frase($frase){
        $palabras = explode(" ", $frase);

        foreach($palabras as $indice => $palabra){
            if(strlen($palabra) > 5){
            $palabras[$indice] = strrev($palabra);
            }
        }
        return implode(" ", $palabras);
    }

    echo (calcular_multiplos(10));
    echo "<br>";
    echo (invertir_frase("Bienvenido a Treda Solutions"));

?>