<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';


$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-gastos";
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
$spreadsheet->getActiveSheet()->setTitle('Gastos');

//ANCHO DE COLUMNAS
        $spreadsheet->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setWrapText(true);//ajustar
        $spreadsheet->getActiveSheet()->setAutoFilter('A2:E2');//Filtro
        $spreadsheet->getActiveSheet()->mergeCells('A1:E1');//Combinar
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);//Ancho
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(35);


        $spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(30);//Alto
        $spreadsheet->getActiveSheet()->getStyle('A1:E2')
               ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()->getStyle('A2:E2')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        $spreadsheet->getActiveSheet()->getStyle('A1:E2')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'LISTA DE REPARTICIONES');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'Id')
              ->setCellValue('B'.$fila , 'Empleado')
              ->setCellValue('C'.$fila , 'Puesto')
              ->setCellValue('D'.$fila , 'Sucursal')
              ->setCellValue('E'.$fila , 'Ruta');

$fila++;
$inF=$fila;//Inicio de fila de la suma
for($i=0; $i<count($reparticion); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , $reparticion[$i]->id)
              ->setCellValue('B'.$fila , $reparticion[$i]->id_empleado.' : '.$reparticion[$i]->empleado)
              ->setCellValue('C'.$fila , $reparticion[$i]->id_puesto.' : '.$reparticion[$i]->puesto)
              ->setCellValue('D'.$fila , $reparticion[$i]->id_sucursal.' : '.$reparticion[$i]->sucursal)
              ->setCellValue('E'.$fila , $reparticion[$i]->id_ruta.' : '.$reparticion[$i]->ruta)
              ;
              $fila++;
  }

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'E'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra azul
$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'A'.$fila)
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
