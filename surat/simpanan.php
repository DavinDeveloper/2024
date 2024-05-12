<?
session_start();
require("../libs/main/config.php");
include "phpqrcode/qrlib.php";
$tempdir = "barcode/simpanan/";

    $post_id = $_GET['1'];
	$check_simpanan = mysqli_query($db, "SELECT * FROM simpanan WHERE id = '$post_id'");
	$data_simpanan = mysqli_fetch_assoc($check_simpanan);
	$data_anggota = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_simpanan['username']."'"));

	if (mysqli_num_rows($check_simpanan) == 0) {
		header("Location: ".cfg(url));
	} else if (empty($_GET['1'])) {
        header("Location: ".cfg(url));
    }
if (!file_exists($tempdir))
mkdir($tempdir);
$teks = "
Tanggal :
".$data_simpanan['datetime']."
            
Penandatangan :
".$data_simpanan['nama']."
            
Perihal :
Simpanan dengan ID".$data_simpanan['id'];
$namafile        = $data_simpanan['id'].".png";
$quality        = "H"; // L (Low), M(Medium), Q(Good), H(High)
$ukuran            = 3; // 1 - 10
$padding        = 1;
QRCode::png($teks, $tempdir . $namafile, $quality, $ukuran, $padding);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><? echo $data_anggota['nama']; ?> - Pembayaran Simpanan ID<? echo $data_simpanan['id']; ?></title>
    <meta name="description" content="Pembayaran Simpanan">
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
            <th colspan="11"><br><br><br>INVOICE PEMBAYARAN<p>SIMPANAN <? echo strtoupper($data_simpanan['jenis']); ?><br><br><br></th>
        </tr>
    </table>

    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Nama Anggota</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_anggota['nama']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Tempat Lahir</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_anggota['tempat_lahir']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Tanggal Lahir</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_anggota['tanggal_lahir']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Pekerjaan</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_anggota['pekerjaan']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Alamat</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_anggota['alamat']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">No. Telpon</td>
            <td style="width: 1%">:</td>
            <td style="width: 35%"><? echo $data_anggota['whatsapp']; ?></td>
        </tr>
    </table>
    <br><br>
                <table>
                    <p></p>
                    <p></p>
                    <tr>
                        <table width="100%"> 
                            <tr>
                                <td style="width: 20%">
                                ID Simpanan : ID<? echo $data_simpanan['id']; ?><br>
                                Jenis Simpanan : <? echo $data_simpanan['jenis']; ?><br>
                                Tipe Pembayaran : <? echo $data_simpanan['tipe']; ?><br>
                                Status Pembayaran : <? echo $data_simpanan['status']; ?><br>
                                Dibayarkan Pada : <? echo $data_simpanan['dibayarkan']; ?><br>
                                Dicetak pada : <? echo date("Y-m-d H:i:s"); ?>
                                <br><br><br><br><br><br>
                                <!--gambar-->
                                <br><br><br><br><br><br><br><br><br><br></td>
                                <td style="width: 15%"></td>
                                <td style="width: 15%">Penandatangan,<br><img width="100px" src="<? echo cfg(url) ?>surat/barcode/simpanan/<? echo $data_simpanan['id']; ?>.png" alt=""><br><b><? echo $data_anggota['nama']; ?></td>
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
