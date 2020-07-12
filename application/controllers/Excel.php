<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH.'vendor/autoload.php';

class Excel extends CI_Controller {
	public function __construct(){
		# code...
		parent::__construct();

	}
	public function index()	{
		//Aqui se descargó: https://github.com/PHPOffice/PhpSpreadsheet
		//https://phpspreadsheet.readthedocs.io/en/develop/
		//cd application composer require phpoffice/phpspreadsheet, para que cree la carpeta vendor
		//Aqui un manual: http://tekina.info/generating-excel-using-phpspreadsheet-php/
		//Aqui se vió sintaxis y el config: https://forum.codeigniter.com/thread-69069.html
    //echo APPPATH.'vendor/autoload.php';
		$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
		//$Excel_writer = new Xls($spreadsheet);  /*----- Excel (Xls) Object*/
		$Excel_writer = new Xlsx($spreadsheet);/*----- Excel (Xlsx) Object*/
		$filename="archivote";

		// Set document properties
		$spreadsheet->getProperties()->setCreator('SGPT')
		    ->setLastModifiedBy('SGPT')
		    ->setTitle('Office 2007 XLSX Documento')
		    ->setSubject('Office 2007 XLSX Documento')
		    ->setDescription('Documento para Office 2007 XLSX, gnerado usando clases de PHP.')
		    ->setKeywords('office 2007 openxml php')
		    ->setCategory('Reporte');
		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Reporte');


		$spreadsheet->setActiveSheetIndex(0);
		$activeSheet = $spreadsheet->getActiveSheet();
		$activeSheet->setCellValue('A1' , 'New file content')->getStyle('A1')->getFont()->setBold(true);
		$activeSheet->setCellValue('A5' , 'Contenido')->getStyle('A1')->getFont()->setBold(true);





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
		//exit;

	}





}
