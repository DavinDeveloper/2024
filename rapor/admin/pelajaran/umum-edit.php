<?php
session_start();
require("../../mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
    $post_id = $_GET['1'];
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
    
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] != "Admin") {
		header("Location: ".$cfg_baseurl);
	} else {
			if (isset($_GET['1'])) {
	
		$check_pelajaran = mysqli_query($db, "SELECT * FROM pelajaran WHERE id = '$post_id'");
		$data_pelajaran = mysqli_fetch_assoc($check_pelajaran);
		if (mysqli_num_rows($check_pelajaran) == 0) {
		       $post_id = $_GET['1'];
		header("Location: ".$cfg_baseurl."admin/pelajaran/umum");
			} else {
				if (isset($_POST['edit'])) {
				    $post_nama =  mysqli_real_escape_string($db,$_POST['nama']);
						$update_pelajaran = mysqli_query($db, "UPDATE pelajaran SET nama = '$post_nama' WHERE id = '$post_id'");
				        if ($update_pelajaran == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Data pelajaran berhasil diubah.<br />";
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
                                    <div class="card-header text-uppercase">Ubah Data Pelajaran</div>
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
										</div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">NAMA PELAJARAN *</label>
												<div class="col-md-12">
													<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Pelajaran" value="<? echo $data_pelajaran['nama']; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">CODE *</label>
												<div class="col-md-12">
													<input type="text" name="code" class="form-control" placeholder="Masukkan Nama Pelajaran" value="<? echo strtoupper($data_pelajaran['code']); ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin/pelajaran/umum" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali</a>
											
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="edit">Ubah</button>
											
												</div>
											</div>
										</form>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->


                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->
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