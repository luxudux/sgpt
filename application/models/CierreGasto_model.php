<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CierreGasto_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='gastos_cierre';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('gastos_cierre.*,cierres.id_sucursal,cierres.nota AS cierre,sucursales_cat.nombre AS sucursal,gastos_cat.nombre AS gasto,
     gastos_cat.id_grupo, grupo_cat.nombre AS grupo,cierres.bloqueado');
     $this->db->join('cierres', 'gastos_cierre.id_cierre=cierres.id');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->join('gastos_cat', 'gastos_cierre.id_gasto=gastos_cat.id');
     $this->db->join('grupo_cat', 'gastos_cat.id_grupo=grupo_cat.id');

     $this->db->order_by('id_cierre', 'DESC');
     $query = $this->db->get($table);
     //$query=$this->db->count_all_results('user_sgpt');
     //return $query;
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('gastos_cierre.*,cierres.id_sucursal,cierres.nota AS cierre,sucursales_cat.nombre AS sucursal,gastos_cat.nombre AS gasto,
     gastos_cat.id_grupo, grupo_cat.nombre AS grupo,cierres.bloqueado');
     $this->db->join('cierres', 'gastos_cierre.id_cierre=cierres.id');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->join('gastos_cat', 'gastos_cierre.id_gasto=gastos_cat.id');
     $this->db->join('grupo_cat', 'gastos_cat.id_grupo=grupo_cat.id');
     $this->db->order_by('id_cierre', 'DESC');
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Mostrar lista por id_cierre
   public function mostrar_por_id_cierre($id){
     $table=$this->table;
     $this->db->select('gastos_cierre.*,cierres.id_sucursal,cierres.nota AS cierre,sucursales_cat.nombre AS sucursal,gastos_cat.nombre AS gasto,
     gastos_cat.id_grupo, grupo_cat.nombre AS grupo,cierres.bloqueado');
     $this->db->join('cierres', 'gastos_cierre.id_cierre=cierres.id');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->join('gastos_cat', 'gastos_cierre.id_gasto=gastos_cat.id');
     $this->db->join('grupo_cat', 'gastos_cat.id_grupo=grupo_cat.id');
     $this->db->order_by('id_cierre', 'DESC');
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
