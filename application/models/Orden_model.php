<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orden_model extends CI_Model{
   function __construct() {
     parent::__construct();
    $this->table='ordenes';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('ordenes.*, sucursales_cat.nombre as sucursal, rendimientos_cat.nombre as rendimiento,
     (cant_rep_tm+cant_rep_th+cant_rep_m+cant_rep_sp+cant_rep_tt) AS cant_rep,
     (cant_dev_tm+cant_dev_th+cant_dev_m+cant_dev_sp+cant_dev_tt) AS cant_dev,
     (mto_rep_tm+mto_rep_th+mto_rep_m+mto_rep_sp+mto_rep_tt) AS mto_rep,
     ((SELECT COUNT(id_orden) FROM suministro_cliente WHERE suministro_cliente.id_orden=ordenes.id)+
     (SELECT COUNT(id_orden) FROM entrada_sucursal WHERE entrada_sucursal.id_orden=ordenes.id)) AS uso');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');
     $this->db->join('rendimientos_cat', 'ordenes.id_rendimiento=rendimientos_cat.id');
     $this->db->order_by("ordenes.id", "desc");
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('ordenes.*, sucursales_cat.nombre as sucursal, rendimientos_cat.nombre as rendimiento,
     (cant_rep_tm+cant_rep_th+cant_rep_m+cant_rep_sp+cant_rep_tt) AS cant_rep,
     (cant_dev_tm+cant_dev_th+cant_dev_m+cant_dev_sp+cant_dev_tt) AS cant_dev,
     (mto_rep_tm+mto_rep_th+mto_rep_m+mto_rep_sp+mto_rep_tt) AS mto_rep,
     ((SELECT COUNT(id_orden) FROM suministro_cliente WHERE suministro_cliente.id_orden=ordenes.id)+
     (SELECT COUNT(id_orden) FROM entrada_sucursal WHERE entrada_sucursal.id_orden=ordenes.id)) AS uso');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');
     $this->db->join('rendimientos_cat', 'ordenes.id_rendimiento=rendimientos_cat.id');
     $this->db->order_by("ordenes.id", "desc");
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Mostrar registro por id
   public function mostrar_por_id($id){
     $table=$this->table;
     $this->db->select('ordenes.*, sucursales_cat.nombre as sucursal, rendimientos_cat.nombre as rendimiento,
     (cant_rep_tm+cant_rep_th+cant_rep_m+cant_rep_sp+cant_rep_tt) AS cant_rep,
     (cant_dev_tm+cant_dev_th+cant_dev_m+cant_dev_sp+cant_dev_tt) AS cant_dev,
     (mto_rep_tm+mto_rep_th+mto_rep_m+mto_rep_sp+mto_rep_tt) AS mto_rep,
     ((SELECT COUNT(id_orden) FROM suministro_cliente WHERE suministro_cliente.id_orden=ordenes.id)+
     (SELECT COUNT(id_orden) FROM entrada_sucursal WHERE entrada_sucursal.id_orden=ordenes.id)) AS uso');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');
     $this->db->join('rendimientos_cat', 'ordenes.id_rendimiento=rendimientos_cat.id');
     $this->db->where('ordenes.id',$id);
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar ordenes sin cierre
   public function mostrar_lista_sin_cierre(){
     $table=$this->table;
     $this->db->select('ordenes.*, sucursales_cat.nombre as sucursal, rendimientos_cat.nombre as rendimiento,
     (cant_rep_tm+cant_rep_th+cant_rep_m+cant_rep_sp+cant_rep_tt) AS cant_rep,
     (cant_dev_tm+cant_dev_th+cant_dev_m+cant_dev_sp+cant_dev_tt) AS cant_dev,
     (mto_rep_tm+mto_rep_th+mto_rep_m+mto_rep_sp+mto_rep_tt) AS mto_rep,
     ((SELECT COUNT(id_orden) FROM suministro_cliente WHERE suministro_cliente.id_orden=ordenes.id)+
     (SELECT COUNT(id_orden) FROM entrada_sucursal WHERE entrada_sucursal.id_orden=ordenes.id)) AS uso');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');
     $this->db->join('rendimientos_cat', 'ordenes.id_rendimiento=rendimientos_cat.id');
     $this->db->order_by("ordenes.id", "desc");
     $this->db->where('ordenes.id_cierre is NULL');
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
      $table=$this->table;
      $this->db->where('id',$id);
      $result=$this->db->update($table, $new_data);
      return $result;
   }
   //Actualiza los numero de cierre
   public function actualizar_cierre($ids,$new_data){
     $table=$this->table;
     $this->db->where_in('id', $ids);
     $result=$this->db->update($table, $new_data);
     return $result;
   }
   //Borrar orden
   public function borrar($id){
     # code...
     $table=$this->table;
     $this->db->where('id', $id);
     $result=$this->db->delete($table);
     return $result;
   }

   //Actualiza a null un cierre
   public function actualizar_cierre_null($id,$data){
     $table=$this->table;
     if(empty($data)){$data=null;}
     $this->db->set('id_cierre', $data);
     $this->db->where_in('id', $id);
     $result=$this->db->update($table);
     return $result;
   }
   //Lista ordenes sin cierres
   public function sincierre(){
     $table=$this->table;
     $this->db->where('id_cierre IS NULL');
     $query = $this->db->get($table);
     return $query->result();
   }

   //Lista ordenes con cierres
   public function concierre(){
     $table=$this->table;
     $this->db->where('id_cierre IS NOT NULL');
     $query = $this->db->get($table);
     return $query->result();
   }
   //Obtener el numero de registros
   function cuantos_registros(){
      $table=$this->table;
      $query = $query=$this->db->get($table);;
      return $query->num_rows();
  }

 }
