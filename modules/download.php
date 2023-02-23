<?php
    require '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $handle = "hello_world.xlsx";


    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($handle);

    $worksheet = $spreadsheet->getActiveSheet();

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$handle.'"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    header("Location:./index.php");