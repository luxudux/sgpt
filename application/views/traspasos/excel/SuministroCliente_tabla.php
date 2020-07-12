<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';

//localhost/g1646015/sgpt/Cierre/excel/4030
$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-suministro-clientes";
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
$spreadsheet->getActiveSheet()->setTitle('Tabla de suministro a clientes');

//ANCHO DE COLUMNAS

        $spreadsheet->getActiveSheet()->getStyle('A2:O2')->getAlignment()->setWrapText(true);//ajustar texto
        $spreadsheet->getActiveSheet()->setAutoFilter('A2:O2');//Filtro
        $spreadsheet->getActiveSheet()->mergeCells('A1:O1');//Combinar celdas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(17);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(17);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(17);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(20);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(20);//Alto de la fila 5
        $spreadsheet->getActiveSheet()->getStyle('A1')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:O2')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



        $spreadsheet->getActiveSheet()->getStyle('A2:O2')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);
        // $spreadsheet->getActiveSheet()->getStyle('A2')
        //   ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);//Color de letra rojo


        $spreadsheet->getActiveSheet()->getStyle('A1:O2')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'SUMINISTRO A CLIENTES');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'No.')
              ->setCellValue('B'.$fila , 'Orden')
              ->setCellValue('C'.$fila , 'Cliente')
              ->setCellValue('D'.$fila , 'Producto')
              ->setCellValue('E'.$fila , 'Grupo')
              ->setCellValue('F'.$fila , 'Cantidad Suministrada')
              ->setCellValue('G'.$fila , 'Precio Unitario($)')
              ->setCellValue('H'.$fila , 'Monto Proyectado($)')
              ->setCellValue('I'.$fila , 'Empleado')
              ->setCellValue('J'.$fila , 'Cantidad Devuelta')
              ->setCellValue('K'.$fila , 'Monto Perdido($)')
              ->setCellValue('L'.$fila , 'Cantidad Efectiva')
              ->setCellValue('M'.$fila , 'Total Recaudo')
              ->setCellValue('N'.$fila , 'Sucursal')
              ->setCellValue('O'.$fila , 'Fecha Orden Ejecución');

