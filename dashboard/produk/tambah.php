<?
include '../../lib/config.php';
if ($user['status'] != 'Admin') {
    header("Location: ".cfg(url)."dashboard");
}
    if (isset($_POST['tambah'])) {
		$extention	= array('png','jpg','jpeg');
		$file = $_FILES['file']['name'];
		$x = explode('.', $file);
		$hasil = str_replace(" ", "", $file);
		$ekstensi = strtolower(end($x));
		$size = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$upload = $hasil;
		$url = cfg(url)."img/produk/".$upload;
		$post_nama = mysqli_real_escape_string($db, trim($_POST['nama']));
		$post_harga = mysqli_real_escape_string($db, trim($_POST['harga']));
		$post_rencana = mysqli_real_escape_string($db, trim($_POST['rencana']));
		$post_fasilitas = mysqli_real_escape_string($db, trim($_POST['fasilitas']));
		$post_persyaratan = mysqli_real_escape_string($db, trim($_POST['persyaratan']));
		$post_syarat = mysqli_real_escape_string($db, trim($_POST['syarat']));
		if (empty($file)) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
		} else if (in_array($ekstensi, $extention) === FALSE) {
		    $msg_type = "error";
			$msg_content = "<b>Gagal:</b> File harus berjenis 'jpg','png' atau 'jpeg'.";
		} else {
	    move_uploaded_file($file_tmp, '../../img/produk/'.$upload);
		$insert = mysqli_query($db, "INSERT INTO produk (nama, gambar, harga, rencana, fasilitas, persyaratan, syarat) VALUES ('$post_nama', '$url', '$post_harga', '$post_rencana', '$post_fasilitas', '$post_persyaratan', '$post_syarat')");
	    if ($insert == TRUE) {
    			$msg_type = "success";
    		    $msg_content = "Berhasil : $post_nama berhasil ditambahkan.";
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
						<h4 class="page-title">Tambah Produk</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Detail Produk</div>
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
											<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Paket" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="file">Gambar</label>
											<input type="file" class="form-control" id="file" name="file" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="harga">Harga Paket</label>
											<input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Paket" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="rencana">Rencana Perjalanan</label>
											<textarea rows="6" type="text" class="form-control" id="rencana" name="rencana" placeholder="Masukkan Rencana Perjalanan" required></textarea>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="rencana">Fasilitas</label>
											<textarea rows="6" type="text" class="form-control" id="fasilitas" name="fasilitas" placeholder="Masukkan Fasilitas" required></textarea>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="rencana">Persyaratan</label>
											<textarea rows="6" type="text" class="form-control" id="persyaratan" name="persyaratan" placeholder="Masukkan Persyaratan" required></textarea>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="rencana">Syarat & Ketentuan</label>
											<textarea rows="6" type="text" class="form-control" id="syarat" name="syarat" placeholder="Masukkan Syarat & Ketentuan" required></textarea>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="card-action">
											<a class="btn btn-warning" href="<? echo cfg(url); ?>dashboard/produk">Kembali</a>
											<button class="btn btn-success" type="submit" name="tambah">Tambah</button>
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