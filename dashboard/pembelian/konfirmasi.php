<?
include '../../lib/config.php';
if ($user['status'] != 'Admin' OR empty($_GET['1'])) {
    header("Location: ".cfg(url)."dashboard");
} else {
    $update = mysqli_query($db, "UPDATE pembelian SET status = 'Pembayaran Dikonfirmasi' WHERE id = '".$_GET['1']."'");
    $data_pembelian = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pembelian WHERE id = '".$_GET['1']."'"));
    $data_pembeli = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_pembelian['username']."'"));
    whatsapp($data_pembeli['whatsapp'], '*Invoice Pembayaran '.cfg(nama).'*

Nama : '.$data_pembeli['nama'].'
Username : '.$data_pembeli['username'].'
WhatsApp : '.$data_pembeli['whatsapp'].'
Paket : '.$data_pembelian['produk'].'
Harga : Rp'.$data_pembelian['harga'].'
Invoice : '.cfg(url).'invoice/'.$data_pembelian['id']);
    header("Location: ".cfg(url)."dashboard/pembelian");
}