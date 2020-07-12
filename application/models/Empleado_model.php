<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Empleado_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='empleados_cat';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('empleados_cat.*,
                        puestos_cat.nombre as puesto,
                        sucursales_cat.nombre as sucursal');
     $this->db->join('puestos_cat', 'empleados_cat.id_puesto=puestos_cat.id');
     $this->db->join('sucursales_cat', 'empleados_cat.id_sucursal=sucursales_cat.id');
     $this->db->order_by("empleados_cat.id", "DESC");
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista activa
   public function mostrar_lista_activa(){
     $table=$this->table;
     $this->db->select('empleados_cat.*,
                        puestos_cat.nombre as puesto,
                        sucursales_cat.nombre as sucursal');
     $this->db->join('puestos_cat', 'empleados_cat.id_puesto=puestos_cat.id');
     $this->db->join('sucursales_cat', 'empleados_cat.id_sucursal=sucursales_cat.id');
     $this->db->order_by("empleados_cat.id", "DESC");
     $this->db->where($this->table.'.activo', '1');
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('empleados_cat.*,
                        puestos_cat.nombre as puesto,
                        sucursales_cat.nombre as sucursal');
     $this->db->join('puestos_cat', 'empleados_cat.id_puesto=puestos_cat.id');
     $this->db->join('sucursales_cat', 'empleados_cat.id_sucursal=sucursales_cat.id');
     $this->db->order_by("empleados_cat.id", "DESC");
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }

   //Muestra lista filtrando segun el puesto y activo
   public function mostrar_lista_repartidor(){
     //$puesto='Repartidor';
     $table=$this->table;
     $this->db->select('empleados_cat.id,empleados_cat.nombre,empleados_cat.id_puesto,empleados_cat.id_sucursal,
                        puestos_cat.nombre as puesto,
                        sucursales_cat.nombre as sucursal');
     $this->db->join('puestos_cat', 'empleados_cat.id_puesto=puestos_cat.id');
     $this->db->join('sucursales_cat', 'empleados_cat.id_sucursal=sucursales_cat.id');
     $this->db->where($this->table.'.activo', '1');
     $this->db->where('puestos_cat.id', '1');
     $this->db->or_where('puestos_cat.id', '3');
     $this->db->order_by("empleados_cat.id", "DESC");
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
  //Mostrar lista empleados sin ruta
  public function mostrar_lista_sinruta(){
    $table=$this->table;
    $this->db->select('empleados_cat.id,empleados_cat.nombre,empleados_cat.id_puesto,puestos_cat.nombre AS puesto,
    reparticiones_cat.id AS sinruta');
    $this->db->join('puestos_cat', 'empleados_cat.id_puesto=puestos_cat.id');
    $this->db->join('reparticiones_cat', 'empleados_cat.id=reparticiones_cat.id_empleado', 'left');
    $this->db->having('sinruta IS NULL');
    $query = $this->db->get($table);
    return $query->result();
  }


 }
