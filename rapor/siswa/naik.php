<?php
session_start();
require("../mainconfig.php");
include "../../barcode/phpqrcode/qrlib.php";
$tempdir = "../barcode/";

    $post_username = $_GET['1'];
    $post_semester = $_GET['2'];

if (isset($_SESSION['user'])) {
    $sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
}

	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl);
	}
	
	if ($post_semester == "1") {
	    header("Location: " . $cfg_baseurl);
	} else if ($post_semester == "2" AND $data_website['akses2'] == "No" AND $data_user['guru'] != 'Yes') {
	    header("Location: " . $cfg_baseurl . "404");
	} else if ($post_semester == "3") {
	    header("Location: " . $cfg_baseurl);
	} else if ($post_semester == "4" AND $data_website['akses4'] == "No" AND $data_user['guru'] != 'Yes') {
	    header("Location: " . $cfg_baseurl . "404");
	} else if ($post_semester == "5") {
	    header("Location: " . $cfg_baseurl);
	} else if ($post_semester == "6") {
	    header("Location: " . $cfg_baseurl);
	}

if (!file_exists($tempdir))
    mkdir($tempdir);
    
if (empty($_GET['1'])) {
    header("Location: " . $cfg_baseurl);
}
    
    $check_user = mysqli_query($db, "SELECT * FROM users,pas WHERE pas.username = users.username AND users.username = '$post_username'");
    $data_user = mysqli_fetch_assoc($check_user);
    $walas = $data_user['walas_user'];

    $check_walas = mysqli_query($db, "SELECT * FROM users WHERE username = '$walas'");
    $data_walas = mysqli_fetch_assoc($check_walas);
	
	if ($post_semester == "2") {
	    $semester = 'II / Genap';
	    $tahun = $data_website['tahunpas2'];
	} else if ($post_semester == "4") {
	    $semester = 'IV / Genap';
	    $tahun = $data_website['tahunpas4'];
	}
	
	if ($data_user['nominal'] > 0) {
	    header("Location: " . $home . "spp/404");
	}
	
    if (mysqli_num_rows($check_user) == 0) {
        header("Location: " . $cfg_baseurl);
    }
    
$teks = "
            Tanggal :
            ".$data_website['tanggalpas'.$post_semester.'']."
            
            Penandatangan :
            ".$data_walas['nama']."
            
            Perihal :
            Rapor Penilaian Akhir Tahun ".$semester." ".$tahun."";
$namafile        = $data_website['tanggalpas'.$post_semester.'']."-davinwardana-".$data_user['username'].".png";
$quality        = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
$ukuran            = 3; // 1 adalah yang terkecil, 10 paling besar
$padding        = 1;

