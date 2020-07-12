<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';

//localhost/g1646015/sgpt/Cierre/excel/4030
$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-cierres-de-venta";
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
$spreadsheet->getActiveSheet()->setTitle('Reporte cierres de venta');

//ANCHO DE COLUMNAS

        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setWrapText(true);//ajustar texto
        $spreadsheet->getActiveSheet()->setAutoFilter('A2:G2');//Filtro
        //$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);//Ancho automático
        $spreadsheet->getActiveSheet()->mergeCells('A1:G1');//Combinar celdas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(17);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(17);
        $spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(20);//Alto de la fila 2
        $spreadsheet->getActiveSheet()->getStyle('A1')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:G2')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')
              ->getFont()->applyFromArray($titulos);
        $spreadsheet->getActiveSheet()->getStyle('A2:G2')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'LISTA DE CIERRES DE VENTA');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'Id')
              ->setCellValue('B'.$fila , 'Cierre')
              ->setCellValue('C'.$fila , 'Sucursal')
              ->setCellValue('D'.$fila , 'Producto')
              ->setCellValue('E'.$fila , 'Cantidad')
              ->setCellValue('F'.$fila , 'Precio unitario')
              ->setCellValue('G'.$fila , 'Venta producida');

$fila++;
$inF=$fila;//Inicio de fila de la suma
$total=0;
for($i=0; $i<count($cierreVenta); $i++) {
    $activeSheet = $spreadsheet->getActiveSheet()
          ->setCellValue('A'.$fila , $cierreVenta[$i]->id)
          ->setCellValue('B'.$fila , $cierreVenta[$i]->id_cierre.':'.$cierreVenta[$i]->cierre)
          ->setCellValue('C'.$fila , $cierreVenta[$i]->id_sucursal.':'.$cierreVenta[$i]->sucursal)
          ->setCellValue('D'.$fila , $cierreVenta[$i]->id_producto.':'.$cierreVenta[$i]->producto)
          ->setCellValue('E'.$fila , $cierreVenta[$i]->cantidad)
          ->setCellValue('F'.$fila , $cierreVenta[$i]->monto)
          ->setCellValue('G'.$fila , $cierreVenta[$i]->cantidad*$cierreVenta[$i]->monto);
    $total+=$cierreVenta[$i]->cantidad*$cierreVenta[$i]->monto;
    $fila++;
  //PRIMEROS REGISTROS
  if((($i+1)<count($cierreVenta)) && ($cierreVenta[$i]->id_cierre!=$cierreVenta[($i+1)]->id_cierre))
  {
      $activeSheet = $spreadsheet->getActiveSheet()
            ->setCellValue('B'.$fila , 'TOTAL: ')
            ->setCellValue('G'.$fila , $total);
      //COLOR FILA
      $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':G'.$fila)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB($franjaAmarilla);
      $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':G'.$fila)
            ->getFont()->applyFromArray($letraNegra);
      $fila++;
      $total=0;
  //ULTIMO REGISTRO
  }elseif($i==count($cierreVenta)-1){
      $activeSheet = $spreadsheet->getActiveSheet()
            ->setCellValue('B'.$fila , 'TOTAL: ')
            ->setCellValue('G'.$fila , $total);
      //COLOR FILA
      $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':G'.$fila)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB($franjaAmarilla);
      $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':G'.$fila)
            ->getFont()->applyFromArray($letraNegra);
      $fila++;
      $total=0;
  }

}

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'G'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra
$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'A'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('E'.$inF.':'.'G'.$fila)->getNumberFormat()
      ->setFormatCode('#,##0.00');
// $spreadsheet->getActiveSheet()->getStyle('F'.$inF.':'.'G'.($fila-1))->getFill()
//       ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
//       ->getStartColor()->setARGB('C8E7F6');
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
