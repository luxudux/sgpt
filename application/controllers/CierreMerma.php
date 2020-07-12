<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CierreMerma extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('CierreMerma_model');
		$this->load->model('Cierre_model');
		$this->load->model('Merma_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->CierreMerma_model->cuantos_registros();
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
		$cierreMerma=$this->CierreMerma_model->mostrar_lista_paginada($iniciop,$paginacion);
		$cierre=$this->Cierre_model->mostrar_lista_no_bloqueada();
		$merma=$this->Merma_model->mostrar_lista();
		$data['cierreMerma']=$cierreMerma;
		$data['cierre']=$cierre;
		$data['merma']=$merma;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('cierres/cierreMerma_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_cierre' => $this->input->post('cierre_n'),
								'id_merma' => $this->input->post('merma_n'),
								'cantidad' => $this->input->post('cantidad_n'),

							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_cierreMerma=$this->CierreMerma_model->nuevo_ingreso($data);
		if($id_cierreMerma>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_cierreMerma,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierreMerma' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierreMerma,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreMerma');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_cierreMerma=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								//'id_matprima' => $this->input->post('cierre_a'),
								//'id' => $this->input->post('id_a'),
								'cantidad' => $this->input->post('cantidad_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->CierreMerma_model->actualizar($id_cierreMerma,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_cierreMerma,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_cierreMerma' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_cierreMerma,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreMerma/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_cierreMerma=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_cierreMerma=$this->security->xss_clean($id_cierreMerma);
			$result=$this->CierreMerma_model->borrar($id_cierreMerma);
			if($result){
				$tempdata =array(
										'numero' => $id_cierreMerma,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_cierreMerma' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_cierreMerma,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('CierreMerma/index/'.$pagina);

	}
	//Lista  a excel
	public function exportar(){
		$cierreMerma=$this->CierreMerma_model->mostrar_lista();
		$data['cierreMerma']=$cierreMerma;
		$this->load->view('cierres/excel/cierreMerma_tabla',$data);
	}
}
