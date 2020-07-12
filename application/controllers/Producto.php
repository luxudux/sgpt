<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Producto extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Producto_model');
		$this->load->model('Grupop_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Producto_model->cuantos_registros();
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
		$producto=$this->Producto_model->mostrar_lista_paginada($iniciop,$paginacion);
		$grupop=$this->Grupop_model->mostrar_lista();
		$data['producto']=$producto;
		$data['grupop']=$grupop;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/producto_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
								'id_grupop' => $this->input->post('grupop_n'),
								'descripcion' => $this->input->post('descripcion_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_producto=$this->Producto_model->nuevo_ingreso($data);
		if($id_producto>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_producto,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_producto' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_producto,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Producto');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_producto=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
								'id_grupop' => $this->input->post('grupop_a'),
								'descripcion' => $this->input->post('descripcion_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Producto_model->actualizar($id_producto,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_producto,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_producto' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_producto,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Producto/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_producto=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_producto=$this->security->xss_clean($id_producto);
			$result=$this->Producto_model->borrar($id_producto);
			if($result){
				$tempdata =array(
										'numero' => $id_producto,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_producto' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_producto,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Producto/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$producto=$this->Producto_model->mostrar_lista();
		$data['producto']=$producto;
		$this->load->view('catalogos/excel/producto_tabla',$data);
	}
}
