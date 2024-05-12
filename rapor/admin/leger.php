<?php
require("../mainconfig.php");
$satu = $_GET['1'];
$dua = $_GET['2'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Leger Tanggal ".$dates.".xls");
?>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<table border="1">
	                                <tr>
									    <th rowspan="2">No</th>
									    <th rowspan="2">Nama</th>
									    <th rowspan="2">NIS</th>
									    <th rowspan="2">NISN</th>
									    <th colspan="2">Pendidikan Agama dan Budi Pekerti</th>
									    <th colspan="2">Pendidikan Pancasila dan Kewarganegaraan</th>
									    <th colspan="2">Bahasa Indonesia</th>
									    <th colspan="2">Matematika</th>
									    <th colspan="2">Sejarah Indonesia</th>
									    <th colspan="2">Bahasa Inggris</th>
									    <th colspan="2">Seni Budaya</th>
									    <th colspan="2">Pendidikan Jasmani, Olahraga dan Kesehatan</th>
									    <th colspan="2">Simulasi dan Komunikasi Digital</th>
									    <th colspan="2">Fisika</th>
									    <th colspan="2">Kimia</th>
									    <th colspan="2">Gambar Teknik Listrik</th>
									    <th colspan="2">Dasar Listrik dan Elektronika</th>
									    <th colspan="2">Instalasi Penerangan Listrik</th>
									    <th colspan="2">Instalasi Tenaga Listrik</th>
									    <th colspan="2">Instalasi Motor Listrik</th>
									    <th colspan="2">Perbaikan Peralatan Listrik</th>
									    <th colspan="2">Produk Kreatif dan Kewirausahaan</th>
									    <th colspan="2">Bahasa Jepang</th>
									    <th colspan="2">Bahasa Mandarin</th>
									    <th colspan="2">Basic Industry</th>
									    <th colspan="2">Gambar Teknik Mesin</th>
									    <th colspan="2">Pekerjaan Dasar Teknik Mesin</th>
									    <th colspan="2">Dasar Perancangan Teknik Mesin</th>
									    <th colspan="2">Gambar Teknik Manufaktur</th>
									    <th colspan="2">Teknik Pemesinan Frais</th>
									    <th colspan="2">Teknik Pemesinan Gerinda</th>
									    <th colspan="2">Teknik Pemesinan NC/CNC dan CAM</th>
									    <th colspan="2">Produk Kreatif dan Kewirausahaan</th>
									    <th colspan="2">Gambar Teknik Otomotif</th>
									    <th colspan="2">Teknologi Dasar Otomotif</th>
									    <th colspan="2">Pekerjaan Dasar Otomotif</th>
									    <th colspan="2">Pemeliharaan Mesin Kendaraan Ringan</th>
									    <th colspan="2">Pemeliharaan Sasis dan Pemindah Tenaga Kendaraan Ringan</th>
									    <th colspan="2">Pemeliharaan Kelistrikan Kendaraan Ringan</th>
									    <th colspan="2">Produk Kreatif dan Kewirausahaan</th>
									    <th colspan="2">Kerja Bengkel dan Gambar Teknik</th>
									    <th colspan="2">Dasar Listrik dan Elektronika</th>
									    <th colspan="2">Teknik Pemrograman, Mikroprosessor dan Mikrokontroller</th>
									    <th colspan="2">Mikroprosessor dan Mikrokontroller</th>
									    <th colspan="2">Penerapan Rangkaian Elektronika</th>
									    <th colspan="2">Sistem Pengendali Elektronik</th>
									    <th colspan="2">Pengendali Sistem Robotik</th>
									    <th colspan="2">Pembuatan, Perbaikan dan Pemeliharaan Peralatan Elektronika</th>
									    <th colspan="2">Produk Kreatif dan Kewirausahaan</th>
									    <th colspan="2">Ekonomi Bisnis</th>
									    <th colspan="2">Administrasi Umum</th>
									    <th colspan="2">IPA</th>
									    <th colspan="2">Ekonomi Bisnis</th>
									    <th colspan="2">Aplikasi Pengolah Angka / Spreadsheet</th>
									    <th colspan="2">Akuntansi Dasar</th>
									    <th colspan="2">Perbankan Dasar</th>
									    <th colspan="2">Praktikum Akuntansi Perusahaan Jasa, Dagang dan Manufaktur</th>
									    <th colspan="2">Praktikum Akuntansi Perusahaan Jasa, Dagang dan Manufaktur</th>
									    <th colspan="2">Akuntansi Keuangan</th>
									    <th colspan="2">Komputer Akuntansi</th>
									    <th colspan="2">Administrasi Pajak</th>
									    <th colspan="2">Produk Kreatif dan Kewirausahaan</th>
									    <th colspan="2">IPA Terapan</th>
									    <th colspan="2">Kepariwisataan</th>
									    <th colspan="2">Komunikasi Industri Pariwisata</th>
									    <th colspan="2">Sanitasi, Hygiene dan Keselamatan Kerja</th>
									    <th colspan="2">Administrasi Umum</th>
									    <th colspan="2">Bahasa Asing Pilihan</th>
									    <th colspan="2">Industri Perhotelan</th>
									    <th colspan="2">Front Office</th>
									    <th colspan="2">Housekeeping</th>
									    <th colspan="2">Laundry</th>
									    <th colspan="2">Food And Beverage</th>
									    <th colspan="2">Kimia</th>
									    <th colspan="2">Kimia</th>
									    <th colspan="2">Kimia</th>
									    <th colspan="2">Kimia</th>
									    <th colspan="2">Kimia</th>
									</tr>
									<tr>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									    <th>Pengetahuan</th>
									    <th>Keterampilan</th>
									</tr>
		                            <?php
									$query_list = "SELECT * FROM users,pas WHERE users.username = pas.username AND siswa = 'Yes' AND kelas = '$satu' ORDER BY kelas ASC"; // edit
									$records_per_page = 10;
									$starting_position = 1;
									$new_query = mysqli_query($db, $query_list);
									$no = 1;
									while ($data_show = mysqli_fetch_array($new_query)) {
									?>
										<tr>
										    <td><?php echo $no++; ?></td>
											<td><?php echo $data_show['asli']; ?></td>
											<td><?php echo $data_show['nis']; ?></td>
											<td><?php echo $data_show['nisn']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_agama']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_agama']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_pkn']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_pkn']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_bahasaindonesia']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_bahasaindonesia']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_matematika']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_matematika']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_sejarahindonesia']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_sejarahindonesia']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_bahasainggris']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_bahasainggris']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_senibudaya']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_senibudaya']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_pjok']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_pjok']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_simdig']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_simdig']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_fisika']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_fisika']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_kimia']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_kimia']; ?></td>
											<td><?php echo $data_show['gambartekniklistrik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['gambartekniklistrik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['dasarlistrikdanelektronika_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['dasarlistrikdanelektronika_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['instalasipeneranganlistrik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['instalasipeneranganlistrik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['instalasitenagalistrik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['instalasitenagalistrik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['perbaikanperalatanlistrik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['perbaikanperalatanlistrik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_bahasajepang']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_bahasajepang']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_bahasamandarin']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_bahasamandarin']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_basicindustry']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_basicindustry']; ?></td>
											<td><?php echo $data_show['gambarteknikmesin_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['gambarteknikmesin_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['pekerjaandasarteknikmesin_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['pekerjaandasarteknikmesin_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['dasarperancanganteknikmesin_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['dasarperancanganteknikmesin_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['gambarteknikmanufaktur_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['gambarteknikmanufaktur_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemesinanbubut_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemesinanbubut_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemesinanfrais_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemesinanfrais_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemesinangerinda_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemesinangerinda_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemesinannccncdancam_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemesinannccncdancam_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['gambarteknikotomotif_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['gambarteknikotomotif_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknologidasarotomotif_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknologidasarotomotif_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['pekerjaandasarteknikotomotif_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['pekerjaandasarteknikotomotif_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['mesinkendaraanringan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['mesinkendaraanringan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['sasisdanpemindahantenagakendaraanringantkro_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['sasisdanpemindahantenagakendaraanringantkro_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['kelistrikankendaraanringan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['kelistrikankendaraanringan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['kerjabengkeldangambarteknik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['kerjabengkeldangambarteknik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['dasarlistrikdanelektronika_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['dasarlistrikdanelektronika_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['teknikpemrogramanmikroprosesordanmikrokontroler_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['mikroprosessordanmikrokontroler_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['mikroprosessordanmikrokontroler_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['penerapanrangkaianelektronika_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['penerapanrangkaianelektronika_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['sistempengendalielektronik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['sistempengendalielektronik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['pengendalisistemrobotik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['pengendalisistemrobotik_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['pembuatanperbaikandanpemeliharaanperalatanelektronika_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['ekonomisbisnis_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['ekonomisbisnis_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['administrasiumum_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['administrasiumum_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_ipa']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_ipa']; ?></td>
											<td><?php echo $data_show['etikaprofesi_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['etikaprofesi_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['aplikasipengolahangka_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['aplikasipengolahangka_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['akuntansidasar_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['akuntansidasar_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['perbankandasar_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['perbankandasar_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['praktikumakuntansiperusahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['praktikumakuntansiperusahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['praktikumakuntansilembaga_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['praktikumakuntansilembaga_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['akuntansikeuangan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['akuntansikeuangan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['komputerakutansi_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['komputerakutansi_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['admnistrasipajak_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['admnistrasipajak_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['produkkreatifdankewirausahaan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['p'.$dua.'_ipaterapan']; ?></td>
											<td><?php echo $data_show['k'.$dua.'_ipaterapan']; ?></td>
											<td><?php echo $data_show['kepariwisataan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['kepariwisataan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['komunikasiindustripariwisata_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['komunikasiindustripariwisata_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['sanitasihyginedankeselamatankerja_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['sanitasihyginedankeselamatankerja_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['administrasiumum_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['administrasiumum_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['bahasaasingpilihan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['bahasaasingpilihan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['industriperhotelan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['industriperhotelan_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['housekeeping_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['housekeeping_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['laundry_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['laundry_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['foodandbeverage_s'.$dua.'']; ?></td>
											<td><?php echo $data_show['foodandbeverage_s'.$dua.'']; ?></td>
										</tr>
									<?php
									}
									?>
	</table>
</body>
</html>