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
	
		$check_kelas = mysqli_query($db, "SELECT * FROM kelas WHERE id = '$post_id'");
		$data_kelas = mysqli_fetch_assoc($check_kelas);
				if (isset($_POST['delete'])) {
					$checkdb_kelas = mysqli_query($db, "SELECT * FROM kelas WHERE id = '$post_id'");
		            $datadb_kelas = mysqli_fetch_assoc($checkdb_kelas);
					if (mysqli_num_rows($checkdb_kelas) == 0) {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Kelas tidak tersedia atau sudah terhapus.";
					} else {
					    if ($delete_siswa == 'yes') {
						    $delete = mysqli_query($db, "DELETE FROM users WHERE kelas = '".$data_kelas['nama']."' AND kelas != '' AND status = 'Siswa'");
					    }
						$delete = mysqli_query($db, "DELETE FROM kelas WHERE id = '$post_id'");
				        if ($delete == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Kelas ".$data_kelas['nama']." berhasil dihapus.<br />";
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
                                    <div class="card-header text-uppercase">Hapus Data Kelas</div>
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
												<label class="col-md-2 control-label">NAMA KELAS *</label>
												<div class="col-md-12">
													<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Kelas" value="<? echo $data_kelas['nama']; ?>" readonly>
												</div>
											</div>
                                    		<div class="form-group">
                                                <div class="col-md-offset-2 col-md-12">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="siswa" value="yes"> Hapus semua data siswa dengan kelas <? echo $data_kelas['nama']; ?>. (Jika tidak di checklist, anda harus mengubah data kelas pada siswa di halaman kelola pengguna)
                                                    </label>
                                                </div>
                                            </div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin/kelas" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali</a>
											
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