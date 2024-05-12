<?php
session_start();
require("../mainconfig.php");

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
	   
	if (isset($_POST['logo'])) {
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
		$update_user = mysqli_query($db, "UPDATE config SET rapor = '$url' WHERE id = '1'");
	    if ($update_user == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b> Logo kop surat berhasil diubah.";
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
                        
                            <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header text-uppercase">Logo Kop</div>
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