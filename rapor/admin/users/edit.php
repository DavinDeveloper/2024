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
	
		$checkdb_users = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_id'");
		$datadb_users = mysqli_fetch_assoc($checkdb_users);
		if (mysqli_num_rows($checkdb_users) == 0) {
		       $post_id = $_GET['1'];
		header("Location: ".$cfg_baseurl."admin/kelola_users");
			} else {
				if (isset($_POST['edit'])) {
				    $post_nama =  mysqli_real_escape_string($db,$_POST['nama']);
					$post_username = $_POST['username'];
					$post_password = $_POST['password'];
					$post_jurusan_id = $_POST['jurusan_id'];
					$post_email = $_POST['email'];
					$post_status = $_POST['status'];
					$post_profile = $_POST['profile'];
					$post_theme = $_POST['theme'];
						$update_users = mysqli_query($db, "UPDATE users SET nama = '$post_nama', username = '$post_username', password = '$post_password', jurusan_id = '$post_jurusan_id', email = '$post_email', status = '$post_status', profile = '$post_profile', theme = '$post_theme' WHERE username = '$post_id'");
				        if ($update_users == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Data users berhasil diubah.<br />";
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> Error system.";
							
						}
					}
				
		$checkdb_siswa = mysqli_query($db, "SELECT * FROM poin_kehadiran, siswa WHERE poin_kehadiran.username = siswa.username AND poin_kehadiran.username = '$post_id'");
		$datadb_siswa = mysqli_fetch_assoc($checkdb_siswa);

				include("../../lib/header.php");
?>
					<br/><br/><br/>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Ubah Data Users</div>
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
												<label class="col-md-2 control-label">ID</label>
												<div class="col-md-10">
													<input type="number" name="id" class="form-control" value="<?php echo $datadb_users['id']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">NAMA</label>
												<div class="col-md-10">
													<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="<?php echo $datadb_users['nama']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">USERNAME</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="<?php echo $datadb_users['username']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">PASSWORD</label>
												<div class="col-md-10">
													<input type="text" name="password" class="form-control" placeholder="Masukkan Password" value="<?php echo $datadb_users['password']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">JURUSAN ID</label>
												<div class="col-md-10">
													<input type="text" name="jurusan_id" class="form-control" placeholder="Masukkan Jurusan ID" value="<?php echo $datadb_users['jurusan_id']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">EMAIl</label>
												<div class="col-md-10">
													<input type="text" name="email" class="form-control" placeholder="Masukkan Email" value="<?php echo $datadb_users['email']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">STATUS</label>
												<div class="col-md-10">
													<input type="text" name="status" class="form-control" placeholder="Masukkan Status" value="<?php echo $datadb_users['status']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">PROFILE</label>
												<div class="col-md-10">
													<input type="text" name="profile" class="form-control" placeholder="Masukkan Profile" value="<?php echo $datadb_users['profile']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">THEME</label>
												    <select class="form-control" name="theme">
														<option value="<?php echo $datadb_users['theme']; ?>"><?php echo $datadb_users['theme']; ?> (Active)</option>
														<option value="dark">Dark Mode</option></option>
														<option value="primary">Tema Biasa</option>
													</select>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin/kelola_users" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											
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