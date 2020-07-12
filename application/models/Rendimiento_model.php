<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rendimiento_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='rendimientos_cat';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('id,nombre,psaco_m,agua_m,psaco_h,agua_h,rmasa,deshidrata,rtortilla_m,rtortilla_h,activo,fecha_reg,bloqueado,
     (SELECT COUNT(id_rendimiento) FROM ordenes WHERE rendimientos_cat.id=ordenes.id_rendimiento)  AS uso');
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista activa
   public function mostrar_lista_activa(){
     $table=$this->table;
     $this->db->select('id,nombre,psaco_m,agua_m,psaco_h,agua_h,rmasa,deshidrata,rtortilla_m,rtortilla_h,activo,fecha_reg,bloqueado,
     (SELECT COUNT(id_rendimiento) FROM ordenes WHERE rendimientos_cat.id=ordenes.id_rendimiento)  AS uso');
     $this->db->where('rendimientos_cat.activo','1');
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('id,nombre,psaco_m,agua_m,psaco_h,agua_h,rmasa,deshidrata,rtortilla_m,rtortilla_h,activo,fecha_reg,bloqueado,
     (SELECT COUNT(id_rendimiento) FROM ordenes WHERE rendimientos_cat.id=ordenes.id_rendimiento)  AS uso');
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
