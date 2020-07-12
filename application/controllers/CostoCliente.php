<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CostoCliente extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('CostoCliente_model');
		$this->load->model('Cliente_model');
		$this->load->model('Producto_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->CostoCliente_model->cuantos_registros();
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
		$costoCliente=$this->CostoCliente_model->mostrar_lista_paginada($iniciop,$paginacion);
		$cliente=$this->Cliente_model->mostrar_lista_activa();
		$producto=$this->Producto_model->mostrar_lista();
		$data['costoCliente']=$costoCliente;
		$data['cliente']=$cliente;
		$data['producto']=$producto;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('inventarios/costoCliente_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_cliente' => $this->input->post('cliente_n'),
								'id_producto' => $this->input->post('producto_n'),
								'monto' => $this->input->post('monto_n'),
								'fecha_reg' => $this->input->post('fecha_n'),
								'activo' => $this->input->post('activo_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_costoCliente=$this->CostoCliente_model->nuevo_ingreso($data);
		if($id_costoCliente>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_costoCliente,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_costoCliente' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_costoCliente,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CostoCliente');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_costoCliente=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'id_cliente' => $this->input->post('cliente_a'),
								'id_producto' => $this->input->post('producto_a'),
								'monto' => $this->input->post('monto_a'),
								'fecha_reg' => $this->input->post('fecha_a'),
								'activo' => $this->input->post('activo_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->CostoCliente_model->actualizar($id_costoCliente,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_costoCliente,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_costoCliente' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_costoCliente,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CostoCliente/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_costoCliente=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_costoCliente=$this->security->xss_clean($id_costoCliente);
			$result=$this->CostoCliente_model->borrar($id_costoCliente);
			if($result){
				$tempdata =array(
										'numero' => $id_costoCliente,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_costoCliente' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_costoCliente,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CostoCliente/index/'.$pagina);

	}
	//Detalle de costos por cliente
	public function excel($id_cliente){
		$costoCliente=$this->CostoCliente_model->mostrar_por_id_cliente($id_cliente);
		$data['costoCliente']=$costoCliente;
		$this->load->view('inventarios/excel/costoCliente_detalle',$data);

	}
	//Lista de cierre a excel
	public function exportar(){
		$costoCliente=$this->CostoCliente_model->mostrar_lista();
		$data['costoCliente']=$costoCliente;
		$this->load->view('inventarios/excel/costoCliente_tabla',$data);
	}
}
