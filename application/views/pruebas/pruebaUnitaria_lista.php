<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo "<pre>";
//print_r($test_lista);
//print_r($nuevo_ingreso);
echo "</pre>";
?>
<table class="table table-hover ">
  <thead>
    <tr class="text-center table-secondary">
      <th>Nombre Prueba</th>
      <th>Dato Test</th>
      <th>Object</th>
      <th>String</th>
      <th>Bool</th>
      <th>True</th>
      <th>False</th>
      <th>Int</th>
      <th>Numeric</th>
      <th>Float</th>
      <th>Double</th>
      <th>Array</th>
      <th>Null</th>
      <th>Resource</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $contador=0;//Contador de fila
      for($i=0; $i<count($test_lista); $i++){
        if($contador==12 or $contador==0){$contador=0; echo"<tr class='text-center'>";}
        if(trim($test_lista[$i]['Resultado'])=='Correcto'){$txt_color='text-success font-weight-bold';}
        else{$txt_color='text-muted';}
        if($contador==0){
            echo"<td class='text-primary text-left'>".$test_lista[$i]['Nombre del test']."</td>
            <td class='text-primary'>".$test_lista[$i]['Tipo de datos del test']."</td>
            <td class='$txt_color'>".$test_lista[$i]['Resultado']."</td>";}
        else{echo"<td class='$txt_color'>".$test_lista[$i]['Resultado']."</td>";}
        $contador++;
        if($contador==12){ echo"</tr>";}//Cada 12 columnas crea una fila
      }?>

  </tbody>
</table>
