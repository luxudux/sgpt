<?php
//Reglas de validación
  $config = array(
    'valida_formulario' => array(
              array(
                      'field' => 'username',
                      'label' => 'Username',
                      'rules' => 'trim|required|min_length[5]|max_length[12]|alpha_numeric'
              ),
              array(
                      'field' => 'password',
                      'label' => 'Password',
                      'rules' => 'trim|required|min_length[8]',
                      'errors' => array(
                              'required' => 'Se requiere que pongas tu %s.',
                      ),
              ),
              array(
                      'field' => 'passconf',
                      'label' => 'Password Confirmation',
                      'rules' => 'trim|required|matches[password]'
              ),
              array(
                      'field' => 'email',
                      'label' => 'Email',
                      'rules' => 'required|valid_email'
              ),
              array(
                      'field' => 'nivel',
                      'label' => 'Nivel',
                      'rules' => 'required|is_natural_no_zero'
              ),
              array(
                      'field' => 'tipo',
                      'label' => 'Tipo',
                      'rules' => 'required'
              )
      ),
      'valida_login' => array(
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email'
                ),
                array(
                       'field' => 'password',
                       'label' => 'Password',
                       'rules' => 'trim|required|min_length[3]',
                       'errors' => array(
                               'required' => 'Se requiere que pongas tu %s.',
                       ),
               )
        )
  );
