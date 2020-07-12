<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model{
   function __construct() {
     parent::__construct();
     $this->table='user_sgpt';
   }
   public function validar($data){
     $this->db->select('id');
     $this->db->where($data);
     $query=$this->db->count_all_results($this->table);
     return $query;
   }
//dvuelve los datos de usuario para mostrar en la barra
   public function datos($data){
      $this->db->select('id,nombre');
      $this->db->where($data);
      $query = $this->db->get($this->table);
      return $query->result();
   }
}
