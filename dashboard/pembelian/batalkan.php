<?
include '../../lib/config.php';
if ($user['status'] != 'Admin' OR empty($_GET['1'])) {
    header("Location: ".cfg(url)."dashboard");
} else {
    $update = mysqli_query($db, "UPDATE pembelian SET status = 'Dibatalkan' WHERE id = '".$_GET['1']."'");
    whatsapp($data_pembeli['whatsapp'], '*Pembelian Dibatalkan*

Nama : '.$data_pembeli['nama'].'
Username : '.$data_pembeli['username'].'
WhatsApp : '.$data_pembeli['whatsapp'].'
Paket : '.$data_pembelian['produk'].'
Harga : Rp'.$data_pembelian['harga'].'
Status : Dibatalkan');
    header("Location: ".cfg(url)."dashboard/pembelian");
}