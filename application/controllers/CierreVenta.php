<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CierreVenta extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
    $this->load->model('CierreVenta_model');
		$this->load->model('Cierre_model');
		$this->load->model('CostoSucursal_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->CierreVenta_model->cuantos_registros();
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
		//Carga del modelo
		//Consulta a la base de datos
		$cierreVenta=$this->CierreVenta_model->mostrar_lista_paginada($iniciop,$paginacion);
		$cierre=$this->Cierre_model->mostrar_lista_no_bloqueada();
		$costoSucursal=$this->CostoSucursal_model->mostrar_lista_activa();
		$data['cierreVenta']=$cierreVenta;
		$data['cierre']=$cierre;
		$data['costoSucursal']=$costoSucursal;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('cierres/cierreVenta_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_cierre' => $this->input->post('cierre_n'),
								'id_cost_suc' => $this->input->post('costo_suc_n'),
								'cantidad' => $this->input->post('cantidad_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_cierreVenta=$this->CierreVenta_model->nuevo_ingreso($data);
		if($id_cierreVenta>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_cierreVenta,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierreVenta' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierreVenta,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreVenta');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_cierreVenta=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'cantidad' => $this->input->post('cantidad_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->CierreVenta_model->actualizar($id_cierreVenta,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_cierreVenta,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierreVenta' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierreVenta,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreVenta/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_cierreVenta=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_cierreVenta=$this->security->xss_clean($id_cierreVenta);
			$result=$this->CierreVenta_model->borrar($id_cierreVenta);
			if($result){
				$tempdata =array(
										'numero' => $id_cierreVenta,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_cierreVenta' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_cierreVenta,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreVenta/index/'.$pagina);

	}
	//Lista  a excel
	public function exportar(){
		$cierreVenta=$this->CierreVenta_model->mostrar_lista();
		$data['cierreVenta']=$cierreVenta;
		$this->load->view('cierres/excel/cierreVenta_tabla',$data);
	}
}
