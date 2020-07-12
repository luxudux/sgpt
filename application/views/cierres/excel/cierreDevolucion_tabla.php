<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';

//localhost/g1646015/sgpt/Cierre/excel/4030
$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-cierres-de-devolucion";
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
$spreadsheet->getActiveSheet()->setTitle('Reporte cierres de devolucion');

//ANCHO DE COLUMNAS

        $spreadsheet->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setWrapText(true);//ajustar texto
        $spreadsheet->getActiveSheet()->setAutoFilter('A2:H2');//Filtro
        //$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);//Ancho automático
        $spreadsheet->getActiveSheet()->mergeCells('A1:H1');//Combinar celdas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(20);//Alto de la fila 2
        $spreadsheet->getActiveSheet()->getStyle('A1')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:H2')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



        $spreadsheet->getActiveSheet()->getStyle('A2:H2')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        $spreadsheet->getActiveSheet()->getStyle('A1:H1')
              ->getFont()->applyFromArray($titulos);
        $spreadsheet->getActiveSheet()->getStyle('A2:H2')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'LISTA DE CIERRES DE DEVOLUCIÓN');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'Id')
              ->setCellValue('B'.$fila , 'Cierre')
              ->setCellValue('C'.$fila , 'Sucursal')
              ->setCellValue('D'.$fila , 'Cliente')
              ->setCellValue('E'.$fila,  'Merma')
              ->setCellValue('F'.$fila,  'Devolvió')
              ->setCellValue('G'.$fila,  'Puesto')
              ->setCellValue('H'.$fila , 'Cantidad');

$fila++;
$inF=$fila;//Inicio de fila de la suma
$total=0;
for($i=0; $i<count($cierreDevolucion); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , $cierreDevolucion[$i]->id)
              ->setCellValue('B'.$fila , $cierreDevolucion[$i]->id_cierre.':'.$cierreDevolucion[$i]->cierre)
              ->setCellValue('C'.$fila , $cierreDevolucion[$i]->id_sucursal.':'.$cierreDevolucion[$i]->sucursal)
              ->setCellValue('D'.$fila , $cierreDevolucion[$i]->id_cliente.':'.$cierreDevolucion[$i]->cliente)
              ->setCellValue('E'.$fila , $cierreDevolucion[$i]->id_merma.':'.$cierreDevolucion[$i]->merma)
              ->setCellValue('F'.$fila , $cierreDevolucion[$i]->id_empleado.':'.$cierreDevolucion[$i]->empleado)
              ->setCellValue('G'.$fila , $cierreDevolucion[$i]->id_puesto.':'.$cierreDevolucion[$i]->puesto)
              ->setCellValue('H'.$fila , $cierreDevolucion[$i]->cantidad);
              $total+=$cierreDevolucion[$i]->cantidad;
              $fila++;

              //PRIMEROS REGISTROS
              if((($i+1)<count($cierreDevolucion)) && ($cierreDevolucion[$i]->id_cierre!=$cierreDevolucion[($i+1)]->id_cierre))
              {
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('B'.$fila , 'TOTAL: ')
                        ->setCellValue('H'.$fila , $total);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':H'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':H'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $total=0;
              //ULTIMO REGISTRO
              }elseif($i==count($cierreDevolucion)-1){
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('B'.$fila , 'TOTAL: ')
                        ->setCellValue('H'.$fila , $total);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':H'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':H'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $total=0;
              }
}

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'H'.$fila)
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
