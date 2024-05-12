<?
include '../../lib/config.php';
if ($user['status'] != 'Admin') {
    header("Location: ".cfg(url)."dashboard");
}
    $check_produk = mysqli_query($db, "SELECT * FROM produk WHERE id = '".$_GET['1']."'");
    $data_produk = mysqli_fetch_assoc($check_produk);
    if (isset($_POST['hapus'])) {
		if (mysqli_num_rows($check_produk) == 0) {
		    $msg_type = "error";
    		$msg_content = "<b>Gagal:</b> Produk tidak tersedia atau sudah terhapus.";
		} else {
		$delete = mysqli_query($db, "DELETE FROM produk WHERE id = '".$_GET['1']."'");
	    if ($delete == TRUE) {
    			$msg_type = "success";
    		    $msg_content = "Berhasil : Produk berhasil dihapus.";
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
						<h4 class="page-title">Hapus Produk</h4>
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
											<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Paket" value="<? echo $data_produk['nama']; ?>" readonly>
											<!--<small id="emailHelp" class="form-text text-muted">Catatan</small>-->
										</div>
										<div class="card-action">
											<a class="btn btn-warning" href="<? echo cfg(url); ?>dashboard/produk">Kembali</a>
											<button class="btn btn-danger" type="submit" name="hapus">Hapus</button>
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