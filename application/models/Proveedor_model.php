<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proveedor_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='proveedores_cat';
   }
   //Mostrar proveedores lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('id,nombre,correo,telefono,activo');
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar proveedores lista activa
   public function mostrar_lista_activa(){
     $table=$this->table;
     $this->db->select('id,nombre,correo,telefono,activo');
     $this->db->where($this->table.'.activo', '1');
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('id,nombre,correo,telefono,activo');
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Nuevo proveedor
   public function nuevo_ingreso($data){
     # code...
     $this->db->insert($this->table,$data);
     $insert_id = $this->db->insert_id();
     return  $insert_id;
   }
   //Actualizar proveedor
   public function actualizar($id,$new_data){
     # code...
      $table=$this->table;
      $this->db->where('id',$id);
      $result=$this->db->update($table, $new_data);//Actualizar el registro
      return $result;
      //echo $result;
   }
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
