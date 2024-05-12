<?php
require("../mainconfig.php");
require("../vendor/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$query = "SELECT nomor AS nis, nama, kelas FROM users WHERE status = 'Siswa' ORDER BY kelas ASC";
$result = mysqli_query($db, $query);

if ($result) {

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'NIS');
    $sheet->setCellValue('C1', 'Nama');
    $sheet->setCellValue('D1', 'Kelas');
    $sheet->setCellValue('E1', 'Nilai Pengetahuan');
    $sheet->setCellValue('F1', 'Nilai Keterampilan');
    $sheet->setCellValue('G1', 'Sikap');
    
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
    
    $sheet->getStyle('A1:B1')->applyFromArray([
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'FF0000',
            ],
        ],
    ]);
    
    $sheet->getStyle('C1:D1')->applyFromArray([
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'D0D0D0',
            ],
        ],
    ]);
    
    $sheet->getStyle('E1:G1')->applyFromArray([
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'FFFF00',
            ],
        ],
    ]);

    $no = 1;
    $row = 2;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $row_data['nis']);
        $sheet->setCellValue('C' . $row, $row_data['nama']);
        $sheet->setCellValue('D' . $row, $row_data['kelas']);
        $sheet->setCellValue('E' . $row, '');
        $sheet->setCellValue('F' . $row, '');
        $sheet->setCellValue('G' . $row, '');
    
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
    
        $no++; 
        $row++;
    }

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="siswa.xls"');
    header('Cache-Control: max-age=0');

    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    die("Query failed: " . mysqli_error($db));
}
?>
