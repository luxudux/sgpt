<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
//Tiene un [] porque va llamar mas de un hook de un tipo
$hook['post_controller_constructor'][] = array(
        'class'    => 'UsuarioNoAutenticado',
        'function' => 'checkAccess',//método
        'filename' => 'UsuarioNoAutenticado.php',
        'filepath' => 'hooks',
        'params'   => array('')
);

// $hook['post_controller_constructor'][] = array(
//         'class'    => 'UsuarioAutenticado',
//         'function' => 'checkAccess',//método
//         'filename' => 'UsuarioAutenticado.php',
//         'filepath' => 'hooks',
//         'params'   => array('')
// );
