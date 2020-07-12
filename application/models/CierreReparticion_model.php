<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CierreReparticion_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='reparticiones_cierre';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('reparticiones_cierre.*,cierres.id_sucursal,cierres.nota AS cierre,costos_clientes_cat.id_cliente,clientes_cat.id_ruta,rutas_cat.nombre AS ruta,clientes_cat.nombre AS cliente,costos_clientes_cat.id_producto,costos_clientes_cat.monto,productos_cat.nombre AS producto,sucursales_cat.nombre AS sucursal,empleados_cat.nombre AS empleado_ejec');
     $this->db->join('cierres', 'reparticiones_cierre.id_cierre=cierres.id');


     $this->db->join('costos_clientes_cat', 'reparticiones_cierre.id_cost_client=costos_clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('rutas_cat', 'clientes_cat.id_ruta=rutas_cat.id');

     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->join('empleados_cat', 'reparticiones_cierre.id_empleado=empleados_cat.id');
     $this->db->order_by('id_cierre', 'DESC');
     $query = $this->db->get($table);
     //$query=$this->db->count_all_results('user_sgpt');
     //return $query;
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('reparticiones_cierre.*,cierres.id_sucursal,cierres.nota AS cierre,costos_clientes_cat.id_cliente,clientes_cat.id_ruta,rutas_cat.nombre AS ruta,clientes_cat.nombre AS cliente,costos_clientes_cat.id_producto,costos_clientes_cat.monto,productos_cat.nombre AS producto,sucursales_cat.nombre AS sucursal,empleados_cat.nombre AS empleado_ejec');
     $this->db->join('cierres', 'reparticiones_cierre.id_cierre=cierres.id');
     $this->db->join('costos_clientes_cat', 'reparticiones_cierre.id_cost_client=costos_clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('rutas_cat', 'clientes_cat.id_ruta=rutas_cat.id');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->join('empleados_cat', 'reparticiones_cierre.id_empleado=empleados_cat.id');
     $this->db->order_by('id_cierre', 'DESC');
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Mostrar lista por id_cierre
   public function mostrar_por_id_cierre($id){
     $table=$this->table;
     $this->db->select('reparticiones_cierre.*,cierres.id_sucursal,cierres.nota AS cierre,costos_clientes_cat.id_cliente,clientes_cat.id_ruta,rutas_cat.nombre AS ruta,clientes_cat.nombre AS cliente,costos_clientes_cat.id_producto,costos_clientes_cat.monto,productos_cat.nombre AS producto,sucursales_cat.nombre AS sucursal,empleados_cat.nombre AS empleado_ejec');
     $this->db->join('cierres', 'reparticiones_cierre.id_cierre=cierres.id');
     $this->db->join('costos_clientes_cat', 'reparticiones_cierre.id_cost_client=costos_clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('rutas_cat', 'clientes_cat.id_ruta=rutas_cat.id');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->join('empleados_cat', 'reparticiones_cierre.id_empleado=empleados_cat.id');
     $this->db->where('cierres.id',$id);
     $query = $this->db->get($table);
     return $query->result();

   }
   //Nuevo
   public function nuevo_ingreso($data){
     $table=$this->table;
     $this->db->insert($table,$data);
     $insert_id = $this->db->insert_id();
     return  $insert_id;
   }
   //Actualizar
   public function actualizar($id,$new_data){
     # code...
      $table=$this->table;
      $this->db->where('id',$id);
      $result=$this->db->update($table, $new_data);//Actualizar el registro
      return $result;
      //echo $result;
   }
   //Borrar
   public function borrar($id){
     # code...
     $table=$this->table;
     $this->db->where('id', $id);
     $result=$this->db->delete($table);
     return $result;
     //echo $result;
   }
   //Obtener el numero de registros
   function cuantos_registros(){
    $table=$this->table;
      $query = $query=$this->db->get($table);
      return $query->num_rows();
  }

 }
