<?php
// **CARGA DE JAVASCRIPT **

//DIRECCIÓN
function carga_dir_js($pagina){
  $pagina=trim($pagina);
  if(ENVIRONMENT=='production'){
    return base_url()."assets/js/".$pagina.".min.js";
  }else{
    return base_url()."assets/js/".$pagina.".js";
  }
}
//CODIGO DE CARGA DEL JS
function carga_script_js($pagina){
  $dir=carga_dir_js($pagina);
  return '<script src="'.$dir.'"></script>';
}

// **CARGA DE CSS **

//DIRECCIÓN
function carga_dir_css($pagina){
  if(ENVIRONMENT=='production'){
    return base_url()."assets/css/".$pagina.".min.css";
  }else{
    return base_url()."assets/css/".$pagina.".css";
  }
}
//CODIGO DE CARGA DEL JS
function carga_script_css($pagina){
  $dir=carga_dir_js($pagina);
  return '<script src="'.$dir.'"></script>';
}
?>
