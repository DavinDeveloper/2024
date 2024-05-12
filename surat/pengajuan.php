<?
session_start();
require("../libs/main/config.php");
include "phpqrcode/qrlib.php";
$tempdir = "barcode/pinjaman/";
$tempdir_ketua = "barcode/ttd/";
$tempdir_bendahara = "barcode/ttd/";

    $post_id = $_GET['1'];
	$check_pinjaman = mysqli_query($db, "SELECT * FROM pinjaman WHERE id = '$post_id'");
	$data_pinjaman = mysqli_fetch_assoc($check_pinjaman);
	$data_peminjam = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_pinjaman['username']."'"));
	$data_ketua = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE status = 'Ketua'"));

	if (mysqli_num_rows($check_pinjaman) == 0) {
		header("Location: ".cfg(url));
	} else if (empty($_GET['1'])) {
        header("Location: ".cfg(url));
    }
if (!file_exists($tempdir))
mkdir($tempdir);
$quality = "H"; // L (Low), M(Medium), Q(Good), H(High)
$ukuran = 3; // 1 - 10
$padding = 1;
$teks = "
Tanggal :
".$data_pinjaman['datetime']."
            
Penandatangan :
".$data_peminjam['nama']."
            
Perihal :
Pinjaman dengan ID".$data_pinjaman['id'];
$namafile = $data_pinjaman['id'].".png";
QRCode::png($teks, $tempdir . $namafile, $quality, $ukuran, $padding);
if (!file_exists($tempdir_ketua))
mkdir($tempdir_ketua);
$teks_ketua = "    
Penandatangan :
Ketua ".cfg(description);
$namafile_ketua = "ketua.png";
QRCode::png($teks_ketua, $tempdir_ketua . $namafile_ketua, $quality, $ukuran, $padding);
if (!file_exists($tempdir_bendahara))
mkdir($tempdir_bendahara);
$teks_bendahara = "    
Penandatangan :
Bendahara ".cfg(description);
$namafile_bendahara = "bendahara.png";
QRCode::png($teks_bendahara, $tempdir_bendahara . $namafile_bendahara, $quality, $ukuran, $padding);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><? echo $data_peminjam['nama']; ?> - Angsuran Pinjaman ID<? echo $data_pinjaman['id_pinjaman']; ?></title>
    <meta name="description" content="Angsuran Pinjaman">
    <meta property="og:image" content="<? echo cfg(logo); ?>">
    <link itemprop="thumbnailUrl" href="<? echo cfg(logo); ?>">
    <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
    <link itemprop="url" href="<? echo cfg(logo); ?>"></span>
    <style>
        body {
            font-family: Verdana;
            font-size: 13px;
        }

        style.page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
<a id="print">
    <table width="100%" cellpadding="0">
        <tr colspan="11">
            <td style="padding-left: 30px"><img src="<? echo cfg(logo); ?>" alt="logo SMK" width="90px" height="90px"></td>
            <th colspan="10" style="padding-right: 95px" width="80%">
                <font size="5,5"><br><? echo cfg(description); ?></br></font size>
                <font size="2px" ;> <? echo cfg(alamat); ?></font><br>
                <font size="1" ;>Telp.(<? echo cfg(whatsapp); ?>), Email : <? echo cfg(email); ?></font>
            </th>
        <tr>

            <td colspan="11">
                <hr></td>
        </tr>

        <tr>
            <th colspan="11"><br><br><br>FORMULIR PERMOHONAN PENGAJUAN PINJAMAN<p><? echo strtoupper(cfg(description)); ?><br><br><br></th>
        </tr>
    </table>
    
    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Kepada Yth.</td>
        </tr>
        <tr>
            <td style="width: 18%">Ketua <? echo cfg(description); ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Di Tempat</td>
        </tr>
    </table>
    
    <br>
    
    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Dengan Hormat,</td>
        </tr>
        <tr>
            <td style="width: 18%">Yang bertandatangan di bawah ini, saya:</td>
        </tr>
        <tr>
            <td style="width: 18%">Nama</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_peminjam['nama']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">ID Anggota</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%">ID<? echo $data_peminjam['id']; ?></td>
        </tr>
    </table>
    
    <br><hr><br>

    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Tempat/Tanggal Lahir</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_peminjam['tempat_lahir']; ?>, <? echo $data_peminjam['tanggal_lahir']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Pekerjaan</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_peminjam['pekerjaan']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Alamat</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_peminjam['alamat']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">No. Telpon</td>
            <td style="width: 1%">:</td>
            <td style="width: 35%"><? echo $data_peminjam['whatsapp']; ?></td>
        </tr>
    </table>
    <br>
    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Dengan ini mengajukan permohonan pinjaman uang kepada <? echo cfg(description); ?>, sebagai berikut:</td>
        </tr>
        <tr>
            <td style="width: 18%">Jumlah Pinjaman</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%">Rp<? echo number_format($data_pinjaman['nominal'],0,',','.'); ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Jumlah Angsuran</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_pinjaman['angsuran']; ?> Bulan</td>
        </tr>
        <tr>
            <td style="width: 18%">Untuk Keperluan</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_pinjaman['keperluan']; ?></td>
        </tr>
    </table>
    <br>
    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Saya bersedia (gaji/tunjangan kinerja/pendapatan lainnya*) bulanan saya dipotong otomatis mulai bulan depan oleh Bendahara Pengeluaran BUTTMKHIT untuk membayar angsuran pinjaman tersebut jika permohonan saya disetujui.</td>
        </tr>
    </table>
    <br>
    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Demikian surat permohonan ini saya buat, atas perhatian dan persetujuannya saya ucapkan terima kasih.</td>
        </tr>
    </table>
    <br><br>
                <table>
                    <p></p>
                    <p></p>
                    <tr>
                        <table width="100%">
                            <tr>
                                <td style="width: 20%">Bekasi, <? echo date("d-m-Y"); ?><br><br><br><br><br><br><br><br>Pemohon,<br><br><img width="100px" src="<? echo cfg(url) ?>surat/barcode/pinjaman/<? echo $data_pinjaman['id']; ?>.png" alt=""><br><br><b><? echo $data_peminjam['nama']; ?>
                                <br><br><br><br><br><br><br><br><br><br><br></td>
                                <td style="width: 15%"></td>
                                <td style="width: 15%">
                                Bendahara <? echo cfg(description); ?><br><br><img width="100px" src="<? echo cfg(url) ?>surat/barcode/ttd/bendahara.png" alt=""><br><br><b>Bendahara <? echo cfg(description); ?></b>
                                <br><br><br>Ketua <? echo cfg(description); ?><br><br><img width="100px" src="<? echo cfg(url) ?>surat/barcode/ttd/ketua.png" alt=""><br><br><b>Ketua <? echo cfg(description); ?></b></td>
                            </tr>


                        </table>
                        </center>
</a>
<script>
    document.getElementById("print").addEventListener("click", function() {
        window.print();
    });
</script>
</body>
</html>
