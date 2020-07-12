<?php
defined('BASEPATH') or exit('No direct script access allowed');
//Se puede agregar la clase 'REST_Controller' en el autoload
// y asi evitamos poner el requiere
require APPPATH . '/libraries/REST_Controller.php';
// se accede con http://miservidor/ApiEjemplo/users?format=json
// se accede con http://miservidor/ApiEjemplo/users?format=xml
class ApiGrafico extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->helper('grafico');
        $this->load->model('ApiGrafico_model');

    }
    //SE CREA UN JSON CON DATOS DINAMICOS PERO NO CONSULTADOS DE UNA BASE DE DATOS
    public function reporteGasto_get()
    {
        //$this->load->helper('mensaje');//funciones personalizadas
        //$this->load->helper('grafico');
        //echo"metodo get grafico";

        //Constantes
        define("BORDER", 2);
        define("FILL", 'false');
        //Array de colores
        $arrayBackgroundColor = arrayBackgroundColor();
        $arrayBorderColor = arrayBorderColor();
        //Crear un array dinamico
        for ($i = 0; $i <= 2; $i++) {

            $resultado[$i] = array(
                'label' => 'Nombre de sucursal ' . $i,
                'backgroundColor' => $arrayBackgroundColor[$i],
                'borderColor' => $arrayBorderColor[$i],
                'borderWidth' => BORDER,
                'data' => arrayRandomNumber(12),
                'fill' => FILL,
            );
        }
        //$this->response(mensaje_correcto_consulta($resultado));//mensaje correcto en json
        $this->response($resultado); //mensaje correcto en json
        //echo <pre>".json_encode($resultado, JSON_PRETTY_PRINT).</pre>";
    }
    // SE CREA UN JSON CON DATOS DINAMICOS CONSULTADOS DE UNA BASE DE DATOS
    // http://localhost/g1646015/sgpt/ApiGrafico/reporteGastoReal  (servicio)
    // http://localhost/g1646015/graficochartjs/gastos1.html (grafico)
    public function reporteGastoReal_get()
    {
        //CONSTANTES Y VARIABLES CONFIGURACIÓN GENERAL
        define("BORDER", 2);
        define("FILL", 'false');
        //Array de colores
        $arrayBackgroundColor = arrayBackgroundColor();
        $arrayBorderColor = arrayBorderColor();
        $registros = $this->ApiGrafico_model->ReporteGastoAnual();

        for ($i = 0; $i < count($registros); $i++) {
            $resultado[$i] = array(
                'label' => $registros[$i]->id . ' ' . $registros[$i]->nombre,
                'backgroundColor' => $arrayBackgroundColor[$i],
                'borderColor' => $arrayBorderColor[$i],
                'borderWidth' => BORDER,
                'data' => array(
                    $registros[$i]->enero,
                    $registros[$i]->febrero,
                    $registros[$i]->marzo,
                    $registros[$i]->abril,
                    $registros[$i]->mayo,
                    $registros[$i]->junio,
                    $registros[$i]->julio,
                    $registros[$i]->agosto,
                    $registros[$i]->septiembre,
                    $registros[$i]->octubre,
                    $registros[$i]->noviembre,
                    $registros[$i]->diciembre,
                ),
                arrayRandomNumber(12),
                'fill' => FILL,
            );
        }
        $this->response($resultado); //mensaje correcto en json
    }

    public function reporteVentaReal_get()
    {
        //CONSTANTES Y VARIABLES CONFIGURACIÓN GENERAL
        define("BORDER", 2);
        define("FILL", 'false');
        //Array de colores
        $arrayBackgroundColor = arrayBackgroundColor();
        $arrayBorderColor = arrayBorderColor();
        $registros = $this->ApiGrafico_model->ReporteVentaAnual();

        for ($i = 0; $i < count($registros); $i++) {
            $resultado[$i] = array(
                'label' => $registros[$i]->id . ' ' . $registros[$i]->nombre,
                'backgroundColor' => $arrayBackgroundColor[$i+3],
                'borderColor' => $arrayBorderColor[$i+3],
                'borderWidth' => BORDER,
                'data' => array(
                    $registros[$i]->enero,
                    $registros[$i]->febrero,
                    $registros[$i]->marzo,
                    $registros[$i]->abril,
                    $registros[$i]->mayo,
                    $registros[$i]->junio,
                    $registros[$i]->julio,
                    $registros[$i]->agosto,
                    $registros[$i]->septiembre,
                    $registros[$i]->octubre,
                    $registros[$i]->noviembre,
                    $registros[$i]->diciembre,
                ),
                arrayRandomNumber(12),
                'fill' => FILL,
            );
        }
        $this->response($resultado); //mensaje correcto en json
    }
    public function reporteMermaReal_get()
    {
        //CONSTANTES Y VARIABLES CONFIGURACIÓN GENERAL
        define("BORDER", 2);
        define("FILL", 'false');
        //Array de colores
        $arrayBackgroundColor = arrayBackgroundColor();
        $arrayBorderColor = arrayBorderColor();
        $registros = $this->ApiGrafico_model->ReporteMermaAnual();

        for ($i = 0; $i < count($registros); $i++) {
            $resultado[$i] = array(
                'label' => $registros[$i]->id . ' ' . $registros[$i]->nombre,
                'backgroundColor' => $arrayBackgroundColor[$i+6],
                'borderColor' => $arrayBorderColor[$i+6],
                'borderWidth' => BORDER,
                'data' => array(
                    $registros[$i]->enero,
                    $registros[$i]->febrero,
                    $registros[$i]->marzo,
                    $registros[$i]->abril,
                    $registros[$i]->mayo,
                    $registros[$i]->junio,
                    $registros[$i]->julio,
                    $registros[$i]->agosto,
                    $registros[$i]->septiembre,
                    $registros[$i]->octubre,
                    $registros[$i]->noviembre,
                    $registros[$i]->diciembre,
                ),
                arrayRandomNumber(12),
                'fill' => FILL,
            );
        }
        $this->response($resultado); //mensaje correcto en json
    }
    public function reporteDevolucionReal_get()
    {
        //CONSTANTES Y VARIABLES CONFIGURACIÓN GENERAL
        define("BORDER", 2);
        define("FILL", 'false');
        //Array de colores
        $arrayBackgroundColor = arrayBackgroundColor();
        $arrayBorderColor = arrayBorderColor();
        $registros = $this->ApiGrafico_model->ReporteDevolucionAnual();

        for ($i = 0; $i < count($registros); $i++) {
            $resultado[$i] = array(
                'label' => $registros[$i]->id . ' ' . $registros[$i]->nombre,
                'backgroundColor' => $arrayBackgroundColor[$i+2],
                'borderColor' => $arrayBorderColor[$i+2],
                'borderWidth' => BORDER,
                'data' => array(
                    $registros[$i]->enero,
                    $registros[$i]->febrero,
                    $registros[$i]->marzo,
                    $registros[$i]->abril,
                    $registros[$i]->mayo,
                    $registros[$i]->junio,
                    $registros[$i]->julio,
                    $registros[$i]->agosto,
                    $registros[$i]->septiembre,
                    $registros[$i]->octubre,
                    $registros[$i]->noviembre,
                    $registros[$i]->diciembre,
                ),
                arrayRandomNumber(12),
                'fill' => FILL,
            );
        }
        $this->response($resultado); //mensaje correcto en json
    }
    public function reporteReparticionReal_get()
    {
        //CONSTANTES Y VARIABLES CONFIGURACIÓN GENERAL
        define("BORDER", 2);
        define("FILL", 'false');
        //Array de colores
        $arrayBackgroundColor = arrayBackgroundColor();
        $arrayBorderColor = arrayBorderColor();
        $registros = $this->ApiGrafico_model->ReporteReparticionAnual();

        for ($i = 0; $i < count($registros); $i++) {
            $resultado[$i] = array(
                'label' => $registros[$i]->id . ' ' . $registros[$i]->nombre,
                'backgroundColor' => $arrayBackgroundColor[$i+4],
                'borderColor' => $arrayBorderColor[$i+4],
                'borderWidth' => BORDER,
                'data' => array(
                    $registros[$i]->enero,
                    $registros[$i]->febrero,
                    $registros[$i]->marzo,
                    $registros[$i]->abril,
                    $registros[$i]->mayo,
                    $registros[$i]->junio,
                    $registros[$i]->julio,
                    $registros[$i]->agosto,
                    $registros[$i]->septiembre,
                    $registros[$i]->octubre,
                    $registros[$i]->noviembre,
                    $registros[$i]->diciembre,
                ),
                arrayRandomNumber(12),
                'fill' => FILL,
            );
        }
        $this->response($resultado); //mensaje correcto en json
    }
    public function reporteMasaProducidaReal_get()
    {
        //CONSTANTES Y VARIABLES CONFIGURACIÓN GENERAL
        define("BORDER", 2);
        define("FILL", 'false');
        //Array de colores
        $arrayBackgroundColor = arrayBackgroundColor();
        $arrayBorderColor = arrayBorderColor();
        $registros = $this->ApiGrafico_model->ReporteMasaProducidaAnual();

        for ($i = 0; $i < count($registros); $i++) {
            $resultado[$i] = array(
                'label' => $registros[$i]->id . ' ' . $registros[$i]->nombre,
                'backgroundColor' => $arrayBackgroundColor[$i+7],
                'borderColor' => $arrayBorderColor[$i+7],
                'borderWidth' => BORDER,
                'data' => array(
                    $registros[$i]->enero,
                    $registros[$i]->febrero,
                    $registros[$i]->marzo,
                    $registros[$i]->abril,
                    $registros[$i]->mayo,
                    $registros[$i]->junio,
                    $registros[$i]->julio,
                    $registros[$i]->agosto,
                    $registros[$i]->septiembre,
                    $registros[$i]->octubre,
                    $registros[$i]->noviembre,
                    $registros[$i]->diciembre,
                ),
                arrayRandomNumber(12),
                'fill' => FILL,
            );
        }
        $this->response($resultado); //mensaje correcto en json
    }

}
