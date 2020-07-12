<?php
//CONVIERTE EL CONTENIDO DE LOS CAMPOS INDICADOS EN MAYUSCULAS
//RECIBE DOS PARAMETROS EL PRIMERO ES UN OBJETO Y EL SEGUNDO EL ARRAY DE CAMPOS A CONVERTIR
function array_capitalizar($data_array, $campos_capitalizar)
{
    $data_procesada = $data_array; //datos procesados
    for ($i = 0; $i < count($data_array); $i++) {
        foreach ($data_array[$i] as $nombre_campo[$i] => $valor_campo[$i]) {
            if (in_array($nombre_campo[$i], $campos_capitalizar)) {
                $data_procesada[$i]->{$nombre_campo[$i]} = strtoupper($valor_campo[$i]);
            }
        }
    }
    return $data_procesada;
}
//FORMATEA UN ARRAY PARA SU CORRECTA LECTURA
function array_legible($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
