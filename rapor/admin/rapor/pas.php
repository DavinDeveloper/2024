<?php
session_start();
require("../../mainconfig.php");

if (isset($_SESSION['user'])) {
    $code = "pas";
    $post_semester = $_GET['1'];
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
    
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] != "Admin") {
		header("Location: ".$cfg_baseurl);
	} else {
			if (isset($_GET['1'])) {
	
		$check_rapor = mysqli_query($db, "SELECT * FROM ".$code."c WHERE semester = '$post_semester'");
		$data_rapor = mysqli_fetch_assoc($check_rapor);
		if (mysqli_num_rows($check_rapor) == 0) {
		header("Location: ".$cfg_baseurl."admin");
			} else {
				if (isset($_POST['edit'])) {
				    $post_kepsek =  mysqli_real_escape_string($db,$_POST['kepsek']);
					$post_nip = $_POST['nip'];
					$post_tanggal = $_POST['tanggal'];
						$update_guru = mysqli_query($db, "UPDATE ".$code."c SET kepsek = '$post_kepsek', nip = '$post_nip', tanggal = '$post_tanggal' WHERE semester = '$post_semester'");
				        if ($update_guru == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Data rapor berhasil diubah.<br />";
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> Error system.";
							
						}
					}

				include("../../lib/header.php");
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Ubah Data <? echo strtoupper($code); ?> Semester <? echo $post_semester; ?></div>
                                        <div class="card-body">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
											<?php echo  mysqli_errno($db); ?>
										</div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">Kepala Sekolah *</label>
												<div class="col-md-12">
													<input type="text" name="kepsek" class="form-control" placeholder="Masukkan Kepala Sekolah" value="<? echo $data_rapor['kepsek']; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">NIP *</label>
												<div class="col-md-12">
													<input type="number" name="nip" class="form-control" placeholder="Masukkan Nip" value="<? echo $data_rapor['nip']; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Lokasi, Tanggal *</label>
												<div class="col-md-12">
													<input type="text" name="tanggal" class="form-control" placeholder="Masukkan Tanggal" value="<? echo $data_rapor['tanggal']; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali</a>
											
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="edit">Ubah</button>
											
												</div>
											</div>
										</form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
<?php
				include("../../lib/footer.php");
			}
		} else {
			header("Location: ".$cfg_baseurl);
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>