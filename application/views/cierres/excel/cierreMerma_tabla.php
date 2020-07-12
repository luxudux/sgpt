<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';

//localhost/g1646015/sgpt/Cierre/excel/4030
$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-cierres-de-merma";
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
$spreadsheet->getActiveSheet()->setTitle('Reporte cierres de merma');

//ANCHO DE COLUMNAS

        $spreadsheet->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setWrapText(true);//ajustar texto
        $spreadsheet->getActiveSheet()->setAutoFilter('A2:E2');//Filtro
        //$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);//Ancho automático
        $spreadsheet->getActiveSheet()->mergeCells('A1:E1');//Combinar celdas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(20);//Alto de la fila 2
        $spreadsheet->getActiveSheet()->getStyle('A1')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:E2')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



        $spreadsheet->getActiveSheet()->getStyle('A2:E2')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')
              ->getFont()->applyFromArray($titulos);
        $spreadsheet->getActiveSheet()->getStyle('A2:E2')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'LISTA DE CIERRES DE MERMA');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'Id')
              ->setCellValue('B'.$fila , 'Cierre')
              ->setCellValue('C'.$fila , 'Sucursal')
              ->setCellValue('D'.$fila,  'Merma')
              ->setCellValue('E'.$fila , 'Cantidad');

$fila++;
$inF=$fila;//Inicio de fila de la suma
$total=0;
for($i=0; $i<count($cierreMerma); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , $cierreMerma[$i]->id)
              ->setCellValue('B'.$fila , $cierreMerma[$i]->id_cierre.':'.$cierreMerma[$i]->cierre)
              ->setCellValue('C'.$fila , $cierreMerma[$i]->id_sucursal.':'.$cierreMerma[$i]->sucursal)
              ->setCellValue('D'.$fila , $cierreMerma[$i]->id_merma.':'.$cierreMerma[$i]->merma)
              ->setCellValue('E'.$fila , $cierreMerma[$i]->cantidad);
              $total+=$cierreMerma[$i]->cantidad;
              $fila++;

              //PRIMEROS REGISTROS
              if((($i+1)<count($cierreMerma)) && ($cierreMerma[$i]->id_cierre!=$cierreMerma[($i+1)]->id_cierre))
              {
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('B'.$fila , 'TOTAL: ')
                        ->setCellValue('E'.$fila , $total);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':E'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':E'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $total=0;
              //ULTIMO REGISTRO
              }elseif($i==count($cierreMerma)-1){
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('B'.$fila , 'TOTAL: ')
                        ->setCellValue('E'.$fila , $total);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':E'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':E'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $total=0;
              }
}

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'E'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra
$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'A'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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
