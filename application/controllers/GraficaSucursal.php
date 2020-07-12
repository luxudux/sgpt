<?php
defined('BASEPATH') or exit('No direct script access allowed');
class GraficaSucursal extends CI_Controller
{
    public function __construct()
    {
        # code...
        parent::__construct();

    }
    public function index()
    {
        $this->load->view('plantilla_head');
        $this->load->view('graficas/sucursal_vista');
        $this->load->view('plantilla_foot');
    }
    public function gastoAnual()
    {
        $this->load->view('plantilla_head');
        $this->load->view('graficas/gastoAnual_vista');
        $this->load->view('plantilla_foot');
    }
    public function ventaAnual()
    {
        $this->load->view('plantilla_head');
        $this->load->view('graficas/ventaAnual_vista');
        $this->load->view('plantilla_foot');
    }
    public function mermaAnual()
    {
        $this->load->view('plantilla_head');
        $this->load->view('graficas/mermaAnual_vista');
        $this->load->view('plantilla_foot');
    }
    public function devolucionAnual()
    {
        $this->load->view('plantilla_head');
        $this->load->view('graficas/devolucionAnual_vista');
        $this->load->view('plantilla_foot');
    }
    public function reparticionAnual()
    {
        $this->load->view('plantilla_head');
        $this->load->view('graficas/reparticionAnual_vista');
        $this->load->view('plantilla_foot');
    }
    public function masaproducidaAnual()
    {
        $this->load->view('plantilla_head');
        $this->load->view('graficas/masaproducidaAnual_vista');
        $this->load->view('plantilla_foot');
    }

}
