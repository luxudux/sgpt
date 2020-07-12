<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rendimiento extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Rendimiento_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Rendimiento_model->cuantos_registros();
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
		$rendimiento=$this->Rendimiento_model->mostrar_lista_paginada($iniciop,$paginacion);
		$data['rendimiento']=$rendimiento;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/rendimiento_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
								'psaco_m' => $this->input->post('sacoMaiz_n'),
								'agua_m' => $this->input->post('aguaMaiz_n'),
                'psaco_h' => $this->input->post('sacoHarina_n'),
								'agua_h' => $this->input->post('aguaHarina_n'),
                'rmasa' => $this->input->post('masa_n'),
                'deshidrata' => $this->input->post('deshidrata_n'),
                'rtortilla_m' => $this->input->post('tortillaM_n'),
                'rtortilla_h' => $this->input->post('tortillaH_n'),
                'activo' => $this->input->post('activo_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_rendimiento=$this->Rendimiento_model->nuevo_ingreso($data);
		if($id_rendimiento>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_rendimiento,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_rendimiento' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_rendimiento,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Rendimiento');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_rendimiento=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
                'nombre' => $this->input->post('nombre_a'),
                'psaco_m' => $this->input->post('sacoMaiz_a'),
								'agua_m' => $this->input->post('aguaMaiz_a'),
                'psaco_h' => $this->input->post('sacoHarina_a'),
								'agua_h' => $this->input->post('aguaHarina_a'),
                'rmasa' => $this->input->post('masa_a'),
                'deshidrata' => $this->input->post('deshidrata_a'),
                'rtortilla_m' => $this->input->post('tortillaM_a'),
                'rtortilla_h' => $this->input->post('tortillaH_a'),
                'activo' => $this->input->post('activo_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Rendimiento_model->actualizar($id_rendimiento,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_rendimiento,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_rendimiento' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_rendimiento,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Rendimiento/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_rendimiento=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_rendimiento=$this->security->xss_clean($id_rendimiento);
			$result=$this->Rendimiento_model->borrar($id_rendimiento);
			if($result){
				$tempdata =array(
										'numero' => $id_rendimiento,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_rendimiento' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_rendimiento,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Rendimiento/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$rendimiento=$this->Rendimiento_model->mostrar_lista();
		$data['rendimiento']=$rendimiento;
		$this->load->view('catalogos/excel/rendimiento_tabla',$data);
	}
}
