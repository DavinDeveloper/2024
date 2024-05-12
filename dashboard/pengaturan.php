<?
include '../lib/config.php';
    if (isset($_POST['ubah'])) {
		$post_nama = mysqli_real_escape_string($db, trim($_POST['nama']));
		$post_whatsapp = mysqli_real_escape_string($db, trim($_POST['whatsapp']));
		if (empty($post_nama) || empty($post_whatsapp)) {
			$msg_type = "error";
			$msg_content = "Gagal: Mohon mengisi semua input.";
		} else {
			$check_user = mysqli_query($db, "SELECT * FROM users WHERE username != '$post_username' AND whatsapp = '$post_whatsapp'");
			if (mysqli_num_rows($check_user) == 0) {
				$msg_type = "error";
				$msg_content = "Gagal : Nomor WhatsApp $post_whatsapp sudah digunakan oleh pengguna lain.";
			} else {
			    $update = mysqli_query($db, "UPDATE users SET nama = '$post_nama', whatsapp = '$post_whatsapp' WHERE username = '".$user['username']."'");
			    if ($update == TRUE) {
    			    $msg_type = "success";
    				$msg_content = "Berhasil : Pengaturan akun berhasil disimpan.";
			    } else {
    				$msg_type = "error";
    				$msg_content = "Gagal : Error sistem.";
			    }
			}
		}
	}
include 'lib/header.php';
?>
			
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Pengaturan</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Pengaturan Akun</div>
									</div>
									<form method="POST">
									<div class="card-body">
									    <? if (!empty($msg_type)) { ?>
										<div class="form-group has-<? echo $msg_type; ?> has-feedback">
											<input type="text" value="<? echo $msg_content; ?>" class="form-control" />
											<span class="la la-times form-control-feedback"></span>
										</div>
										<? } ?>
										<div class="form-group">
											<label for="nama">Nama</label>
											<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<? echo $user['nama']; ?>" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="form-group">
											<label for="whatsapp">WhatsApp</label>
											<input type="number" class="form-control" id="whatsapp" name="whatsapp" placeholder="Masukkan Nomor WhatsApp" value="<? echo $user['whatsapp']; ?>" required>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="card-action">
											<button class="btn btn-success" type="submit" name="ubah">Ubah</button>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
<?
include 'lib/footer.php';
?>