<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cierre_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='cierres';
   }
   //Mostrar lista
   public function mostrar_lista(){
     $table=$this->table;
     $this->db->select('cierres.*, sucursales_cat.nombre as sucursal,
     (cant_vta_tm + cant_vta_th + cant_vta_m + cant_vta_sp + cant_vta_tt) AS cant_vta,
     (cant_merm_tm + cant_merm_th + cant_merm_m + cant_merm_sp + cant_merm_tt) AS cant_merm,
     (mto_vta_tm + mto_vta_th + mto_vta_m + mto_vta_sp + mto_vta_tt) AS mto_vta,

     IFNULL((SELECT SUM(cant_rep_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_tm,
     IFNULL((SELECT SUM(cant_rep_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_th,
     IFNULL((SELECT SUM(cant_rep_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_m,
     IFNULL((SELECT SUM(cant_rep_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_sp,
     IFNULL((SELECT SUM(cant_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_tt,

     IFNULL((SELECT SUM(cant_dev_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_tm,
     IFNULL((SELECT SUM(cant_dev_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_th,
     IFNULL((SELECT SUM(cant_dev_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_m,
     IFNULL((SELECT SUM(cant_dev_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_sp,
     IFNULL((SELECT SUM(cant_dev_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_tt,

     IFNULL((SELECT SUM(mto_rep_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_tm,
     IFNULL((SELECT SUM(mto_rep_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_th,
     IFNULL((SELECT SUM(mto_rep_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_m,
     IFNULL((SELECT SUM(mto_rep_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_sp,
     IFNULL((SELECT SUM(mto_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_tt,

     IFNULL((SELECT SUM(cant_mp_h) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_h,
     IFNULL((SELECT SUM(cant_mp_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_m,
     IFNULL((SELECT SUM(cant_mp_p) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_p,
     IFNULL((SELECT SUM(cant_mp_b) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_b,
     IFNULL((SELECT SUM(cant_mp_e) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_e,
     IFNULL((SELECT SUM(cant_mp_c) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_c,

     IFNULL((SELECT SUM(cant_rep_tm+cant_rep_th+cant_rep_m+cant_rep_sp+cant_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep,
     IFNULL((SELECT SUM(cant_dev_tm+cant_dev_th+cant_dev_m+cant_dev_sp+cant_dev_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev,
     IFNULL((SELECT SUM(mto_rep_tm+mto_rep_th+mto_rep_m+mto_rep_sp+mto_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep,
     ((SELECT COUNT(id_cierre) FROM ventas_cierre WHERE ventas_cierre.id_cierre=cierres.id)+
     (SELECT COUNT(id_cierre) FROM gastos_cierre WHERE gastos_cierre.id_cierre=cierres.id)+
     (SELECT COUNT(id_cierre) FROM mermas_cierre WHERE mermas_cierre.id_cierre=cierres.id)) AS uso,
     (SELECT COUNT(id_cierre) FROM ordenes WHERE ordenes.id_cierre=cierres.id) AS ouso');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->order_by("cierres.id", "DESC");
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar lista paginada
   public function mostrar_lista_paginada($inicio,$paginado){
     $table=$this->table;
     $this->db->select('cierres.*, sucursales_cat.nombre as sucursal,
     (cant_vta_tm + cant_vta_th + cant_vta_m + cant_vta_sp + cant_vta_tt) AS cant_vta,
     (cant_merm_tm + cant_merm_th + cant_merm_m + cant_merm_sp + cant_merm_tt) AS cant_merm,
     (mto_vta_tm + mto_vta_th + mto_vta_m + mto_vta_sp + mto_vta_tt) AS mto_vta,

     IFNULL((SELECT SUM(cant_rep_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_tm,
     IFNULL((SELECT SUM(cant_rep_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_th,
     IFNULL((SELECT SUM(cant_rep_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_m,
     IFNULL((SELECT SUM(cant_rep_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_sp,
     IFNULL((SELECT SUM(cant_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_tt,

     IFNULL((SELECT SUM(cant_dev_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_tm,
     IFNULL((SELECT SUM(cant_dev_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_th,
     IFNULL((SELECT SUM(cant_dev_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_m,
     IFNULL((SELECT SUM(cant_dev_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_sp,
     IFNULL((SELECT SUM(cant_dev_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_tt,

     IFNULL((SELECT SUM(mto_rep_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_tm,
     IFNULL((SELECT SUM(mto_rep_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_th,
     IFNULL((SELECT SUM(mto_rep_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_m,
     IFNULL((SELECT SUM(mto_rep_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_sp,
     IFNULL((SELECT SUM(mto_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_tt,

     IFNULL((SELECT SUM(cant_mp_h) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_h,
     IFNULL((SELECT SUM(cant_mp_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_m,
     IFNULL((SELECT SUM(cant_mp_p) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_p,
     IFNULL((SELECT SUM(cant_mp_b) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_b,
     IFNULL((SELECT SUM(cant_mp_e) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_e,
     IFNULL((SELECT SUM(cant_mp_c) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_c,

     IFNULL((SELECT SUM(cant_rep_tm+cant_rep_th+cant_rep_m+cant_rep_sp+cant_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep,
     IFNULL((SELECT SUM(cant_dev_tm+cant_dev_th+cant_dev_m+cant_dev_sp+cant_dev_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev,
     IFNULL((SELECT SUM(mto_rep_tm+mto_rep_th+mto_rep_m+mto_rep_sp+mto_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep,
     ((SELECT COUNT(id_cierre) FROM ventas_cierre WHERE ventas_cierre.id_cierre=cierres.id)+
     (SELECT COUNT(id_cierre) FROM gastos_cierre WHERE gastos_cierre.id_cierre=cierres.id)+
     (SELECT COUNT(id_cierre) FROM mermas_cierre WHERE mermas_cierre.id_cierre=cierres.id)) AS uso,
     (SELECT COUNT(id_cierre) FROM ordenes WHERE ordenes.id_cierre=cierres.id) AS ouso');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->order_by("cierres.id", "DESC");
     $query = $this->db->get($table, $paginado, $inicio);
     return $query->result();
   }
   //Mostrar cierre por id
   public function mostrar_por_id($id){
     $table=$this->table;
     $this->db->select('cierres.*, sucursales_cat.nombre as sucursal,
     (cant_vta_tm + cant_vta_th + cant_vta_m + cant_vta_sp + cant_vta_tt) AS cant_vta,
     (cant_merm_tm + cant_merm_th + cant_merm_m + cant_merm_sp + cant_merm_tt) AS cant_merm,
     (mto_vta_tm + mto_vta_th + mto_vta_m + mto_vta_sp + mto_vta_tt) AS mto_vta,

     IFNULL((SELECT SUM(cant_rep_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_tm,
     IFNULL((SELECT SUM(cant_rep_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_th,
     IFNULL((SELECT SUM(cant_rep_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_m,
     IFNULL((SELECT SUM(cant_rep_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_sp,
     IFNULL((SELECT SUM(cant_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_tt,

     IFNULL((SELECT SUM(cant_dev_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_tm,
     IFNULL((SELECT SUM(cant_dev_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_th,
     IFNULL((SELECT SUM(cant_dev_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_m,
     IFNULL((SELECT SUM(cant_dev_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_sp,
     IFNULL((SELECT SUM(cant_dev_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_tt,

     IFNULL((SELECT SUM(mto_rep_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_tm,
     IFNULL((SELECT SUM(mto_rep_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_th,
     IFNULL((SELECT SUM(mto_rep_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_m,
     IFNULL((SELECT SUM(mto_rep_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_sp,
     IFNULL((SELECT SUM(mto_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_tt,

    IFNULL((SELECT SUM(cant_mp_h) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_h,
    IFNULL((SELECT SUM(cant_mp_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_m,
    IFNULL((SELECT SUM(cant_mp_p) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_p,
    IFNULL((SELECT SUM(cant_mp_b) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_b,
    IFNULL((SELECT SUM(cant_mp_e) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_e,
    IFNULL((SELECT SUM(cant_mp_c) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_c,

     IFNULL((SELECT SUM(cant_rep_tm+cant_rep_th+cant_rep_m+cant_rep_sp+cant_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep,
     IFNULL((SELECT SUM(cant_dev_tm+cant_dev_th+cant_dev_m+cant_dev_sp+cant_dev_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev,
     IFNULL((SELECT SUM(mto_rep_tm+mto_rep_th+mto_rep_m+mto_rep_sp+mto_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep,
     ((SELECT COUNT(id_cierre) FROM ventas_cierre WHERE ventas_cierre.id_cierre=cierres.id)+
     (SELECT COUNT(id_cierre) FROM gastos_cierre WHERE gastos_cierre.id_cierre=cierres.id)+
     (SELECT COUNT(id_cierre) FROM mermas_cierre WHERE mermas_cierre.id_cierre=cierres.id)) AS uso,
     (SELECT COUNT(id_cierre) FROM ordenes WHERE ordenes.id_cierre=cierres.id) AS ouso');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->where('cierres.id',$id);
     $query = $this->db->get($table);
     return $query->result();
   }
   //Mostrar cierre sin bloqueo
   public function mostrar_lista_no_bloqueada(){
     $table=$this->table;
     $this->db->select('cierres.*, sucursales_cat.nombre as sucursal,
     (cant_vta_tm + cant_vta_th + cant_vta_m + cant_vta_sp + cant_vta_tt) AS cant_vta,
     (cant_merm_tm + cant_merm_th + cant_merm_m + cant_merm_sp + cant_merm_tt) AS cant_merm,
     (mto_vta_tm + mto_vta_th + mto_vta_m + mto_vta_sp + mto_vta_tt) AS mto_vta,

     IFNULL((SELECT SUM(cant_rep_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_tm,
     IFNULL((SELECT SUM(cant_rep_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_th,
     IFNULL((SELECT SUM(cant_rep_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_m,
     IFNULL((SELECT SUM(cant_rep_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_sp,
     IFNULL((SELECT SUM(cant_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep_tt,

     IFNULL((SELECT SUM(cant_dev_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_tm,
     IFNULL((SELECT SUM(cant_dev_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_th,
     IFNULL((SELECT SUM(cant_dev_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_m,
     IFNULL((SELECT SUM(cant_dev_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_sp,
     IFNULL((SELECT SUM(cant_dev_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev_tt,

     IFNULL((SELECT SUM(mto_rep_tm) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_tm,
     IFNULL((SELECT SUM(mto_rep_th) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_th,
     IFNULL((SELECT SUM(mto_rep_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_m,
     IFNULL((SELECT SUM(mto_rep_sp) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_sp,
     IFNULL((SELECT SUM(mto_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep_tt,

    IFNULL((SELECT SUM(cant_mp_h) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_h,
    IFNULL((SELECT SUM(cant_mp_m) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_m,
    IFNULL((SELECT SUM(cant_mp_p) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_p,
    IFNULL((SELECT SUM(cant_mp_b) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_b,
    IFNULL((SELECT SUM(cant_mp_e) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_e,
    IFNULL((SELECT SUM(cant_mp_c) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_mp_c,

     IFNULL((SELECT SUM(cant_rep_tm+cant_rep_th+cant_rep_m+cant_rep_sp+cant_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_rep,
     IFNULL((SELECT SUM(cant_dev_tm+cant_dev_th+cant_dev_m+cant_dev_sp+cant_dev_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS cant_dev,
     IFNULL((SELECT SUM(mto_rep_tm+mto_rep_th+mto_rep_m+mto_rep_sp+mto_rep_tt) from ordenes WHERE ordenes.id_cierre=cierres.id),0) AS mto_rep,
     ((SELECT COUNT(id_cierre) FROM ventas_cierre WHERE ventas_cierre.id_cierre=cierres.id)+
     (SELECT COUNT(id_cierre) FROM gastos_cierre WHERE gastos_cierre.id_cierre=cierres.id)+
     (SELECT COUNT(id_cierre) FROM mermas_cierre WHERE mermas_cierre.id_cierre=cierres.id)) AS uso,
     (SELECT COUNT(id_cierre) FROM ordenes WHERE ordenes.id_cierre=cierres.id) AS ouso');
     $this->db->join('sucursales_cat', 'cierres.id_sucursal=sucursales_cat.id');
     $this->db->where('cierres.bloqueado','0');
     $this->db->order_by("cierres.id", "DESC");
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
      $table=$this->table;
      $this->db->where('id',$id);
      $result=$this->db->update($table, $new_data);//Actualizar el registro
      return $result;
   }
   //Borrar
   public function borrar($id){
     $table=$this->table;
     $this->db->where('id', $id);
     $result=$this->db->delete($table);
     return $result;
   }
   //Obtener el numero de registros
   function cuantos_registros(){
      $table=$this->table;
      $query = $query=$this->db->get($table);
      return $query->num_rows();
  }

 }
