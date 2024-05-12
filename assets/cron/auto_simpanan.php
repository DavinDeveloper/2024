<?php
include '../../libs/main/config.php';
$wajib = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM nominal WHERE jenis = 'Wajib'"));
$query_users = mysqli_query($db, "SELECT * FROM users WHERE status = 'Anggota'");
while($user = mysqli_fetch_assoc($query_users)) {
    $username = $user['username'];
    $check_simpanan = mysqli_query($db, "SELECT * FROM simpanan WHERE username = '$username' AND jenis = 'Wajib' AND bulan = '".date("Y-m")."'");
    if(mysqli_num_rows($check_simpanan) == 0) {
        $insert = mysqli_query($db, "INSERT INTO simpanan (username, jenis, nominal, bulan, tenggat, notifikasi_tanggal, datetime) VALUES ('$username', 'Wajib', '".$wajib['nominal']."', '".date("Y-m")."', '".date("Y-m")."-25', '".date("Y-m")."-20', '".date("Y-m-d H:i:s")."')");
        if($insert) {
            echo "Simpanan wajib berhasil ditambahkan untuk pengguna $username<br><br>";
        } else {
            echo "Gagal menambahkan simpanan wajib untuk pengguna $username<br><br>";
        }
    }
}
?>
