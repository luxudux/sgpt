<?php
/**
 *
 * Clase UsuarioNoAutenticado
 *
 * Hook para verificar el acceso a los controladores
 *
 * @package application\hooks
 * @author Luis Aguilar
 */
class UsuarioNoAutenticado
{
  /**
  * CI instancia de super objeto de codeigniter
  * @var object
  */
  private $ci;

  /**
  * Controladores que podrá acceder
  * cuando el usuario no esté autenticado
  * @var array
  */
  private $allowed_controllers;

  /**
  * Metodos que podrá acceder
  * cuando el usuario no esté autenticado
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
    //array de todos los controladores que
    //puede acceder si no está logeado
    //No importa que esté en minusculas
    $this->allowed_controllers = ['Login','Api','ApiGrafico'];
    //array de todos los metodos que
    //puede acceder si no está logeado
    $this->allowed_methods= ['entrar'];
    //array de metodos no permitidos
    //aunque esten dentro del controlador permitido
    $this->disallowed_methods=['salir'];
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




    //SI NO HAY SESSION Y NO ESTAS A CONTROLADOR PERMITIDO
    if(empty($session) && !in_array($class, $this->allowed_controllers)){
      echo"no hay session y no esta permitido el controlador $class";
      //SI NO ESTAS EN UN METODO EN LA LISTA DE PERMITIDOS
      if(!in_array($method, $this->allowed_methods)){
        redirect('Login');//REDIRECCIONA
      }
    }

    //SI NO HAY SESSION Y SI A CONTROLADOR PERMITIDO
    if(empty($session) && in_array($class, $this->allowed_controllers)){
      //echo"no hay session y si esta permitido el controlador $class";
      //SI ESTAS EN UN METODO EN LA LISTA DE NO PERMITIDOS
      if(in_array($method, $this->disallowed_methods)){
        redirect('Login');//REDIRECCIONA
      }
    }



  }



}
