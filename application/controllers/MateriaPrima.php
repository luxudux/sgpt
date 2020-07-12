<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MateriaPrima extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('MateriaPrima_model');
		$this->load->model('Grupom_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->MateriaPrima_model->cuantos_registros();
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
		$materiaPrima=$this->MateriaPrima_model->mostrar_lista_paginada($iniciop,$paginacion);
		$grupom=$this->Grupom_model->mostrar_lista();
		$data['materiaPrima']=$materiaPrima;
		$data['grupom']=$grupom;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/materiaprima_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
								'id_grupom' => $this->input->post('grupom_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_materiaPrima=$this->MateriaPrima_model->nuevo_ingreso($data);
		if($id_materiaPrima>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_materiaPrima,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_materiaPrima' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_materiaPrima,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('MateriaPrima');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_materiaPrima=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
								'id_grupom' => $this->input->post('grupom_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->MateriaPrima_model->actualizar($id_materiaPrima,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_materiaPrima,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_materiaPrima' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_materiaPrima,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('MateriaPrima/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_materiaPrima=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_materiaPrima=$this->security->xss_clean($id_materiaPrima);
			$result=$this->MateriaPrima_model->borrar($id_materiaPrima);
			if($result){
				$tempdata =array(
										'numero' => $id_materiaPrima,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_materiaPrima' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_materiaPrima,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('MateriaPrima/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$materiaPrima=$this->MateriaPrima_model->mostrar_lista();
		$data['materiaPrima']=$materiaPrima;
		$this->load->view('catalogos/excel/materiaPrima_tabla',$data);
	}
}
