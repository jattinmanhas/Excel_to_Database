<?php
require('dbconfig.php');
require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Database extends Dbconfig
{
    protected $hostName;
    protected $userName;
    protected $password;
    protected $dbName;
    private $table_name = 'first_data';
    private $dbConnect = false;

    public function __construct()
    {
        if (!$this->dbConnect) {
            $database = new dbConfig();
            $database->dbConfig();

            $this->hostName = $database->serverName;
            $this->userName = $database->userName;
            $this->password = $database->password;
            $this->dbName = $database->dbName;

            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);

            if ($conn->connect_error) {
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else {
                $this->dbConnect = $conn;
                // echo "Connected to the database successfully.";
            }
        }
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->dbConnect, $query);
        // print_r($result);

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function insert_data()
    {
        if (isset($_POST['import_file_btn'])) {
            $fileName = $_FILES['import_file']['name'];

            $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

            $allowed_ext = ['xls', 'csv', 'xlsx'];

            if (in_array($file_ext, $allowed_ext)) {
                $inputFileNamePath = $_FILES['import_file']['tmp_name'];
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
                $worksheet = $spreadsheet->getActiveSheet();

                $isSheetValid = $this ->sheet_validation($worksheet);

                $count = 0;
                $errors_sheet = $this->validation_data($spreadsheet, $count);

                if ($errors_sheet == 0 && $isSheetValid == true) {
                    foreach ($worksheet->getRowIterator(2) as $row) {
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(FALSE);
                        $cells = [];
                        foreach ($cellIterator as $cell) {
                            $cells[] = $cell->getValue();
                        }

                        
                        $sql = "INSERT INTO first_data (full_name, job_title, department, gender, age, annual_salary) VALUES ('" . $cells[0] . "', '" . $cells[1] . "', '" . $cells[2] . "', '" . $cells[3] . "', '" . $cells[4] . "', '" . $cells[5] . "')";
                        $this->dbConnect->query($sql);
                        $msg = true;
                    }
                } else {

                    echo '<script>alert("There are errors in the excel sheet.")</script>';
                }
                if (isset($msg)) {
                    header("Location:index.php");
                }
            } else {
                echo '<script>alert("Invalid File.")</script>';
            }
        }
    }

    function sheet_validation($worksheet){
        $firstRow = $worksheet->rangeToArray('A1:' . $worksheet->getHighestColumn() . '1', NULL, TRUE, FALSE)[0];
        if(strtolower($firstRow['0']) == strtolower("Full Name") && strtolower($firstRow['1']) == strtolower("Job Title") && strtolower($firstRow['2']) == strtolower("Department") && strtolower($firstRow['3']) == strtolower("Gender") && strtolower($firstRow['4']) == strtolower("Age") && strtolower($firstRow['5']) == strtolower("Annual Salary")){
            return true;
        }
        echo '<script>alert("Please Insert Data in the Following order \n Full Name => Job Title => Department => Gender => Age => Annual Salary.")</script>';
        return false;
    }

    public function delete_data()
    {
        if (isset($_POST['delete_file_btn'])) {
            $query = "TRUNCATE TABLE " . $this->table_name;

            $result = mysqli_query($this->dbConnect, $query);
            $msg = true;

            if (isset($msg)) {
                header("Location:index.php");
                exit(0);
            }
        }
    }

    public function download_data()
    {
        $query = "SELECT * FROM first_data";
        $result = mysqli_query($this->dbConnect, $query);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Select the active worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'ID');
        $worksheet->setCellValue('B1', 'FULL NAME');
        $worksheet->setCellValue('C1', 'JOB TITLE');
        $worksheet->setCellValue('D1', 'DEPARTMENT');
        $worksheet->setCellValue('E1', 'GENDER');
        $worksheet->setCellValue('F1', 'AGE');
        $worksheet->setCellValue('G1', 'ANNUAL SALARY');

        $row = 2;

        if ($result->num_rows > 0) {
            // $delimiter = ",";
            $filename = "all-data_" . date('Y-m-d') . ".xlsx";

            while ($row_data = $result->fetch_assoc()) {
                $worksheet->setCellValue('A' . $row, $row_data['id']);
                $worksheet->setCellValue('B' . $row, $row_data['full_name']);
                $worksheet->setCellValue('C' . $row, $row_data['job_title']);
                $worksheet->setCellValue('D' . $row, $row_data['department']);
                $worksheet->setCellValue('E' . $row, $row_data['gender']);
                $worksheet->setCellValue('F' . $row, $row_data['age']);
                $worksheet->setCellValue('G' . $row, $row_data['annual_salary']);
                $row++;
            }

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            // Write the spreadsheet object to a file
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        } else {
            echo '<script>alert("Empty Table.")</script>';
        }
        // header("Location: index.php");
    }

    function validation_data($spreadsheet, $count)
    {
        $worksheet = $spreadsheet->getActiveSheet();
        $newSpreadsheet = new Spreadsheet();
        $sheet = $newSpreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();

        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnupdated = chr(ord($highestColumn) + 1);

        $seenValues = array();
        $columnIndex = 'A';

        for ($row = 2; $row <= $highestRow; $row++) {
            $sheet->setCellValue($highestColumnupdated.'1', "Status");
            $sheet->setCellValue($highestColumnupdated . $row, "ok");
        }


        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Include empty cells

            foreach ($cellIterator as $cell) {
                $value = $cell->getValue();
                if ($value == "") {
                    $sheet->setCellValue($highestColumnupdated . $cell->getRow(), 'Empty');
                    $count++;
                    echo "<h6 style='text-align: center; color: red;'>Empty Cell at Column: " . $cell->getColumn() . $cell->getRow() . "</h6>";
                }
                $sheet->setCellValue($cell->getColumn() . $cell->getRow(), $value);
            }
        }

        for ($row = 1; $row <= $highestRow; $row++) {
            $cellValue = $worksheet->getCell($columnIndex . $row)->getValue();

            if (in_array($cellValue, $seenValues)) {
                echo "<h6 style='text-align: center; color: red;'>Duplicate value found in column " . 'A' . $row . ": " . $cellValue . "</h6>\n";
                $sheet->setCellValue($highestColumnupdated . $row, "Duplicate");
                $count++;
                // return false;
            } else if (!empty($cellValue)) {
                $seenValues[] = $cellValue;
            }
        }

        $writer = new Xlsx($newSpreadsheet);
        $writer->save('hello_world.xlsx');

        if ($count > 0) {
            echo "<a style='display:block; text-align:center;' href='./download.php'>Do you want to download status file?</a>";
        }

        return $count;
    }
}
