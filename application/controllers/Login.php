<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Login_model');//cargamos el modelo
	}
	public function index()	{
    //Destruir session
    $this->session->sess_destroy();
    //Carga vistas
    $this->load->view('login/head');
		$this->load->view('login/body');
	}
	public function entrar(){
		$this->form_validation->set_error_delimiters('','');
      //Validar formulario
      if ($this->form_validation->run('valida_login') == FALSE){
				$this->load->view('login/head');
			 	$this->load->view('login/body');
      }else{
				//Si los datos son integros
         $data =array(
                     'email' => $this->input->post('email'),
										 //PASSWORD ENCRIPTADO
                     'password' => sha1($this->input->post('password')),
										 //'password' => $this->input->post('password'),
                   );
         //Se consulta al modelo
         $query=$this->Login_model->validar($data);
				 //echo $query;

         if($query===1){

            //Consultar los datos de usuario
            $usuario=$this->Login_model->datos($data);
            //creamos session
            $newdata = array(
              'id_usr'  => $usuario[0]->id,
              'nombre_usr'  => $usuario[0]->nombre,
              'email_usr' => $this->input->post('email'),
              'fecha_usr' => now(),
              'login_usr' => TRUE,
							'paginado' => 8 //paginado de las tablas
              );
            $this->session->set_userdata($newdata);
            redirect('Home');

         }else{
						redirect('Login');
         }
			 }
	}
	public function salir(){
    //Destruimos session
    $this->session->sess_destroy();
    redirect('Login');
	}
	public function olvidar(){
		echo"Controlador, Salir";
	}
  public function key(){
    $password="laoriginal";
    //$password="php123";
    echo sha1($password);
	}
}
