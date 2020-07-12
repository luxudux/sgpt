<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ApiGrafico_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        
    }
    public function ReporteGastoAnual()
    {
        $table='grafico_gastos';
        //$table='grafico_gastos_anual';
        //$this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->result();
    }
    public function ReporteVentaAnual()
    {
        $table='grafico_ventas';
        $query = $this->db->get($table);
        return $query->result();
    }
    public function ReporteMermaAnual()
    {
        $table='grafico_mermas';
        $query = $this->db->get($table);
        return $query->result();
    }
    public function ReporteDevolucionAnual()
    {
        $table='grafico_devoluciones';
        $query = $this->db->get($table);
        return $query->result();
    }
    public function ReporteReparticionAnual()
    {
        $table='grafico_reparticiones';
        $query = $this->db->get($table);
        return $query->result();
    }
    public function ReporteMasaProducidaAnual()
    {
        $table='grafico_masaproducida';
        $query = $this->db->get($table);
        return $query->result();
    }


    
}
