<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gasto extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Gasto_model');
		$this->load->model('Grupo_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		//$iniciop=$this->input->get('per_page', TRUE);
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Gasto_model->cuantos_registros();
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

		$gasto=$this->Gasto_model->mostrar_lista_paginada($iniciop,$paginacion);
		$grupo=$this->Grupo_model->mostrar_lista();
		$data['gasto']=$gasto;
		$data['grupo']=$grupo;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/gasto_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
								'id_grupo' => $this->input->post('grupo_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_gasto=$this->Gasto_model->nuevo_ingreso($data);
		if($id_gasto>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_gasto,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_gasto' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_gasto,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Gasto');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_gasto=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
								'id_grupo' => $this->input->post('grupo_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Gasto_model->actualizar($id_gasto,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_gasto,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_gasto' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_gasto,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Gasto/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_gasto=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_gasto=$this->security->xss_clean($id_gasto);
			$result=$this->Gasto_model->borrar($id_gasto);
			if($result){
				$tempdata =array(
										'numero' => $id_gasto,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_gasto' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_gasto,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Gasto/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$gasto=$this->Gasto_model->mostrar_lista();
		$data['gasto']=$gasto;
		$this->load->view('catalogos/excel/gasto_tabla',$data);
	}
}
