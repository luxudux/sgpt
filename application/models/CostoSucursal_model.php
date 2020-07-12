<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CostoSucursal_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='costos_sucursales_cat';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('costos_sucursales_cat.*,sucursales_cat.nombre AS sucursal,productos_cat.nombre AS producto,
     (SELECT COUNT(id_cost_suc) FROM ventas_cierre WHERE ventas_cierre.id_cost_suc=costos_sucursales_cat.id)  AS uso');
     $this->db->join('sucursales_cat', 'costos_sucursales_cat.id_sucursal=sucursales_cat.id');
     $this->db->join('productos_cat', 'costos_sucursales_cat.id_producto=productos_cat.id');
     $this->db->order_by("costos_sucursales_cat.id", "DESC");
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('costos_sucursales_cat.*,sucursales_cat.nombre AS sucursal,productos_cat.nombre AS producto,
     (SELECT COUNT(id_cost_suc) FROM ventas_cierre WHERE ventas_cierre.id_cost_suc=costos_sucursales_cat.id)  AS uso');
     $this->db->join('sucursales_cat', 'costos_sucursales_cat.id_sucursal=sucursales_cat.id');
     $this->db->join('productos_cat', 'costos_sucursales_cat.id_producto=productos_cat.id');
     $this->db->order_by("costos_sucursales_cat.id", "DESC");
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Mostrar por sucursal
   public function mostrar_por_id_sucursal($id){
     $table=$this->table;
     $this->db->select('costos_sucursales_cat.*,sucursales_cat.nombre AS sucursal,productos_cat.nombre AS producto,
     (SELECT COUNT(id_cost_suc) FROM ventas_cierre WHERE ventas_cierre.id_cost_suc=costos_sucursales_cat.id)  AS uso');
     $this->db->join('sucursales_cat', 'costos_sucursales_cat.id_sucursal=sucursales_cat.id');
     $this->db->join('productos_cat', 'costos_sucursales_cat.id_producto=productos_cat.id');
     $this->db->where('sucursales_cat.id',$id);
     $this->db->order_by("costos_sucursales_cat.id", "DESC");
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista activa
   public function mostrar_lista_activa(){
     $table=$this->table;
     $this->db->select('costos_sucursales_cat.*,sucursales_cat.nombre AS sucursal,productos_cat.nombre AS producto,
     (SELECT COUNT(id_cost_suc) FROM ventas_cierre WHERE ventas_cierre.id_cost_suc=costos_sucursales_cat.id)  AS uso');
     $this->db->join('sucursales_cat', 'costos_sucursales_cat.id_sucursal=sucursales_cat.id');
     $this->db->join('productos_cat', 'costos_sucursales_cat.id_producto=productos_cat.id');
     $this->db->where('costos_sucursales_cat.activo','1');
     $this->db->order_by("costos_sucursales_cat.id", "DESC");
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
      $query = $query=$this->db->get($table);;
      return $query->num_rows();
  }


 }
