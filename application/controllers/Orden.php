<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orden extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//Carga del modelo
    $this->load->model('Orden_model');//cargamos el modelo
		$this->load->model('Sucursal_model');
		$this->load->model('Cierre_model');
		$this->load->model('SuministroCliente_model');
		$this->load->model('SuministroSucursal_model');
		$this->load->model('Rendimiento_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Orden_model->cuantos_registros();
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
		$orden=$this->Orden_model->mostrar_lista_paginada($iniciop,$paginacion);
		$sucursal=$this->Sucursal_model->mostrar_lista();
		$cierre=$this->Cierre_model->mostrar_lista();
		$rendimiento=$this->Rendimiento_model->mostrar_lista_activa();

		$data['orden']=$orden;
		$data['sucursal']=$sucursal;
		$data['cierre']=$cierre;
		$data['rendimiento']=$rendimiento;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('traspasos/orden_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_sucursal' => $this->input->post('sucursal_n'),
								'nota' => $this->input->post('nota_n'),
								'fecha_ejec' => $this->input->post('fecha_ejec_n'),
								'hora_ejec' => $this->input->post('hora_ejec_n'),
								'id_rendimiento' => $this->input->post('rendimiento_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_orden=$this->Orden_model->nuevo_ingreso($data);
		if($id_orden>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_orden,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_orden' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_orden,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Orden');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_orden=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');

		$data =array(
			'id_sucursal' => $this->input->post('sucursal_a'),
			'nota' => $this->input->post('nota_a'),
			'fecha_ejec' => $this->input->post('fecha_ejec_a'),
			'hora_ejec' => $this->input->post('hora_ejec_a'),
			'id_rendimiento' => $this->input->post('rendimiento_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Orden_model->actualizar($id_orden,$data);
		//Actualizamos el cierre
		$resultado_cierre=$this->Orden_model->actualizar_cierre_null($id_orden,$this->input->post('cierre_a'));

		if($resultado && $resultado_cierre){

			$tempdata =array(
									'numero' => $id_orden,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_orden' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_orden,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Orden/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_orden=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_orden=$this->security->xss_clean($id_orden);
			$result=$this->Orden_model->borrar($id_orden);
			if($result){
				$tempdata =array(
										'numero' => $id_orden,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_orden' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_orden,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Orden/index/'.$pagina);

	}
	//EXPORTAR ORDEN A EXCEL
	public function excel($id_orden){
		$orden=$this->Orden_model->mostrar_por_id($id_orden);
		//$suministroCliente=$this->SuministroCliente_model->mostrar_por_id_orden($id_orden);
		//$suministroSucursal=$this->SuministroSucursal_model->mostrar_por_id_orden($id_orden);
		$data['orden']=$orden;
		//$data['suministroCliente']=$suministroCliente;
		//$data['suministroSucursal']=$suministroSucursal;
		$this->load->view('traspasos/excel/orden_detalle',$data);
	}
	//Lista de cierre a excel
	public function exportar(){
		$orden=$this->Orden_model->mostrar_lista();
		$data['orden']=$orden;
		$this->load->view('traspasos/excel/orden_tabla',$data);
	}
}
