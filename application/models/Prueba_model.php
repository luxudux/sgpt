<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prueba_model extends CI_Model{
   function __construct() {
     parent::__construct();
   }
   //Mostrar lista de variables de prueba
   public function mostrar_lista(){
     $arreglo = array('is_object','is_string','is_bool',
 										'is_true','is_false','is_int','is_numeric',
 										'is_float','is_double','is_array','is_null',
 										'is_resource'	);
 		return $arreglo;
   }
   //Catalogo de clases, para cargarse en constructor
   public function catalogo_clases(){
     $arreglo = array('Puesto','Merma','Producto','Sucursal','MateriaPrima','Ruta','Cliente',
                      'Empleado','Proveedor','Reparticion','Grupo','Gasto',
                      'EntradaAlmacen','CostoCliente','CostoSucursal',
                      'Orden','SuministroCliente','SuministroSucursal',
                      'Cierre','CierreVenta','CierreGasto','CierreMerma','CierreDevolucion','CierreReparticion');
     return $arreglo;
   }
   //Clases simples de un registro del módulo Catálogos, sin FK
   public function catalogo_simple(){
     $arreglo = array('Puesto','Merma','Producto','Sucursal','MateriaPrima','Ruta','Proveedor','Grupo');
     return $arreglo;
   }
}
