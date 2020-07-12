<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CierreReparticion extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('CierreReparticion_model');
		$this->load->model('Cierre_model');
		$this->load->model('Empleado_model');
		$this->load->model('Producto_model');
		$this->load->model('CostoCliente_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->CierreReparticion_model->cuantos_registros();
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
		$cierreReparticion=$this->CierreReparticion_model->mostrar_lista_paginada($iniciop,$paginacion);
		$cierre=$this->Cierre_model->mostrar_lista();
		$empleado=$this->Empleado_model->mostrar_lista_puesto('');
		$producto=$this->Producto_model->mostrar_lista();
		$costoCliente=$this->CostoCliente_model->mostrar_lista();
		$data['cierreReparticion']=$cierreReparticion;
		$data['cierre']=$cierre;
		$data['producto']=$producto;
		$data['empleado']=$empleado;
		$data['costoCliente']=$costoCliente;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('cierres/cierreReparticion_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_cierre' => $this->input->post('cierre_n'),
								'id_cost_client' => $this->input->post('costo_cliente_n'),
								'id_empleado' => $this->input->post('empleado_n'),
								'cantidad' => $this->input->post('cantidad_n'),

							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_cierreReparticion=$this->CierreReparticion_model->nuevo_ingreso($data);
		if($id_cierreReparticion>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_cierreReparticion,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierreReparticion' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierreReparticion,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreReparticion');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_cierreReparticion=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								//'id_matprima' => $this->input->post('cierre_a'),
								//'id' => $this->input->post('id_a'),
								'cantidad' => $this->input->post('cantidad_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->CierreReparticion_model->actualizar($id_cierreReparticion,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_cierreReparticion,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierreReparticion' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierreReparticion,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreReparticion/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_cierreReparticion=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_cierreReparticion=$this->security->xss_clean($id_cierreReparticion);
			$result=$this->CierreReparticion_model->borrar($id_cierreReparticion);
			if($result){
				$tempdata =array(
										'numero' => $id_cierreReparticion,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_cierreReparticion' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_cierreReparticion,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreReparticion/index/'.$pagina);

	}
	//Lista  a excel
	public function exportar(){
		$cierreReparticion=$this->CierreReparticion_model->mostrar_lista();
		$data['cierreReparticion']=$cierreReparticion;
		$this->load->view('cierres/excel/cierreReparticion_tabla',$data);
	}
}
