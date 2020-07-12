<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sucursal extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Sucursal_model');//cargamos el modelo
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Sucursal_model->cuantos_registros();
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
		$sucursal=$this->Sucursal_model->mostrar_lista_paginada($iniciop,$paginacion);

		$data['sucursal']=$sucursal;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/sucursal_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
								'direccion' => $this->input->post('direccion_n'),
								'telefono' => $this->input->post('telefono_n'),

							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_sucursal=$this->Sucursal_model->nuevo_ingreso($data);
		if($id_sucursal>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_sucursal,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_sucursal' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_sucursal,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Sucursal');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_sucursal=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
								'direccion' => $this->input->post('direccion_a'),
								'telefono' => $this->input->post('telefono_a'),

							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Sucursal_model->actualizar($id_sucursal,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_sucursal,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_sucursal' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_sucursal,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Sucursal/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_sucursal=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_sucursal=$this->security->xss_clean($id_sucursal);
			$result=$this->Sucursal_model->borrar($id_sucursal);
			if($result){
				$tempdata =array(
										'numero' => $id_sucursal,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_sucursal' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_sucursal,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Sucursal/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$sucursal=$this->Sucursal_model->mostrar_lista();
		$data['sucursal']=$sucursal;
		$this->load->view('catalogos/excel/sucursal_tabla',$data);
	}
}
