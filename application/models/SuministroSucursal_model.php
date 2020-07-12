<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SuministroSucursal_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='entrada_sucursal';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('entrada_sucursal.*,materia_prima_cat.nombre AS materiaPrima,ordenes.nota AS orden,
     ordenes.id_sucursal,sucursales_cat.nombre AS sucursal, entradas_almacen_gral.id_matprima, entradas_almacen_gral.id_proveedor,
     (entradas_almacen_gral.cantidad - entradas_almacen_gral.cantidad_usada) AS stock, entradas_almacen_gral.cantidad AS totalProducto,
     materia_prima_cat.id_grupom,gruposm_cat.nombre AS grupom,
     ordenes.fecha_ejec,ordenes.hora_ejec,ordenes.id_cierre,
     proveedores_cat.nombre AS proveedor');
     $this->db->join('entradas_almacen_gral', 'entrada_sucursal.id_almacen_gral=entradas_almacen_gral.id');
     $this->db->join('materia_prima_cat', 'entradas_almacen_gral.id_matprima=materia_prima_cat.id');
     $this->db->join('gruposm_cat', 'materia_prima_cat.id_grupom=gruposm_cat.id');
     $this->db->join('proveedores_cat', 'entradas_almacen_gral.id_proveedor=proveedores_cat.id');
     $this->db->join('ordenes', 'entrada_sucursal.id_orden=ordenes.id');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');
     $this->db->order_by('id_orden', 'DESC');
     $query = $this->db->get($table);
     //$query=$this->db->count_all_results('user_sgpt');
     //return $query;
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('entrada_sucursal.*,materia_prima_cat.nombre AS materiaPrima,ordenes.nota AS orden,
     ordenes.id_sucursal,sucursales_cat.nombre AS sucursal, entradas_almacen_gral.id_matprima, entradas_almacen_gral.id_proveedor,
     (entradas_almacen_gral.cantidad - entradas_almacen_gral.cantidad_usada) AS stock, entradas_almacen_gral.cantidad AS totalProducto,
     materia_prima_cat.id_grupom,gruposm_cat.nombre AS grupom,
     ordenes.fecha_ejec,ordenes.hora_ejec,ordenes.id_cierre,
     proveedores_cat.nombre AS proveedor');
     $this->db->join('entradas_almacen_gral', 'entrada_sucursal.id_almacen_gral=entradas_almacen_gral.id');
     $this->db->join('materia_prima_cat', 'entradas_almacen_gral.id_matprima=materia_prima_cat.id');
     $this->db->join('gruposm_cat', 'materia_prima_cat.id_grupom=gruposm_cat.id');
     $this->db->join('proveedores_cat', 'entradas_almacen_gral.id_proveedor=proveedores_cat.id');
     $this->db->join('ordenes', 'entrada_sucursal.id_orden=ordenes.id');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');
     $this->db->order_by('id_orden', 'DESC');
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Mostrar lista lista por id orden
   public function mostrar_por_id_orden($id){
     $table=$this->table;
     $this->db->select('entrada_sucursal.*,materia_prima_cat.nombre AS materiaPrima,ordenes.nota AS orden,
     ordenes.id_sucursal,sucursales_cat.nombre AS sucursal, entradas_almacen_gral.id_matprima, entradas_almacen_gral.id_proveedor,
     (entradas_almacen_gral.cantidad - entradas_almacen_gral.cantidad_usada) AS stock, entradas_almacen_gral.cantidad AS totalProducto,
     materia_prima_cat.id_grupom,gruposm_cat.nombre AS grupom,
     ordenes.fecha_ejec,ordenes.hora_ejec,ordenes.id_cierre,
     proveedores_cat.nombre AS proveedor');
     $this->db->join('entradas_almacen_gral', 'entrada_sucursal.id_almacen_gral=entradas_almacen_gral.id');
     $this->db->join('materia_prima_cat', 'entradas_almacen_gral.id_matprima=materia_prima_cat.id');
     $this->db->join('gruposm_cat', 'materia_prima_cat.id_grupom=gruposm_cat.id');
     $this->db->join('proveedores_cat', 'entradas_almacen_gral.id_proveedor=proveedores_cat.id');
     $this->db->join('ordenes', 'entrada_sucursal.id_orden=ordenes.id');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');
     $this->db->where('ordenes.id',$id);
     $this->db->order_by('id_orden', 'DESC');
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
