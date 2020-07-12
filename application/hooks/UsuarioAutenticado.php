<?php
/**
 *
 * Clase UsuarioAutenticado
 *
 * Hook para verificar el acceso a los controladores
 *
 * @package application\hooks
 * @author Luis Aguilar
 */
class UsuarioAutenticado
{
  /**
  * CI instancia de super objeto de codeigniter
  * @var object
  */
  private $ci;

  /**
  * Controladores que no podrá acceder
  * cuando el usuario esté autenticado
  * @var array
  */
  private $disallowed_controllers;

  /**
  * Metodos que podrá acceder
  * cuando el usuario esté autenticado
  * @var array
  */
  private $allowed_methods;

  /**
  * Metodos que podrá acceder
  * cuando el usuario esté autenticado
  * @var array
  */
  private $disallowed_methods;

  public function __construct(){
    //crear una instancia del super objeto
    $this->ci =& get_instance();
    //array de todos los controladores que no
    //puede acceder si está logeado
    //No importa que esté en minusculas
    $this->disallowed_controllers = ['login','Login'];
    //array de todos los metodos que
    //puede acceder si está logeado
    $this->allowed_methods= ['salir'];
    //array de metodos no permitidos
    //aunque esten dentro del controlador permitido
    $this->disallowed_methods=['entrar','index'];
    //Cargamos el helper url
    $this->ci->load->helper('url');
  }
  /**
  * Determina si el usuario tiene permiso de acceso
  * para la petición del controlador y metodo
  * @return redirect  Redirecciona al usuario a login
  */
  public function checkAccess(){
    //Obtenemos la Clase
    $class=$this->ci->router->class;
    //Obtenemos el metodos
    $method=$this->ci->router->method;
    //Obtener datos de session
    $session=$this->ci->session->userdata('nombre_usr');

    //SI HAY SESSION Y ESTAS EN UN CONTROLLADOR NO PERMITIDO
    if($session && in_array($class, $this->disallowed_controllers)){
      // echo "si hay session $class";
      // echo "$method";
      //SI NO ESTAS EN UN METODO EN LA LISTA DE PERMITIDOS
      if(!in_array($method, $this->allowed_methods)){
        redirect('Home');//REDIRECCIONA
      }
    }

    //SI HAY SESSION Y SI A CONTROLADOR NO PERMITIDO
    if($session && !in_array($class, $this->disallowed_controllers)){
      //SI ESTAS EN UN METODO EN LA LISTA DE NO PERMITIDOS
      // echo "$class <br>";
      // echo "$method";
      if(in_array($method, $this->disallowed_methods)){
        redirect('Home');//REDIRECCIONA
      }
    }


  }



}
