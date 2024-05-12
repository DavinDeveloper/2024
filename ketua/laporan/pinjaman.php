<?php
include '../../libs/main/config.php';
require("../../vendor/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$query = "SELECT * FROM pinjaman ORDER BY id ASC";
$result = mysqli_query($db, $query);

if ($result) {

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', '#');
    $sheet->setCellValue('B1', 'ID Pinjaman');
    $sheet->setCellValue('C1', 'Anggota');
    $sheet->setCellValue('D1', 'Nama');
    $sheet->setCellValue('E1', 'Nominal');
    $sheet->setCellValue('F1', 'Angsuran');
    $sheet->setCellValue('G1', 'Keperluan');
    $sheet->setCellValue('H1', 'Sisa');
    $sheet->setCellValue('I1', 'Status Lunas');
    $sheet->setCellValue('J1', 'Status Pengajuan');

    foreach (range('A', 'K') as $col) {
        $sheet->getColumnDimension($col)->setWidth(20);
    }

    $sheet->getStyle('A1:J1')->applyFromArray([
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
        $data_pengguna = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$row_data['username']."'"));
        $sisa_angsuran = mysqli_num_rows(mysqli_query($db, "SELECT * FROM angsuran WHERE id_pinjaman = '".$row_data['id']."' AND status != 'Dibayar'"));
        if ($row_data['pengajuan'] == 'Menunggu' OR $row_data['pengajuan'] == 'Ditolak') {
            $sisa_bulan = $row_data['pengajuan'];
        } else if ($sisa_angsuran == 0) {
            $sisa_bulan = 'Lunas';
        } else {
            $sisa_bulan = $sisa_angsuran.' Bulan';
        }

        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, 'ID'.$row_data['id']);
        $sheet->setCellValue('C' . $row, $row_data['username']);
        $sheet->setCellValue('D' . $row, $data_pengguna['nama']);
        $sheet->setCellValue('E' . $row, 'Rp'.number_format($row_data['nominal'], 0, ',', '.'));
        $sheet->setCellValue('F' . $row, $row_data['angsuran'].' Bulan');
        $sheet->setCellValue('G' . $row, $row_data['keperluan']);
        $sheet->setCellValue('H' . $row, $sisa_bulan);
        $sheet->setCellValue('I' . $row, $row_data['status']);
        $sheet->setCellValue('J' . $row, $row_data['pengajuan']);

        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $sheet->getStyle('A'.$row.':J'.$row)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        $row++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="pinjaman.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "Query failed: " . mysqli_error($db);
}
?>