QRCode::png($teks, $tempdir . $namafile, $quality, $ukuran, $padding);
// include("../lib/header.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data_user['asli']; ?></title>
    <meta name="description" content="Rapor Kenaikan Semester <?php echo $post_semester; ?>">
    <meta property="og:image" content="<?php echo $data_user['profile']; ?>">
    <link itemprop="thumbnailUrl" href="<?php echo $data_user['profile']; ?>">
    <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
    <link itemprop="url" href="<?php echo $data_user['profile']; ?>"></span>
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
    <div class="hidden-print">
        <div class="float-right">
            <a target=”_blank” href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_user['username']; ?>/" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <table width="100%" cellpadding="0">
        <tr colspan="11">
            <td style="padding-left: 30px"><img src="<?php echo $cfg['logo']; ?>" alt="logo SMK" width="90px" height="90px"></td>
            <th colspan="10" style="padding-right: 95px" width="80%">
                <font size="5,5"><br><?php echo $cfg['name']; ?></br></font size>
                <font size="2px" ;> <?php echo $cfg['alamat']; ?></font><br>
                <font size="1" ;>Telp.(<?php echo $cfg['telepon']; ?>), Email : <?php echo $cfg['email']; ?></font>
            </th>
        <tr>

            <td colspan="11">
                <hr></td>
        </tr>

        <tr>
            <th colspan="11">LAPORAN HASIL BELAJAR SISWA<p>PENILAIAN AKHIR TAHUN</th>
        </tr>
    </table>

    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Nama Siswa</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_user['asli']; ?></td>
            <td style="width: 20%">Program Keahlian</td>
            <td style="width: 1%">:</td>
            <td style="width: 25%"><?php echo $data_user['program']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Nomor Induk</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_user['nis']; ?></td>
            <td style="width: 23%">Kompetensi Keahlian</td>
            <td style="width: 1%">:</td>
            <td style="width: 25%"><?php echo $data_user['jurusan']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">NISN</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_user['nisn']; ?></td>
            <td style="width: 20%">Semester</td>
            <td style="width: 1%">:</td>
            <td style="width: 25%"><?php echo $semester; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Kelas</td>
            <td style="width: 1%">:</td>
            <td style="width: 35%"><?php echo $data_user['kelas']; ?></td>
            <td style="width: 20%">Tahun Pelajaran</td>
            <td style="width: 1%">:</td>
            <td style="width: 40%"><?php echo $tahun; ?></td>

        </tr>
    </table>
    <br>
    <div class="strong"><b>A.&nbsp;&nbsp;Nilai Akademik</b></div>
    
    <!--NILAI AKADEMIK-->
    
    <table width="100%" style="border-collapse: collapse; border:1px solid black;" cellpadding="4">
        <tr>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">No</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Mata Pelajaran</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Pengetahuan</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Keterampilan</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Nilai Akhir</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Predikat</th>
        </tr>
        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b> Kelompok A (Muatan Nasional)</b></td>
        </tr>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">1</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pendidikan Agama dan Budi Pekerti</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_agama']==0){echo "-";}elseif($data_user['p'.$post_semester.'_agama']>0){echo $data_user['p'.$post_semester.'_agama'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_agama']==0){echo "-";}elseif($data_user['k'.$post_semester.'_agama']>0){echo $data_user['k'.$post_semester.'_agama'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_agama']==0 && $data_user['k'.$post_semester.'_agama']==0){echo "-";}elseif($data_user['p'.$post_semester.'_agama']>0 && $data_user['k'.$post_semester.'_agama']>0){ echo number_format(($data_user['p'.$post_semester.'_agama'] + $data_user['k'.$post_semester.'_agama']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_agama']+$data_user['k'.$post_semester.'_agama'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">2</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pendidikan Pancasila dan Kewarganegaraan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_pkn']==0){echo "-";}elseif($data_user['p'.$post_semester.'_pkn']>0){echo $data_user['p'.$post_semester.'_pkn'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_pkn']==0){echo "-";}elseif($data_user['k'.$post_semester.'_pkn']>0){echo $data_user['k'.$post_semester.'_pkn'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_pkn']==0 && $data_user['k'.$post_semester.'_pkn']==0){echo "-";}elseif($data_user['p'.$post_semester.'_pkn']>0 && $data_user['k'.$post_semester.'_pkn']>0){ echo number_format(($data_user['p'.$post_semester.'_pkn'] + $data_user['k'.$post_semester.'_pkn']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_pkn']+$data_user['k'.$post_semester.'_pkn'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">3</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Indonesia</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasaindonesia']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasaindonesia']>0){echo $data_user['p'.$post_semester.'_bahasaindonesia'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasaindonesia']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasaindonesia']>0){echo $data_user['k'.$post_semester.'_bahasaindonesia'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasaindonesia']==0 && $data_user['k'.$post_semester.'_bahasaindonesia']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasaindonesia']>0 && $data_user['k'.$post_semester.'_bahasaindonesia']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasaindonesia'] + $data_user['k'.$post_semester.'_bahasaindonesia']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasaindonesia']+$data_user['k'.$post_semester.'_bahasaindonesia'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">4</td>
                    <td style="border-collapse: collapse; border:1px solid black">Matematika</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_matematika']==0){echo "-";}elseif($data_user['p'.$post_semester.'_matematika']>0){echo $data_user['p'.$post_semester.'_matematika'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_matematika']==0){echo "-";}elseif($data_user['k'.$post_semester.'_matematika']>0){echo $data_user['k'.$post_semester.'_matematika'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_matematika']==0 && $data_user['k'.$post_semester.'_matematika']==0){echo "-";}elseif($data_user['p'.$post_semester.'_matematika']>0 && $data_user['k'.$post_semester.'_matematika']>0){ echo number_format(($data_user['p'.$post_semester.'_matematika'] + $data_user['k'.$post_semester.'_matematika']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_matematika']+$data_user['k'.$post_semester.'_matematika'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">5</td>
                    <td style="border-collapse: collapse; border:1px solid black">Sejarah Indonesia</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_sejarahindonesia']==0){echo "-";}elseif($data_user['p'.$post_semester.'_sejarahindonesia']>0){echo $data_user['p'.$post_semester.'_sejarahindonesia'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_sejarahindonesia']==0){echo "-";}elseif($data_user['k'.$post_semester.'_sejarahindonesia']>0){echo $data_user['k'.$post_semester.'_sejarahindonesia'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_sejarahindonesia']==0 && $data_user['k'.$post_semester.'_sejarahindonesia']==0){echo "-";}elseif($data_user['p'.$post_semester.'_sejarahindonesia']>0 && $data_user['k'.$post_semester.'_sejarahindonesia']>0){ echo number_format(($data_user['p'.$post_semester.'_sejarahindonesia'] + $data_user['k'.$post_semester.'_sejarahindonesia']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_sejarahindonesia']+$data_user['k'.$post_semester.'_sejarahindonesia'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">6</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Inggris</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasainggris']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasainggris']>0){echo $data_user['p'.$post_semester.'_bahasainggris'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasainggris']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasainggris']>0){echo $data_user['k'.$post_semester.'_bahasainggris'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasainggris']==0 && $data_user['k'.$post_semester.'_bahasainggris']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasainggris']>0 && $data_user['k'.$post_semester.'_bahasainggris']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasainggris'] + $data_user['k'.$post_semester.'_bahasainggris']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasainggris']+$data_user['k'.$post_semester.'_bahasainggris'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
        <tr>
            <td colspan="6" style="background: lightgray;"><b>Kelompok B (Muatan Kewilayahan)</b></td>
        </tr>
                 <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">7</td>
                    <td style="border-collapse: collapse; border:1px solid black">Seni Budaya</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_senibudaya']==0){echo "-";}elseif($data_user['p'.$post_semester.'_senibudaya']>0){echo $data_user['p'.$post_semester.'_senibudaya'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_senibudaya']==0){echo "-";}elseif($data_user['k'.$post_semester.'_senibudaya']>0){echo $data_user['k'.$post_semester.'_senibudaya'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_senibudaya']==0 && $data_user['k'.$post_semester.'_senibudaya']==0){echo "-";}elseif($data_user['p'.$post_semester.'_senibudaya']>0 && $data_user['k'.$post_semester.'_senibudaya']>0){ echo number_format(($data_user['p'.$post_semester.'_senibudaya'] + $data_user['k'.$post_semester.'_senibudaya']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_senibudaya']+$data_user['k'.$post_semester.'_senibudaya'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                 </tr>
                  <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">8</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pendidikan Jasmani, Olahraga dan Kesehatan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_pjok']==0){echo "-";}elseif($data_user['p'.$post_semester.'_pjok']>0){echo $data_user['p'.$post_semester.'_pjok'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_pjok']==0){echo "-";}elseif($data_user['k'.$post_semester.'_pjok']>0){echo $data_user['k'.$post_semester.'_pjok'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_pjok']==0 && $data_user['k'.$post_semester.'_pjok']==0){echo "-";}elseif($data_user['p'.$post_semester.'_pjok']>0 && $data_user['k'.$post_semester.'_pjok']>0){ echo number_format(($data_user['p'.$post_semester.'_pjok'] + $data_user['k'.$post_semester.'_pjok']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_pjok']+$data_user['k'.$post_semester.'_pjok'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>Kelompok C (Peminatan)</b></td>
        </tr>
        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C1. Dasar Bidang Keahlian</b></td>
        </tr>
        <?php if ($data_user['jurusan'] == 'Akuntansi dan Keuangan Lembaga') { ?>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">9</td>
                    <td style="border-collapse: collapse; border:1px solid black">Simulasi dan Komunikasi Digital</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['p'.$post_semester.'_simdig']>0){echo $data_user['p'.$post_semester.'_simdig'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['k'.$post_semester.'_simdig']>0){echo $data_user['k'.$post_semester.'_simdig'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_simdig']==0 && $data_user['k'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['p'.$post_semester.'_simdig']>0 && $data_user['k'.$post_semester.'_simdig']>0){ echo number_format(($data_user['p'.$post_semester.'_simdig'] + $data_user['k'.$post_semester.'_simdig']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_simdig']+$data_user['k'.$post_semester.'_simdig'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">10</td>
                    <td style="border-collapse: collapse; border:1px solid black">Ekonomi Bisnis</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['ekonomibisnis_s'.$post_semester.'']==0){echo "-";}elseif($data_user['ekonomibisnis_s'.$post_semester.'']>0){echo $data_user['ekonomibisnis_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['ekonomibisnis_s'.$post_semester.'']==0){echo "-";}elseif($data_user['ekonomibisnis_s'.$post_semester.'']>0){echo $data_user['ekonomibisnis_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['ekonomibisnis_s'.$post_semester.'']==0 && $data_user['ekonomibisnis_s'.$post_semester.'']==0){echo "-";}elseif($data_user['ekonomibisnis_s'.$post_semester.'']>0 && $data_user['ekonomibisnis_s'.$post_semester.'']>0){ echo number_format(($data_user['ekonomibisnis_s'.$post_semester.''] + $data_user['ekonomibisnis_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['ekonomibisnis_s'.$post_semester.'']+$data_user['ekonomibisnis_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">11</td>
                    <td style="border-collapse: collapse; border:1px solid black">Administrasi Umum</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['administrasiumum_s'.$post_semester.'']==0){echo "-";}elseif($data_user['administrasiumum_s'.$post_semester.'']>0){echo $data_user['administrasiumum_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['administrasiumum_s'.$post_semester.'']==0){echo "-";}elseif($data_user['administrasiumum_s'.$post_semester.'']>0){echo $data_user['administrasiumum_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['administrasiumum_s'.$post_semester.'']==0 && $data_user['administrasiumum_s'.$post_semester.'']==0){echo "-";}elseif($data_user['administrasiumum_s'.$post_semester.'']>0 && $data_user['administrasiumum_s'.$post_semester.'']>0){ echo number_format(($data_user['administrasiumum_s'.$post_semester.''] + $data_user['administrasiumum_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['administrasiumum_s'.$post_semester.'']+$data_user['administrasiumum_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">12</td>
                    <td style="border-collapse: collapse; border:1px solid black">IPA</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_ipa']==0){echo "-";}elseif($data_user['p'.$post_semester.'_ipa']>0){echo $data_user['p'.$post_semester.'_ipa'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_ipa']==0){echo "-";}elseif($data_user['k'.$post_semester.'_ipa']>0){echo $data_user['k'.$post_semester.'_ipa'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_ipa']==0 && $data_user['k'.$post_semester.'_ipa']==0){echo "-";}elseif($data_user['p'.$post_semester.'_ipa']>0 && $data_user['k'.$post_semester.'_ipa']>0){ echo number_format(($data_user['p'.$post_semester.'_ipa'] + $data_user['k'.$post_semester.'_ipa']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_ipa']+$data_user['k'.$post_semester.'_ipa'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
        <?php } else if ($data_user['jurusan'] == 'Perhotelan') { ?>
        
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">9</td>
                    <td style="border-collapse: collapse; border:1px solid black">Simulasi dan Komunikasi Digital</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['p'.$post_semester.'_simdig']>0){echo $data_user['p'.$post_semester.'_simdig'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['k'.$post_semester.'_simdig']>0){echo $data_user['k'.$post_semester.'_simdig'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_simdig']==0 && $data_user['k'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['p'.$post_semester.'_simdig']>0 && $data_user['k'.$post_semester.'_simdig']>0){ echo number_format(($data_user['p'.$post_semester.'_simdig'] + $data_user['k'.$post_semester.'_simdig']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_simdig']+$data_user['k'.$post_semester.'_simdig'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">10</td>
                    <td style="border-collapse: collapse; border:1px solid black">IPA Terapan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_ipaterapan']==0){echo "-";}elseif($data_user['p'.$post_semester.'_ipaterapan']>0){echo $data_user['p'.$post_semester.'_ipaterapan'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_ipaterapan']==0){echo "-";}elseif($data_user['k'.$post_semester.'_ipaterapan']>0){echo $data_user['k'.$post_semester.'_ipaterapan'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_ipaterapan']==0 && $data_user['k'.$post_semester.'_ipaterapan']==0){echo "-";}elseif($data_user['p'.$post_semester.'_ipaterapan']>0 && $data_user['k'.$post_semester.'_ipaterapan']>0){ echo number_format(($data_user['p'.$post_semester.'_ipaterapan'] + $data_user['k'.$post_semester.'_ipaterapan']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_ipaterapan']+$data_user['k'.$post_semester.'_ipaterapan'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">11</td>
                    <td style="border-collapse: collapse; border:1px solid black">Kepariwisataan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kepariwisataan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kepariwisataan_s'.$post_semester.'']>0){echo $data_user['kepariwisataan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kepariwisataan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kepariwisataan_s'.$post_semester.'']>0){echo $data_user['kepariwisataan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kepariwisataan_s'.$post_semester.'']==0 && $data_user['kepariwisataan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kepariwisataan_s'.$post_semester.'']>0 && $data_user['kepariwisataan_s'.$post_semester.'']>0){ echo number_format(($data_user['kepariwisataan_s'.$post_semester.''] + $data_user['kepariwisataan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['kepariwisataan_s'.$post_semester.'']+$data_user['kepariwisataan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
        <?php } else { ?>
        
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">9</td>
                    <td style="border-collapse: collapse; border:1px solid black">Simulasi dan Komunikasi Digital</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['p'.$post_semester.'_simdig']>0){echo $data_user['p'.$post_semester.'_simdig'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['k'.$post_semester.'_simdig']>0){echo $data_user['k'.$post_semester.'_simdig'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_simdig']==0 && $data_user['k'.$post_semester.'_simdig']==0){echo "-";}elseif($data_user['p'.$post_semester.'_simdig']>0 && $data_user['k'.$post_semester.'_simdig']>0){ echo number_format(($data_user['p'.$post_semester.'_simdig'] + $data_user['k'.$post_semester.'_simdig']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_simdig']+$data_user['k'.$post_semester.'_simdig'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">10</td>
                    <td style="border-collapse: collapse; border:1px solid black">Fisika</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_fisika']==0){echo "-";}elseif($data_user['p'.$post_semester.'_fisika']>0){echo $data_user['p'.$post_semester.'_fisika'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_fisika']==0){echo "-";}elseif($data_user['k'.$post_semester.'_fisika']>0){echo $data_user['k'.$post_semester.'_fisika'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_fisika']==0 && $data_user['k'.$post_semester.'_fisika']==0){echo "-";}elseif($data_user['p'.$post_semester.'_fisika']>0 && $data_user['k'.$post_semester.'_fisika']>0){ echo number_format(($data_user['p'.$post_semester.'_fisika'] + $data_user['k'.$post_semester.'_fisika']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_fisika']+$data_user['k'.$post_semester.'_fisika'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">11</td>
                    <td style="border-collapse: collapse; border:1px solid black">Kimia</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_kimia']==0){echo "-";}elseif($data_user['p'.$post_semester.'_kimia']>0){echo $data_user['p'.$post_semester.'_kimia'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_kimia']==0){echo "-";}elseif($data_user['k'.$post_semester.'_kimia']>0){echo $data_user['k'.$post_semester.'_kimia'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_kimia']==0 && $data_user['k'.$post_semester.'_kimia']==0){echo "-";}elseif($data_user['p'.$post_semester.'_kimia']>0 && $data_user['k'.$post_semester.'_kimia']>0){ echo number_format(($data_user['p'.$post_semester.'_kimia'] + $data_user['k'.$post_semester.'_kimia']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_kimia']+$data_user['k'.$post_semester.'_kimia'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
        <?php  } ?>
        
        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C2. Dasar Program Keahlian</b></td>
        </tr>
        <?php if ($data_user['jurusan'] == 'Teknik dan Bisnis Sepeda Motor') { ?>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">12</td>
                    <td style="border-collapse: collapse; border:1px solid black">Gambar Teknik Otomotif</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['gambarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['gambarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['gambarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['gambarteknikotomotif_s'.$post_semester.'']+$data_user['gambarteknikotomotif_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                   
                      <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">13</td>
                    <td style="border-collapse: collapse; border:1px solid black">Teknologi Dasar Otomotif</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknologidasarotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknologidasarotomotif_s'.$post_semester.'']>0){echo $data_user['teknologidasarotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknologidasarotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknologidasarotomotif_s'.$post_semester.'']>0){echo $data_user['teknologidasarotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknologidasarotomotif_s'.$post_semester.'']==0 && $data_user['teknologidasarotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknologidasarotomotif_s'.$post_semester.'']>0 && $data_user['teknologidasarotomotif_s'.$post_semester.'']>0){ echo number_format(($data_user['teknologidasarotomotif_s'.$post_semester.''] + $data_user['teknologidasarotomotif_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['teknologidasarotomotif_s'.$post_semester.'']+$data_user['teknologidasarotomotif_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">14</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pekerjaan Dasar Teknik Otomotif</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']==0 && $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']>0 && $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']>0){ echo number_format(($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.''] + $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']+$data_user['pekerjaandasarteknikotomotif_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     </tr>
                     
<tr>
    <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C3. Kompetensi Keahlian</b></td>

   <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">15</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pemeliharaan Mesin Sepeda Motor</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mesinsepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mesinsepedamotor_s'.$post_semester.'']>0){echo $data_user['mesinsepedamotor_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mesinsepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mesinsepedamotor_s'.$post_semester.'']>0){echo $data_user['mesinsepedamotor_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mesinsepedamotor_s'.$post_semester.'']==0 && $data_user['mesinsepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mesinsepedamotor_s'.$post_semester.'']>0 && $data_user['mesinsepedamotor_s'.$post_semester.'']>0){ echo number_format(($data_user['mesinsepedamotor_s'.$post_semester.''] + $data_user['mesinsepedamotor_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['mesinsepedamotor_s'.$post_semester.'']+$data_user['mesinsepedamotor_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">16</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pemeliharaan Sasis Sepeda Motor</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sasissepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sasissepedamotor_s'.$post_semester.'']>0){echo $data_user['sasissepedamotor_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sasissepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sasissepedamotor_s'.$post_semester.'']>0){echo $data_user['sasissepedamotor_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sasissepedamotor_s'.$post_semester.'']==0 && $data_user['sasissepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sasissepedamotor_s'.$post_semester.'']>0 && $data_user['sasissepedamotor_s'.$post_semester.'']>0){ echo number_format(($data_user['sasissepedamotor_s'.$post_semester.''] + $data_user['sasissepedamotor_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['sasissepedamotor_s'.$post_semester.'']+$data_user['sasissepedamotor_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">17</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pemeliharaan Kelistrikan Sepeda Motor</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kelistrikansepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kelistrikansepedamotor_s'.$post_semester.'']>0){echo $data_user['kelistrikansepedamotor_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kelistrikansepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kelistrikansepedamotor_s'.$post_semester.'']>0){echo $data_user['kelistrikansepedamotor_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kelistrikansepedamotor_s'.$post_semester.'']==0 && $data_user['kelistrikansepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kelistrikansepedamotor_s'.$post_semester.'']>0 && $data_user['kelistrikansepedamotor_s'.$post_semester.'']>0){ echo number_format(($data_user['kelistrikansepedamotor_s'.$post_semester.''] + $data_user['kelistrikansepedamotor_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['kelistrikansepedamotor_s'.$post_semester.'']+$data_user['kelistrikansepedamotor_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">18</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pengelolaan Bengkel Sepeda Motor</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['bengkelsepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['bengkelsepedamotor_s'.$post_semester.'']>0){echo $data_user['bengkelsepedamotor_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['bengkelsepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['bengkelsepedamotor_s'.$post_semester.'']>0){echo $data_user['bengkelsepedamotor_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['bengkelsepedamotor_s'.$post_semester.'']==0 && $data_user['bengkelsepedamotor_s'.$post_semester.'']==0){echo "-";}elseif($data_user['bengkelsepedamotor_s'.$post_semester.'']>0 && $data_user['bengkelsepedamotor_s'.$post_semester.'']>0){ echo number_format(($data_user['bengkelsepedamotor_s'.$post_semester.''] + $data_user['bengkelsepedamotor_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['bengkelsepedamotor_s'.$post_semester.'']+$data_user['bengkelsepedamotor_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">19</td>
                    <td style="border-collapse: collapse; border:1px solid black">Produk Kreatif dan Kewirausahaan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){ echo number_format(($data_user['produkkreatifdankewirausahaan_s'.$post_semester.''] + $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']+$data_user['produkkreatifdankewirausahaan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>

        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray"><b>D. Muatan Lokal</b></td>
        </tr>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">20</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Jepang</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0){echo $data_user['p'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasajepang']>0){echo $data_user['k'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0 && $data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0 && $data_user['k'.$post_semester.'_bahasajepang']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasajepang'] + $data_user['k'.$post_semester.'_bahasajepang']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasajepang']+$data_user['k'.$post_semester.'_bahasajepang'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">21</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Mandarin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0){echo $data_user['p'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasamandarin']>0){echo $data_user['k'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0 && $data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0 && $data_user['k'.$post_semester.'_bahasamandarin']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasamandarin'] + $data_user['k'.$post_semester.'_bahasamandarin']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasamandarin']+$data_user['k'.$post_semester.'_bahasamandarin'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">22</td>
                    <td style="border-collapse: collapse; border:1px solid black">Basic Industry</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0){echo $data_user['p'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['k'.$post_semester.'_basicindustry']>0){echo $data_user['k'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0 && $data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0 && $data_user['k'.$post_semester.'_basicindustry']>0){ echo number_format(($data_user['p'.$post_semester.'_basicindustry'] + $data_user['k'.$post_semester.'_basicindustry']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_basicindustry']+$data_user['p'.$post_semester.'_basicindustry'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         
        <?php } ?>
        
        <?php if ($data_user['jurusan'] == 'Teknik Kendaraan Ringan Otomotif') { ?>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">12</td>
                    <td style="border-collapse: collapse; border:1px solid black">Gambar Teknik Otomotif</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['gambarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['gambarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['gambarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['gambarteknikotomotif_s'.$post_semester.'']+$data_user['gambarteknikotomotif_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                   
                      <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">13</td>
                    <td style="border-collapse: collapse; border:1px solid black">Teknologi Dasar Otomotif</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknologidasarotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknologidasarotomotif_s'.$post_semester.'']>0){echo $data_user['teknologidasarotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknologidasarotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknologidasarotomotif_s'.$post_semester.'']>0){echo $data_user['teknologidasarotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknologidasarotomotif_s'.$post_semester.'']==0 && $data_user['teknologidasarotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknologidasarotomotif_s'.$post_semester.'']>0 && $data_user['teknologidasarotomotif_s'.$post_semester.'']>0){ echo number_format(($data_user['teknologidasarotomotif_s'.$post_semester.''] + $data_user['teknologidasarotomotif_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['teknologidasarotomotif_s'.$post_semester.'']+$data_user['teknologidasarotomotif_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">14</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pekerjaan Dasar Teknik Otomotif</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']>0){echo $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']==0 && $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']>0 && $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']>0){ echo number_format(($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.''] + $data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['pekerjaandasarteknikotomotif_s'.$post_semester.'']+$data_user['pekerjaandasarteknikotomotif_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     </tr>
                     
<tr>
    <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C3. Kompetensi Keahlian</b></td>

   <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">15</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pemeliharaan Mesin Kendaraan Ringan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mesinkendaraanringan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mesinkendaraanringan_s'.$post_semester.'']>0){echo $data_user['mesinkendaraanringan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mesinkendaraanringan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mesinkendaraanringan_s'.$post_semester.'']>0){echo $data_user['mesinkendaraanringan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mesinkendaraanringan_s'.$post_semester.'']==0 && $data_user['mesinkendaraanringan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mesinkendaraanringan_s'.$post_semester.'']>0 && $data_user['mesinkendaraanringan_s'.$post_semester.'']>0){ echo number_format(($data_user['mesinkendaraanringan_s'.$post_semester.''] + $data_user['mesinkendaraanringan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['mesinkendaraanringan_s'.$post_semester.'']+$data_user['mesinkendaraanringan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">16</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pemeliharaan Sasis dan Pemindah Tenaga Kendaraan Ringan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']>0){echo $data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']>0){echo $data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']==0 && $data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']>0 && $data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']>0){ echo number_format(($data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.''] + $data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.'']+$data_user['sasisdanpemindahantenagakendaraanringantkro_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">17</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pemeliharaan Kelistrikan Kendaraan Ringan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kelistrikankendaraanringan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kelistrikankendaraanringan_s'.$post_semester.'']>0){echo $data_user['kelistrikankendaraanringan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kelistrikankendaraanringan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kelistrikankendaraanringan_s'.$post_semester.'']>0){echo $data_user['kelistrikankendaraanringan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kelistrikankendaraanringan_s'.$post_semester.'']==0 && $data_user['kelistrikankendaraanringan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kelistrikankendaraanringan_s'.$post_semester.'']>0 && $data_user['kelistrikankendaraanringan_s'.$post_semester.'']>0){ echo number_format(($data_user['kelistrikankendaraanringan_s'.$post_semester.''] + $data_user['kelistrikankendaraanringan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['kelistrikankendaraanringan_s'.$post_semester.'']+$data_user['kelistrikankendaraanringan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">18</td>
                    <td style="border-collapse: collapse; border:1px solid black">Produk Kreatif dan Kewirausahaan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){ echo number_format(($data_user['produkkreatifdankewirausahaan_s'.$post_semester.''] + $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']+$data_user['produkkreatifdankewirausahaan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>

        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray"><b>D. Muatan Lokal</b></td>
        </tr>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">19</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Jepang</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0){echo $data_user['p'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasajepang']>0){echo $data_user['k'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0 && $data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0 && $data_user['k'.$post_semester.'_bahasajepang']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasajepang'] + $data_user['k'.$post_semester.'_bahasajepang']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasajepang']+$data_user['k'.$post_semester.'_bahasajepang'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">20</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Mandarin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0){echo $data_user['p'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasamandarin']>0){echo $data_user['k'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0 && $data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0 && $data_user['k'.$post_semester.'_bahasamandarin']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasamandarin'] + $data_user['k'.$post_semester.'_bahasamandarin']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasamandarin']+$data_user['k'.$post_semester.'_bahasamandarin'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">21</td>
                    <td style="border-collapse: collapse; border:1px solid black">Basic Industry</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0){echo $data_user['p'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['k'.$post_semester.'_basicindustry']>0){echo $data_user['k'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0 && $data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0 && $data_user['k'.$post_semester.'_basicindustry']>0){ echo number_format(($data_user['p'.$post_semester.'_basicindustry'] + $data_user['k'.$post_semester.'_basicindustry']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_basicindustry']+$data_user['p'.$post_semester.'_basicindustry'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         
        <?php } ?>
        
        <?php if ($data_user['jurusan'] == 'Teknik Pemesinan') { ?>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">12</td>
                    <td style="border-collapse: collapse; border:1px solid black">Gambar Teknik Mesin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikmesin_s'.$post_semester.'']>0){echo $data_user['gambarteknikmesin_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikmesin_s'.$post_semester.'']>0){echo $data_user['gambarteknikmesin_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikmesin_s'.$post_semester.'']>0){echo $data_user['gambarteknikmesin_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['gambarteknikmesin_s'.$post_semester.'']+$data_user['gambarteknikmesin_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                   
                      <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">13</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pekerjaan Dasar Teknik Mesin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']>0){echo $data_user['pekerjaandasarteknikmesin_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']>0){echo $data_user['pekerjaandasarteknikmesin_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']==0 && $data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']>0 && $data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']>0){ echo number_format(($data_user['pekerjaandasarteknikmesin_s'.$post_semester.''] + $data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['pekerjaandasarteknikmesin_s'.$post_semester.'']+$data_user['pekerjaandasarteknikmesin_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">14</td>
                    <td style="border-collapse: collapse; border:1px solid black">Dasar Perancangan Teknik Mesin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarperancanganteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarperancanganteknikmesin_s'.$post_semester.'']>0){echo $data_user['dasarperancanganteknikmesin_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarperancanganteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarperancanganteknikmesin_s'.$post_semester.'']>0){echo $data_user['dasarperancanganteknikmesin_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarperancanganteknikmesin_s'.$post_semester.'']==0 && $data_user['dasarperancanganteknikmesin_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarperancanganteknikmesin_s'.$post_semester.'']>0 && $data_user['dasarperancanganteknikmesin_s'.$post_semester.'']>0){ echo number_format(($data_user['dasarperancanganteknikmesin_s'.$post_semester.''] + $data_user['dasarperancanganteknikmesin_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['dasarperancanganteknikmesin_s'.$post_semester.'']+$data_user['dasarperancanganteknikmesin_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     </tr>
                     
<tr>
    <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C3. Kompetensi Keahlian</b></td>

   <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">15</td>
                    <td style="border-collapse: collapse; border:1px solid black">Gambar Teknik Manufaktur</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikmanufaktur_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikmanufaktur_s'.$post_semester.'']>0){echo $data_user['gambarteknikmanufaktur_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikmanufaktur_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikmanufaktur_s'.$post_semester.'']>0){echo $data_user['gambarteknikmanufaktur_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambarteknikmanufaktur_s'.$post_semester.'']==0 && $data_user['gambarteknikmanufaktur_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambarteknikmanufaktur_s'.$post_semester.'']>0 && $data_user['gambarteknikmanufaktur_s'.$post_semester.'']>0){ echo number_format(($data_user['gambarteknikmanufaktur_s'.$post_semester.''] + $data_user['gambarteknikmanufaktur_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['gambarteknikmanufaktur_s'.$post_semester.'']+$data_user['gambarteknikmanufaktur_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">16</td>
                    <td style="border-collapse: collapse; border:1px solid black">Teknik Pemesinan Bubut</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinanbubut_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinanbubut_s'.$post_semester.'']>0){echo $data_user['teknikpemesinanbubut_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinanbubut_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinanbubut_s'.$post_semester.'']>0){echo $data_user['teknikpemesinanbubut_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinanbubut_s'.$post_semester.'']==0 && $data_user['teknikpemesinanbubut_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinanbubut_s'.$post_semester.'']>0 && $data_user['teknikpemesinanbubut_s'.$post_semester.'']>0){ echo number_format(($data_user['teknikpemesinanbubut_s'.$post_semester.''] + $data_user['teknikpemesinanbubut_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['teknikpemesinanbubut_s'.$post_semester.'']+$data_user['teknikpemesinanbubut_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">17</td>
                    <td style="border-collapse: collapse; border:1px solid black">Teknik Pemesinan Frais</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinanfrais_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinanfrais_s'.$post_semester.'']>0){echo $data_user['teknikpemesinanfrais_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinanfrais_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinanfrais_s'.$post_semester.'']>0){echo $data_user['teknikpemesinanfrais_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinanfrais_s'.$post_semester.'']==0 && $data_user['teknikpemesinanfrais_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinanfrais_s'.$post_semester.'']>0 && $data_user['teknikpemesinanfrais_s'.$post_semester.'']>0){ echo number_format(($data_user['teknikpemesinanfrais_s'.$post_semester.''] + $data_user['teknikpemesinanfrais_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['teknikpemesinanfrais_s'.$post_semester.'']+$data_user['teknikpemesinanfrais_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">18</td>
                    <td style="border-collapse: collapse; border:1px solid black">Teknik Pemesinan Gerinda</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinangerinda_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinangerinda_s'.$post_semester.'']>0){echo $data_user['teknikpemesinangerinda_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinangerinda_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinangerinda_s'.$post_semester.'']>0){echo $data_user['teknikpemesinangerinda_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinangerinda_s'.$post_semester.'']==0 && $data_user['teknikpemesinangerinda_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinangerinda_s'.$post_semester.'']>0 && $data_user['teknikpemesinangerinda_s'.$post_semester.'']>0){ echo number_format(($data_user['teknikpemesinangerinda_s'.$post_semester.''] + $data_user['teknikpemesinangerinda_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['teknikpemesinangerinda_s'.$post_semester.'']+$data_user['teknikpemesinangerinda_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">19</td>
                    <td style="border-collapse: collapse; border:1px solid black">Teknik Pemesinan NC/CNC dan CAM</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinannccncdancam_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinannccncdancam_s'.$post_semester.'']>0){echo $data_user['teknikpemesinannccncdancam_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinannccncdancam_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinannccncdancam_s'.$post_semester.'']>0){echo $data_user['teknikpemesinannccncdancam_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemesinannccncdancam_s'.$post_semester.'']==0 && $data_user['teknikpemesinannccncdancam_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemesinannccncdancam_s'.$post_semester.'']>0 && $data_user['teknikpemesinannccncdancam_s'.$post_semester.'']>0){ echo number_format(($data_user['teknikpemesinannccncdancam_s'.$post_semester.''] + $data_user['teknikpemesinannccncdancam_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['teknikpemesinannccncdancam_s'.$post_semester.'']+$data_user['teknikpemesinannccncdancam_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">20</td>
                    <td style="border-collapse: collapse; border:1px solid black">Produk Kreatif dan Kewirausahaan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){ echo number_format(($data_user['produkkreatifdankewirausahaan_s'.$post_semester.''] + $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']+$data_user['produkkreatifdankewirausahaan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>

        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray"><b>D. Muatan Lokal</b></td>
        </tr>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">20</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Jepang</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0){echo $data_user['p'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasajepang']>0){echo $data_user['k'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0 && $data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0 && $data_user['k'.$post_semester.'_bahasajepang']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasajepang'] + $data_user['k'.$post_semester.'_bahasajepang']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasajepang']+$data_user['k'.$post_semester.'_bahasajepang'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">21</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Mandarin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0){echo $data_user['p'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasamandarin']>0){echo $data_user['k'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0 && $data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0 && $data_user['k'.$post_semester.'_bahasamandarin']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasamandarin'] + $data_user['k'.$post_semester.'_bahasamandarin']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasamandarin']+$data_user['k'.$post_semester.'_bahasamandarin'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">22</td>
                    <td style="border-collapse: collapse; border:1px solid black">Basic Industry</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0){echo $data_user['p'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['k'.$post_semester.'_basicindustry']>0){echo $data_user['k'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0 && $data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0 && $data_user['k'.$post_semester.'_basicindustry']>0){ echo number_format(($data_user['p'.$post_semester.'_basicindustry'] + $data_user['k'.$post_semester.'_basicindustry']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_basicindustry']+$data_user['p'.$post_semester.'_basicindustry'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         
        <?php } ?>
        
        <?php if ($data_user['jurusan'] == 'Teknik Elektronika Industri') { ?>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">12</td>
                    <td style="border-collapse: collapse; border:1px solid black">Kerja Bengkel dan Gambar Teknik</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kerjabengkeldangambarteknik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kerjabengkeldangambarteknik_s'.$post_semester.'']>0){echo $data_user['kerjabengkeldangambarteknik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kerjabengkeldangambarteknik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kerjabengkeldangambarteknik_s'.$post_semester.'']>0){echo $data_user['kerjabengkeldangambarteknik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['kerjabengkeldangambarteknik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['kerjabengkeldangambarteknik_s'.$post_semester.'']>0){echo $data_user['kerjabengkeldangambarteknik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['kerjabengkeldangambarteknik_s'.$post_semester.'']+$data_user['kerjabengkeldangambarteknik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                   
                      <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">13</td>
                    <td style="border-collapse: collapse; border:1px solid black">Dasar Listrik dan Elektronika</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']>0){echo $data_user['dasarlistrikdanelektronika_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']>0){echo $data_user['dasarlistrikdanelektronika_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']==0 && $data_user['dasarlistrikdanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']>0 && $data_user['dasarlistrikdanelektronika_s'.$post_semester.'']>0){ echo number_format(($data_user['dasarlistrikdanelektronika_s'.$post_semester.''] + $data_user['dasarlistrikdanelektronika_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']+$data_user['dasarlistrikdanelektronika_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">14</td>
                    <td style="border-collapse: collapse; border:1px solid black">Teknik Pemrograman, Mikroprosesor dan Mikrokontroler</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']>0){echo $data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']>0){echo $data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']==0 && $data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']==0){echo "-";}elseif($data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']>0 && $data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']>0){ echo number_format(($data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.''] + $data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.'']+$data_user['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     </tr>
                     
<tr>
    <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C3. Kompetensi Keahlian</b></td>

   <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">15</td>
                    <td style="border-collapse: collapse; border:1px solid black">Mikroprosessor dan Mikrokontroler</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']>0){echo $data_user['mikroprosessordanmikrokontroler_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']>0){echo $data_user['mikroprosessordanmikrokontroler_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']==0 && $data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']==0){echo "-";}elseif($data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']>0 && $data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']>0){ echo number_format(($data_user['mikroprosessordanmikrokontroler_s'.$post_semester.''] + $data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['mikroprosessordanmikrokontroler_s'.$post_semester.'']+$data_user['mikroprosessordanmikrokontroler_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">16</td>
                    <td style="border-collapse: collapse; border:1px solid black">Penerapan Rangkaian Elektronika</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['penerapanrangkaianelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['penerapanrangkaianelektronika_s'.$post_semester.'']>0){echo $data_user['penerapanrangkaianelektronika_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['penerapanrangkaianelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['penerapanrangkaianelektronika_s'.$post_semester.'']>0){echo $data_user['penerapanrangkaianelektronika_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['penerapanrangkaianelektronika_s'.$post_semester.'']==0 && $data_user['penerapanrangkaianelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['penerapanrangkaianelektronika_s'.$post_semester.'']>0 && $data_user['penerapanrangkaianelektronika_s'.$post_semester.'']>0){ echo number_format(($data_user['penerapanrangkaianelektronika_s'.$post_semester.''] + $data_user['penerapanrangkaianelektronika_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['penerapanrangkaianelektronika_s'.$post_semester.'']+$data_user['penerapanrangkaianelektronika_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">17</td>
                    <td style="border-collapse: collapse; border:1px solid black">Sistem Pengendali Elektronika</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sistempengendalielektronik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sistempengendalielektronik_s'.$post_semester.'']>0){echo $data_user['sistempengendalielektronik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sistempengendalielektronik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sistempengendalielektronik_s'.$post_semester.'']>0){echo $data_user['sistempengendalielektronik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sistempengendalielektronik_s'.$post_semester.'']==0 && $data_user['sistempengendalielektronik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sistempengendalielektronik_s'.$post_semester.'']>0 && $data_user['sistempengendalielektronik_s'.$post_semester.'']>0){ echo number_format(($data_user['sistempengendalielektronik_s'.$post_semester.''] + $data_user['sistempengendalielektronik_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['sistempengendalielektronik_s'.$post_semester.'']+$data_user['sistempengendalielektronik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">18</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pengendali Sistem Robotik</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pengendalisistemrobotik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pengendalisistemrobotik_s'.$post_semester.'']>0){echo $data_user['pengendalisistemrobotik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pengendalisistemrobotik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pengendalisistemrobotik_s'.$post_semester.'']>0){echo $data_user['pengendalisistemrobotik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pengendalisistemrobotik_s'.$post_semester.'']==0 && $data_user['pengendalisistemrobotik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pengendalisistemrobotik_s'.$post_semester.'']>0 && $data_user['pengendalisistemrobotik_s'.$post_semester.'']>0){ echo number_format(($data_user['pengendalisistemrobotik_s'.$post_semester.''] + $data_user['pengendalisistemrobotik_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['pengendalisistemrobotik_s'.$post_semester.'']+$data_user['pengendalisistemrobotik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">19</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pembuatan, Perbaikan dan Pemeliharaan Peralatan Elektronika</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']>0){echo $data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']>0){echo $data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']==0 && $data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']>0 && $data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']>0){ echo number_format(($data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.''] + $data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.'']+$data_user['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">20</td>
                    <td style="border-collapse: collapse; border:1px solid black">Produk Kreatif dan Kewirausahaan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){ echo number_format(($data_user['produkkreatifdankewirausahaan_s'.$post_semester.''] + $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']+$data_user['produkkreatifdankewirausahaan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>

        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray"><b>D. Muatan Lokal</b></td>
        </tr>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">21</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Jepang</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0){echo $data_user['p'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasajepang']>0){echo $data_user['k'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0 && $data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0 && $data_user['k'.$post_semester.'_bahasajepang']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasajepang'] + $data_user['k'.$post_semester.'_bahasajepang']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasajepang']+$data_user['k'.$post_semester.'_bahasajepang'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">22</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Mandarin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0){echo $data_user['p'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasamandarin']>0){echo $data_user['k'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0 && $data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0 && $data_user['k'.$post_semester.'_bahasamandarin']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasamandarin'] + $data_user['k'.$post_semester.'_bahasamandarin']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasamandarin']+$data_user['k'.$post_semester.'_bahasamandarin'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">23</td>
                    <td style="border-collapse: collapse; border:1px solid black">Basic Industry</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0){echo $data_user['p'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['k'.$post_semester.'_basicindustry']>0){echo $data_user['k'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0 && $data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0 && $data_user['k'.$post_semester.'_basicindustry']>0){ echo number_format(($data_user['p'.$post_semester.'_basicindustry'] + $data_user['k'.$post_semester.'_basicindustry']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_basicindustry']+$data_user['p'.$post_semester.'_basicindustry'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         
        <?php } ?>
        
        <?php if ($data_user['jurusan'] == 'Teknik Instalasi Tenaga Listrik') { ?>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">12</td>
                    <td style="border-collapse: collapse; border:1px solid black">Gambar Teknik Listrik</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambartekniklistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambartekniklistrik_s'.$post_semester.'']>0){echo $data_user['gambartekniklistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambartekniklistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambartekniklistrik_s'.$post_semester.'']>0){echo $data_user['gambartekniklistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['gambartekniklistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['gambartekniklistrik_s'.$post_semester.'']>0){echo $data_user['gambartekniklistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['gambartekniklistrik_s'.$post_semester.'']+$data_user['gambartekniklistrik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                   
                      <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">13</td>
                    <td style="border-collapse: collapse; border:1px solid black">Dasar Listrik dan Elektronika</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']>0){echo $data_user['dasarlistrikdanelektronika_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']>0){echo $data_user['dasarlistrikdanelektronika_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']==0 && $data_user['dasarlistrikdanelektronika_s'.$post_semester.'']==0){echo "-";}elseif($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']>0 && $data_user['dasarlistrikdanelektronika_s'.$post_semester.'']>0){ echo number_format(($data_user['dasarlistrikdanelektronika_s'.$post_semester.''] + $data_user['dasarlistrikdanelektronika_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['dasarlistrikdanelektronika_s'.$post_semester.'']+$data_user['dasarlistrikdanelektronika_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">14</td>
                    <td style="border-collapse: collapse; border:1px solid black">Pekerjaan Dasar Elektromekanik</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']>0){echo $data_user['pekerjaandasarelektromekanik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']>0){echo $data_user['pekerjaandasarelektromekanik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']==0 && $data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']>0 && $data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']>0){ echo number_format(($data_user['pekerjaandasarelektromekanik_s'.$post_semester.''] + $data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['pekerjaandasarelektromekanik_s'.$post_semester.'']+$data_user['pekerjaandasarelektromekanik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     </tr>
                     
<tr>
    <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C3. Kompetensi Keahlian</b></td>

   <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">15</td>
                    <td style="border-collapse: collapse; border:1px solid black">Instalasi Penerangan Listrik</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasipeneranganlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasipeneranganlistrik_s'.$post_semester.'']>0){echo $data_user['instalasipeneranganlistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasipeneranganlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasipeneranganlistrik_s'.$post_semester.'']>0){echo $data_user['instalasipeneranganlistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasipeneranganlistrik_s'.$post_semester.'']==0 && $data_user['instalasipeneranganlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasipeneranganlistrik_s'.$post_semester.'']>0 && $data_user['instalasipeneranganlistrik_s'.$post_semester.'']>0){ echo number_format(($data_user['instalasipeneranganlistrik_s'.$post_semester.''] + $data_user['instalasipeneranganlistrik_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['instalasipeneranganlistrik_s'.$post_semester.'']+$data_user['instalasipeneranganlistrik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">16</td>
                    <td style="border-collapse: collapse; border:1px solid black">Instalasi Tenaga Listrik</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasitenagalistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasitenagalistrik_s'.$post_semester.'']>0){echo $data_user['instalasitenagalistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasitenagalistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasitenagalistrik_s'.$post_semester.'']>0){echo $data_user['instalasitenagalistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasitenagalistrik_s'.$post_semester.'']==0 && $data_user['instalasitenagalistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasitenagalistrik_s'.$post_semester.'']>0 && $data_user['instalasitenagalistrik_s'.$post_semester.'']>0){ echo number_format(($data_user['instalasitenagalistrik_s'.$post_semester.''] + $data_user['instalasitenagalistrik_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['instalasitenagalistrik_s'.$post_semester.'']+$data_user['instalasitenagalistrik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">17</td>
                    <td style="border-collapse: collapse; border:1px solid black">Instalasi Motor Listrik</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasimotorlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasimotorlistrik_s'.$post_semester.'']>0){echo $data_user['instalasimotorlistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasimotorlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasimotorlistrik_s'.$post_semester.'']>0){echo $data_user['instalasimotorlistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['instalasimotorlistrik_s'.$post_semester.'']==0 && $data_user['instalasimotorlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['instalasimotorlistrik_s'.$post_semester.'']>0 && $data_user['instalasimotorlistrik_s'.$post_semester.'']>0){ echo number_format(($data_user['instalasimotorlistrik_s'.$post_semester.''] + $data_user['instalasimotorlistrik_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['instalasimotorlistrik_s'.$post_semester.'']+$data_user['instalasimotorlistrik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">18</td>
                    <td style="border-collapse: collapse; border:1px solid black">Perbaikan Peralatan Listrik</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['perbaikanperalatanlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['perbaikanperalatanlistrik_s'.$post_semester.'']>0){echo $data_user['perbaikanperalatanlistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['perbaikanperalatanlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['perbaikanperalatanlistrik_s'.$post_semester.'']>0){echo $data_user['perbaikanperalatanlistrik_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['perbaikanperalatanlistrik_s'.$post_semester.'']==0 && $data_user['perbaikanperalatanlistrik_s'.$post_semester.'']==0){echo "-";}elseif($data_user['perbaikanperalatanlistrik_s'.$post_semester.'']>0 && $data_user['perbaikanperalatanlistrik_s'.$post_semester.'']>0){ echo number_format(($data_user['perbaikanperalatanlistrik_s'.$post_semester.''] + $data_user['perbaikanperalatanlistrik_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['perbaikanperalatanlistrik_s'.$post_semester.'']+$data_user['perbaikanperalatanlistrik_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">19</td>
                    <td style="border-collapse: collapse; border:1px solid black">Produk Kreatif dan Kewirausahaan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){ echo number_format(($data_user['produkkreatifdankewirausahaan_s'.$post_semester.''] + $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']+$data_user['produkkreatifdankewirausahaan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>

        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray"><b>D. Muatan Lokal</b></td>
        </tr>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">20</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Jepang</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0){echo $data_user['p'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasajepang']>0){echo $data_user['k'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0 && $data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0 && $data_user['k'.$post_semester.'_bahasajepang']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasajepang'] + $data_user['k'.$post_semester.'_bahasajepang']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasajepang']+$data_user['k'.$post_semester.'_bahasajepang'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">21</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Mandarin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0){echo $data_user['p'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasamandarin']>0){echo $data_user['k'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0 && $data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0 && $data_user['k'.$post_semester.'_bahasamandarin']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasamandarin'] + $data_user['k'.$post_semester.'_bahasamandarin']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasamandarin']+$data_user['k'.$post_semester.'_bahasamandarin'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">22</td>
                    <td style="border-collapse: collapse; border:1px solid black">Basic Industry</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0){echo $data_user['p'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['k'.$post_semester.'_basicindustry']>0){echo $data_user['k'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0 && $data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0 && $data_user['k'.$post_semester.'_basicindustry']>0){ echo number_format(($data_user['p'.$post_semester.'_basicindustry'] + $data_user['k'.$post_semester.'_basicindustry']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_basicindustry']+$data_user['p'.$post_semester.'_basicindustry'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         
        <?php } ?>
        
        <?php if ($data_user['jurusan'] == 'Akuntansi dan Keuangan Lembaga') { ?>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">13</td>
                    <td style="border-collapse: collapse; border:1px solid black">Etika Profesi</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['etikaprofesi_s'.$post_semester.'']==0){echo "-";}elseif($data_user['etikaprofesi_s'.$post_semester.'']>0){echo $data_user['etikaprofesi_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['etikaprofesi_s'.$post_semester.'']==0){echo "-";}elseif($data_user['etikaprofesi_s'.$post_semester.'']>0){echo $data_user['etikaprofesi_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['etikaprofesi_s'.$post_semester.'']==0){echo "-";}elseif($data_user['etikaprofesi_s'.$post_semester.'']>0){echo $data_user['etikaprofesi_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['etikaprofesi_s'.$post_semester.'']+$data_user['etikaprofesi_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                   
                      <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">14</td>
                    <td style="border-collapse: collapse; border:1px solid black">Aplikasi Pengolah Angka/Spreadsheet</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['aplikasipengolahangka_s'.$post_semester.'']==0){echo "-";}elseif($data_user['aplikasipengolahangka_s'.$post_semester.'']>0){echo $data_user['aplikasipengolahangka_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['aplikasipengolahangka_s'.$post_semester.'']==0){echo "-";}elseif($data_user['aplikasipengolahangka_s'.$post_semester.'']>0){echo $data_user['aplikasipengolahangka_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['aplikasipengolahangka_s'.$post_semester.'']==0 && $data_user['aplikasipengolahangka_s'.$post_semester.'']==0){echo "-";}elseif($data_user['aplikasipengolahangka_s'.$post_semester.'']>0 && $data_user['aplikasipengolahangka_s'.$post_semester.'']>0){ echo number_format(($data_user['aplikasipengolahangka_s'.$post_semester.''] + $data_user['aplikasipengolahangka_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['aplikasipengolahangka_s'.$post_semester.'']+$data_user['aplikasipengolahangka_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">15</td>
                    <td style="border-collapse: collapse; border:1px solid black">Akuntansi Dasar</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['akuntansidasar_s'.$post_semester.'']==0){echo "-";}elseif($data_user['akuntansidasar_s'.$post_semester.'']>0){echo $data_user['akuntansidasar_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['akuntansidasar_s'.$post_semester.'']==0){echo "-";}elseif($data_user['akuntansidasar_s'.$post_semester.'']>0){echo $data_user['akuntansidasar_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['akuntansidasar_s'.$post_semester.'']==0 && $data_user['akuntansidasar_s'.$post_semester.'']==0){echo "-";}elseif($data_user['akuntansidasar_s'.$post_semester.'']>0 && $data_user['akuntansidasar_s'.$post_semester.'']>0){ echo number_format(($data_user['akuntansidasar_s'.$post_semester.''] + $data_user['akuntansidasar_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['akuntansidasar_s'.$post_semester.'']+$data_user['akuntansidasar_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">16</td>
                    <td style="border-collapse: collapse; border:1px solid black">Perbankan Dasar</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['perbankandasar_s'.$post_semester.'']==0){echo "-";}elseif($data_user['perbankandasar_s'.$post_semester.'']>0){echo $data_user['perbankandasar_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['perbankandasar_s'.$post_semester.'']==0){echo "-";}elseif($data_user['perbankandasar_s'.$post_semester.'']>0){echo $data_user['perbankandasar_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['perbankandasar_s'.$post_semester.'']==0 && $data_user['perbankandasar_s'.$post_semester.'']==0){echo "-";}elseif($data_user['perbankandasar_s'.$post_semester.'']>0 && $data_user['perbankandasar_s'.$post_semester.'']>0){ echo number_format(($data_user['perbankandasar_s'.$post_semester.''] + $data_user['perbankandasar_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['perbankandasar_s'.$post_semester.'']+$data_user['perbankandasar_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     </tr>
                     
<tr>
    <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C3. Kompetensi Keahlian</b></td>

   <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">17</td>
                    <td style="border-collapse: collapse; border:1px solid black">Praktikum Akuntansi Perusahaan Jasa, Dagang dan Manufaktur</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']>0){echo $data_user['praktikumakuntansiperusahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']>0){echo $data_user['praktikumakuntansiperusahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']==0 && $data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']>0 && $data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']>0){ echo number_format(($data_user['praktikumakuntansiperusahaan_s'.$post_semester.''] + $data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['praktikumakuntansiperusahaan_s'.$post_semester.'']+$data_user['praktikumakuntansiperusahaan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">18</td>
                    <td style="border-collapse: collapse; border:1px solid black">Praktikum Akuntansi Lembaga/Instansi Pemerintah</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['praktikumakuntansilembaga_s'.$post_semester.'']==0){echo "-";}elseif($data_user['praktikumakuntansilembaga_s'.$post_semester.'']>0){echo $data_user['praktikumakuntansilembaga_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['praktikumakuntansilembaga_s'.$post_semester.'']==0){echo "-";}elseif($data_user['praktikumakuntansilembaga_s'.$post_semester.'']>0){echo $data_user['praktikumakuntansilembaga_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['praktikumakuntansilembaga_s'.$post_semester.'']==0 && $data_user['praktikumakuntansilembaga_s'.$post_semester.'']==0){echo "-";}elseif($data_user['praktikumakuntansilembaga_s'.$post_semester.'']>0 && $data_user['praktikumakuntansilembaga_s'.$post_semester.'']>0){ echo number_format(($data_user['praktikumakuntansilembaga_s'.$post_semester.''] + $data_user['praktikumakuntansilembaga_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['praktikumakuntansilembaga_s'.$post_semester.'']+$data_user['praktikumakuntansilembaga_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">19</td>
                    <td style="border-collapse: collapse; border:1px solid black">Akuntansi Keuangan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['akuntansikeuangan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['akuntansikeuangan_s'.$post_semester.'']>0){echo $data_user['akuntansikeuangan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['akuntansikeuangan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['akuntansikeuangan_s'.$post_semester.'']>0){echo $data_user['akuntansikeuangan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['akuntansikeuangan_s'.$post_semester.'']==0 && $data_user['akuntansikeuangan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['akuntansikeuangan_s'.$post_semester.'']>0 && $data_user['akuntansikeuangan_s'.$post_semester.'']>0){ echo number_format(($data_user['akuntansikeuangan_s'.$post_semester.''] + $data_user['akuntansikeuangan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['akuntansikeuangan_s'.$post_semester.'']+$data_user['akuntansikeuangan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">20</td>
                    <td style="border-collapse: collapse; border:1px solid black">Komputer Akuntansi</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['komputerakutansi_s'.$post_semester.'']==0){echo "-";}elseif($data_user['komputerakutansi_s'.$post_semester.'']>0){echo $data_user['komputerakutansi_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['komputerakutansi_s'.$post_semester.'']==0){echo "-";}elseif($data_user['komputerakutansi_s'.$post_semester.'']>0){echo $data_user['komputerakutansi_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['komputerakutansi_s'.$post_semester.'']==0 && $data_user['komputerakutansi_s'.$post_semester.'']==0){echo "-";}elseif($data_user['komputerakutansi_s'.$post_semester.'']>0 && $data_user['komputerakutansi_s'.$post_semester.'']>0){ echo number_format(($data_user['komputerakutansi_s'.$post_semester.''] + $data_user['komputerakutansi_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['komputerakutansi_s'.$post_semester.'']+$data_user['komputerakutansi_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">21</td>
                    <td style="border-collapse: collapse; border:1px solid black">Administrasi Pajak</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['admnistrasipajak_s'.$post_semester.'']==0){echo "-";}elseif($data_user['admnistrasipajak_s'.$post_semester.'']>0){echo $data_user['admnistrasipajak_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['admnistrasipajak_s'.$post_semester.'']==0){echo "-";}elseif($data_user['admnistrasipajak_s'.$post_semester.'']>0){echo $data_user['admnistrasipajak_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['admnistrasipajak_s'.$post_semester.'']==0 && $data_user['admnistrasipajak_s'.$post_semester.'']==0){echo "-";}elseif($data_user['admnistrasipajak_s'.$post_semester.'']>0 && $data_user['admnistrasipajak_s'.$post_semester.'']>0){ echo number_format(($data_user['admnistrasipajak_s'.$post_semester.''] + $data_user['admnistrasipajak_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['admnistrasipajak_s'.$post_semester.'']+$data_user['admnistrasipajak_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">22</td>
                    <td style="border-collapse: collapse; border:1px solid black">Produk Kreatif dan Kewirausahaan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){ echo number_format(($data_user['produkkreatifdankewirausahaan_s'.$post_semester.''] + $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']+$data_user['produkkreatifdankewirausahaan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>

        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray"><b>D. Muatan Lokal</b></td>
        </tr>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">23</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Jepang</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0){echo $data_user['p'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasajepang']>0){echo $data_user['k'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0 && $data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0 && $data_user['k'.$post_semester.'_bahasajepang']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasajepang'] + $data_user['k'.$post_semester.'_bahasajepang']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasajepang']+$data_user['k'.$post_semester.'_bahasajepang'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">24</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Mandarin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0){echo $data_user['p'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasamandarin']>0){echo $data_user['k'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0 && $data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0 && $data_user['k'.$post_semester.'_bahasamandarin']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasamandarin'] + $data_user['k'.$post_semester.'_bahasamandarin']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasamandarin']+$data_user['k'.$post_semester.'_bahasamandarin'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">25</td>
                    <td style="border-collapse: collapse; border:1px solid black">Basic Industry</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0){echo $data_user['p'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['k'.$post_semester.'_basicindustry']>0){echo $data_user['k'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0 && $data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0 && $data_user['k'.$post_semester.'_basicindustry']>0){ echo number_format(($data_user['p'.$post_semester.'_basicindustry'] + $data_user['k'.$post_semester.'_basicindustry']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_basicindustry']+$data_user['p'.$post_semester.'_basicindustry'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         
        <?php } ?>
        
        <?php if ($data_user['jurusan'] == 'Perhotelan') { ?>
         <tr>
             
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">12</td>
                    <td style="border-collapse: collapse; border:1px solid black">Komunikasi Industri Pariwisata</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['komunikasiindustripariwisata_s'.$post_semester.'']==0){echo "-";}elseif($data_user['komunikasiindustripariwisata_s'.$post_semester.'']>0){echo $data_user['komunikasiindustripariwisata_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['komunikasiindustripariwisata_s'.$post_semester.'']==0){echo "-";}elseif($data_user['komunikasiindustripariwisata_s'.$post_semester.'']>0){echo $data_user['komunikasiindustripariwisata_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['komunikasiindustripariwisata_s'.$post_semester.'']==0){echo "-";}elseif($data_user['komunikasiindustripariwisata_s'.$post_semester.'']>0){echo $data_user['komunikasiindustripariwisata_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['komunikasiindustripariwisata_s'.$post_semester.'']+$data_user['komunikasiindustripariwisata_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                   
                      <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">13</td>
                    <td style="border-collapse: collapse; border:1px solid black">Sanitasi, Hygiene dan keselamatan Kerja</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']>0){echo $data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']>0){echo $data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']==0 && $data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']==0){echo "-";}elseif($data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']>0 && $data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']>0){ echo number_format(($data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.''] + $data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.'']+$data_user['sanitasihyginedankeselamatankerja_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">14</td>
                    <td style="border-collapse: collapse; border:1px solid black">Administrasi Umum</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['administrasiumum_s'.$post_semester.'']==0){echo "-";}elseif($data_user['administrasiumum_s'.$post_semester.'']>0){echo $data_user['administrasiumum_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['administrasiumum_s'.$post_semester.'']==0){echo "-";}elseif($data_user['administrasiumum_s'.$post_semester.'']>0){echo $data_user['administrasiumum_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['administrasiumum_s'.$post_semester.'']==0 && $data_user['administrasiumum_s'.$post_semester.'']==0){echo "-";}elseif($data_user['administrasiumum_s'.$post_semester.'']>0 && $data_user['administrasiumum_s'.$post_semester.'']>0){ echo number_format(($data_user['administrasiumum_s'.$post_semester.''] + $data_user['administrasiumum_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['administrasiumum_s'.$post_semester.'']+$data_user['administrasiumum_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">15</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Asing Pilihan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['bahasaasingpilihan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['bahasaasingpilihan_s'.$post_semester.'']>0){echo $data_user['bahasaasingpilihan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['bahasaasingpilihan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['bahasaasingpilihan_s'.$post_semester.'']>0){echo $data_user['bahasaasingpilihan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['bahasaasingpilihan_s'.$post_semester.'']==0 && $data_user['bahasaasingpilihan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['bahasaasingpilihan_s'.$post_semester.'']>0 && $data_user['bahasaasingpilihan_s'.$post_semester.'']>0){ echo number_format(($data_user['bahasaasingpilihan_s'.$post_semester.''] + $data_user['bahasaasingpilihan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['bahasaasingpilihan_s'.$post_semester.'']+$data_user['bahasaasingpilihan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
                     </tr>
                     </tr>
                     
<tr>
    <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray;"><b>C3. Kompetensi Keahlian</b></td>

   <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">16</td>
                    <td style="border-collapse: collapse; border:1px solid black">Industri Perhotelan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['industriperhotelan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['industriperhotelan_s'.$post_semester.'']>0){echo $data_user['industriperhotelan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['industriperhotelan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['industriperhotelan_s'.$post_semester.'']>0){echo $data_user['industriperhotelan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['industriperhotelan_s'.$post_semester.'']==0 && $data_user['industriperhotelan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['industriperhotelan_s'.$post_semester.'']>0 && $data_user['industriperhotelan_s'.$post_semester.'']>0){ echo number_format(($data_user['industriperhotelan_s'.$post_semester.''] + $data_user['industriperhotelan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['industriperhotelan_s'.$post_semester.'']+$data_user['industriperhotelan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">17</td>
                    <td style="border-collapse: collapse; border:1px solid black"><i>Front Office</i></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['frontoffice_s'.$post_semester.'']==0){echo "-";}elseif($data_user['frontoffice_s'.$post_semester.'']>0){echo $data_user['frontoffice_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['frontoffice_s'.$post_semester.'']==0){echo "-";}elseif($data_user['frontoffice_s'.$post_semester.'']>0){echo $data_user['frontoffice_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['frontoffice_s'.$post_semester.'']==0 && $data_user['frontoffice_s'.$post_semester.'']==0){echo "-";}elseif($data_user['frontoffice_s'.$post_semester.'']>0 && $data_user['frontoffice_s'.$post_semester.'']>0){ echo number_format(($data_user['frontoffice_s'.$post_semester.''] + $data_user['frontoffice_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['frontoffice_s'.$post_semester.'']+$data_user['frontoffice_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">18</td>
                    <td style="border-collapse: collapse; border:1px solid black"><i>Housekeeping</i></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['housekeeping_s'.$post_semester.'']==0){echo "-";}elseif($data_user['housekeeping_s'.$post_semester.'']>0){echo $data_user['housekeeping_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['housekeeping_s'.$post_semester.'']==0){echo "-";}elseif($data_user['housekeeping_s'.$post_semester.'']>0){echo $data_user['housekeeping_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['housekeeping_s'.$post_semester.'']==0 && $data_user['housekeeping_s'.$post_semester.'']==0){echo "-";}elseif($data_user['housekeeping_s'.$post_semester.'']>0 && $data_user['housekeeping_s'.$post_semester.'']>0){ echo number_format(($data_user['housekeeping_s'.$post_semester.''] + $data_user['housekeeping_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['housekeeping_s'.$post_semester.'']+$data_user['housekeeping_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">19</td>
                    <td style="border-collapse: collapse; border:1px solid black"><i>Laundry</i></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['laundry_s'.$post_semester.'']==0){echo "-";}elseif($data_user['laundry_s'.$post_semester.'']>0){echo $data_user['laundry_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['laundry_s'.$post_semester.'']==0){echo "-";}elseif($data_user['laundry_s'.$post_semester.'']>0){echo $data_user['laundry_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['laundry_s'.$post_semester.'']==0 && $data_user['laundry_s'.$post_semester.'']==0){echo "-";}elseif($data_user['laundry_s'.$post_semester.'']>0 && $data_user['laundry_s'.$post_semester.'']>0){ echo number_format(($data_user['laundry_s'.$post_semester.''] + $data_user['laundry_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['laundry_s'.$post_semester.'']+$data_user['laundry_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">20</td>
                    <td style="border-collapse: collapse; border:1px solid black"><i>Food and Beverage</i></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['foodandbeverage_s'.$post_semester.'']==0){echo "-";}elseif($data_user['foodandbeverage_s'.$post_semester.'']>0){echo $data_user['foodandbeverage_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['foodandbeverage_s'.$post_semester.'']==0){echo "-";}elseif($data_user['foodandbeverage_s'.$post_semester.'']>0){echo $data_user['foodandbeverage_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['foodandbeverage_s'.$post_semester.'']==0 && $data_user['foodandbeverage_s'.$post_semester.'']==0){echo "-";}elseif($data_user['foodandbeverage_s'.$post_semester.'']>0 && $data_user['foodandbeverage_s'.$post_semester.'']>0){ echo number_format(($data_user['foodandbeverage_s'.$post_semester.''] + $data_user['foodandbeverage_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['foodandbeverage_s'.$post_semester.'']+$data_user['foodandbeverage_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">21</td>
                    <td style="border-collapse: collapse; border:1px solid black">Produk Kreatif dan Kewirausahaan</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){echo $data_user['produkkreatifdankewirausahaan_s'.$post_semester.''];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']==0){echo "-";}elseif($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0 && $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']>0){ echo number_format(($data_user['produkkreatifdankewirausahaan_s'.$post_semester.''] + $data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['produkkreatifdankewirausahaan_s'.$post_semester.'']+$data_user['produkkreatifdankewirausahaan_s'.$post_semester.''])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>

        <tr>
            <td colspan="6" style="border-collapse: collapse; border:1px solid black; background: lightgray"><b>D. Muatan Lokal</b></td>
        </tr>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">22</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Jepang</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0){echo $data_user['p'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasajepang']>0){echo $data_user['k'.$post_semester.'_bahasajepang'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasajepang']==0 && $data_user['k'.$post_semester.'_bahasajepang']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasajepang']>0 && $data_user['k'.$post_semester.'_bahasajepang']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasajepang'] + $data_user['k'.$post_semester.'_bahasajepang']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasajepang']+$data_user['k'.$post_semester.'_bahasajepang'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">23</td>
                    <td style="border-collapse: collapse; border:1px solid black">Bahasa Mandarin</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0){echo $data_user['p'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['k'.$post_semester.'_bahasamandarin']>0){echo $data_user['k'.$post_semester.'_bahasamandarin'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_bahasamandarin']==0 && $data_user['k'.$post_semester.'_bahasamandarin']==0){echo "-";}elseif($data_user['p'.$post_semester.'_bahasamandarin']>0 && $data_user['k'.$post_semester.'_bahasamandarin']>0){ echo number_format(($data_user['p'.$post_semester.'_bahasamandarin'] + $data_user['k'.$post_semester.'_bahasamandarin']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_bahasamandarin']+$data_user['k'.$post_semester.'_bahasamandarin'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">24</td>
                    <td style="border-collapse: collapse; border:1px solid black">Basic Industry</td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0){echo $data_user['p'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['k'.$post_semester.'_basicindustry']>0){echo $data_user['k'.$post_semester.'_basicindustry'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if($data_user['p'.$post_semester.'_basicindustry']==0 && $data_user['k'.$post_semester.'_basicindustry']==0){echo "-";}elseif($data_user['p'.$post_semester.'_basicindustry']>0 && $data_user['k'.$post_semester.'_basicindustry']>0){ echo number_format(($data_user['p'.$post_semester.'_basicindustry'] + $data_user['k'.$post_semester.'_basicindustry']) / 2, -1, '.', '');} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php $na=($data_user['p'.$post_semester.'_basicindustry']+$data_user['p'.$post_semester.'_basicindustry'])/2; if($na>=95){echo "A+";}elseif($na>89){echo "A";}elseif($na>84){echo "A-";}elseif($na>79){echo "B+";}elseif($na>74){echo "B";}elseif($na>69){echo "B-";}elseif($na>59){echo "C";}elseif($na<=59 && $na>0){echo "D";}elseif($na==0){echo "-";} ?></td>
        </tr>
         
        <?php } ?>
        
    </table>
    </div>
    <p></p>
    <div style="page-break-before: always;"></div>
    <div class="strong"><b>B.&nbsp;&nbsp;Catatan Akademik</b></div>
    <table width="100%" style="border-collapse: collapse; border:1px solid black">
        <td style="border-collapse: collapse; border:1px solid black;"><?php if (!empty($data_user['catatan'.$post_semester.''])) { echo $data_user['catatan'.$post_semester.'']; } else { ?>-<?php } ?></td>

    </table>
    <br/>
    
    <table>
        <div class="strong"><b>C.&nbsp;&nbsp;Praktik Kerja Lapangan</b></div>
        <table width="100%" style="border-collapse: collapse; border:1px solid black">

            <tr>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">No</th>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Mitra DU/DI</th>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Lokasi</th>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Predikat</th>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Keterangan</th>
            </tr>
            <tr>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center">1</td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['dudi1_s'.$post_semester.''])) { echo $data_user['dudi1_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['lokasi1_s'.$post_semester.''])) { echo $data_user['lokasi1_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['predikat1_s'.$post_semester.''])) { echo $data_user['predikat1_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['keterangan1_s'.$post_semester.''])) { echo $data_user['keterangan1_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
            </tr>
            <tr>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center">2</td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['dudi2_s'.$post_semester.''])) { echo $data_user['dudi2_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['lokasi2_s'.$post_semester.''])) { echo $data_user['lokasi2_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['predikat2_s'.$post_semester.''])) { echo $data_user['predikat2_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['keterangan2_s'.$post_semester.''])) { echo $data_user['keterangan2_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
            </tr>
            <tr>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center">3</td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['dudi3_s'.$post_semester.''])) { echo $data_user['dudi3_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['lokasi3_s'.$post_semester.''])) { echo $data_user['lokasi3_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['predikat3_s'.$post_semester.''])) { echo $data_user['predikat3_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['keterangan3_s'.$post_semester.''])) { echo $data_user['keterangan3_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
            </tr>
        </table>
     
        <br>
        <table>
            <div class="strong"><b>D.&nbsp;&nbsp;Ekstrakurikuler</b></div>
            <table width="100%" style="border-collapse: collapse; border:1px solid black">

                <tr>
                    <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">No</th>
                    <th style="border-collapse: collapse; border:1px solid black; text-align:center; background: lightgray;">Ekstrakurikuler</th>
                    <th style="border-collapse: collapse; border:1px solid black; text-align:center; background: lightgray;">Nilai</th>
                </tr>
                <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">1</td>
                    <td style="border-collapse: collapse; border:1px solid black;"> <?php if (!empty($data_user['ekskul1_s'.$post_semester.''])) { echo $data_user['ekskul1_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['ekskul1_s'.$post_semester.''])) { echo $data_user['nilaiekskul1_s'.$post_semester.'']; } else { ?>-<?php } ?></td>

                </tr>
                <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">2</td>
                    <td style="border-collapse: collapse; border:1px solid black;"> <?php if (!empty($data_user['ekskul2_s'.$post_semester.''])) { echo $data_user['ekskul2_s'.$post_semester.'']; } else { ?>-<?php } ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if (!empty($data_user['nilaiekskul2_s'.$post_semester.''])) { echo $data_user['nilaiekskul2_s'.$post_semester.'']; } else { ?>-<?php } ?></td>

                </tr>
            </table>
            <p></p>
            <table>
                <div class="strong"><b>E.&nbsp;&nbsp;Ketidakhadiran</b></div>
                <table width="100%" style="border-collapse: collapse; border:1px solid black">

                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Sakit</td>
                        <td width="50%" style="border-collapse: collapse; border:1px solid black"> <?php if ($data_user['sakit'.$post_semester.''] != '0') { echo $data_user['sakit'.$post_semester.'']; } else { ?>-<?php } ?></td>

                        <th rowspan="3" style="border-collapse: collapse; border:1px solid black; background: lightgray;">POIN</th>
                        <th rowspan="3" style="border-collapse: collapse; border:1px solid black"> <?php if ($data_user['point'.$post_semester.''] != '0') { echo $data_user['point'.$post_semester.'']; } else { ?>-<?php } ?></th>
                    </tr>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Izin</td>
                        <td width="60%" style="border-collapse: collapse; border:1px solid black"> <?php if ($data_user['izin'.$post_semester.''] != '0') { echo $data_user['izin'.$post_semester.'']; } else { ?>-<?php } ?></td>
                    </tr>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Tanpa Keterangan</td>
                        <td width="60%" style="border-collapse: collapse; border:1px solid black"> <?php if ($data_user['tanpaketerangan'.$post_semester.''] != '0') { echo $data_user['tanpaketerangan'.$post_semester.'']; } else { ?>-<?php } ?></td>
                    </tr>
                </table>

                <p></p>
                <div class="strong"><b>F.&nbsp;&nbsp;Kenaikan Kelas</b></div>
                <table width="100%" style="border-collapse: collapse; border:1px solid black">
                    <?php if ($post_semester == '2') { 
                    $kenaikan = '1';
                    } else if ($post_semester == '4') {
                    $kenaikan = '2';
                    }
                    ?>
                    <td style="border-collapse: collapse; border:1px solid black;"><?php if (!empty($data_user['kenaikan'.$kenaikan.''])) { echo $data_user['kenaikan'.$kenaikan.'']; } else { ?>-<?php } ?></td>

                </table>
                <br>
                <div class="strong"><b>G.&nbsp;&nbsp;Deskripsi Karakter (5 Nilai)</b></div>
               <table width="100%" style="border-collapse: collapse; border:1px solid black">
                <?php
                $check_5 = mysqli_query($db, "SELECT * FROM 5_nilai ORDER BY id ASC");
                while ($nilai_5 = mysqli_fetch_assoc($check_5)) {
                ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black"><b><center><?php echo $nilai_5['name']; ?></center></b></td>
                        <td style="border-collapse: collapse; border:1px solid black;"><?php echo $nilai_5['rapor']; ?></td>

                    </tr>
                <?php } ?>
                </table>
                <table>
                    <p></p>
                    <div class="strong"><b>H.&nbsp;&nbsp;Catatan Perkembangan Karakter</b></div>
                    <table width="100%" style="border-collapse: collapse; border:1px solid black">
                        <td style="border-collapse: collapse; border:1px solid black;"><?php if (!empty($data_user['perkembangan'.$post_semester.''])) { echo $data_user['perkembangan'.$post_semester.'']; } else { ?>-<?php } ?></td>

                    </table>
                    <p></p>
                    <p></p>
                    <tr>
                        <table width="100%">
                            <tr>
                                <td style="width: 20%">Diberikan di : Kabupaten Bekasi<br><br>Pada tanggal : <?php echo $data_website['tanggalpas'.$post_semester.'']; ?><br><br><br><br><br><br>Orang Tua/Wali<br><br><br><br><br><br><br><br>...........................
                                <br><br><br><br><br><br><br><br><br><br><br></td>
                                <td style="width: 15%"></td>
                                <!--<td style="width: 15%">Keputusan : <br><br>Dengan memperhatikan hasil yang dicapai semester III sampai dengan semester IV maka ditetapkan siswa/I tersebut NAIK / TIDAK BAIK ke kelas XII.<br><br>-->
                                <td style="width: 15%">Keputusan : <br><br>
                                <?php if (!empty($data_user['keputusan'.$kenaikan.''])) { echo $data_user['keputusan'.$kenaikan.'']; } else { ?>-<?php } ?><br><br>
                                Wali Kelas,<br><br><img width="70px" src="<?php echo $cfg_baseurl ?>barcode/<?php echo $data_website['tanggalpas'.$post_semester.'']; ?>-davinwardana-<?php echo $data_user['username']; ?>.png" alt=""><br><br><b><?php echo $data_walas['gelar']; ?></b><br>NIK. <?php echo $data_walas['nik']; ?>
                                <br><br><br>Kepala Sekolah,<br><br><img width="70px" src="<?php echo $data_website['barcode'.$post_semester.'']; ?>" alt=""><br><br><b>Lispiyatmini, S.Pd</b><br>NIK. 7012001</td>
                            </tr>


                        </table>
                        </center>
</body>
</html>

<?php
// include("../lib/footer.php");
?>