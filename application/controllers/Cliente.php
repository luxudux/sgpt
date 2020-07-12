<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cliente extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Cliente_model');//cargamos el modelo
		$this->load->model('Ruta_model');
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Cliente_model->cuantos_registros();
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
		$cliente=$this->Cliente_model->mostrar_lista_paginada($iniciop,$paginacion);
		$ruta=$this->Ruta_model->mostrar_lista();
		$data['cliente']=$cliente;
		$data['ruta']=$ruta;
    $data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
		//Carga de vistas
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/cliente_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//INGRESAR NUEVO
	public function nuevo()	{
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
								'direccion' => $this->input->post('direccion_n'),
								'telefono' => $this->input->post('telefono_n'),
								'id_ruta' => $this->input->post('ruta_n'),
								'correo' => $this->input->post('correo_n'),
								'activo' => $this->input->post('activo_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_clien=$this->Cliente_model->nuevo_ingreso($data);
		if($id_clien>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_clien,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_clien' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_clien,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Cliente');
	}
	//ACTUALIZAR
	public function actualizar(){
		$id_clien=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
								'direccion' => $this->input->post('direccion_a'),
								'telefono' => $this->input->post('telefono_a'),
								'id_ruta' => $this->input->post('ruta_a'),
								'correo' => $this->input->post('correo_a'),
								'activo' => $this->input->post('activo_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Cliente_model->actualizar($id_clien,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_clien,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_clien' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_clien,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Cliente/index/'.$pagina);
	}
	//BORRAR
	public function borrar(){

		$id_clien=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_clien=$this->security->xss_clean($id_clien);
			$result=$this->Cliente_model->borrar($id_clien);
			if($result){
				$tempdata =array(
										'numero' => $id_clien,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_clien' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_clien,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Cliente/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$cliente=$this->Cliente_model->mostrar_lista();
		$data['cliente']=$cliente;
		$this->load->view('catalogos/excel/cliente_tabla',$data);
	}
}
