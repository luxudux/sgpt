<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    //$this->load->model('Login_model');//cargamos el modelo
	}

	public function index()	{
		 //var_dump($_SESSION);
		// echo"oop";
		// echo $this->session->has_userdata('nombre_usr');
		$this->load->view('plantilla_head');
    $this->load->view('plantilla_body');
    $this->load->view('plantilla_foot');
	}


}
