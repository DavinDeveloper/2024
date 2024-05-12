<?php
include '../../libs/main/config.php';
require("../../vendor/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$query = "SELECT * FROM simpanan ORDER BY id ASC";
$result = mysqli_query($db, $query);

if ($result) {

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', '#');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Username');
    $sheet->setCellValue('D1', 'Bulan');
    $sheet->setCellValue('E1', 'Nominal');
    $sheet->setCellValue('F1', 'Jenis');
    $sheet->setCellValue('G1', 'Pembayaran');

    foreach (range('A', 'G') as $col) {
        $sheet->getColumnDimension($col)->setWidth(20);
    }

    $sheet->getStyle('A1:G1')->applyFromArray([
        'font' => [
            'bold' => true,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'FFFF00',
            ],
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ]);

    $row = 2;
    $no = 1;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$row_data['username']."'"));
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $user_data['nama']);
        $sheet->setCellValue('C' . $row, $row_data['username']);
        $sheet->setCellValue('D' . $row, $row_data['bulan']);
        $sheet->setCellValue('E' . $row, 'Rp'.number_format($row_data['nominal'], 0, ',', '.'));
        $sheet->setCellValue('F' . $row, $row_data['jenis']);
        $sheet->setCellValue('G' . $row, $row_data['tipe']);

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
    header('Content-Disposition: attachment;filename="simpanan.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "Query failed: " . mysqli_error($db);
}
?>
