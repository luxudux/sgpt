<?php
//configuracion de paginacion
$config['base_url'] = site_url('');
$config['total_rows'] = 0;//total de filas que regresa el resultado
$config['per_page'] = 8;//numero de reg. mostrados por pagina
//Etiqueta principal del menu
$config['full_tag_open'] ='<nav aria-label="..."><ul class="pagination">';
$config['full_tag_close'] = '</ul></nav>';
//Nombres
$config['first_link'] = 'Primero';
$config['last_link'] = 'Ultimo';
$config['prev_link'] = '&lt; Anterior';
$config['next_link'] = 'Siguiente &gt;';
//Liga del primero-- la etiqueta <a> es automatica
$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['first_tag_close'] = '</span></li>';
//$config['first_url'] = '';
//Liga de last -- la etiqueta <a> es automatica
$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['last_tag_close'] = '</span></li>';
//Liga de next-- la etiqueta <a> es automatica
$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['next_tag_close'] = '</span></li>';
//Liga de Previus-- la etiqueta <a> es automatica
$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['prev_tag_close'] = '</span></li>';
//numero seleccionado-- la etiqueta <a> es automatica
$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span>';
//Ligas numericas-- la etiqueta <a> es automatica
$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
$config['num_tag_close'] = '</span></li>';
//$config['display_pages'] = FALSE;
//$config['attributes']['rel'] = FALSE;
$config['page_query_string'] = FALSE;//TRUE PASA LA VARIABLE, FALSE PASA COMO URL INDEX/8
//$config['query_string_segment'] = 'per_page';//NOMBRE VARIABLE SI ES QUE EL ANTERIOR ES TRUE.
