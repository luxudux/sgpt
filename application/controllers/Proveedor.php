<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proveedor extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Carga del modelo
    $this->load->model('Proveedor_model');//cargamos el modelo
		$this->load->library('pagination');
	}
	public function index($iniciop=0)	{
		// -- Start pagination
		$paginacion=$this->session->paginado;//registros por pagina
		$cuantos=$this->Proveedor_model->cuantos_registros();
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
		$proveedor=$this->Proveedor_model->mostrar_lista_paginada($iniciop,$paginacion);
		$data['proveedor']=$proveedor;
		$data['pagina']=($paginacion==($cuantos-1)) ? 0 : $iniciop;
		//Carga de vistas
    $this->load->view('plantilla_head');
    $this->load->view('catalogos/proveedor_lista',$data);
    $this->load->view('plantilla_foot');

  }
	//Ingreso de nuevo proveedor
	public function nuevo()	{
		# code...
		//echo"Nuevo registro<b>";
		$data =array(
								'nombre' => $this->input->post('nombre_n'),
								'correo' => $this->input->post('correo_n'),
								'telefono' => $this->input->post('telefono_n'),
								'activo' => $this->input->post('activo_n'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		//Modelo
		$id_prov=$this->Proveedor_model->nuevo_ingreso($data);
		//echo $id_prov."<br><br>";
		//var_dump($data);
		if($id_prov>1){
			//Flash data
			$tempdata =array(
									'numero' => $id_prov,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_prov' se ingresó correctamente",
									'alert'=> 'alert-success',
								);
			//var_dump($this->session->tempdata());
		}else{
			$tempdata =array(
									'numero' => $id_prov,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo ingresar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Proveedor');
	}
	//Actualizar proveedor
	public function actualizar(){
		# code...
		//echo"Actualizar datos del proveedor";
		$id_prov=$this->input->post('id_a');
		$pagina=$this->input->post('pagina_a');
		$data =array(
								'nombre' => $this->input->post('nombre_a'),
								'correo' => $this->input->post('correo_a'),
								'telefono' => $this->input->post('telefono_a'),
								'activo' => $this->input->post('activo_a'),
							);
		//PROTECCION CONTRA xss
		$data = $this->security->xss_clean($data);
		$resultado=$this->Proveedor_model->actualizar($id_prov,$data);
		if($resultado){
			//echo"Se actualizó correctamente";
			//var_dump($data);
			$tempdata =array(
									'numero' => $id_prov,
									'estado' => TRUE,
									'icono' => "Bien!",
									'mensaje' => "El registro con el 'Id: $id_prov' se actualizó correctamente",
									'alert'=> 'alert-success',
								);
		}else{
			$tempdata =array(
									'numero' => $id_prov,
									'estado' => FALSE,
									'icono' => "Ups!",
									'mensaje' => "No se pudo actualizar el registro",
									'alert'=> 'alert-warning',
								);
		}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Proveedor/index/'.$pagina);
	}
	//Borrar proveedor
	public function borrar(){

		$id_prov=$this->input->post('id_b');
		$pagina=$this->input->post('pagina_b');
		$id_prov=$this->security->xss_clean($id_prov);
			$result=$this->Proveedor_model->borrar($id_prov);
			if($result){
				$tempdata =array(
										'numero' => $id_prov,
										'estado' => TRUE,
										'icono' => "Bien!",
										'mensaje' => "El registro con el 'Id: $id_prov' se eliminó correctamente",
										'alert'=> 'alert-success',
									);
			}else{
				$tempdata =array(
										'numero' => $id_prov,
										'estado' => FALSE,
										'icono' => "Ups!",
										'mensaje' => "No se pudo eliminar el registro, compruebe que el registro no esté en uso.",
										'alert'=> 'alert-warning',
									);
			}
		$expire=5; //5segundos
		$this->session->set_tempdata($tempdata, NULL, $expire);
		redirect('Proveedor/index/'.$pagina);

	}
	//Exportar Lista a excel
	public function exportar(){
		$proveedor=$this->Proveedor_model->mostrar_lista();
		$data['proveedor']=$proveedor;
		$this->load->view('catalogos/excel/proveedor_tabla',$data);
	}
}
