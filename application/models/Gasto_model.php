<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gasto_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='gastos_cat';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table_gasto=$this->table;
     $this->db->select('gastos_cat.*,grupo_cat.nombre as grupo');
     $this->db->join('grupo_cat', 'gastos_cat.id_grupo=grupo_cat.id');
     $query = $this->db->get($table_gasto);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table_gasto=$this->table;
     $this->db->select('gastos_cat.*,grupo_cat.nombre as grupo');
     $this->db->join('grupo_cat', 'gastos_cat.id_grupo=grupo_cat.id');
     $query = $this->db->get($table_gasto, $paginado, $inicio);
     // Executes: SELECT * FROM mytable LIMIT 20, 10
     return $query->result();
   }
   //Nuevo
   public function nuevo_ingreso($data){
     $table_gasto=$this->table;
     $this->db->insert($table_gasto,$data);
     $insert_id = $this->db->insert_id();
     return  $insert_id;
   }
   //Actualizar
   public function actualizar($id,$new_data){
     # code...
      $table_gasto=$this->table;
      $this->db->where('id',$id);
      $result=$this->db->update($table_gasto, $new_data);//Actualizar el registro
      return $result;
      //echo $result;
   }
   //Borrar
   public function borrar($id){
     # code...
     $table_gasto=$this->table;
     $this->db->where('id', $id);
     $result=$this->db->delete($table_gasto);
     return $result;
     //echo $result;
   }
   //Obtener el numero de registros
   function cuantos_registros(){
      $table_gasto=$this->table;
      $query = $query=$this->db->get($table_gasto);;
      return $query->num_rows();
  }

}
