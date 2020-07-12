<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cierre extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Cierre_model');
		$this->load->model('Sucursal_model');
		$this->load->model('Orden_model');
		$this->load->model('CierreVenta_model');
		$this->load->model('CierreReparticion_model');
		$this->load->model('CierreGasto_model');
		$this->load->model('CierreMerma_model');
		$this->load->model('CierreDevolucion_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Cierre_model->cuantos_registros();
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
		$cierre=$this->Cierre_model->mostrar_lista_paginada($iniciop,$paginacion);
		$sucursal=$this->Sucursal_model->mostrar_lista();
		$sincierre=$this->Orden_model->sincierre();
		$concierre=$this->Orden_model->concierre();

		$data['cierre']=$cierre;
		$data['sucursal']=$sucursal;
		$data['sincierre']=$sincierre;
		$data['concierre']=$concierre;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;

    $this->load->view('plantilla_head');
    $this->load->view('cierres/cierre_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{

		$data =array(
								'id_sucursal' => $this->input->post('sucursal_n'),
								'fecha_reg' => $this->input->post('fecha_reg_n'),
								'nota' => $this->input->post('nota_n'),
								'bloqueado' => $this->input->post('bloqueado_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_cierre=$this->Cierre_model->nuevo_ingreso($data);

		$data =array(
								'id_cierre' => $id_cierre,
							);
		$ids=$this->input->post('orden_n');
		$resultado=$this->Orden_model->actualizar_cierre($ids,$data);

		//if($id_cierre>1){
		if($resultado && $id_cierre>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_cierre,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierre' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierre,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Cierre');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_cierre=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
							'nota' => $this->input->post('nota_a'),
							'fecha_reg' => $this->input->post('fecha_reg_a'),
							'bloqueado' => $this->input->post('bloqueado_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Cierre_model->actualizar($id_cierre,$data);

		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_cierre,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierre' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierre,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Cierre/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_cierre=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_cierre=$this->security->xss_clean($id_cierre);
			$result=$this->Cierre_model->borrar($id_cierre);
			if($result){
				$tempdata =array(
										'numero' => $id_cierre,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_cierre' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_cierre,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Cierre/index/'.$pagina);

	}
	//Detalle de cierre
	public function excel($id_cierre){

		$cierre=$this->Cierre_model->mostrar_por_id($id_cierre);
		// $cierreVenta=$this->CierreVenta_model->mostrar_por_id_cierre($id_cierre);
		// $cierreReparticion=$this->CierreReparticion_model->mostrar_por_id_cierre($id_cierre);
		// $cierreGasto=$this->CierreGasto_model->mostrar_por_id_cierre($id_cierre);
		// $cierreMerma=$this->CierreMerma_model->mostrar_por_id_cierre($id_cierre);
		// $cierreDevolucion=$this->CierreDevolucion_model->mostrar_por_id_cierre($id_cierre);

		$data['cierre']=$cierre;
		// $data['cierreVenta']=$cierreVenta;
		// $data['cierreReparticion']=$cierreReparticion;
		// $data['cierreGasto']=$cierreGasto;
		// $data['cierreMerma']=$cierreMerma;
		// $data['cierreDevolucion']=$cierreDevolucion;

		$this->load->view('cierres/excel/cierre_detalle',$data);

	}
	//Lista a excel
	public function exportar(){
		$cierre=$this->Cierre_model->mostrar_lista();
		$data['cierre']=$cierre;
		$this->load->view('cierres/excel/cierre_tabla',$data);
	}
}
