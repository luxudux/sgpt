<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Grupom extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Grupom_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Grupom_model->cuantos_registros();
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
		$grupom=$this->Grupom_model->mostrar_lista_paginada($iniciop,$paginacion);
		$data['grupom']=$grupom;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/grupom_lista',$data);
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
		$id_grupom=$this->Grupom_model->nuevo_ingreso($data);
		if($id_grupom>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_grupom,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_grupom' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_grupom,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Grupom');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_grupom=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Grupom_model->actualizar($id_grupom,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_grupom,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_grupom' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_grupom,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Grupom/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_grupom=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_grupom=$this->security->xss_clean($id_grupom);
			$result=$this->Grupom_model->borrar($id_grupom);
			if($result){
				$tempdata =array(
										'numero' => $id_grupom,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_grupom' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_grupom,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Grupom/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$grupom=$this->Grupom_model->mostrar_lista();
		$data['grupom']=$grupom;
		$this->load->view('catalogos/excel/grupom_tabla',$data);
	}
}
