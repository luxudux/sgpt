<?php


//DEBEN TENER EL MISMO TONO DE COLOR Y NUMERO DE COLORES
//5 TONOS DE COLORES PARA GRAFICAR 5 SUCURSALES
function arrayBackgroundColor(){
  return array( 'rgba(198, 0, 0, 0.5)',
                'rgba(41, 138, 8, 0.5)',
                'rgba(242, 142, 10, 0.5)',
                'rgba(23, 104, 221, 0.5)',
                'rgba(162, 12, 233, 0.5)',
                'rgba(16, 101, 34,0.5)',
                'rgba(228, 220, 10,0.5)',
                'rgba(5, 200, 242,0.5)',
                'rgba(255, 111, 111,0.5)',
                'rgba(105, 105, 105,0.5)',
                'rgba(254, 181, 255, 0.5)'
              );
}
function arrayBorderColor(){
  return array( 'rgb(198, 0, 0)',
                'rgb(41, 138, 8)',
                'rgb(242, 142, 10)',
                'rgb(23, 104, 221)',
                'rgb(162, 12, 233)',
                'rgb(16, 101, 34)',
                'rgb(228, 220, 10)',
                'rgb(5, 200, 242)',
                'rgb(255, 111, 111)',
                'rgb(105, 105, 105)',
                'rgb(254, 181, 255)',

              );
}
//RETORNA UN ARRAY DE NUMERO ALEATORIOS INDICANDO LA LONGITUD DEL ARRAY
function arrayRandomNumber($longitud){
  if($longitud>0){
      $minimo=0;
      $maximo=100;
      for($i=0; $i<$longitud; $i++){
        $array[$i]=$array[]=rand($minimo,$maximo);
      }
      return $array;
  }else{
      return $array[0]=0;
  }

}
?>
