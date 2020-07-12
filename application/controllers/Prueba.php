<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prueba extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();
		//Variables iniciales
		$this->modeloname='_model';
		$this->number=rand(5,100);
		$this->string='Prueba:'.md5(rand());
		//Carga del libreria y modelo
		$this->load->library('unit_test');
		$this->load->model('Prueba'.$this->modeloname);
		//Carga de modelos
		foreach ($this->Prueba_model->catalogo_clases() as $clase){
				$this->load->model($clase.$this->modeloname);
		}
		$this->valueTest=$this->Prueba_model->mostrar_lista();

	}
	public function index()	{
		// $this->load->view('plantilla_head');
		// $this->unit->use_strict(TRUE);
		// //MÓDULO CATÁLOGOS
		// // $this->catalogo_simple();
		// // $this->cliente();
		// // $this->empleado();
		// // $this->reparticion();
		// // $this->gasto();
		// //MÓDULO INVENTARIOS
		// // $this->EntradaAlmacen();
		// // $this->CostoCliente();
		// // $this->CostoSucursal();
		// //MÓDULO ORDENES
		// //$this->Orden();
		// //$this->SuministroCliente();
		// //$this->SuministroSucursal();
		// //MÓDULO CIERRES
		// //$this->Cierre();
		// //$this->CierreVenta();
		// //$this->CierreGasto();
		// //$this->CierreMerma();
		// //$this->CierreDevolucion();
		// //$this->CierreReparticion();
		// $this->run();//Correr, siempre al ultimo
		// $this->load->view('plantilla_foot');
	}
	//Funcion para correr todo
	public function run(){
		# code...
		$test_lista=$this->unit->result();//modo array
		$data['test_lista']=$test_lista;
		$this->load->view('pruebas/pruebaUnitaria_lista',$data);
	}
	public function ejemplo(){
		//Datos de prueba
		$new_data =array('nombre' => $this->string);
		//Variable de la clase
		$clase="Puesto";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
		//$this->unit->use_strict(TRUE);
		//$mostrar_lista=$this->unit->report();//Preformateado
		//$test_lista=$this->unit->result();//modo array
		//$data['test_lista']=$test_lista;
		//Carga de vistas
		//$this->load->view('plantilla_head');
		//$this->load->view('pruebas/pruebaUnitaria_lista',$data);
		//$this->load->view('plantilla_foot');
	}
	public function catalogo_simple(){
		//$metodos=$this->Prueba_model->catalogo_simple();
		foreach ($this->Prueba_model->catalogo_simple() as $clase){
			//Datos de prueba
			$new_data =array('nombre' => $this->string);
			$claseTest=$clase.$this->modeloname;
			$modelo=$this->$claseTest;
			$methodsTest=array(
						array(
									"nombre" => $clase."->mostrar_lista()",
									"metodo" => $modelo->mostrar_lista(),),
						array(
									"nombre" => $clase."->nuevo_ingreso()",
									"metodo" => $modelo->nuevo_ingreso($new_data),),
						array(
									"nombre" => $clase."->actualizar()",
									"metodo" => $modelo->actualizar($this->number,$new_data),),
						array(
									"nombre" => $clase."->borrar()",
									"metodo" => $modelo->borrar($this->number),),
				);
			for($i=0; $i<count($methodsTest); $i++){
					$test_name = $methodsTest[$i]['nombre'];
					$test= $methodsTest[$i]['metodo'];
					foreach ($this->valueTest as $expected_result) {
								$nota="Prueba con: ".$expected_result;
								$this->unit->run($test, $expected_result, $test_name,$nota);
					}
				}
			}
	}
	public function cliente(){
		//Datos de prueba
		$new_data =array('nombre' => $this->string,
										'direccion' => $this->string,
										'telefono' => $this->number,
										'id_ruta' => '500');
		//Variable de la clase
		$clase="Cliente";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function empleado(){
		//Datos de prueba
		$new_data =array('nombre' => $this->string,
										'direccion' => $this->string,
										'telefono' => $this->number,
										'nacimiento' => date('Y-m-d'),
										'id_puesto' => '1',
										'id_sucursal' => '300');
		//Variable de la clase
		$clase="Empleado";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function reparticion(){
		//Datos de prueba
		$new_data =array('id_empleado' => rand(400,411),
										'id_ruta' => rand(500,525));
		//Variable de la clase
		$clase="Reparticion";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function gasto(){
		//Datos de prueba
		$new_data =array('nombre' => $this->string,
										'id_grupo' => rand(1,10));
		//Variable de la clase
		$clase="Gasto";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function EntradaAlmacen(){
		//Datos de prueba
		$new_data =array('id_matprima' => rand(200,224),
										'id_proveedor' => rand(100,123),
										'cantidad' => $this->number,
										'fecha_reg' => date('Y-m-d'));
		//Variable de la clase
		$clase="EntradaAlmacen";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),
			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function CostoCliente(){
		//Datos de prueba
		$new_data =array('id_cliente' => rand(700,724),
										'id_producto' => rand(600,623),
										'monto' => $this->number,
										'fecha_reg' => date('Y-m-d'));
		//Variable de la clase
		$clase="CostoCliente";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),
					array(
								"nombre" => $clase."->mostrar_por_id_cliente()",
								"metodo" => $modelo->mostrar_por_id_cliente($this->number),),
			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function CostoSucursal(){
		//Datos de prueba
		$new_data =array('id_sucursal' => rand(300,320),
										'id_producto' => rand(600,623),
										'monto' => $this->number,
										'fecha_reg' => date('Y-m-d'));
		//Variable de la clase
		$clase="CostoSucursal";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),
					array(
								"nombre" => $clase."->mostrar_por_id_sucursal()",
								"metodo" => $modelo->mostrar_por_id_sucursal($this->number),),
			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function Orden(){
		//Datos de prueba
		$new_data =array('id_sucursal' => rand(300,320),
										'nota' =>  $this->string,
										'fecha_ejec' => date('Y-m-d'),
										'hora_ejec' => date('H:s'));
		//Variable de la clase
		$clase="Orden";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id()",
								"metodo" => $modelo->mostrar_por_id($this->number),),
					array(
								"nombre" => $clase."->actualizar_cierre()",
								"metodo" => $modelo->actualizar_cierre($this->number,$new_data),),
					array(
					 			"nombre" => $clase."->actualizar_cierre_null()",
					 			"metodo" => $modelo->actualizar_cierre_null($this->number,''),),
					array(
								"nombre" => $clase."->sincierre()",
								"metodo" => $modelo->sincierre(),),
					array(
								"nombre" => $clase."->concierre()",
								"metodo" => $modelo->concierre(),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function SuministroCliente(){
		//Datos de prueba
		$new_data =array('id_orden' => rand(1,23),
										'id_cliente' => rand(700,720),
										'id_producto' => rand(600,620),
										'cantidad' =>  $this->number);
		//Variable de la clase
		$clase="SuministroCliente";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id_orden()",
								"metodo" => $modelo->mostrar_por_id_orden($this->number),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function SuministroSucursal(){
		//Datos de prueba
		$new_data =array('id_orden' => rand(1,23),
										'id_matprima' => rand(200,225),
										'cantidad' =>  $this->number);
		//Variable de la clase
		$clase="SuministroSucursal";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id_orden()",
								"metodo" => $modelo->mostrar_por_id_orden($this->number),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function Cierre(){
		//Datos de prueba
		$new_data =array('id_sucursal' => rand(300,320),
										'fecha_reg' => date('Y-m-d'),
										'nota' =>  $this->string);
		//Variable de la clase
		$clase="Cierre";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id()",
								"metodo" => $modelo->mostrar_por_id($this->number),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function CierreVenta(){
		//Datos de prueba
		$new_data =array('id_cierre' => rand(4015,4031),
										'id_cost_suc' => rand(2000,2025),
										'cantidad' =>  $this->number);
		//Variable de la clase
		$clase="CierreVenta";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id_cierre()",
								"metodo" => $modelo->mostrar_por_id_cierre($this->number),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function CierreGasto(){
		//Datos de prueba
		$new_data =array('id_cierre' => rand(4015,4031),
										'id_gasto' => rand(800,820),
										'monto' =>  $this->number);
		//Variable de la clase
		$clase="CierreGasto";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id_cierre()",
								"metodo" => $modelo->mostrar_por_id_cierre($this->number),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function CierreMerma(){
		//Datos de prueba
		$new_data =array('id_cierre' => rand(4015,4031),
										'id_merma' => rand(900,905),
										'cantidad' =>  $this->number);
		//Variable de la clase
		$clase="CierreMerma";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id_cierre()",
								"metodo" => $modelo->mostrar_por_id_cierre($this->number),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function CierreDevolucion(){
		//Datos de prueba
		$new_data =array('id_cierre' => rand(4015,4031),
										'id_merma' => rand(900,905),
										'id_empleado' => rand(400,413),
										'id_cliente' => rand(700,714),
										'cantidad' =>  $this->number);
		//Variable de la clase
		$clase="CierreDevolucion";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id_cierre()",
								"metodo" => $modelo->mostrar_por_id_cierre($this->number),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
	public function CierreReparticion(){
		//Datos de prueba
		$new_data =array('id_cierre' => rand(4015,4031),
										'id_cost_client' => rand(1000,1014),
										'id_empleado' => rand(400,413),
										'cantidad' =>  $this->number);
		//Variable de la clase
		$clase="CierreReparticion";
		$claseTest=$clase.$this->modeloname;
		$modelo=$this->$claseTest;
		$methodsTest=array(
					array(
								"nombre" => $clase."->mostrar_lista()",
								"metodo" => $modelo->mostrar_lista(),),
					array(
								"nombre" => $clase."->mostrar_lista_paginada()",
								"metodo" => $modelo->mostrar_lista_paginada(0,8),),
					array(
								"nombre" => $clase."->mostrar_por_id_cierre()",
								"metodo" => $modelo->mostrar_por_id_cierre($this->number),),
					array(
								"nombre" => $clase."->nuevo_ingreso()",
								"metodo" => $modelo->nuevo_ingreso($new_data),),
					array(
								"nombre" => $clase."->actualizar()",
								"metodo" => $modelo->actualizar($this->number,$new_data),),
					array(
								"nombre" => $clase."->borrar()",
								"metodo" => $modelo->borrar($this->number),),
					array(
								"nombre" => $clase."->cuantos_registros()",
								"metodo" => $modelo->cuantos_registros(),),

			);
		for($i=0; $i<count($methodsTest); $i++){
				$test_name = $methodsTest[$i]['nombre'];
				$test= $methodsTest[$i]['metodo'];
				foreach ($this->valueTest as $expected_result) {
							$nota="Prueba con: ".$expected_result;
							$this->unit->run($test, $expected_result, $test_name,$nota);
				}
			}
	}
}
