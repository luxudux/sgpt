<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Empleado extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Empleado_model');//cargamos el modelo
		$this->load->model('Puesto_model');
		$this->load->model('Sucursal_model');
		$this->load->library('pagination');

	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Empleado_model->cuantos_registros();
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
		$empleado=$this->Empleado_model->mostrar_lista_paginada($iniciop,$paginacion);
		$puesto=$this->Puesto_model->mostrar_lista();
		$sucursal=$this->Sucursal_model->mostrar_lista();

		$data['empleado']=$empleado;
		$data['puesto']=$puesto;
		$data['sucursal']=$sucursal;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;

    $this->load->view('plantilla_head');
    $this->load->view('catalogos/empleado_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
								'direccion' => $this->input->post('direccion_n'),
								'telefono' => $this->input->post('telefono_n'),
								'nacimiento' => $this->input->post('nacimiento_n'),
								'id_puesto' => $this->input->post('puesto_n'),
								'id_sucursal' => $this->input->post('sucursal_n'),
								'activo' => $this->input->post('activo_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_empl=$this->Empleado_model->nuevo_ingreso($data);
		if($id_empl>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_empl,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_empl' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_empl,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Empleado');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_empl=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
								'direccion' => $this->input->post('direccion_a'),
								'telefono' => $this->input->post('telefono_a'),
								'nacimiento' => $this->input->post('nacimiento_a'),
								'id_puesto' => $this->input->post('puesto_a'),
								'id_sucursal' => $this->input->post('sucursal_a'),
								'activo' => $this->input->post('activo_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Empleado_model->actualizar($id_empl,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_empl,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_empl' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_empl,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Empleado/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_empl=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_empl=$this->security->xss_clean($id_empl);
			$result=$this->Empleado_model->borrar($id_empl);
			if($result){
				$tempdata =array(
										'numero' => $id_empl,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_empl' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_empl,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Empleado/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$empleado=$this->Empleado_model->mostrar_lista();
		$data['empleado']=$empleado;
		$this->load->view('catalogos/excel/empleado_tabla',$data);
	}
}
