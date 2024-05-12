<?php
require("../../mainconfig.php");
require("../../vendor/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$query = "SELECT id, nomor AS username, nomor, nama, kelas, pelajaran, jurusan FROM users WHERE status = 'Guru'";
$result = mysqli_query($db, $query);

if ($result) {

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'USERNAME');
    $sheet->setCellValue('C1', 'NIP');
    $sheet->setCellValue('D1', 'Nama');
    $sheet->setCellValue('E1', 'Kelas');
    $sheet->setCellValue('F1', 'Pelajaran');
    $sheet->setCellValue('G1', 'Jurusan');
    
    foreach (range('A', 'G') as $col) {
        $sheet->getColumnDimension($col)->setWidth(strlen($sheet->getCell($col.'1')->getValue()) + 5);
    }
    
    $sheet->getStyle('A1:G1')->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ]);
    
    $sheet->getStyle('A1')->applyFromArray([
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'FF0000',
            ],
        ],
    ]);
    
    $sheet->getStyle('B1:G1')->applyFromArray([
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'FFFF00',
            ],
        ],
    ]);

    $row = 2;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $row_data['id']);
        $sheet->setCellValue('B' . $row, $row_data['username']);
        $sheet->setCellValue('C' . $row, $row_data['nomor']);
        $sheet->setCellValue('D' . $row, $row_data['nama']);
        $sheet->setCellValue('E' . $row, $row_data['kelas']);
        $sheet->setCellValue('F' . $row, $row_data['pelajaran']);
        $sheet->setCellValue('G' . $row, $row_data['jurusan']);
    
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $sheet->getStyle('A'.$row.':G'.$row)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
        
        $row++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="guru.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "Query failed: " . mysqli_error($db);
}
?>
