<?php

//MENSAJE DE ACCIONES
function accionAER(){
  echo "Acciones <br> Act./Elim./Rep.";
}
function accionAE(){
  echo "Acciones <br> Act./Elim.";
}
//REPORTES DE EXCEL COLORES

//MONTOS
function tipFranjaAmarilla(){
  return 'FFFFC4';
}
//CANTIDADES
function tipFranjaVerde(){
  return 'A7DFA3';
}
//TOTALES
function tipFranjaAzul(){
  return 'A2D5EB';
}
//PARTE SUPERIOR TITULO
function tipFranjaGris(){
  return 'E2DDD7';
}

// TIPOGRAFÍA DE REPORTES DE EXCEL
//Titulos de las columnas
function tipTitulosColumnas(){
  $estilo=array(
         'name'=> 'Arial',
         'bold'=> true,
         'size'=> '10',
          );
  return $estilo;
}
function tipNegraTotales(){
  $estilo=array(
        'name'=> 'Tahoma',
        'size'=> '10',//numero de tamano de la letra
        'bold'=> true,
        );
  return $estilo;
}

?>
