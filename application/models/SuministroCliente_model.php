<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SuministroCliente_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='suministro_cliente';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('suministro_cliente.*,ordenes.nota AS orden,costos_clientes_cat.id_cliente,clientes_cat.nombre AS cliente,
     costos_clientes_cat.id_producto,productos_cat.nombre AS producto,
     ordenes.id_sucursal,sucursales_cat.nombre AS sucursal,
     ordenes.fecha_ejec,ordenes.hora_ejec,
     costos_clientes_cat.monto AS monto, productos_cat.id_grupop,gruposp_cat.nombre AS grupop, empleados_cat.nombre AS empleado ');
     $this->db->join('ordenes', 'suministro_cliente.id_orden=ordenes.id');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');

     $this->db->join('costos_clientes_cat', 'suministro_cliente.id_costo_cliente=costos_clientes_cat.id');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('gruposp_cat', 'productos_cat.id_grupop=gruposp_cat.id');
     $this->db->join('empleados_cat', 'suministro_cliente.id_empleado=empleados_cat.id');
     $this->db->order_by('id_orden', 'DESC');
     $query = $this->db->get($table);
     //$query=$this->db->count_all_results('user_sgpt');
     //return $query;
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('suministro_cliente.*,ordenes.nota AS orden,costos_clientes_cat.id_cliente,clientes_cat.nombre AS cliente,
     costos_clientes_cat.id_producto,productos_cat.nombre AS producto,
     ordenes.id_sucursal,sucursales_cat.nombre AS sucursal,
     costos_clientes_cat.monto AS monto, productos_cat.id_grupop,gruposp_cat.nombre AS grupop, empleados_cat.nombre AS empleado ');
     $this->db->join('ordenes', 'suministro_cliente.id_orden=ordenes.id');
     $this->db->join('sucursales_cat', 'ordenes.id_sucursal=sucursales_cat.id');

     $this->db->join('costos_clientes_cat', 'suministro_cliente.id_costo_cliente=costos_clientes_cat.id');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('gruposp_cat', 'productos_cat.id_grupop=gruposp_cat.id');
     $this->db->join('empleados_cat', 'suministro_cliente.id_empleado=empleados_cat.id');
     $this->db->order_by('id_orden', 'DESC');
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Mostrar lista lista por id orden
   public function mostrar_por_id_orden($id){
     $table=$this->table;
     $this->db->select('suministro_cliente.*,ordenes.nota AS orden,costos_clientes_cat.id_cliente,clientes_cat.nombre AS cliente,
     costos_clientes_cat.id_producto,productos_cat.nombre AS producto,
     costos_clientes_cat.monto AS monto, productos_cat.id_grupop,gruposp_cat.nombre AS grupop, empleados_cat.nombre AS empleado ');
     $this->db->join('ordenes', 'suministro_cliente.id_orden=ordenes.id');
     $this->db->join('costos_clientes_cat', 'suministro_cliente.id_costo_cliente=costos_clientes_cat.id');
     $this->db->join('clientes_cat', 'costos_clientes_cat.id_cliente=clientes_cat.id');
     $this->db->join('productos_cat', 'costos_clientes_cat.id_producto=productos_cat.id');
     $this->db->join('gruposp_cat', 'productos_cat.id_grupop=gruposp_cat.id');
     $this->db->join('empleados_cat', 'suministro_cliente.id_empleado=empleados_cat.id');
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
      $query = $query=$this->db->get($table);;
      return $query->num_rows();
   }

 }
