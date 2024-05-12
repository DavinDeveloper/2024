<?php
include '../../libs/main/config.php';
$update = mysqli_query($db, "UPDATE users SET keanggotaan = '".$_GET['2']."' WHERE id = '".$_GET['1']."'");
header("Location: ".cfg(url)."ketua/anggota");