<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';


$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-empleados";
//Colores de fondo
$franjaAmarilla=tipFranjaAmarilla();//amarillo subrayado
$franjaVerde=tipFranjaVerde();
$franjaAzul=tipFranjaAzul();
$franjaGris=tipFranjaGris();//gris titulo
//Estilos de letra
$titulos=tipTitulosColumnas();
$letraNegra=tipNegraTotales();
// Set document properties
$spreadsheet->getProperties()->setCreator('SGPT')
    ->setLastModifiedBy('SGPT')
    ->setTitle('Office 2007 XLSX Documento')
    ->setSubject('Office 2007 XLSX Documento')
    ->setDescription('Documento para Office 2007 XLSX, gnerado usando clases de PHP.')
    ->setKeywords('office 2007 openxml php')
    ->setCategory('Reporte');
// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Empleados');

//ANCHO DE COLUMNAS
        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setWrapText(true);//ajustar
        $spreadsheet->getActiveSheet()->setAutoFilter('A2:G2');//Filtro
        $spreadsheet->getActiveSheet()->mergeCells('A1:G1');//Combinar
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);//Ancho
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);

        $spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(20);//Alto
        $spreadsheet->getActiveSheet()->getStyle('A1:G2')
               ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        $spreadsheet->getActiveSheet()->getStyle('A1:G2')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'LISTA DE EMPLEADOS');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'Id')
              ->setCellValue('B'.$fila , 'Nombre')
              ->setCellValue('C'.$fila , 'Dirección')
              ->setCellValue('D'.$fila , 'Teléfono')
              ->setCellValue('E'.$fila , 'Nacimiento')
              ->setCellValue('F'.$fila , 'Puesto')
              ->setCellValue('G'.$fila , 'Sucursal');

$fila++;
$inF=$fila;//Inicio de fila de la suma
for($i=0; $i<count($empleado); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , $empleado[$i]->id)
              ->setCellValue('B'.$fila , $empleado[$i]->nombre)
              ->setCellValue('C'.$fila , $empleado[$i]->direccion)
              ->setCellValue('D'.$fila , $empleado[$i]->telefono)
              ->setCellValue('E'.$fila , nice_date($empleado[$i]->nacimiento, 'd-m-Y'))
              ->setCellValue('F'.$fila , $empleado[$i]->id_puesto.''.$empleado[$i]->puesto)
              ->setCellValue('G'.$fila , $empleado[$i]->id_sucursal.''.$empleado[$i]->sucursal);
              $fila++;
  }

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'G'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra azul
$spreadsheet->getActiveSheet()->getStyle('D'.$inF.':'.'E'.$fila)
       ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$Excel_writer->save('php://output');
//LIMIPAR
$spreadsheet->disconnectWorksheets();
unset($spreadsheet);
