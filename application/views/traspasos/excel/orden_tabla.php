<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';

//localhost/g1646015/sgpt/Cierre/excel/4030
$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Lista-de-ordenes";
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
$spreadsheet->getActiveSheet()->setTitle('Reporte tabla de ordenes');

//ANCHO DE COLUMNAS

        $spreadsheet->getActiveSheet()->getStyle('A2:AQ3')->getAlignment()->setWrapText(true);//ajustar texto
        $spreadsheet->getActiveSheet()->setAutoFilter('A3:H3');//Filtro
        $spreadsheet->getActiveSheet()->mergeCells('A1:AQ1');//Combinar celdas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(12);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(9);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(14);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(8);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(8);

        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AH')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('AJ')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('AK')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('AL')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('AN')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('AO')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('AP')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('AQ')->setWidth(11);

        //HIDE COLUMN
        $visible=FALSE;
            $spreadsheet->getActiveSheet()->getColumnDimension('N')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('O')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('P')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('R')->setVisible($visible);

            $spreadsheet->getActiveSheet()->getColumnDimension('T')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('U')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('V')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('W')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('X')->setVisible($visible);

            $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setVisible($visible);
            $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setVisible($visible);

        $spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(35);//Alto de la fila 2
        $spreadsheet->getActiveSheet()->getStyle('A1')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:AQ3')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



        $spreadsheet->getActiveSheet()->getStyle('A2:AQ3')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        // $spreadsheet->getActiveSheet()->getStyle('A2')
        //   ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);//Color de letra rojo


        $spreadsheet->getActiveSheet()->getStyle('A1:AQ1')
              ->getFont()->applyFromArray($titulos);
        $spreadsheet->getActiveSheet()->getStyle('A2:AQ3')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'TABLA DE ÓRDENES');
$fila++;
      $spreadsheet->getActiveSheet()->mergeCells('A'.$fila.':'.'G'.$fila);//Combinar celdas
      $spreadsheet->getActiveSheet()->mergeCells('H'.$fila.':'.'M'.$fila);
      $spreadsheet->getActiveSheet()->mergeCells('N'.$fila.':'.'S'.$fila);
      $spreadsheet->getActiveSheet()->mergeCells('T'.$fila.':'.'Y'.$fila);
      $spreadsheet->getActiveSheet()->mergeCells('Z'.$fila.':'.'AE'.$fila);
      $spreadsheet->getActiveSheet()->mergeCells('AF'.$fila.':'.'AK'.$fila);
      $spreadsheet->getActiveSheet()->mergeCells('AL'.$fila.':'.'AQ'.$fila);

$activeSheet = $spreadsheet->getActiveSheet()
        ->setCellValue('A'.$fila , 'ORDEN')
        ->setCellValue('H'.$fila , 'RENDIMIENTO')
        ->setCellValue('N'.$fila , 'CANTIDAD DE REPARTICIONES PROGRAMADAS')
        ->setCellValue('T'.$fila , 'CANTIDAD DE DEVOLUCIONES')
        ->setCellValue('Z'.$fila , 'CANTIDAD DE REPARTICIONES EFECTIVAS')
        ->setCellValue('AF'.$fila , 'MONTO DE REPARTO')
        ->setCellValue('AL'.$fila , 'CANTIDAD DE MATERIA PRIMA SUMINISTRADA');
