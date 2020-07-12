<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EntradaAlmacen_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='entradas_almacen_gral';
   }
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('entradas_almacen_gral.*,materia_prima_cat.nombre AS materiaPrima,proveedores_cat.nombre AS proveedor,
     (entradas_almacen_gral.cantidad - entradas_almacen_gral.cantidad_usada) AS stock');
     $this->db->join('materia_prima_cat', 'entradas_almacen_gral.id_matprima=materia_prima_cat.id');
     $this->db->join('proveedores_cat', 'entradas_almacen_gral.id_proveedor=proveedores_cat.id');
     $this->db->order_by('id', 'DESC');
     $query = $this->db->get($table);
     return $query->result();
   }
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('entradas_almacen_gral.*,materia_prima_cat.nombre AS materiaPrima,proveedores_cat.nombre AS proveedor,
     (entradas_almacen_gral.cantidad - entradas_almacen_gral.cantidad_usada) AS stock');
     $this->db->join('materia_prima_cat', 'entradas_almacen_gral.id_matprima=materia_prima_cat.id');
     $this->db->join('proveedores_cat', 'entradas_almacen_gral.id_proveedor=proveedores_cat.id');
     $this->db->order_by('id', 'DESC');
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //MOSTRA LA LISTA CON STOCK MAYOR A 0
   public function mostrar_lista_stock(){
     $table=$this->table;
     $this->db->select('entradas_almacen_gral.*,materia_prima_cat.nombre AS materiaPrima,proveedores_cat.nombre AS proveedor,
     (entradas_almacen_gral.cantidad - entradas_almacen_gral.cantidad_usada) AS stock');
     $this->db->join('materia_prima_cat', 'entradas_almacen_gral.id_matprima=materia_prima_cat.id');
     $this->db->join('proveedores_cat', 'entradas_almacen_gral.id_proveedor=proveedores_cat.id');
     $this->db->order_by('id', 'DESC');
     $this->db->where('(entradas_almacen_gral.cantidad - entradas_almacen_gral.cantidad_usada)>',0);
     $query = $this->db->get($table);
     return $query->result();
   }
   public function nuevo_ingreso($data){
     $table=$this->table;
     $this->db->insert($table,$data);
     $insert_id = $this->db->insert_id();
     return  $insert_id;
   }
   public function actualizar($id,$new_data){
      $table=$this->table;
      $this->db->where('id',$id);
      $result=$this->db->update($table, $new_data);
      return $result;
   }
   public function borrar($id){
     $table=$this->table;
     $this->db->where('id', $id);
     $result=$this->db->delete($table);
     return $result;
   }
   //Obtener el numero de registros
   function cuantos_registros(){
      $table=$this->table;
      $query = $query=$this->db->get($table);;
      return $query->num_rows();
  }

 }
