<?
include '../../lib/config.php';
if ($user['status'] != 'User') {
    header("Location: ".cfg(url)."dashboard");
}
    $check_pembelian = mysqli_query($db, "SELECT * FROM pembelian WHERE id = '".$_GET['1']."'");
    if (mysqli_num_rows($check_pembelian) == 0) {
        header("Location: ".cfg(url)."dashboard/user/pembelian");
    } else {
        $data_pembelian = mysqli_fetch_assoc($check_pembelian);
    }

    if (isset($_POST['bayar'])) {
		$extention	= array('png','jpg','jpeg');
		$file = $_FILES['file']['name'];
		$x = explode('.', $file);
		$hasil = str_replace(" ", "", $file);
		$ekstensi = strtolower(end($x));
		$size = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$upload = $hasil;
		$url = cfg(url)."img/pembelian/".$upload;
		if (in_array($ekstensi, $extention) === FALSE) {
    		$msg_type = "error";
    		$msg_content = "Gagal: File harus berjenis 'jpg','png' atau 'jpeg'.";
		} else {
	        move_uploaded_file($file_tmp, '../../img/pembelian/'.$upload);
		$update = mysqli_query($db, "UPDATE pembelian SET bukti = '$url' WHERE id = '".$_GET['1']."'");
		if ($update == TRUE) {
    			$msg_type = "success";
    		    $msg_content = "Berhasil : Bukti pembayaran berhasil diupload.";
		} else {
    			$msg_type = "error";
    			$msg_content = "Gagal : Error sistem.";
		}
		}
	}
include '../lib/header.php';
?>
			
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Pembayaran</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title"><p><? echo nl2br(cfg(pembayaran)); ?></p></div>
									</div>
									<form method="POST" enctype="multipart/form-data">
									<div class="card-body">
									    <? if (!empty($msg_type)) { ?>
										<div class="form-group has-<? echo $msg_type; ?> has-feedback">
											<input type="text" value="<? echo $msg_content; ?>" class="form-control" />
											<span class="la la-times form-control-feedback"></span>
										</div>
										<? } ?>
										<div class="form-group">
											<label for="nama">Nama Paket</label>
											<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Paket" value="<? echo $data_pembelian['produk']; ?>" readonly>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="harga">Harga Paket</label>
											<input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Paket" value="<? echo $data_pembelian['harga']; ?>" readonly>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="file">Upload Pembayaran</label>
											<input type="file" class="form-control" id="file" name="file" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="card-action">
											<a class="btn btn-warning" href="<? echo cfg(url); ?>dashboard/user/pembelian">Kembali</a>
											<button class="btn btn-success" type="submit" name="bayar">Bayar</button>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
<?
include '../lib/footer.php';
?>