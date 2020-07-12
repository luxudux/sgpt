<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SuministroCliente extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('SuministroCliente_model');
		$this->load->model('Orden_model');
		$this->load->model('CostoCliente_model');
		$this->load->model('Empleado_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->SuministroCliente_model->cuantos_registros();
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
		$suministroCliente=$this->SuministroCliente_model->mostrar_lista_paginada($iniciop,$paginacion);
		$orden=$this->Orden_model->mostrar_lista_sin_cierre();
		$costoCliente=$this->CostoCliente_model->mostrar_lista_activa();
		$empleado=$this->Empleado_model->mostrar_lista_repartidor();


		$data['suministroCliente']=$suministroCliente;
		$data['orden']=$orden;
		$data['costoCliente']=$costoCliente;
		$data['empleado']=$empleado;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;

    $this->load->view('plantilla_head');
    $this->load->view('traspasos/suministroCliente_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_orden' => $this->input->post('orden_n'),
								'id_costo_cliente' => $this->input->post('costo_cliente_n'),
								'cantidad' => $this->input->post('cantidad_n'),
								'id_empleado' => $this->input->post('empleado_n'),
								'devolucion' => $this->input->post('devolucion_n'),

							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_suministroCliente=$this->SuministroCliente_model->nuevo_ingreso($data);
		if($id_suministroCliente>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_suministroCliente,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_suministroCliente' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_suministroCliente,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('SuministroCliente');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_suministroCliente=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								//'id' => $this->input->post('id_a'),
								//'id_costo_cliente' => $this->input->post('costo_cliente_a'),
								'cantidad' => $this->input->post('cantidad_a'),
								'id_empleado' => $this->input->post('empleado_a'),
								'devolucion' => $this->input->post('devolucion_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->SuministroCliente_model->actualizar($id_suministroCliente,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_suministroCliente,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_suministroCliente' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_suministroCliente,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('SuministroCliente/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_suministroCliente=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_suministroCliente=$this->security->xss_clean($id_suministroCliente);
			$result=$this->SuministroCliente_model->borrar($id_suministroCliente);
			if($result){
				$tempdata =array(
										'numero' => $id_suministroCliente,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_suministroCliente' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_suministroCliente,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('SuministroCliente/index/'.$pagina);

	}
	//Lista a excel
	public function exportar(){
		$suministroCliente=$this->SuministroCliente_model->mostrar_lista();
		$data['suministroCliente']=$suministroCliente;
		$this->load->view('traspasos/excel/suministroCliente_tabla',$data);
	}
}
