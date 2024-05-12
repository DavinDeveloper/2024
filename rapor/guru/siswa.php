<?php
require("../mainconfig.php");
require("../vendor/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$query = "SELECT nomor AS nis, nama, kelas FROM users WHERE status = 'Siswa' AND kelas = '".$_GET['1']."' ORDER BY nama ASC";
$result = mysqli_query($db, $query);

if ($result) {

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'NIS');
    $sheet->setCellValue('C1', 'Nama');
    $sheet->setCellValue('D1', 'Kelas');
    $sheet->setCellValue('E1', 'Catatan Akademik');
    $sheet->setCellValue('F1', 'Mitra DU/DI 1');
    $sheet->setCellValue('G1', 'Lokasi');
    $sheet->setCellValue('H1', 'Lama (Angka dalam bulan)');
    $sheet->setCellValue('I1', 'Nilai');
    $sheet->setCellValue('J1', 'Mitra DU/DI 2');
    $sheet->setCellValue('K1', 'Lokasi');
    $sheet->setCellValue('L1', 'Lama (Angka dalam bulan)');
    $sheet->setCellValue('M1', 'Nilai');
    $sheet->setCellValue('N1', 'Mitra DU/DI 3');
    $sheet->setCellValue('O1', 'Lokasi');
    $sheet->setCellValue('P1', 'Lama (Angka dalam bulan)');
    $sheet->setCellValue('Q1', 'Nilai');
    $sheet->setCellValue('R1', 'Ekstrakurikuler 1');
    $sheet->setCellValue('S1', 'Nilai');
    $sheet->setCellValue('T1', 'Ekstrakurikuler 2');
    $sheet->setCellValue('U1', 'Nilai');
    $sheet->setCellValue('V1', 'Ekstrakurikuler 3');
    $sheet->setCellValue('W1', 'Nilai');
    $sheet->setCellValue('X1', 'Sakit');
    $sheet->setCellValue('Y1', 'Izin');
    $sheet->setCellValue('Z1', 'Alfa');
    $sheet->setCellValue('AA1', 'Kenaikan Kelas');
    $sheet->setCellValue('AB1', 'Integritas');
    $sheet->setCellValue('AC1', 'Religius');
    $sheet->setCellValue('AD1', 'Nasionalis');
    $sheet->setCellValue('AE1', 'Mandiri');
    $sheet->setCellValue('AF1', 'Gotong-royong');
    $sheet->setCellValue('AG1', 'Catatan Perkembangan Karakter');
    $sheet->setCellValue('AH1', 'Prestasi Kurikuler 1');
    $sheet->setCellValue('AI1', 'Prestasi Kurikuler 2');
    $sheet->setCellValue('AJ1', 'Prestasi Kurikuler 3');
    $sheet->setCellValue('AK1', 'Prestasi Ekstra Kurikuler 1');
    $sheet->setCellValue('AL1', 'Prestasi Ekstra Kurikuler 2');
    $sheet->setCellValue('AM1', 'Prestasi Ekstra Kurikuler 3');
    $sheet->setCellValue('AN1', 'Prestasi Khusus Lainnya 1');
    $sheet->setCellValue('AO1', 'Prestasi Khusus Lainnya 2');
    $sheet->setCellValue('AP1', 'Prestasi Khusus Lainnya 3');
    
    $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP'];
    foreach ($columns as $col) {
        $sheet->getColumnDimension($col)->setWidth(strlen($sheet->getCell($col.'1')->getValue()) + 5);
    }
    
    $sheet->getStyle('A1:AP1')->applyFromArray([
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
    
    $sheet->getStyle('E1:AP1')->applyFromArray([
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
        $sheet->setCellValue('H' . $row, '');
        $sheet->setCellValue('I' . $row, '');
        $sheet->setCellValue('J' . $row, '');
        $sheet->setCellValue('K' . $row, '');
        $sheet->setCellValue('L' . $row, '');
        $sheet->setCellValue('M' . $row, '');
        $sheet->setCellValue('N' . $row, '');
        $sheet->setCellValue('O' . $row, '');
        $sheet->setCellValue('P' . $row, '');
        $sheet->setCellValue('Q' . $row, '');
        $sheet->setCellValue('R' . $row, '');
        $sheet->setCellValue('S' . $row, '');
        $sheet->setCellValue('T' . $row, '');
        $sheet->setCellValue('U' . $row, '');
        $sheet->setCellValue('V' . $row, '');
        $sheet->setCellValue('W' . $row, '');
        $sheet->setCellValue('X' . $row, '');
        $sheet->setCellValue('Y' . $row, '');
        $sheet->setCellValue('Z' . $row, '');
        $sheet->setCellValue('AA' . $row, '');
        $sheet->setCellValue('AB' . $row, 'Ananda memiliki pola hidup bermasyarakat yang baik dilingkungan sekolah');
        $sheet->setCellValue('AC' . $row, 'Ananda menunjukan ketakwaan pada agama yang dianutnya dan memiliki sikap toleran pada penganut agama berbeda');
        $sheet->setCellValue('AD' . $row, 'Ananda memiliki sikap disiplin dan tanggungjawab yang cukup baik serta aktif dalam mengikuti upacara disekolah');
        $sheet->setCellValue('AE' . $row, 'Ananda aktif dalam kegiatan pembelajaran dikelas');
        $sheet->setCellValue('AF' . $row, 'Ananda menunjukan sikap menghormati pendapat orang lain dalam musyawarah serta gotong royong dalam kegiatan bakti sosial dilingkungan sekolah');
        $sheet->setCellValue('AG' . $row, 'Ananda menunjukkan perkembangan karakter yang baik pada pembelajaran semester ini.');
        $sheet->setCellValue('AH' . $row, '');
        $sheet->setCellValue('AI' . $row, '');
        $sheet->setCellValue('AJ' . $row, '');
        $sheet->setCellValue('AK' . $row, '');
        $sheet->setCellValue('AL' . $row, '');
        $sheet->setCellValue('AM' . $row, '');
        $sheet->setCellValue('AN' . $row, '');
        $sheet->setCellValue('AO' . $row, '');
        $sheet->setCellValue('AP' . $row, '');
        
        foreach ($columns as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $sheet->getStyle('A'.$row.':AP'.$row)->applyFromArray([
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
    header('Content-Disposition: attachment;filename="Siswa Kelas '.$_GET['1'].'.xls"');
    header('Cache-Control: max-age=0');

    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    die("Query failed: " . mysqli_error($db));
}
?>
