<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';


//localhost/g1646015/sgpt/Cierre/excel/4030
$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
$filename="Datos-del-cierre";
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
$spreadsheet->getActiveSheet()->setTitle('Reporte del cierre');

//ANCHO DE COLUMNAS

        $spreadsheet->getActiveSheet()->getStyle('A3:BC3')->getAlignment()->setWrapText(true);//ajustar texto
        $spreadsheet->getActiveSheet()->setAutoFilter('A3:C3');//Filtro
        //$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);//Ancho automático
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(6);//Ancho de la columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);

        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);

        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('AH')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(12);

        $spreadsheet->getActiveSheet()->getColumnDimension('AJ')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AK')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AL')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('AN')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('AO')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('AP')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AQ')->setWidth(9.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AR')->setWidth(6.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('AS')->setWidth(6.2);
        $spreadsheet->getActiveSheet()->getColumnDimension('AT')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('AU')->setWidth(11);

        $spreadsheet->getActiveSheet()->getColumnDimension('AV')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('AW')->setWidth(20);

        $spreadsheet->getActiveSheet()->getColumnDimension('AX')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('AY')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('AZ')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('BA')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('BB')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('BC')->setWidth(11);

        $spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(20);//Alto de la fila 2


    //HIDE COLUMN
        $visible=FALSE;
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setVisible($visible);
        //REP PROG
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setVisible($visible);
        //DEV
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setVisible($visible);
        //EFECT
        $spreadsheet->getActiveSheet()->getColumnDimension('W')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('X')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setVisible($visible);
        //MERMA
        $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setVisible($visible);
        //MNTO VTA
        $spreadsheet->getActiveSheet()->getColumnDimension('AJ')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AK')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AL')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AM')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AN')->setVisible($visible);
        //MNTO REP
        $spreadsheet->getActiveSheet()->getColumnDimension('AP')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AQ')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AR')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AS')->setVisible($visible);
        $spreadsheet->getActiveSheet()->getColumnDimension('AT')->setVisible($visible);




        $spreadsheet->getActiveSheet()->getStyle('A1')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:BC3')
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



        $spreadsheet->getActiveSheet()->getStyle('A2:BC3')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB($franjaGris);

        $spreadsheet->getActiveSheet()->getStyle('A1:T1')
              ->getFont()->applyFromArray($titulos);
        $spreadsheet->getActiveSheet()->getStyle('A2:BC3')
              ->getFont()->applyFromArray($titulos);

