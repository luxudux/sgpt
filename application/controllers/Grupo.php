<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Grupo extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Grupo_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Grupo_model->cuantos_registros();
		//Carga configuracion del paginado
		$this->config->load('pagination', TRUE);
		$config = $this->config->item('pagination');
		//Reescribimos configuracion del paginado
		$config['base_url'] = site_url($this->router->fetch_class().'/'.$this->router->fetch_method());
		$config['total_rows'] = $cuantos;
		$config['per_page'] = $paginacion;
		//inicializar paginacion
		$this->pagination->initialize($config);
		// --End pagination

		//Consulta a la base de datos
		$grupo=$this->Grupo_model->mostrar_lista_paginada($iniciop,$paginacion);
		$data['grupo']=$grupo;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/grupo_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_grupo=$this->Grupo_model->nuevo_ingreso($data);
		if($id_grupo>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_grupo,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_grupo' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_grupo,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Grupo');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_grupo=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Grupo_model->actualizar($id_grupo,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_grupo,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_grupo' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_grupo,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Grupo/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_grupo=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_grupo=$this->security->xss_clean($id_grupo);
			$result=$this->Grupo_model->borrar($id_grupo);
			if($result){
				$tempdata =array(
										'numero' => $id_grupo,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_grupo' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_grupo,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Grupo/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$grupo=$this->Grupo_model->mostrar_lista();
		$data['grupo']=$grupo;
		$this->load->view('catalogos/excel/grupo_tabla',$data);
	}
}
