<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reparticion extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Reparticion_model');
		$this->load->model('Empleado_model');
		$this->load->model('Ruta_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Reparticion_model->cuantos_registros();
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
		$reparticion=$this->Reparticion_model->mostrar_lista_paginada($iniciop,$paginacion);
		$empleado=$this->Empleado_model->mostrar_lista_sinruta();
		$ruta=$this->Ruta_model->mostrar_lista();
		$data['reparticion']=$reparticion;
		$data['empleado']=$empleado;
		$data['ruta']=$ruta;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/reparticion_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_empleado' => $this->input->post('empleado_n'),
								'id_ruta' => $this->input->post('ruta_n')
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_reparticion=$this->Reparticion_model->nuevo_ingreso($data);
		if($id_reparticion>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_reparticion,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_reparticion' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_reparticion,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Reparticion');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_reparticion=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'id_ruta' => $this->input->post('ruta_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Reparticion_model->actualizar($id_reparticion,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_reparticion,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_reparticion' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_reparticion,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Reparticion/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_reparticion=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_reparticion=$this->security->xss_clean($id_reparticion);
			$result=$this->Reparticion_model->borrar($id_reparticion);
			if($result){
				$tempdata =array(
										'numero' => $id_reparticion,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_reparticion' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_reparticion,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Reparticion/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$reparticion=$this->Reparticion_model->mostrar_lista();
		$data['reparticion']=$reparticion;
		$this->load->view('catalogos/excel/reparticion_tabla',$data);
	}
}
