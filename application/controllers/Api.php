<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Se puede agregar la clase 'REST_Controller' en el autoload
// y asi evitamos poner el requiere
require APPPATH . '/libraries/REST_Controller.php';
// se accede con http://miservidor/ApiEjemplo/users?format=json
// se accede con http://miservidor/ApiEjemplo/users?format=xml
class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->database();
        //$this->load->helper('url');
        $this->load->model('MateriaPrima_model');
    }

    //MATERIAL
    //GET, POST, PUT, DELETE, PATCH, HEAD and OPTIONS
    // se accede con http://miservidor/Api/material/id/2  (mandando 1 parametro id)
    // se accede con http://miservidor/Api/material/id/2/nombre/3  (mandando 2 parametros id y nombre)
    function material_get(){
        // Para obtener datos
        //Send an HTTP 200 Ok
        //echo"metodo get material<br>";
        $parametros_num=count($this->get());//Numero de parametros que se envian
        $cuantos=$this->MateriaPrima_model->cuantos_registros(); //numero de registros
        //SI EXISTE EL PARAMETRO ID Y SOLO MANDA ESE UNICO PARAMETRO
        if(count($this->get('id')) && $parametros_num==1){
          echo"Está mandando el parametro id<br>";
          //Validar que el parametro id sea numerico
          // ESTANDARD ERROR https://developers.google.com/webmaster-tools/search-console-api-original/v3/errors
          //si no es numerico
          if(!is_numeric($this->get('id'))){
            $this->load->helper('mensaje');//funciones personalizadas
            $this->response(mensaje_error_id_numeric($this->get('id')),400);
            return; //Para que se detenga en este punto
          }
          //si es mayor al rango numerico existente o es menor a cero el id
          //Es 200 porque el id empieza con 200
          if( ($this->get('id') >= $cuantos+200) OR ($this->get('id')<0) ){
            $this->load->helper('mensaje');//funciones personalizadas
            $this->response(mensaje_error_fueraderango($this->get('id')),400);
            return;
          }
          //SE PUEDE HACER LA CONSULTA SEGÚN EL ID
          //echo"Puede hacerse la consulta filtrada por id correctamente";
          $this->load->helper('array');//funciones personalizadas
          $this->load->helper('mensaje');//funciones personalizadas
          $materiaPrima=$this->MateriaPrima_model->mostrar_registro($this->get('id'));
          //SI REGRESA REGISTROS LA CONSULTA
          if(count($materiaPrima)){
            $campos_capitalizar=array("nombre");
            $resultado=array_capitalizar($materiaPrima,$campos_capitalizar);//MAYUSCULAS ciertos campos
            $this->response(mensaje_correcto_consulta($resultado));//mensaje correcto en json
          //SI NO REGRESA REGISTROS
          }else{
            $this->response(mensaje_error_no_existe($this->get('id')));//mensaje error en json
          }
          //var_dump($this->get());
          //echo $this->get('id'); // GET param
          //echo $this->get('nombre'); // GET param
          //echo $this->query('id'); // Query param cualquier parametro mandado por url
        }
        //SI MANDA EL PARAMETRO NOMBRE Y EL NUMERO DE PARAMETROS SOLO ES 1
         elseif(count($this->get('nombre'))&& $parametros_num==1){
           $longitud=5;//LONGITUD PERMITIDA DE LA VARIABLE NOMBRE
           $nombre=$this->get('nombre');
           $nombre=$this->security->xss_clean($nombre);
           $nombre=trim($nombre);
           //SI SOBREPASA LA LONGITUD
           if(strlen($nombre)>$longitud){
              $this->load->helper('mensaje');//funciones personalizadas
              $this->response(mensaje_error_long_string($nombre,$longitud),400);
           }

           echo"Está mandando el parametro nombre puede hacerse la consulta por nombre correctamente<br>";
           //SANITISAR LA CADENA


        }
        // elseif(count($this->get('nombre')) && count($this->get('cantidad'))&& $parametros_num<=2){
        //   //echo"Está mandando el parametro parametro nombre y cantidad<br>";
        //   $materiaPrima=$this->MateriaPrima_model->mostrar_lista();
        //   $this->response($materiaPrima);//repuesta con formato
        // }
        else{
        //  echo"No está mandando ningun parametro <br>";
          $this->load->helper('array');//funciones personalizadas
          $this->load->helper('mensaje');//funciones personalizadas
          $campos_capitalizar=array("nombre");
          $materiaPrima=$this->MateriaPrima_model->mostrar_lista();
          $resultado=array_capitalizar($materiaPrima,$campos_capitalizar);//MAYUSCULAS ciertos campos
          //array_legible($resultado);
          $this->response(mensaje_correcto_consulta($resultado));//mensaje correcto en json
          //$this->response(mensaje_correcto_consulta($resultado),200);//mensaje correcto en json
        }
        //acceder
        // http://miservidor/sgpt/Api/material.xml
        //http://miservidor/sgpt/Api/material.json
        //Estos ultimos dos no se pueden implementar por que se mandan como parametros
        // http://miservidor/sgpt/Api/material?format=xml
        //http://miservidor/sgpt/Api/material?format=json
        //Cuando son varios parametros se pone
        //http://miservidor/sgpt/Api/material.xml/nombre/luis/cantidad/10

    }
    function material_post(){
        // Para actualizar un recurso
        //Send an HTTP 201 Created
        echo"metodo post material";
        echo $this->post('id'); // POST param
    }
    function material_put(){
        // Para crear un recurso
        echo"metodo put material";
        echo var_dump($this->put());
        echo $this->put('id'); // PUT param
    }
    // se accede con DELETE http://miservidor/Api/material/2/
    function material_delete($id){
        // Para borrar un recurso
        echo"metodo delete material";
        echo"El id tiene el valor: ".$id;
        $this->response([
		          'returned from delete:' => $id,
	         ]);
    }
    function material_patch(){
        // Para crear un recurso
        echo"metodo patch material";
        echo var_dump($this->patch());
        echo $this->patch('id'); // PATCH param
    }

    function material_options(){
        // Para crear un recurso
        echo"metodo options material";
        echo var_dump($this->options());
        echo $this->options('id'); // OPTIONS param
    }


}
