<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';

//localhost/g1646015/sgpt/Cierre/excel/4030
$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-suministro-sucursales";
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
$spreadsheet->getActiveSheet()->setTitle('Tabla de suministro a sucursal');

//ANCHO DE COLUMNAS

        $spreadsheet->getActiveSheet()->getStyle('A2:J2')->getAlignment()->setWrapText(true);//ajustar texto
        $spreadsheet->getActiveSheet()->setAutoFilter('A2:J2');//Filtro
        $spreadsheet->getActiveSheet()->mergeCells('A1:J1');//Combinar celdas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(33);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(22);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $spreadsheet->getActiveSheet()->getRowDimension('4')->setRowHeight(20);//Alto de la fila 2
        $spreadsheet->getActiveSheet()->getStyle('A1')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:J2')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



        $spreadsheet->getActiveSheet()->getStyle('A2:J2')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        // $spreadsheet->getActiveSheet()->getStyle('A2')
        //   ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);//Color de letra rojo


        $spreadsheet->getActiveSheet()->getStyle('A1:J2')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'SUMINISTRO A SUCURSALES');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'No.')
              ->setCellValue('B'.$fila , 'Orden')
              ->setCellValue('C'.$fila , 'Sucursal')
              ->setCellValue('D'.$fila , 'Producto')
              ->setCellValue('E'.$fila , 'Grupo')
              ->setCellValue('F'.$fila , 'Cantidad Suministrada')
              ->setCellValue('G'.$fila , 'Proveedor')
              ->setCellValue('H'.$fila , 'Stock')
              ->setCellValue('I'.$fila , 'Fecha Orden')
              ->setCellValue('J'.$fila , 'No. Cierre');

$fila++;
$inF=$fila;//Inicio de fila de la suma
$total=0;
for($i=0; $i<count($suministroSucursal); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
             ->setCellValue('A'.$fila , $suministroSucursal[$i]->id)
             ->setCellValue('B'.$fila , $suministroSucursal[$i]->id_orden.':'.$suministroSucursal[$i]->orden)
             ->setCellValue('C'.$fila , $suministroSucursal[$i]->id_sucursal.':'.$suministroSucursal[$i]->sucursal)
             ->setCellValue('D'.$fila , $suministroSucursal[$i]->id_matprima.':'.$suministroSucursal[$i]->materiaPrima)
             ->setCellValue('E'.$fila , $suministroSucursal[$i]->id_grupom.':'.$suministroSucursal[$i]->grupom)
             ->setCellValue('F'.$fila , $suministroSucursal[$i]->cantidad)
             ->setCellValue('G'.$fila , $suministroSucursal[$i]->id_proveedor.':'.$suministroSucursal[$i]->proveedor)
             ->setCellValue('H'.$fila , $suministroSucursal[$i]->stock)
             ->setCellValue('I'.$fila , $suministroSucursal[$i]->fecha_ejec.':'.$suministroSucursal[$i]->hora_ejec)
             ->setCellValue('J'.$fila , $suministroSucursal[$i]->id_cierre);
              $total+=$suministroSucursal[$i]->cantidad;
              $fila++;

              //PRIMEROS REGISTROS
              if((($i+1)<count($suministroSucursal)) && ($suministroSucursal[$i]->id_orden!=$suministroSucursal[($i+1)]->id_orden))
              {
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('A'.$fila , 'TOTAL')
                        ->setCellValue('B'.$fila , 'ORDEN: # '.$suministroSucursal[$i]->id_orden)
                        ->setCellValue('F'.$fila , $total)
                        ->setCellValue('I'.$fila , $suministroSucursal[$i]->fecha_ejec.':'.$suministroSucursal[$i]->hora_ejec)
                        ->setCellValue('J'.$fila , $suministroSucursal[$i]->id_cierre);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':J'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':J'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $total=0;
              //ULTIMO REGISTRO
              }elseif($i==count($suministroSucursal)-1){
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('A'.$fila , 'TOTAL')
                        ->setCellValue('B'.$fila , 'ORDEN: # '.$suministroSucursal[$i]->id_orden)
                        ->setCellValue('F'.$fila , $total)
                        ->setCellValue('I'.$fila , $suministroSucursal[$i]->fecha_ejec.':'.$suministroSucursal[$i]->hora_ejec)
                        ->setCellValue('J'.$fila , $suministroSucursal[$i]->id_cierre);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':J'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':J'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $total=0;
              }
 }

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'J'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra azul
$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'A'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()->getStyle('F'.$inF.':'.'F'.$fila)->getNumberFormat()
      ->setFormatCode('#,##0.00');
$spreadsheet->getActiveSheet()->getStyle('H'.$inF.':'.'H'.$fila)->getNumberFormat()
      ->setFormatCode('#,##0.00');
//Fin contenido

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