$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'No.')
              ->setCellValue('B'.$fila , 'Sucursal')
              ->setCellValue('C'.$fila , 'Nota')
              ->setCellValue('D'.$fila , 'Fecha Reg.')
              ->setCellValue('E'.$fila , 'Fecha Ejec.')
              ->setCellValue('F'.$fila , 'Hora Ejec.')
              ->setCellValue('G'.$fila , 'No. Cierre')
              ->setCellValue('H'.$fila , 'Nombre Rend.')
              ->setCellValue('I'.$fila , 'Masa Kg.')
              ->setCellValue('J'.$fila , 'T-Maíz Kg.')
              ->setCellValue('K'.$fila , 'Agua-M Lts.')
              ->setCellValue('L'.$fila , 'T-Harina Kg.')
              ->setCellValue('M'.$fila , 'Agua-H Lts.')

              ->setCellValue('N'.$fila , 'Tortilla M')
              ->setCellValue('O'.$fila , 'Tortilla H')
              ->setCellValue('P'.$fila , 'Masa')
              ->setCellValue('Q'.$fila , 'Sope')
              ->setCellValue('R'.$fila , 'Tostada')
              ->setCellValue('S'.$fila , 'Total Rep.')

              ->setCellValue('T'.$fila , 'Tortilla M')
              ->setCellValue('U'.$fila , 'Tortilla H')
              ->setCellValue('V'.$fila , 'Masa')
              ->setCellValue('W'.$fila , 'Sope')
              ->setCellValue('X'.$fila , 'Tostada')
              ->setCellValue('Y'.$fila , 'Total Dev.')

              ->setCellValue('Z'.$fila , 'Tortilla M')
              ->setCellValue('AA'.$fila , 'Tortilla H')
              ->setCellValue('AB'.$fila , 'Masa')
              ->setCellValue('AC'.$fila , 'Sope')
              ->setCellValue('AD'.$fila , 'Tostada')
              ->setCellValue('AE'.$fila , 'Total Efec.')

              ->setCellValue('AF'.$fila , 'Tortilla M')
              ->setCellValue('AG'.$fila , 'Tortilla H')
              ->setCellValue('AH'.$fila , 'Masa')
              ->setCellValue('AI'.$fila , 'Sope')
              ->setCellValue('AJ'.$fila , 'Tostada')
              ->setCellValue('AK'.$fila , 'Total Rep.')

              ->setCellValue('AL'.$fila , 'HARINA')
              ->setCellValue('AM'.$fila , 'MAÍZ')
              ->setCellValue('AN'.$fila , 'PAPEL')
              ->setCellValue('AO'.$fila , 'BOLSA')
              ->setCellValue('AP'.$fila , 'ETIQUETA')
              ->setCellValue('AQ'.$fila , 'CAL');

