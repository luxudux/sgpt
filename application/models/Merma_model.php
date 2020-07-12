<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Merma_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='mermas_cat';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('mermas_cat.id,mermas_cat.nombre,mermas_cat.id_grupop,
     mermas_cat.bloqueado,gruposp_cat.nombre AS grupop');
     $this->db->join('gruposp_cat', 'mermas_cat.id_grupop=gruposp_cat.id');
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('mermas_cat.id,mermas_cat.nombre,mermas_cat.id_grupop,
     mermas_cat.bloqueado,gruposp_cat.nombre AS grupop');
     $this->db->join('gruposp_cat', 'mermas_cat.id_grupop=gruposp_cat.id');
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
