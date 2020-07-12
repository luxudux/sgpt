<?php
//DEVUELVE UN ICONO SEGUN EL ESTADO
function icono_activo($estado){
  if($estado==0){ return '<i class="fas fa-toggle-off text-danger" title="Inactivo"></i>'; }
  else{return '<i class="fas fa-toggle-on text-info" title="Activo"></i>';}
}
//BOTONES DE LISTA
function icono_nuevo(){
  return '<i class="fa fa-plus-circle" aria-hidden="true"  title="Crear un nuevo registro"></i> Nuevo';
}
function icono_actualizar(){
  return '<i class="fa fa-edit" aria-hidden="true" title="Actualizar registro"></i>';
}
function icono_borrar(){
  return '<i class="fa fa-trash-alt" aria-hidden="true" title="Borrar registro"></i>';
}
function icono_excel(){
  return '<i class="fa fa-download" aria-hidden="true" title="Exportar lista a Excel"></i>';
}
function icono_excel_reg(){
  return '<i class="fa fa-file-excel" aria-hidden="true" title="Exportar registro a Excel"></i>';
}
function icono_pdf(){
  return 0;
}
//BOTONES DEL FORMULARIO
function icono_guardar(){
  return '<i class="fa fa-save" aria-hidden="true"></i>';
}
//TITULOS DE FORMULARIO
function icono_titulo_nuevo(){
  return '<i class="fa fa-plus" aria-hidden="true"></i>';
}
function icono_titulo_actualizar(){
  return '<i class="fa fa-pencil-alt" aria-hidden="true"></i>';
}
function icono_titulo_borrar(){
  return '<i class="fa fa-eraser" aria-hidden="true"></i>';
}

//ICONO DE MODULOS
function icono_mod_catalogos(){
  return '<i class="fa fa-list-ul" aria-hidden="true"></i> Lista de ';
}
function icono_mod_inventarios(){
  return '<i class="fa fa-archive" aria-hidden="true"></i> Lista de ';
}
function icono_mod_ordenes(){
  return '<i class="fa fa-clipboard" aria-hidden="true"></i> Lista de ';
}
function icono_mod_cierres(){
  return '<i class="fa fa-moon" aria-hidden="true"></i> Lista de ';
}


//ICONO MENU
function icono_menu_catalogos(){
  return '<i class="fa fa-list-ul" aria-hidden="true"></i>';
}
function icono_menu_inventarios(){
  return '<i class="fa fa-archive" aria-hidden="true"></i>';
}
function icono_menu_ordenes(){
  return '<i class="fa fa-clipboard" aria-hidden="true"></i>';
}
function icono_menu_cierres(){
  return '<i class="fa fa-moon" aria-hidden="true"></i>';
}
function icono_menu_reportes(){
  return '<i class="fa fa-chart-line" aria-hidden="true"></i>';
}

//ICONO DE CIERRE
function icono_tiene_cierre($cierre){
  if($cierre>0){
    return '<i class="fa fa-check-circle text-info" aria-hidden="true" title="'.$cierre.'"></i>';
  }else{
    return '<i class="fa fa-ban text-danger" aria-hidden="true"></i>';
  }
}
//ICONO CANTIDAD DE MATERIA PRIMA
function icono_tiene_matprima($cantidad){
  $cantidad=trim($cantidad);
  if($cantidad==0){
    return '<i class="fa fa-dolly text-danger" aria-hidden="true" title="Materia prima sin Stock ('.$cantidad.')"></i>';
  }elseif ($cantidad>0 && $cantidad<=50) {
    return '<i class="fa fa-dolly text-warning" aria-hidden="true" title="Materia prima con Muy Bajo Stock ('.$cantidad.')"></i>';
  }elseif ($cantidad>50 && $cantidad<=150) {
    return '<i class="fa fa-dolly text-success" aria-hidden="true" title="Materia prima con Bajo Stock ('.$cantidad.')"></i>';
  }else{
    return '<i class="fa fa-dolly text-info" aria-hidden="true" title="Materia prima con Alto Stock ('.$cantidad.')"></i>';
  }
}
//ICONO CANTIDAD DE REGISTROS EN USO ORDENES, CIERRE, INVENTARIOS
function icono_reg_uso($cantidad){
  $cantidad=trim($cantidad);
  if($cantidad==0){
    return '<i class="fa fa-lock-open text-success" aria-hidden="true" title="Registro sin uso ('.$cantidad.') "></i>';
  }else{
    return '<i class="fa fa-lock text-secondary" aria-hidden="true" title="Registro en uso ('.$cantidad.')"></i>';
  }
}
//ICONO REGISTROS BLOQUEADOS
function icono_reg_bloqueado($estado){
  $estado=trim($estado);
  if($estado==0){
    return '<i class="fa fa-lock-open text-warning" aria-hidden="true" title="Desbloqueado"></i>';
  }else{
    return '<i class="fa fa-lock text-danger" aria-hidden="true" title="Bloqueado"></i>';
  }
}

//ICONO DE UTILIDAD EN CIERRE GENERAL
function icono_tiene_utilidadCierre($cantidad){
  if($cantidad<=0){
    return '<i class="fa fa-dollar-sign text-danger" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }elseif($cantidad>0 && $cantidad<=500){
    return '<i class="fa fa-dollar-sign text-warning" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }elseif($cantidad>500 && $cantidad<=1500){
    return '<i class="fa fa-dollar-sign text-success" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }else{
    return '<i class="fa fa-dollar-sign text-info" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }
}
//ICONO DE VENTAS EN CIERRE GENERAL
function icono_tiene_ventaCierre($cantidad){
  if($cantidad==0){
    return '<i class="fa fa-dollar-sign text-danger" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }elseif($cantidad>0 && $cantidad<=3000){
    return '<i class="fa fa-dollar-sign text-warning" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }elseif($cantidad>500 && $cantidad<=6000){
    return '<i class="fa fa-dollar-sign text-success" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }else{
    return '<i class="fa fa-dollar-sign text-info" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }
}
//ICONO DE GASTOS EN CIERRE GENERAL
function icono_tiene_gastoCierre($cantidad){
  if($cantidad==0){
    return '<i class="fa fa-dollar-sign text-info" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }elseif($cantidad>0 && $cantidad<=500){
    return '<i class="fa fa-dollar-sign text-success" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }elseif($cantidad>500 && $cantidad<=1500){
    return '<i class="fa fa-dollar-sign text-warning" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }else{
    return '<i class="fa fa-dollar-sign text-danger" aria-hidden="true" title="$ '.number_format($cantidad,2).'"></i>';
  }
}


?>
