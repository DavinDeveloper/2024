<?
include '../../lib/config.php';
if ($user['status'] != 'Admin') {
    header("Location: ".cfg(url)."dashboard");
}
    if (isset($_POST['ubah_nama'])) {
		$post_nama = mysqli_real_escape_string($db, trim($_POST['nama']));
		$update = mysqli_query($db, "UPDATE website SET content = '$post_nama' WHERE config = 'nama'");
	    if ($update == TRUE) {
    			$msg_type = "success";
    		    $msg_content = "Berhasil : Nama website berhasil diubah.";
		} else {
    			$msg_type = "error";
    			$msg_content = "Gagal : Error sistem.";
		}
	}
	if (isset($_POST['ubah_logo'])) {
		$extention	= array('png','jpg','jpeg');
		$file = $_FILES['file']['name'];
		$x = explode('.', $file);
		$hasil = str_replace(" ", "", $file);
		$ekstensi = strtolower(end($x));
		$size = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$upload = $hasil;
		$url = cfg(url)."img/logo/".$upload;
		if (in_array($ekstensi, $extention) === FALSE) {
    		    $msg_type = "error";
    			$msg_content = "Gagal: File harus berjenis 'jpg','png' atau 'jpeg'.";
		} else {
	    move_uploaded_file($file_tmp, '../../img/logo/'.$upload);
		$update = mysqli_query($db, "UPDATE website SET content = '$url' WHERE config = 'logo'");
		if ($update == TRUE) {
    			$msg_type = "success";
    		    $msg_content = "Berhasil : Logo website berhasil diubah.";
		} else {
    			$msg_type = "error";
    			$msg_content = "Gagal : Error sistem.";
		}
		}
	}
	if (isset($_POST['ubah_kontak'])) {
		$post_phone = mysqli_real_escape_string($db, trim($_POST['phone']));
		$post_email = mysqli_real_escape_string($db, trim($_POST['email']));
		$post_address = mysqli_real_escape_string($db, trim($_POST['address']));
		$update = mysqli_query($db, "UPDATE website SET content = '$post_phone' WHERE config = 'phone'");
		$update = mysqli_query($db, "UPDATE website SET content = '$post_email' WHERE config = 'email'");
		$update = mysqli_query($db, "UPDATE website SET content = '$post_address' WHERE config = 'address'");
	    if ($update == TRUE) {
    			$msg_type = "success";
    		    $msg_content = "Berhasil : Kontak berhasil diubah.";
		} else {
    			$msg_type = "error";
    			$msg_content = "Gagal : Error sistem.";
		}
	}
	if (isset($_POST['ubah_pembayaran'])) {
		$post_pembayaran = mysqli_real_escape_string($db, trim($_POST['pembayaran']));
		$update = mysqli_query($db, "UPDATE website SET content = '$post_pembayaran' WHERE config = 'pembayaran'");
	    if ($update == TRUE) {
    			$msg_type = "success";
    		    $msg_content = "Berhasil : Pembayaran berhasil diubah.";
		} else {
    			$msg_type = "error";
    			$msg_content = "Gagal : Error sistem.";
		}
	}
include '../lib/header.php';
?>
			
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<div class="row">
						    
						    <div class="col-md-12">
							    <? if (!empty($msg_type)) { ?>
								<div class="form-group has-<? echo $msg_type; ?> has-feedback">
									<input type="text" value="<? echo $msg_content; ?>" class="form-control" />
									<span class="la la-times form-control-feedback"></span>
								</div>
								<? } ?>
							</div>
						    
						    <div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Nama Website</div>
									</div>
									<form method="POST">
									<div class="card-body">
										<div class="form-group">
											<label for="nama">Nama Website</label>
											<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Website" value="<? echo cfg(nama); ?>" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="card-action">
											<button class="btn btn-success" type="submit" name="ubah_nama">Ubah</button>
										</div>
									</div>
									</form>
								</div>
							</div>
						    
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Logo Website</div>
									</div>
									<form method="POST" enctype="multipart/form-data">
									<div class="card-body">
										<div class="form-group">
											<label for="file">Upload Logo</label>
											<input type="file" class="form-control" id="file" name="file">
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="card-action">
											<button class="btn btn-success" type="submit" name="ubah_logo">Ubah</button>
										</div>
									</div>
									</form>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Kontak</div>
									</div>
									<form method="POST">
									<div class="card-body">
										<div class="form-group">
											<label for="phone">Kontak WhatsApp</label>
											<input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan Kontak WhatsApp" value="<? echo cfg(phone); ?>" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="email">Kontak Email</label>
											<input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Kontak Email" value="<? echo cfg(email); ?>" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="address">Kontak Address</label>
											<textarea type="address" rows="3" class="form-control" id="address" name="address" placeholder="Masukkan Kontak Address" required><? echo cfg(address); ?></textarea>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="card-action">
											<button class="btn btn-success" type="submit" name="ubah_kontak">Ubah</button>
										</div>
									</div>
									</form>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Pembayaran</div>
									</div>
									<form method="POST">
									<div class="card-body">
											<label for="pembayaran">Catatan Pembayaran</label>
											<textarea type="pembayaran" rows="3" class="form-control" id="pembayaran" name="pembayaran" placeholder="Masukkan Catatan Pembayaran" required><? echo cfg(pembayaran); ?></textarea>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="card-action">
											<button class="btn btn-success" type="submit" name="ubah_pembayaran">Ubah</button>
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