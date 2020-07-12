<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CostoSucursal extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('CostoSucursal_model');
		$this->load->model('Sucursal_model');
		$this->load->model('Producto_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->CostoSucursal_model->cuantos_registros();
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
		$costoSucursal=$this->CostoSucursal_model->mostrar_lista_paginada($iniciop,$paginacion);
		$sucursal=$this->Sucursal_model->mostrar_lista();
		$producto=$this->Producto_model->mostrar_lista();
		$data['costoSucursal']=$costoSucursal;
		$data['sucursal']=$sucursal;
		$data['producto']=$producto;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('inventarios/costoSucursal_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_sucursal' => $this->input->post('sucursal_n'),
								'id_producto' => $this->input->post('producto_n'),
								'monto' => $this->input->post('monto_n'),
								'fecha_reg' => $this->input->post('fecha_n'),
								'activo' => $this->input->post('activo_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_costoSucursal=$this->CostoSucursal_model->nuevo_ingreso($data);
		if($id_costoSucursal>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_costoSucursal,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_costoSucursal' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_costoSucursal,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CostoSucursal');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_costoSucursal=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'id_sucursal' => $this->input->post('sucursal_a'),
								'id_producto' => $this->input->post('producto_a'),
								'monto' => $this->input->post('monto_a'),
								'fecha_reg' => $this->input->post('fecha_a'),
								'activo' => $this->input->post('activo_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->CostoSucursal_model->actualizar($id_costoSucursal,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_costoSucursal,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_costoSucursal' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_costoSucursal,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CostoSucursal/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_costoSucursal=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_costoSucursal=$this->security->xss_clean($id_costoSucursal);
			$result=$this->CostoSucursal_model->borrar($id_costoSucursal);
			if($result){
				$tempdata =array(
										'numero' => $id_costoSucursal,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_costoSucursal' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_costoSucursal,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CostoSucursal/index/'.$pagina);

	}
	//Detalle de costos por sucursal
	public function excel($id_sucursal){
		$costoSucursal=$this->CostoSucursal_model->mostrar_por_id_sucursal($id_sucursal);
		$data['costoSucursal']=$costoSucursal;
		$this->load->view('inventarios/excel/costoSucursal_detalle',$data);

	}
	//Exportar Lista a excel
	public function exportar(){
		$costoSucursal=$this->CostoSucursal_model->mostrar_lista();
		$data['costoSucursal']=$costoSucursal;
		$this->load->view('inventarios/excel/costoSucursal_tabla',$data);
	}
}