//Contenido
$fila=1;
$spreadsheet->getActiveSheet()->mergeCells('A'.$fila.':'.'BC'.$fila);//Combinar celdas
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'LISTA DE CIERRES');
$fila++;
$spreadsheet->getActiveSheet()->mergeCells('A'.$fila.':'.'D'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('E'.$fila.':'.'J'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('K'.$fila.':'.'P'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('Q'.$fila.':'.'V'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('W'.$fila.':'.'AB'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('AC'.$fila.':'.'AH'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('AJ'.$fila.':'.'AO'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('AP'.$fila.':'.'AU'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('AV'.$fila.':'.'AW'.$fila);//Combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('AX'.$fila.':'.'BC'.$fila);//Combinar celdas
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'CIERRE')
              ->setCellValue('E'.$fila , 'CANTIDAD DE VENTAS DE LA SUCURSAL')
              ->setCellValue('K'.$fila , 'CANTIDAD DE REPARTICIONES PROGRAMADAS')
              ->setCellValue('Q'.$fila , 'CANTIDAD DE DEVOLUCIONES')
              ->setCellValue('W'.$fila , 'CANTIDAD DE REPARTICIONES EFECTIVAS')
              ->setCellValue('AC'.$fila , 'CANTIDAD DE MERMA')
              ->setCellValue('AJ'.$fila , 'MONTO VENTA MOSTRADOR')
              ->setCellValue('AP'.$fila , 'MONTO DE REPARTO')
              ->setCellValue('AV'.$fila , 'MONTOS TOTALES')
              ->setCellValue('AX'.$fila , 'CANTIDAD DE MATERIA PRIMA SUMINISTRADA');

$fila++;
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , 'No.')
              ->setCellValue('B'.$fila , 'Sucursal')
              ->setCellValue('C'.$fila,  'Fecha')
              ->setCellValue('D'.$fila , 'Nota')
              ->setCellValue('E'.$fila , 'Tortilla M')
              ->setCellValue('F'.$fila , 'Tortilla H')
              ->setCellValue('G'.$fila , 'Masa')
              ->setCellValue('H'.$fila , 'Sope')
              ->setCellValue('I'.$fila , 'Tostada')
              ->setCellValue('J'.$fila , 'Total Vta.')

              ->setCellValue('K'.$fila , 'Tortilla M')
              ->setCellValue('L'.$fila , 'Tortilla H')
              ->setCellValue('M'.$fila , 'Masa')
              ->setCellValue('N'.$fila , 'Sope')
              ->setCellValue('O'.$fila , 'Tostada')
              ->setCellValue('P'.$fila , 'Total Rep.')

              ->setCellValue('Q'.$fila , 'Tortilla M')
              ->setCellValue('R'.$fila , 'Tortilla H')
              ->setCellValue('S'.$fila , 'Masa')
              ->setCellValue('T'.$fila , 'Sope')
              ->setCellValue('U'.$fila , 'Tostada')
              ->setCellValue('V'.$fila , 'Total Dev.')

              ->setCellValue('W'.$fila , 'Tortilla M')
              ->setCellValue('X'.$fila , 'Tortilla H')
              ->setCellValue('Y'.$fila , 'Masa')
              ->setCellValue('Z'.$fila , 'Sope')
              ->setCellValue('AA'.$fila , 'Tostada')
              ->setCellValue('AB'.$fila , 'Total Efec.')

              ->setCellValue('AC'.$fila , 'Tortilla M')
              ->setCellValue('AD'.$fila , 'Tortilla H')
              ->setCellValue('AE'.$fila , 'Masa')
              ->setCellValue('AF'.$fila , 'Sope')
              ->setCellValue('AG'.$fila , 'Tostada')
              ->setCellValue('AH'.$fila , 'Total Mrm.')

              ->setCellValue('AI'.$fila , 'Total Gasto')

              ->setCellValue('AJ'.$fila , 'Tortilla M')
              ->setCellValue('AK'.$fila , 'Tortilla H')
              ->setCellValue('AL'.$fila , 'Masa')
              ->setCellValue('AM'.$fila , 'Sope')
              ->setCellValue('AN'.$fila , 'Tostada')
              ->setCellValue('AO'.$fila , 'Total Most.')

              ->setCellValue('AP'.$fila , 'Tortilla M')
              ->setCellValue('AQ'.$fila , 'Tortilla H')
              ->setCellValue('AR'.$fila , 'Masa')
              ->setCellValue('AS'.$fila , 'Sope')
              ->setCellValue('AT'.$fila , 'Tostada')
              ->setCellValue('AU'.$fila , 'Total Rpto.')
              ->setCellValue('AV'.$fila , 'Total Vta.')
              ->setCellValue('AW'.$fila , 'Total Utilidad.')

              ->setCellValue('AX'.$fila , 'HARINA')
              ->setCellValue('AY'.$fila , 'MAÍZ')
              ->setCellValue('AZ'.$fila , 'PAPEL')
              ->setCellValue('BA'.$fila , 'BOLSA')
              ->setCellValue('BB'.$fila , 'ETIQUETA')
              ->setCellValue('BC'.$fila , 'CAL');;

$fila++;
$inF=$fila;//Inicio de fila de la suma
for($i=0; $i<count($cierre); $i++) {
$activeSheet = $spreadsheet->getActiveSheet()
              ->setCellValue('A'.$fila , $cierre[$i]->id)
              ->setCellValue('B'.$fila , $cierre[$i]->id_sucursal.':'.$cierre[$i]->sucursal)
              ->setCellValue('C'.$fila , nice_date($cierre[$i]->fecha_reg, 'd-m-Y'))
              ->setCellValue('D'.$fila , $cierre[$i]->nota)
              ->setCellValue('E'.$fila , $cierre[$i]->cant_vta_tm)
              ->setCellValue('F'.$fila , $cierre[$i]->cant_vta_th)
              ->setCellValue('G'.$fila , $cierre[$i]->cant_vta_m)
              ->setCellValue('H'.$fila , $cierre[$i]->cant_vta_sp)
              ->setCellValue('I'.$fila , $cierre[$i]->cant_vta_tt)
              ->setCellValue('J'.$fila , $cierre[$i]->cant_vta)
              ->setCellValue('K'.$fila , $cierre[$i]->cant_rep_tm)
              ->setCellValue('L'.$fila , $cierre[$i]->cant_rep_th)
              ->setCellValue('M'.$fila , $cierre[$i]->cant_rep_m)
              ->setCellValue('N'.$fila , $cierre[$i]->cant_rep_sp)
              ->setCellValue('O'.$fila , $cierre[$i]->cant_rep_tt)
              ->setCellValue('P'.$fila , $cierre[$i]->cant_rep)

              ->setCellValue('Q'.$fila , $cierre[$i]->cant_dev_tm)
              ->setCellValue('R'.$fila , $cierre[$i]->cant_dev_th)
              ->setCellValue('S'.$fila , $cierre[$i]->cant_dev_m)
              ->setCellValue('T'.$fila , $cierre[$i]->cant_dev_sp)
              ->setCellValue('U'.$fila , $cierre[$i]->cant_dev_tt)
              ->setCellValue('V'.$fila , $cierre[$i]->cant_dev)

              ->setCellValue('W'.$fila ,  $cierre[$i]->cant_rep_tm-$cierre[$i]->cant_dev_tm)
              ->setCellValue('X'.$fila ,  $cierre[$i]->cant_rep_th-$cierre[$i]->cant_dev_th)
              ->setCellValue('Y'.$fila ,  $cierre[$i]->cant_rep_m-$cierre[$i]->cant_dev_m)
              ->setCellValue('Z'.$fila ,  $cierre[$i]->cant_rep_sp-$cierre[$i]->cant_dev_sp)
              ->setCellValue('AA'.$fila , $cierre[$i]->cant_rep_tt-$cierre[$i]->cant_dev_tt)
              ->setCellValue('AB'.$fila , $cierre[$i]->cant_rep-$cierre[$i]->cant_dev)

              ->setCellValue('AC'.$fila , $cierre[$i]->cant_merm_tm)
              ->setCellValue('AD'.$fila , $cierre[$i]->cant_merm_th)
              ->setCellValue('AE'.$fila , $cierre[$i]->cant_merm_m)
              ->setCellValue('AF'.$fila , $cierre[$i]->cant_merm_sp)
              ->setCellValue('AG'.$fila , $cierre[$i]->cant_merm_tt)
              ->setCellValue('AH'.$fila , $cierre[$i]->cant_merm)

              ->setCellValue('AI'.$fila , $cierre[$i]->gasto)

              ->setCellValue('AJ'.$fila , $cierre[$i]->mto_vta_tm)
              ->setCellValue('AK'.$fila , $cierre[$i]->mto_vta_th)
              ->setCellValue('AL'.$fila , $cierre[$i]->mto_vta_m)
              ->setCellValue('AM'.$fila , $cierre[$i]->mto_vta_sp)
              ->setCellValue('AN'.$fila , $cierre[$i]->mto_vta_tt)
              ->setCellValue('AO'.$fila , $cierre[$i]->mto_vta)

              ->setCellValue('AP'.$fila , $cierre[$i]->mto_rep_tm)
              ->setCellValue('AQ'.$fila , $cierre[$i]->mto_rep_th)
              ->setCellValue('AR'.$fila , $cierre[$i]->mto_rep_m)
              ->setCellValue('AS'.$fila , $cierre[$i]->mto_rep_sp)
              ->setCellValue('AT'.$fila , $cierre[$i]->mto_rep_tt)
              ->setCellValue('AU'.$fila , $cierre[$i]->mto_rep)

              ->setCellValue('AV'.$fila , $cierre[$i]->mto_vta+$cierre[$i]->mto_rep)
              ->setCellValue('AW'.$fila , ($cierre[$i]->mto_vta+$cierre[$i]->mto_rep)-$cierre[$i]->gasto)

              ->setCellValue('AX'.$fila , $cierre[$i]->cant_mp_h)
              ->setCellValue('AY'.$fila , $cierre[$i]->cant_mp_m)
              ->setCellValue('AZ'.$fila , $cierre[$i]->cant_mp_p)
              ->setCellValue('BA'.$fila , $cierre[$i]->cant_mp_b)
              ->setCellValue('BB'.$fila , $cierre[$i]->cant_mp_e)
              ->setCellValue('BC'.$fila , $cierre[$i]->cant_mp_c);


              $spreadsheet->getActiveSheet()->getStyle('J'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaVerde);
              $spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaVerde);
              $spreadsheet->getActiveSheet()->getStyle('V'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaVerde);
              $spreadsheet->getActiveSheet()->getStyle('AB'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaVerde);
              $spreadsheet->getActiveSheet()->getStyle('AH'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaVerde);
              $spreadsheet->getActiveSheet()->getStyle('AI'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaAmarilla);
              $spreadsheet->getActiveSheet()->getStyle('AO'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaAmarilla);
              $spreadsheet->getActiveSheet()->getStyle('AU'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaAmarilla);
              $spreadsheet->getActiveSheet()->getStyle('AV'.$fila.':'.'AW'.$fila)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($franjaAzul);
              $fila++;
}

$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'BC'.$fila)
      ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);//Color de letra azul
//FORMATO NUMERO
$spreadsheet->getActiveSheet()->getStyle('AI'.$inF.':'.'AW'.$fila)->getNumberFormat()
      ->setFormatCode('#,##0.00');

//COLOR FILA
// $spreadsheet->getActiveSheet()->getStyle('M'.$inF.':T'.($fila-1))->getFill()
//       ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
//       ->getStartColor()->setARGB($franjaAmarilla);
$spreadsheet->getActiveSheet()->getStyle('A'.$inF.':'.'A'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('E'.$inF.':'.'AH'.$fila)
      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('AX'.$inF.':'.'BC'.$fila)
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