$fila++;
$inF=$fila;//Inicio de fila de la suma
$cantidad_suministrada=0;
$monto_proyectado=0;
$cantidad_devuelta=0;
$monto_perdido=0;
$cantidad_efectiva=0;
$total_recaudo=0;
for($i=0; $i<count($suministroCliente); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
             ->setCellValue('A'.$fila , $suministroCliente[$i]->id)
             ->setCellValue('B'.$fila , $suministroCliente[$i]->id_orden.':'.$suministroCliente[$i]->orden)
             ->setCellValue('C'.$fila , $suministroCliente[$i]->id_cliente.':'.$suministroCliente[$i]->cliente)
             ->setCellValue('D'.$fila , $suministroCliente[$i]->id_producto.':'.$suministroCliente[$i]->producto)
             ->setCellValue('E'.$fila , $suministroCliente[$i]->id_grupop.':'.$suministroCliente[$i]->grupop)
             ->setCellValue('F'.$fila , $suministroCliente[$i]->cantidad)
             ->setCellValue('G'.$fila , $suministroCliente[$i]->monto)
             ->setCellValue('H'.$fila , $suministroCliente[$i]->cantidad*$suministroCliente[$i]->monto)
             ->setCellValue('I'.$fila , $suministroCliente[$i]->id_empleado.':'.$suministroCliente[$i]->empleado)
             ->setCellValue('J'.$fila , $suministroCliente[$i]->devolucion)
             ->setCellValue('K'.$fila , $suministroCliente[$i]->monto*$suministroCliente[$i]->devolucion)
             ->setCellValue('L'.$fila , $suministroCliente[$i]->cantidad-$suministroCliente[$i]->devolucion)
             ->setCellValue('M'.$fila , ($suministroCliente[$i]->cantidad-$suministroCliente[$i]->devolucion)*$suministroCliente[$i]->monto)
             ->setCellValue('N'.$fila , $suministroCliente[$i]->id_sucursal.':'.$suministroCliente[$i]->sucursal)
             ->setCellValue('O'.$fila , $suministroCliente[$i]->fecha_ejec.' '.$suministroCliente[$i]->hora_ejec);
              $cantidad_suministrada+=$suministroCliente[$i]->cantidad;//cantidad suministrada
              $monto_proyectado+=($suministroCliente[$i]->cantidad*$suministroCliente[$i]->monto);
              $cantidad_devuelta+=$suministroCliente[$i]->devolucion;
              $monto_perdido+=($suministroCliente[$i]->monto*$suministroCliente[$i]->devolucion);
              $cantidad_efectiva+=($suministroCliente[$i]->cantidad-$suministroCliente[$i]->devolucion);
              $total_recaudo+=(($suministroCliente[$i]->cantidad-$suministroCliente[$i]->devolucion)*$suministroCliente[$i]->monto);
              $fila++;

              //PRIMEROS REGISTROS
              if((($i+1)<count($suministroCliente)) && ($suministroCliente[$i]->id_orden!=$suministroCliente[($i+1)]->id_orden))
              {
                  $activeSheet = $spreadsheet->getActiveSheet()
                        ->setCellValue('A'.$fila , 'TOTAL')
                        ->setCellValue('B'.$fila , 'ORDEN: #'.$suministroCliente[$i]->id_orden)
                        ->setCellValue('F'.$fila , $cantidad_suministrada)
                        ->setCellValue('H'.$fila , $monto_proyectado)
                        ->setCellValue('J'.$fila , $cantidad_devuelta)
                        ->setCellValue('K'.$fila , $monto_perdido)
                        ->setCellValue('L'.$fila , $cantidad_efectiva)
                        ->setCellValue('M'.$fila , $total_recaudo)
                        ->setCellValue('N'.$fila , $suministroCliente[$i]->id_sucursal.':'.$suministroCliente[$i]->sucursal)
                        ->setCellValue('O'.$fila , $suministroCliente[$i]->fecha_ejec.' '.$suministroCliente[$i]->hora_ejec);


                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':O'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':O'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $cantidad_suministrada=0;
                  $monto_proyectado=0;
                  $cantidad_devuelta=0;
                  $monto_perdido=0;
                  $cantidad_efectiva=0;
                  $total_recaudo=0;
              //ULTIMO REGISTRO
              }elseif($i==count($suministroCliente)-1){
                  $activeSheet = $spreadsheet->getActiveSheet()
                      ->setCellValue('A'.$fila , 'TOTAL')
                      ->setCellValue('B'.$fila , 'ORDEN: #'.$suministroCliente[$i]->id_orden)
                      ->setCellValue('F'.$fila , $cantidad_suministrada)
                      ->setCellValue('H'.$fila , $monto_proyectado)
                      ->setCellValue('J'.$fila , $cantidad_devuelta)
                      ->setCellValue('K'.$fila , $monto_perdido)
                      ->setCellValue('L'.$fila , $cantidad_efectiva)
                      ->setCellValue('M'.$fila , $total_recaudo)
                      ->setCellValue('N'.$fila , $suministroCliente[$i]->id_sucursal.':'.$suministroCliente[$i]->sucursal)
                      ->setCellValue('O'.$fila , $suministroCliente[$i]->fecha_ejec.' '.$suministroCliente[$i]->hora_ejec);
                  //COLOR FILA
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':O'.$fila)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($franjaAmarilla);
                  $spreadsheet->getActiveSheet()->getStyle('A'.$fila.':O'.$fila)
                        ->getFont()->applyFromArray($letraNegra);
                  $fila++;
                  $cantidad_suministrada=0;
                  $monto_proyectado=0;
                  $cantidad_devuelta=0;
                  $monto_perdido=0;
                  $cantidad_efectiva=0;
                  $total_recaudo=0;
              }
 }

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'M'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra azul
$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'A'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()->getStyle('F'.$inF.':'.'H'.$fila)->getNumberFormat()
            ->setFormatCode('#,##0.00');
$spreadsheet->getActiveSheet()->getStyle('J'.$inF.':'.'M'.$fila)->getNumberFormat()
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
