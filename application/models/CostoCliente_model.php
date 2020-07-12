<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CostoCliente_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='costos_clientes_cat';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('costos_clientes_cat.*,clientes_cat.nombre AS cliente,productos_cat.nombre AS producto,
     (SELECT COUNT(id_cost_client) FROM reparticiones_cierre WHERE reparticiones_cierre.id_cost_client=costos_clientes_cat.id)  AS uso,
     productos_cat.id_grupop,gruposp_cat.nombre AS grupop');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('gruposp_cat', 'productos_cat.id_grupop=gruposp_cat.id');
     $this->db->order_by("costos_clientes_cat.id", "DESC");
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('costos_clientes_cat.*,clientes_cat.nombre AS cliente,productos_cat.nombre AS producto,
     (SELECT COUNT(id_cost_client) FROM reparticiones_cierre WHERE reparticiones_cierre.id_cost_client=costos_clientes_cat.id)  AS uso,
     productos_cat.id_grupop,gruposp_cat.nombre AS grupop');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('gruposp_cat', 'productos_cat.id_grupop=gruposp_cat.id');
     $this->db->order_by("costos_clientes_cat.id", "DESC");
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Mostrar lista por id cliente
   public function mostrar_por_id_cliente($id){
     $table=$this->table;
     $this->db->select('costos_clientes_cat.*,clientes_cat.nombre AS cliente,productos_cat.nombre AS producto,
     (SELECT COUNT(id_cost_client) FROM reparticiones_cierre WHERE reparticiones_cierre.id_cost_client=costos_clientes_cat.id)  AS uso,
     productos_cat.id_grupop,gruposp_cat.nombre AS grupop');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('gruposp_cat', 'productos_cat.id_grupop=gruposp_cat.id');
     $this->db->where('clientes_cat.id',$id);
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista con registros activos
   public function mostrar_lista_activa(){
     $table=$this->table;
     $this->db->select('costos_clientes_cat.*,clientes_cat.nombre AS cliente,productos_cat.nombre AS producto,
     (SELECT COUNT(id_cost_client) FROM reparticiones_cierre WHERE reparticiones_cierre.id_cost_client=costos_clientes_cat.id)  AS uso,
     productos_cat.id_grupop,gruposp_cat.nombre AS grupop');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('gruposp_cat', 'productos_cat.id_grupop=gruposp_cat.id');
     $this->db->where('costos_clientes_cat.activo','1');
     $this->db->order_by("costos_clientes_cat.id", "DESC");
     $query = $this->db->get($table);
     //$query=$this->db->count_all_results('user_sgpt');
     //return $query;
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
