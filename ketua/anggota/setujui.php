<?php
include '../../libs/main/config.php';
$limit = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM nominal WHERE jenis = 'Limit'"));
$update = mysqli_query($db, "UPDATE users SET pinjaman = 'Disetujui', limit_pinjam = '".$limit['nominal']."' WHERE id = '".$_GET['1']."'");
header("Location: ".cfg(url)."ketua/anggota");