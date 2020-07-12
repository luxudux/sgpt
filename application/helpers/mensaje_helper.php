<?php
//https://developers.google.com/webmaster-tools/search-console-api-original/v3/errors
//MENSAJE ERROR CUANDO NO ES NUMERICO
function mensaje_error_id_numeric($id){
  $mensaje=array(
    'error' => TRUE,//siempre en MAYUSCULAS
    'domain' =>$_SERVER['HTTP_HOST'],
    'port' => $_SERVER['SERVER_PORT'],
    'reason' => 'invalidParameter',
    'message' => 'Invalid numeric value:'.$id.'. Allowed values: [numeric]',
    'locationType'=> 'parameter');
  return $mensaje;
}
//MENSAJE DE ERROR CUANDO UNA CADENA SEA MAS LARGA DE LO PERMITIDO
function mensaje_error_long_string($string,$long){
  $mensaje=array(
    'error' => TRUE,//siempre en MAYUSCULAS
    'domain' =>$_SERVER['HTTP_HOST'],
    'port' => $_SERVER['SERVER_PORT'],
    'reason' => 'badContent',
    'message' => 'Invalid string value:'.$string.'. Allowed values ​​with max length: '.$long,
    'locationType'=> 'content');
  return $mensaje;
}
// MENSAJE ERROR CUANDO ESTA FUERA DEL RANGO DE REGISTROS
function mensaje_error_fueraderango($id){
  $mensaje=array(
    'error' => TRUE,//siempre en MAYUSCULAS
    'domain' =>$_SERVER['HTTP_HOST'],
    'port' => $_SERVER['SERVER_PORT'],
    'reason:' => 'requestedRangeNotSatisfiable',
    'message:' => 'The range:'.$id.'. cannot be satisfied.',
    'locationType:'=> 'requestedRange',);
  return $mensaje;
}

// MENSAJE DE ERROR CUANDO NO DEVUELVE RESULTADOS UNA CONSULTA POR ID
function mensaje_error_no_existe($id){
  $mensaje=array(
    'error' => TRUE,//siempre en MAYUSCULAS
    'domain' =>$_SERVER['HTTP_HOST'],
    'port' => $_SERVER['SERVER_PORT'],
    'quantity' => 0,//cantidad
    'records' => NULL, //registros
    'reason:' => 'notFound',
    'message:' => 'The resource: '.$id.' not be found.',
    'locationType:'=> 'resourceNotFound',);
  return $mensaje;
}




// MENSAJE CUANDO LA CONSULTA SEA LA CORRECTA
function mensaje_correcto_consulta($records){
  $mensaje=array(
    'error' => FALSE,//siempre en MAYUSCULAS
    'domain' =>$_SERVER['HTTP_HOST'],
    'port' => $_SERVER['SERVER_PORT'],
    'quantity' => count($records),//cantidad
    'records' => $records, //registros
    'reason:' => 'queryDatabaseOk',
    'message:' => 'The query is correct.',
    'locationType:'=> 'requestOk',);
  return $mensaje;
}

?>
