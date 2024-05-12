<?php
session_start();
require("../mainconfig.php");

    $post_username = $_GET['1'];
    $post_semester = $_GET['2'];

	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
	$data_user = mysqli_fetch_assoc($check_user);

	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl);
	}
    
if (empty($_GET['1'])) {
    header("Location: " . $cfg_baseurl);
}   

    $rapor = 'pas';    
    $check_user = mysqli_query($db, "SELECT * FROM users WHERE nomor = '$post_username'");
    $data_user = mysqli_fetch_assoc($check_user);
    $check_nilai = mysqli_query($db, "SELECT * FROM ".$rapor." WHERE nis = '$post_username'");
    $data_nilai = mysqli_fetch_assoc($check_nilai);
    $check_nilai = mysqli_query($db, "SELECT * FROM ".$rapor." WHERE nis = '$post_username'");
    $data_nilai = mysqli_fetch_assoc($check_nilai);
    $check_jurusan = mysqli_query($db, "SELECT * FROM jurusan WHERE nama = '".$data_user['jurusan']."'");
    $data_jurusan = mysqli_fetch_assoc($check_jurusan);
    $check_walas = mysqli_query($db, "SELECT * FROM users WHERE kelas = '".$data_user['kelas']."' AND status = 'Guru'");
    $data_walas = mysqli_fetch_assoc($check_walas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data_user['nama']; ?></title>
    <meta name="description" content="Rapor <? echo strtoupper($rapor); ?> Semester <?php echo $post_semester; ?>">
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
        <tr colspan="12">
            <td style="padding-left: 30px"><img src="<?php echo $cfg['logo']; ?>" alt="logo SMK" width="90px" height="90px"></td>
            <th colspan="10" width="80%">
                <font size="5,5"><br><?php echo strtoupper($cfg['name']); ?></br></font size>
                <p>Jurusan : <? echo $data_jurusan['nama']; ?></p>
                <font size="2px";> <?php echo $cfg['alamat']; ?></font><br>
                <font size="1";>Telp.(<?php echo $cfg['telepon']; ?>), Email : <?php echo $cfg['email']; ?></font>
            </th>
            <td style="padding-left: 30px"><img src="<?php echo $cfg['rapor']; ?>" alt="logo SMK" width="90px" height="90px"></td>
        <tr>

            <td colspan="12">
                <hr></td>
        </tr>

        <tr>
            <th colspan="12">LAPORAN HASIL BELAJAR<p>PENILAIAN AKHIR SEMESTER</th>
        </tr>
    </table>

    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Nama Peserta Didik</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_user['nama']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Nomor Induk</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_user['nomor']; ?>/<?php echo $data_user['nisn']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Kelas</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_user['kelas']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Kompetensi Keahlian</td>
            <td style="width: 1%">:</td>
            <td style="width: 35%"><?php echo $data_jurusan['kompetensi']; ?></td>

        </tr>
    </table>
    <br>
    <div class="strong"><b>A.&nbsp;&nbsp;Nilai Akademik</b></div>
    
    <!--NILAI AKADEMIK-->
    
    <table width="100%" style="border-collapse: collapse; border:1px solid black;" cellpadding="4">
        <tr>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;" rowspan="2">No</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;" rowspan="2">Mata Pelajaran</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;" rowspan="2">KKM</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;" rowspan="2">Pengetahuan</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;" rowspan="2">Keterampilan</th>
            <th style="border-collapse: collapse; border:1px solid black; background: lightgray;" rowspan="2">Sikap</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <td style="border-collapse: collapse; border:1px solid black; background: lightgray;" colspan="1"><b><center>A.</center></b></td>
            <td style="border-collapse: collapse; border:1px solid black; background: lightgray;" colspan="6"><b>Muatan Nasional</b></td>
        </tr>
        <?
        $code = 'a1';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">1</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <?
        $code = 'a2';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">2</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <?
        $code = 'a3';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">3</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <?
        $code = 'a4';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">4</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <?
        $code = 'a5';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">5</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <tr>
            <td style="border-collapse: collapse; border:1px solid black; background: lightgray;" colspan="1"><b><center>B.</center></b></td>
            <td style="border-collapse: collapse; border:1px solid black; background: lightgray;" colspan="6"><b>Muatan Kewilayahan</b></td>
        </tr>
        <?
        $code = 'b1';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">1</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <tr>
            <td style="border-collapse: collapse; border:1px solid black; background: lightgray;" colspan="1"><b><center>C.</center></b></td>
            <td style="border-collapse: collapse; border:1px solid black; background: lightgray;" colspan="6"><b>Muatan Minatan Kejuruan</b></td>
        </tr>
        <tr>
            <td style="border-collapse: collapse; border:1px solid black; background: lightgray;" colspan="1"><b><center>C3</center></b></td>
            <td style="border-collapse: collapse; border:1px solid black; background: lightgray;" colspan="6"><b>Kompetensi Keahlian</b></td>
        </tr>
        
        <?
        $code = 'c1';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code' AND jurusan = '".$data_user['jurusan']."'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">1</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <?
        $code = 'c2';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code' AND jurusan = '".$data_user['jurusan']."'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">2</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <?
        $code = 'c3';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code' AND jurusan = '".$data_user['jurusan']."'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">3</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <?
        $code = 'c4';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code' AND jurusan = '".$data_user['jurusan']."'"));
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">4</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <?
        $code = 'c5';
        $data_pelajaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pelajaran WHERE code = '$code' AND jurusan = '".$data_user['jurusan']."'"));
        if (!empty($data_pelajaran['nama'])) {
        ?>
        <tr>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center">5</td>
                    <td style="border-collapse: collapse; border:1px solid black"><? echo $data_pelajaran['nama']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><? echo $data_pelajaran['kkm']; ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_p'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_p'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_k'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_k'];} ?></td>
                    <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_s'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_s'];} ?></td>
        </tr>
        <? } ?>
    </table>
    </div>
    <p></p>
    <div class="strong"><b>B.&nbsp;&nbsp;Catatan Akademik</b></div>
    <table width="100%" style="border-collapse: collapse; border:1px solid black">
        <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_ca'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_ca'];} ?></td>
    </table>
    <br/>
    
    <table>
        <div class="strong"><b>C.&nbsp;&nbsp;Praktik Kerja Lapangan</b></div>
        <table width="100%" style="border-collapse: collapse; border:1px solid black">

            <tr>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">No</th>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Mitra DU/DI</th>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Lokasi</th>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Lamanya</th>
                <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">Nilai</th>
            </tr>
            <?
            $code = 'pkl1';
            ?>
            <tr>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center">1</td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_dd'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_dd'];} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_lks'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_lks'];} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_bln'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_bln']." Bulan";} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_n'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_n'];} ?></td>
            </tr> 
            <?
            $code = 'pkl2';
            ?>
            <tr>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center">2</td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_dd'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_dd'];} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_lks'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_lks'];} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_bln'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_bln']." Bulan";} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_n'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_n'];} ?></td>
            </tr>
            <?
            $code = 'pkl3';
            ?>
            <tr>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center">3</td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_dd'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_dd'];} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_lks'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_lks'];} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_bln'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_bln']." Bulan";} ?></td>
                        <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_n'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_n'];} ?></td>
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
                <?
                $code = 'eks1';
                ?>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center">1</td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_eks'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_eks'];} ?></td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_n'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_n'];} ?></td>
                </tr>
                <? 
                $code = 'eks2';
                ?>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center">2</td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_eks'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_eks'];} ?></td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_n'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_n'];} ?></td>
                </tr>
                <?
                $code = 'eks3';
                ?>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center">3</td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_eks'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_eks'];} ?></td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.'_n'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.'_n'];} ?></td>
                </tr>
            </table>
            <p></p>
            <table>
                <div class="strong"><b>E.&nbsp;&nbsp;Ketidakhadiran</b></div>
                <table width="100%" style="border-collapse: collapse; border:1px solid black">
                    <?
                    $code = 's';
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Sakit</td>
                        <td width="60%" style="border-collapse: collapse; border:1px solid black"><?php if(empty($data_nilai['s'.$post_semester.'_hdr_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_hdr_'.$code.''];} ?></td>
                    </tr>
                    <?
                    $code = 'i';
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Izin</td>
                        <td width="60%" style="border-collapse: collapse; border:1px solid black"><?php if(empty($data_nilai['s'.$post_semester.'_hdr_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_hdr_'.$code.''];} ?></td>
                    </tr>
                    <?
                    $code = 't';
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Tanpa Keterangan</td>
                        <td width="60%" style="border-collapse: collapse; border:1px solid black"><?php if(empty($data_nilai['s'.$post_semester.'_hdr_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_hdr_'.$code.''];} ?></td>
                    </tr>
            </table>
            <p></p>
                <?
                $code = 'naik';
                ?>
                <div class="strong"><b>F.&nbsp;&nbsp;Kenaikan Kelas</b></div>
                <table width="100%" style="border-collapse: collapse; border:1px solid black">
                        <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.''];} ?></td>
                </table>
            <p></p>
            <div style="page-break-before: always;"></div>
                <div class="strong"><b>G.&nbsp;&nbsp;Deskripsi Perkembangan Karakter</b></div>
               <table width="100%" style="border-collapse: collapse; border:1px solid black">
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black"><b><center>Karakter yang Dibangun</center></b></td>
                        <td style="border-collapse: collapse; border:1px solid black"><b><center>Deskripsi</center></b></td>
                    </tr>
                    <?
                    $code = 'pk_i';
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Integritas</td>
                        <td style="border-collapse: collapse; border:1px solid black"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.''];} ?></td>
                    </tr>
                    <?
                    $code = 'pk_r';
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Religius</td>
                        <td style="border-collapse: collapse; border:1px solid black"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.''];} ?></td>
                    </tr>
                    <?
                    $code = 'pk_n';
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Nasionalis</td>
                        <td style="border-collapse: collapse; border:1px solid black"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.''];} ?></td>
                    </tr>
                    <?
                    $code = 'pk_m';
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Mandiri</td>
                        <td style="border-collapse: collapse; border:1px solid black"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.''];} ?></td>
                    </tr>
                    <?
                    $code = 'pk_g';
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border:1px solid black">Gotong-royong</td>
                        <td style="border-collapse: collapse; border:1px solid black"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.''];} ?></td>
                    </tr>
                </table>
                <table>
                    <p></p>
                <?
                $code = 'pk_c';
                ?>
                <div class="strong"><b>H.&nbsp;&nbsp;Catatan Perkembangan Karakter</b></div>
                <table width="100%" style="border-collapse: collapse; border:1px solid black">
                        <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_'.$code.''])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_'.$code.''];} ?></td>
                </table>
                    <p></p>
                    <p></p>
                    <?
                    $data_rapor = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM ".$rapor."c WHERE semester = '$post_semester'"))
                    ?>
                    <tr>
                        <table width="100%">
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"></td>
                                <td style="width: 15%"><?php echo $data_rapor['tanggal']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%">Orang Tua/Wali</td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%">Wali Kelas <?php echo $data_walas['kelas']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%"><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td style="width: 20%">...........................</td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%"><b><?php echo $data_walas['nama']; ?></b></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%">NIP. <?php echo $data_walas['nomor']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%">Mengetahui,</td>
                                <td style="width: 7%"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%">Kepala <? echo $cfg['name']; ?></td>
                                <td style="width: 7%"></td>
                            </tr>
                          <tr>
                                <td></td>
                                <td><br><br><br><br></td>
                                <td></td>

                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"><b><?php echo $data_rapor['kepsek']; ?></b></td>
                                <td style="width: 7%"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 10%">NIP. <?php echo $data_rapor['nip']; ?></td>
                                <td style="width: 7%"></td>
                            </tr>
                            


                        </table>
                        </center>
    <div style="page-break-before: always;"></div>
    <p></p><p></p><p></p>
    <table width="100%" cellpadding="0">
        <tr>
            <th colspan="12">CATATAN PRESTASI YANG PERNAH DICAPAI</th>
        </tr>
    </table>
    <p></p>
    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Nama Peserta Didik</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_user['nama']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Nama Sekolah</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $cfg['name']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">NISN/NIS</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_user['nisn']; ?>/<?php echo $data_user['nomor']; ?></td>
        </tr>
    </table>
    <p></p>
        <table>
            <table width="100%" style="border-collapse: collapse; border:1px solid black">

                <tr>
                    <th style="border-collapse: collapse; border:1px solid black; background: lightgray;">No</th>
                    <th style="border-collapse: collapse; border:1px solid black; text-align:center; background: lightgray;">Prestasi yang Pernah Dicapai</th>
                    <th style="border-collapse: collapse; border:1px solid black; text-align:center; background: lightgray;">Keterangan</th>
                </tr>
                <?
                $code = 'k';
                ?>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center" rowspan="4">1</td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center" rowspan="4">Kurikuler</td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'1'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'1'];} ?></td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'2'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'2'];} ?></td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'3'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'3'];} ?></td>
                </tr>
                <? 
                $code = 'e';
                ?>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center" rowspan="4">2</td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center" rowspan="4">Ekstra Kurikuler</td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'1'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'1'];} ?></td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'2'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'2'];} ?></td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'3'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'3'];} ?></td>
                </tr>
                <?
                $code = 'c';
                ?>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center" rowspan="4">3</td>
                            <td style="border-collapse: collapse; border:1px solid black; text-align:center" rowspan="4">Catatan Khusus Lainnya</td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'1'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'1'];} ?></td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'2'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'2'];} ?></td>
                </tr>
                <tr>
                            <td style="border-collapse: collapse; border:1px solid black;"><?php if(empty($data_nilai['s'.$post_semester.'_pres_'.$code.'3'])){echo "-";}else{echo $data_nilai['s'.$post_semester.'_pres_'.$code.'3'];} ?></td>
                </tr>
            </table>
            
            <p></p>
                    <p></p>
                    <?
                    $data_rapor = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM ".$rapor."c WHERE semester = '$post_semester'"))
                    ?>
                    <tr>
                        <table width="100%">
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"></td>
                                <td style="width: 15%"><?php echo $data_rapor['tanggal']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%">Orang Tua/Wali</td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%">Wali Kelas <?php echo $data_walas['kelas']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%"><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td style="width: 20%">...........................</td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%"><b><?php echo $data_walas['nama']; ?></b></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%">NIP. <?php echo $data_walas['nomor']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"></td>
                                <td style="width: 7%"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%">Mengetahui,</td>
                                <td style="width: 7%"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%">Kepala <? echo $cfg['name']; ?></td>
                                <td style="width: 7%"></td>
                            </tr>
                          <tr>
                                <td></td>
                                <td><br><br><br><br></td>
                                <td></td>

                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 15%"><b><?php echo $data_rapor['kepsek']; ?></b></td>
                                <td style="width: 7%"></td>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td style="width: 10%">NIP. <?php echo $data_rapor['nip']; ?></td>
                                <td style="width: 7%"></td>
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