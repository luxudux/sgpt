<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SuministroSucursal extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('SuministroSucursal_model');
		$this->load->model('EntradaAlmacen_model');
		$this->load->model('Orden_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->SuministroSucursal_model->cuantos_registros();
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
		$suministroSucursal=$this->SuministroSucursal_model->mostrar_lista_paginada($iniciop,$paginacion);
		$entradaAlmacen=$this->EntradaAlmacen_model->mostrar_lista_stock();
		$orden=$this->Orden_model->mostrar_lista_sin_cierre();
		$data['suministroSucursal']=$suministroSucursal;
		$data['entradaAlmacen']=$entradaAlmacen;
		$data['orden']=$orden;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('traspasos/suministroSucursal_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_almacen_gral' => $this->input->post('materiaPrima_n'),
								'id_orden' => $this->input->post('orden_n'),
								'cantidad' => $this->input->post('cantidad_n'),

							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_suministroSucursal=$this->SuministroSucursal_model->nuevo_ingreso($data);
		if($id_suministroSucursal>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_suministroSucursal,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_suministroSucursal' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_suministroSucursal,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('SuministroSucursal');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_suministroSucursal=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								//'id_matprima' => $this->input->post('materiaPrima_a'),
								//'id' => $this->input->post('id_a'),
								'cantidad' => $this->input->post('cantidad_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->SuministroSucursal_model->actualizar($id_suministroSucursal,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_suministroSucursal,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_suministroSucursal' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_suministroSucursal,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('SuministroSucursal/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_suministroSucursal=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_suministroSucursal=$this->security->xss_clean($id_suministroSucursal);
			$result=$this->SuministroSucursal_model->borrar($id_suministroSucursal);
			if($result){
				$tempdata =array(
										'numero' => $id_suministroSucursal,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_suministroSucursal' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_suministroSucursal,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('SuministroSucursal/index/'.$pagina);

	}
	//Lista a excel
	public function exportar(){
		$suministroSucursal=$this->SuministroSucursal_model->mostrar_lista();
		$data['suministroSucursal']=$suministroSucursal;
		$this->load->view('traspasos/excel/suministroSucursal_tabla',$data);
	}
}
