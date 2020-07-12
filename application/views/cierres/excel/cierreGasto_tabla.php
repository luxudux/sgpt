<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';

//localhost/g1646015/sgpt/Cierre/excel/4030
$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-cierres-de-gasto";
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
$spreadsheet->getActiveSheet()->setTitle('Reporte cierres de gasto');

//ANCHO DE COLUMNAS
        $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setWrapText(true);//ajustar texto
        $spreadsheet->getActiveSheet()->setAutoFilter('A2:F2');//Filtro
        //$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);//Ancho automático
        $spreadsheet->getActiveSheet()->mergeCells('A1:F1');//Combinar celdas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(20);//Alto de la fila
        $spreadsheet->getActiveSheet()->getStyle('A1')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:F2')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



        $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        $spreadsheet->getActiveSheet()->getStyle('A1:F1')
              ->getFont()->applyFromArray($titulos);
        $spreadsheet->getActiveSheet()->getStyle('A2:F2')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'LISTA DE CIERRES DE GASTO');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'Id')
              ->setCellValue('B'.$fila , 'Cierre')
              ->setCellValue('C'.$fila , 'Sucursal')
              ->setCellValue('D'.$fila,  'Gasto')
              ->setCellValue('E'.$fila , 'Grupo')
              ->setCellValue('F'.$fila , 'Monto');

$fila++;
$inF=$fila;//Inicio de fila de la suma
$total=0;
for($i=0; $i<count($cierreGasto); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , $cierreGasto[$i]->id)
              ->setCellValue('B'.$fila , $cierreGasto[$i]->id_cierre.':'.$cierreGasto[$i]->cierre)
              ->setCellValue('C'.$fila , $cierreGasto[$i]->id_sucursal.':'.$cierreGasto[$i]->sucursal)
              ->setCellValue('D'.$fila , $cierreGasto[$i]->id_gasto.':'.$cierreGasto[$i]->gasto)
              ->setCellValue('E'.$fila , $cierreGasto[$i]->id_grupo.':'.$cierreGasto[$i]->grupo)
              ->setCellValue('F'.$fila , $cierreGasto[$i]->monto);
              $total+=$cierreGasto[$i]->monto;
              $fila++;
              //PRIMEROS REGISTROS
              if((($i+1)<count($cierreGasto)) && ($cierreGasto[$i]->id_cierre!=$cierreGasto[($i+1)]->id_cierre))
              {
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('B'.$fila , 'TOTAL: ')
                        ->setCellValue('F'.$fila , $total);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':F'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':F'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $total=0;
              //ULTIMO REGISTRO
              }elseif($i==count($cierreGasto)-1){
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('B'.$fila , 'TOTAL: ')
                        ->setCellValue('F'.$fila , $total);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':F'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':F'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $fila++;
                  $total=0;
              }
}

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'F'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra
$spreadsheet->getActiveSheet()->getStyle('F'.$inF.':'.'F'.$fila)->getNumberFormat()
      ->setFormatCode('#,##0.00');
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
