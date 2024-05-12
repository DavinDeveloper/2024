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
	
		$check_guru = mysqli_query($db, "SELECT * FROM users WHERE id = '$post_id'");
		$data_guru = mysqli_fetch_assoc($check_guru);
				if (isset($_POST['delete'])) {
					if (mysqli_num_rows($check_guru) == 0) {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Guru tidak tersedia atau sudah terhapus.";
					} else {
						$delete = mysqli_query($db, "DELETE FROM users WHERE id = '$post_id'");
				        if ($delete == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Guru ".$data_guru['nama']." berhasil dihapus.<br />";
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> Error system.";
    						}
						}
					}

				include("../../lib/header.php");
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Hapus Data Siswa</div>
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
												<label class="col-md-2 control-label">NAMA GURU *</label>
												<div class="col-md-12">
													<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Guru" value="<? echo $data_guru['nama']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">KELAS *</label>
												<div class="col-md-12">
													<input type="text" name="kelas" class="form-control" placeholder="Masukkan Kelas Guru" value="<? echo $data_guru['kelas']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">JURUSAN *</label>
												<div class="col-md-12">
													<input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan Guru" value="<? echo $data_guru['jurusan']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin/guru" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali</a>
											
											<button type="submit" class="btn btn-danger btn-bordered waves-effect w-md waves-light" name="delete">Hapus</button>
											
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
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>