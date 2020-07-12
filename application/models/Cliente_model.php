<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cliente_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='clientes_cat';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('clientes_cat.*, rutas_cat.nombre as ruta');
     $this->db->join('rutas_cat', 'clientes_cat.id_ruta=rutas_cat.id');
     $query = $this->db->get($table);
     //$query=$this->db->count_all_results('user_sgpt');
     //return $query;
     return $query->result();
   }
   //Mostrar lista activa
   public function mostrar_lista_activa(){
     $table=$this->table;
     $this->db->select('clientes_cat.*, rutas_cat.nombre as ruta');
     $this->db->join('rutas_cat', 'clientes_cat.id_ruta=rutas_cat.id');
     $this->db->where($this->table.'.activo', '1');
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('clientes_cat.*, rutas_cat.nombre as ruta');
     $this->db->join('rutas_cat', 'clientes_cat.id_ruta=rutas_cat.id');
     $query = $this->db->get($table, $paginado, $inicio);
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
