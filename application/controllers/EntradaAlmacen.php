<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EntradaAlmacen extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('EntradaAlmacen_model');
		$this->load->model('MateriaPrima_model');
		$this->load->model('Proveedor_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->EntradaAlmacen_model->cuantos_registros();
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
		$entradaAlmacen=$this->EntradaAlmacen_model->mostrar_lista_paginada($iniciop,$paginacion);
		$materiaPrima=$this->MateriaPrima_model->mostrar_lista();
		$proveedor=$this->Proveedor_model->mostrar_lista_activa();
		$data['entradaAlmacen']=$entradaAlmacen;
		$data['materiaPrima']=$materiaPrima;
		$data['proveedor']=$proveedor;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('inventarios/entradaAlmacen_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'id_matprima' => $this->input->post('materiaPrima_n'),
								'id_proveedor' => $this->input->post('proveedor_n'),
								'cantidad' => $this->input->post('cantidad_n'),
								'fecha_reg' => $this->input->post('fecha_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_entradaAlmacen=$this->EntradaAlmacen_model->nuevo_ingreso($data);
		if($id_entradaAlmacen>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_entradaAlmacen,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_entradaAlmacen' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_entradaAlmacen,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('EntradaAlmacen');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_entradaAlmacen=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');

		$data =array(
								//'id_matprima' => $this->input->post('materiaPrima_a'),
								'id_proveedor' => $this->input->post('proveedor_a'),
								'cantidad' => $this->input->post('cantidad_a'),
								'fecha_reg' => $this->input->post('fecha_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->EntradaAlmacen_model->actualizar($id_entradaAlmacen,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_entradaAlmacen,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_entradaAlmacen' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_entradaAlmacen,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('EntradaAlmacen/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_entradaAlmacen=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_entradaAlmacen=$this->security->xss_clean($id_entradaAlmacen);
			$result=$this->EntradaAlmacen_model->borrar($id_entradaAlmacen);
			if($result){
				$tempdata =array(
										'numero' => $id_entradaAlmacen,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_entradaAlmacen' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_entradaAlmacen,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('EntradaAlmacen/index/'.$pagina);

	}
	//Lista de cierre a excel
	public function exportar(){
		$entradaAlmacen=$this->EntradaAlmacen_model->mostrar_lista();
		$data['entradaAlmacen']=$entradaAlmacen;
		$this->load->view('inventarios/excel/entradaAlmacen_tabla',$data);
	}
}
