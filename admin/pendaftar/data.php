<?php
require("../mainconfig.php");
require("../vendor/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Hyperlink;

$query = "SELECT * FROM ppdb";
$result = mysqli_query($db, $query);

if ($result) {

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Jenis');
    $sheet->setCellValue('D1', 'Jalur');
    $sheet->setCellValue('E1', 'Jurusan');
    $sheet->setCellValue('F1', 'Kelamin');
    $sheet->setCellValue('G1', 'Tempat Lahir');
    $sheet->setCellValue('H1', 'Tanggal Lahir');
    $sheet->setCellValue('I1', 'Agama');
    $sheet->setCellValue('J1', 'Alamat');
    $sheet->setCellValue('K1', 'Kabupaten');
    $sheet->setCellValue('L1', 'Telepon');
    $sheet->setCellValue('M1', 'Kewarganegaraan');
    $sheet->setCellValue('N1', 'Foto');
    $sheet->setCellValue('O1', 'Bukti Transfer');
    $sheet->setCellValue('P1', 'Waktu');
    
    foreach (range('A', 'P') as $col) {
        $sheet->getColumnDimension($col)->setWidth(strlen($sheet->getCell($col.'1')->getValue()) + 5);
    }
    $sheet->getStyle('A1:P1')->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ]);
    $sheet->getStyle('A1:P1')->applyFromArray([
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'FFFF00',
            ],
        ],
    ]);
    $counter = 1;
    $row = 2;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $counter);
        $sheet->setCellValue('B' . $row, $row_data['nama']);
        $sheet->setCellValue('C' . $row, $row_data['jenis']);
        $sheet->setCellValue('D' . $row, $row_data['jalur']);
        $sheet->setCellValue('E' . $row, $row_data['jurusan']);
        $sheet->setCellValue('F' . $row, $row_data['kelamin']);
        $sheet->setCellValue('G' . $row, $row_data['tempat_lahir']);
        $sheet->setCellValue('H' . $row, $row_data['tanggal_lahir']);
        $sheet->setCellValue('I' . $row, $row_data['agama']);
        $sheet->setCellValue('J' . $row, $row_data['alamat']);
        $sheet->setCellValue('K' . $row, $row_data['kabupaten']);
        $sheet->setCellValue('L' . $row, $row_data['telepon']);
        $sheet->setCellValue('M' . $row, $row_data['kewarganegaraan']);
        $sheet->setCellValue('N' . $row, $row_data['foto']);
        $sheet->setCellValue('O' . $row, $row_data['bukti']);

        $sheet->setCellValue('P' . $row, $row_data['datetime']);

        foreach (range('A', 'P') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $sheet->getStyle('A'.$row.':P'.$row)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
        $counter++;
        $row++;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ppdb.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "Query failed: " . mysqli_error($db);
}
?>
