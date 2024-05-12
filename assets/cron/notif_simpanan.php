<?php
include '../../libs/main/config.php';
$query_simpanan = mysqli_query($db, "SELECT * FROM simpanan WHERE notifikasi_status = 'Belum' AND notifikasi_tanggal = '".date("Y-m-d")."'");
while($simpanan = mysqli_fetch_assoc($query_simpanan)) {
    $data_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$simpanan['username']."'"));
    whatsapp($data_user['whatsapp'], "*Koperasi ".cfg(nama)."*

Tagihan anda sudah dekat, mari bayar simpanan ".$simpanan['jenis']." anda.

Nominal : Rp".$simpanan['nominal']."
Tenggat : ".$simpanan['tenggat']."

Terima kasih.");
    $update = mysqli_query($db, "UPDATE simpanan SET notifikasi_status = 'Sudah' WHERE id = '".$simpanan['id']."'");
    echo "Notifikasi simpanan ".$simpanan['jenis']." berhasil dikirim ke ".$data_user['username']."<br><br>";
}
?>
