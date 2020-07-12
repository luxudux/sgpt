<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CierreGasto extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('CierreGasto_model');
		$this->load->model('Cierre_model');
		$this->load->model('Gasto_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->CierreGasto_model->cuantos_registros();
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
		$cierreGasto=$this->CierreGasto_model->mostrar_lista_paginada($iniciop,$paginacion);
		$cierre=$this->Cierre_model->mostrar_lista_no_bloqueada();
		$gasto=$this->Gasto_model->mostrar_lista();
		$data['cierreGasto']=$cierreGasto;
		$data['cierre']=$cierre;
		$data['gasto']=$gasto;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('cierres/cierreGasto_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_cierre' => $this->input->post('cierre_n'),
								'id_gasto' => $this->input->post('gasto_n'),
								'monto' => $this->input->post('monto_n'),

							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_cierreGasto=$this->CierreGasto_model->nuevo_ingreso($data);
		if($id_cierreGasto>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_cierreGasto,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierreGasto' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierreGasto,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreGasto');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_cierreGasto=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								//'id_matprima' => $this->input->post('cierre_a'),
								//'id' => $this->input->post('id_a'),
								'monto' => $this->input->post('monto_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->CierreGasto_model->actualizar($id_cierreGasto,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_cierreGasto,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierreGasto' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierreGasto,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreGasto/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_cierreGasto=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_cierreGasto=$this->security->xss_clean($id_cierreGasto);
			$result=$this->CierreGasto_model->borrar($id_cierreGasto);
			if($result){
				$tempdata =array(
										'numero' => $id_cierreGasto,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_cierreGasto' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_cierreGasto,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreGasto/index/'.$pagina);

	}
	//Lista  a excel
	public function exportar(){
		$cierreGasto=$this->CierreGasto_model->mostrar_lista();
		$data['cierreGasto']=$cierreGasto;
		$this->load->view('cierres/excel/cierreGasto_tabla',$data);
	}
}
