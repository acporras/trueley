<?php
/**
 * Librería para el manejo de Archivos Excel
 * Documentación: https://phpspreadsheet.readthedocs.io/en/develop/#welcome-to-phpspreadsheets-documentation
 * Archivos Soportados: .ods, .xlsx, .xls(97), .xls(95-Lectura), .xls(2003-Lectura), CSV, HTML
 */
use xfxstudios\general\GeneralClass;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class My_excel
{
    public function __construct(){
        $this->general = new GeneralClass();
    }

    public function test(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Bienvenidos a Excel!');

        $writer = new Xlsx($spreadsheet);
        $writer->save($_SERVER['DOCUMENT_ROOT'].'/Docs/Bienvenidos.xlsx');
    }

}