$fila++;
$inF=$fila;//Inicio de fila de la suma
for($i=0; $i<count($orden); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
             ->setCellValue('A'.$fila , $orden[$i]->id)
             ->setCellValue('B'.$fila , $orden[$i]->id_sucursal.':'.$orden[$i]->sucursal)
             ->setCellValue('C'.$fila , $orden[$i]->nota)
             ->setCellValue('D'.$fila , nice_date($orden[$i]->fecha_reg, 'd-m-Y'))
             ->setCellValue('E'.$fila , nice_date($orden[$i]->fecha_ejec, 'd-m-Y'))
             ->setCellValue('F'.$fila , $orden[$i]->hora_ejec)
             ->setCellValue('G'.$fila , $orden[$i]->id_cierre)
             ->setCellValue('H'.$fila , $orden[$i]->id_rendimiento.':'.$orden[$i]->rendimiento)
             ->setCellValue('I'.$fila , $orden[$i]->masa_producida)
             ->setCellValue('J'.$fila , $orden[$i]->tm_producida)
             ->setCellValue('K'.$fila , $orden[$i]->tm_agua)
             ->setCellValue('L'.$fila , $orden[$i]->th_producida)
             ->setCellValue('M'.$fila , $orden[$i]->th_agua)

             ->setCellValue('N'.$fila , $orden[$i]->cant_rep_tm)
             ->setCellValue('O'.$fila , $orden[$i]->cant_rep_th)
             ->setCellValue('P'.$fila , $orden[$i]->cant_rep_m)
             ->setCellValue('Q'.$fila , $orden[$i]->cant_rep_sp)
             ->setCellValue('R'.$fila , $orden[$i]->cant_rep_tt)
             ->setCellValue('S'.$fila , $orden[$i]->cant_rep)

             ->setCellValue('T'.$fila , $orden[$i]->cant_dev_tm)
             ->setCellValue('U'.$fila , $orden[$i]->cant_dev_th)
             ->setCellValue('V'.$fila , $orden[$i]->cant_dev_m)
             ->setCellValue('W'.$fila , $orden[$i]->cant_dev_sp)
             ->setCellValue('X'.$fila , $orden[$i]->cant_dev_tt)
             ->setCellValue('Y'.$fila , $orden[$i]->cant_dev)

             ->setCellValue('Z'.$fila ,  $orden[$i]->cant_rep_tm-$orden[$i]->cant_dev_tm)
             ->setCellValue('AA'.$fila , $orden[$i]->cant_rep_th-$orden[$i]->cant_dev_th)
             ->setCellValue('AB'.$fila , $orden[$i]->cant_rep_m-$orden[$i]->cant_dev_m)
             ->setCellValue('AC'.$fila , $orden[$i]->cant_rep_sp-$orden[$i]->cant_dev_sp)
             ->setCellValue('AD'.$fila , $orden[$i]->cant_rep_tt-$orden[$i]->cant_dev_tt)
             ->setCellValue('AE'.$fila , $orden[$i]->cant_rep-$orden[$i]->cant_dev)

             ->setCellValue('AF'.$fila , number_format($orden[$i]->mto_rep_tm,2))
             ->setCellValue('AG'.$fila , number_format($orden[$i]->mto_rep_th,2))
             ->setCellValue('AH'.$fila , number_format($orden[$i]->mto_rep_m,2))
             ->setCellValue('AI'.$fila , number_format($orden[$i]->mto_rep_sp,2))
             ->setCellValue('AJ'.$fila , number_format($orden[$i]->mto_rep_tt,2))
             ->setCellValue('AK'.$fila , number_format($orden[$i]->mto_rep,2))

             ->setCellValue('AL'.$fila , $orden[$i]->cant_mp_h)
             ->setCellValue('AM'.$fila , $orden[$i]->cant_mp_m)
             ->setCellValue('AN'.$fila , $orden[$i]->cant_mp_p)
             ->setCellValue('AO'.$fila , $orden[$i]->cant_mp_b)
             ->setCellValue('AP'.$fila , $orden[$i]->cant_mp_e)
             ->setCellValue('AQ'.$fila , $orden[$i]->cant_mp_c)
             ;

             $spreadsheet->getActiveSheet()->getStyle('I'.$fila.':'.'M'.$fila)->getFill()
                   ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                   ->getStartColor()->setARGB($franjaVerde);
            $spreadsheet->getActiveSheet()->getStyle('S'.$fila)->getFill()
                   ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                   ->getStartColor()->setARGB($franjaVerde);
            $spreadsheet->getActiveSheet()->getStyle('Y'.$fila)->getFill()
                  ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                  ->getStartColor()->setARGB($franjaVerde);
            $spreadsheet->getActiveSheet()->getStyle('AE'.$fila)->getFill()
                  ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                  ->getStartColor()->setARGB($franjaVerde);
            $spreadsheet->getActiveSheet()->getStyle('AF'.$fila.':'.'AJ'.$fila)->getFill()
                  ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                  ->getStartColor()->setARGB($franjaAmarilla);
            $spreadsheet->getActiveSheet()->getStyle('AK'.$fila)->getFill()
                  ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                  ->getStartColor()->setARGB($franjaAzul);

              $fila++;
 }

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'AK'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra azul
$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'A'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('D'.$inF.':'.'G'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('I'.$inF.':'.'AE'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//FORMATO NUMERO
$spreadsheet->getActiveSheet()->getStyle('AF'.$inF.':'.'AK'.$fila)->getNumberFormat()
      ->setFormatCode('#,##0.00');
$spreadsheet->getActiveSheet()->getStyle('AL'.$inF.':'.'AQ'.$fila)
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
