<?php
session_start();
require("../mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: " . $cfg_baseurl . "logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: " . $cfg_baseurl . "logout.php");
	} else {
	
	if (isset($_POST['ubah'])) {
		$post_password = trim(stripslashes(strip_tags(htmlspecialchars($_POST['password'],ENT_QUOTES))));
		$post_npassword = trim(stripslashes(strip_tags(htmlspecialchars($_POST['npassword'],ENT_QUOTES))));
		$post_cnpassword = trim(stripslashes(strip_tags(htmlspecialchars($_POST['cnpassword'],ENT_QUOTES))));
		if (empty($post_password) || empty($post_npassword) || empty($post_cnpassword)) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Mohon mengisi semua input.';
		} else if (md5($post_password) <> $data_user['password']) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Password lama salah.';
		} else if (strlen($post_npassword) < 5) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Password baru telalu pendek, minimal 5 karakter.';
		} else if ($post_cnpassword <> $post_npassword) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Konfirmasi password baru tidak sesuai.';
		} else {
            $post_cnpassword = md5($post_cnpassword);
			$update_user = mysqli_query($db, "UPDATE users SET password = '$post_cnpassword' WHERE username = '$sess_username'");
			if ($update_user == TRUE) {
				$msg_type = "success";
				$msg_content = '<b>Success:</b> Password telah diubah.';
			} else {
				$msg_type = "error";
				$msg_content = '<b>Gagal:</b> Error system.';
			}
		}
	}
	
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	
	include("../lib/header.php");
?>
						
   <div class="row">
								
							<div class="col-lg-12 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="member-card">
                                        <div class="text-center w-75 m-auto">
                                            <h4 class="m-b-5 mt-2"><?php echo $data_user['nama']; ?></h4>
                                            <p class="text-muted">Informasi Profile Anda</p>
                                        </div> 

									<div class="table-responsive">
										<table class="table table-bordered">
										        <tr>
													<td>Username</td>
													<td><?php echo $data_user['username']; ?></td>
												</tr>
												<tr>
													<td>Akses</td>
													<td><?php echo $data_user['status']; ?></td>
												</tr>
										</table>
									</div>

                                    </div>

                                </div>
                            </div>
                        </div>
								
                        </div>
						<div class="row">
						    <div class="col-lg-12">
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
							</div>
						</div>
						<div class="row">	
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Ganti Password</div>
                                        <div class="card-body">
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-12 control-label">Password Lama</label>
												<div class="col-md-12">
													<input type="password" name="password" class="form-control" placeholder="Password Lama">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-12 control-label">Password Baru</label>
												<div class="col-md-12">
													<input type="password" name="npassword" class="form-control" placeholder="Password Baru">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-12 control-label">Konfirmasi Password Baru</label>
												<div class="col-md-12">
													<input type="password" name="cnpassword" class="form-control" placeholder="Konfirmasi Password Baru">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-12">
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="ubah">Ubah Password</button>
												</div>
											</div>
										</form>
                                </div>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                    </div>
                </div>
                        
<?php
		include("../lib/footer.php");
	}
} else {
	header("Location: " . $cfg_baseurl);
}
?>