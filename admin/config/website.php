<?php
session_start();
require("../mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
    
    $post = $_GET['1'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: " . $cfg_baseurl . "logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: " . $cfg_baseurl . "logout.php");
	} else if ($data_user['status'] != "Admin") {
		header("Location: " . $home);
	} else {
	   
	if (isset($_POST['nama_website'])) {
	    $post_name = trim($_POST['name']);
	    $update = mysqli_query($db, "UPDATE config SET name = '$post_name' WHERE id = '1'");
	    if ($update == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b> Nama website berhasil diubah.";
		} else {
	    $msg_type = "error";
		$msg_content = "<b>Gagal:</b> Error system.";
		}
	} else if (isset($_POST['contact'])) {
	    $post_telepon = trim($_POST['telepon']);
	    $post_email = trim($_POST['email']);
	    $post_alamat = trim($_POST['alamat']);
	    $update = mysqli_query($db, "UPDATE config SET telepon = '$post_telepon', email = '$post_email', alamat = '$post_alamat' WHERE id = '1'");
	    if ($update == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b> Contact berhasil diubah.";
		} else {
	    $msg_type = "error";
		$msg_content = "<b>Gagal:</b> Error system.";
		}
	}else if (isset($_POST['logo'])) {
		$extention	= array('png','jpg','jpeg');
		$file = $_FILES['file']['name'];
		$x = explode('.', $file);
		$hasil = str_replace(" ", "", $file);
		$ekstensi = strtolower(end($x));
		$size = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$upload = $hasil;
		$url = $home."assets/img/logo/".$upload;
		if (empty($file)) {
			$msg_type = "error";
			$msg_content = "<b>Error:</b> Mohon mengisi semua input.";
		} else if (in_array($ekstensi, $extention) === FALSE) {
		    $msg_type = "error";
			$msg_content = "<b>Error:</b> File harus berjenis 'jpg','png' atau 'jpeg'.";
		} else {
	    move_uploaded_file($file_tmp, '../../assets/img/logo/'.$upload);
		$update_user = mysqli_query($db, "UPDATE config SET logo = '$url' WHERE id = '1'");
	    if ($update_user == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b> Logo berhasil diubah.";
		} else {
	    $msg_type = "error";
		$msg_content = "<b>Gagal:</b> Error system.";
			}
		}
	}
		include("../lib/header.php");
?>
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
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header text-uppercase">Nama Website</div>
                                        <div class="card-body">
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-12 control-label">Nama Website</label>
												<div class="col-md-12">
													<input type="text" name="name" class="form-control" placeholder="Nama Website" value="<?php echo $cfg['name']; ?>">
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="nama_website">Ubah</button>
												</div>
											</div>
										</form>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header text-uppercase">Logo</div>
                                            <div class="card-body">
    										<form class="form-horizontal" method="POST" enctype="multipart/form-data">
    											<div class="form-group">
    												<label class="col-md-12 control-label">Upload Foto (1:1)</label>
    												<div class="col-md-12">
    													<input type="file" name="file" class="form-control"/>
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<div class="col-md-offset-2 col-md-10">
    											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="logo">Ubah</button>
    												</div>
    											</div>
    										</form>
                                    </div>
                                </div>
                            </div>
                            
                        
                        <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Contact</div>
                                        <div class="card-body">
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-12 control-label">Telepon</label>
												<div class="col-md-12">
												    <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $cfg['telepon']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-12 control-label">Email</label>
												<div class="col-md-12">
													<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $cfg['email']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-12 control-label">Alamat</label>
												<div class="col-md-12">
													<input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?php echo $cfg['alamat']; ?>">
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="contact">Ubah</button>
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
                        </div>

<?php
		include("../lib/footer.php");
	}
} else {
	header("Location: " . $cfg_baseurl);
}
?>