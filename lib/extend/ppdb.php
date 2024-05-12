<?php
session_start();
require("config.php");

    $post_id = $_GET['1'];
	$check_pendaftaran = mysqli_query($db, "SELECT * FROM ppdb WHERE id = '$post_id'");
	$data_pendaftaran = mysqli_fetch_assoc($check_pendaftaran);

	if (mysqli_num_rows($check_pendaftaran) == 0) {
		header("Location: ".$cfg_baseurl);
	} else if (empty($_GET['1'])) {
        header("Location: " . $cfg_baseurl);
    }
	
    if (mysqli_num_rows($check_user) == 0) {
        header("Location: " . $cfg_baseurl);
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data_pendaftaran['nama']; ?> - PPDB <? echo strtoupper($cfg['name']); ?></title>
    <meta name="description" content="Formulir Penerimaan Siswa Didik Baru">
    <meta property="og:image" content="<?php echo $data_pendaftaran['foto']; ?>">
    <link itemprop="thumbnailUrl" href="<?php echo $data_pendaftaran['foto']; ?>">
    <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
    <link itemprop="url" href="<?php echo $data_pendaftaran['foto']; ?>"></span>
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
            <th colspan="11"><br><br><br>SURAT FORMULIR PENDAFTARAN<p>PENERIMAAN PESERTA DIDIK BARU<br><br><br></th>
        </tr>
    </table>

    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Nama Pendaftar</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_pendaftaran['nama']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Jenis Pendaftaran</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_pendaftaran['jenis']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Jalur Pendaftaran</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_pendaftaran['jalur']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Jurusan</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_pendaftaran['jurusan']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Jenis Kelamin</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_pendaftaran['kelamin']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">TTL</td>
            <td style="width: 1%">:</td>
            <td style="width: 35%"><?php echo $data_pendaftaran['tempat_lahir']; ?>, <?php echo $data_pendaftaran['tanggal_lahir']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Agama</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_pendaftaran['agama']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Alamat</td>
            <td style="width: 1%">:</td>
            <td style="width: 35%"><?php echo $data_pendaftaran['alamat']; ?>, <?php echo $data_pendaftaran['kabupaten']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Telepon</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_pendaftaran['telepon']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Kewarganegaraan</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><?php echo $data_pendaftaran['kewarganegaraan']; ?></td>
        </tr>
    </table>
    <br><br>
                <table>
                    <p></p>
                    <p></p>
                    <tr>
                        <table width="100%"> 
                            <tr>
                                <td style="width: 20%">Diberikan di : <? echo $cfg['alamat']; ?><br><br>Dicetak pada : <?php echo $data_pendaftaran['datetime']; ?>
                                <br><br><br><br><br><br>
                                <img src="<? echo $data_pendaftaran['foto']; ?>" height="200px">
                                <br><br><br><br><br><br><br><br><br><br></td>
                                <td style="width: 15%"></td>
                                <td style="width: 15%">Penandatangan,<br><br><br><br><br><br><br><b><? echo $data_pendaftaran['nama']; ?></td>
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
