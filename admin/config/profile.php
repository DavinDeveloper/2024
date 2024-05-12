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

	if (isset($_POST['update_profile'])) {
	    $extention	= array('png','jpg','jpeg');
		$file = $_FILES['file']['name'];
		$x = explode('.', $file);
		$ekstensi = strtolower(end($x));
		$size = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$upload = "profile.".$ekstensi;
		$url = $home."assets/img/konten/".$upload;
	    $post_profile = trim($_POST['profile']);
	    if (!empty($file)) {
	        if (in_array($ekstensi, $extention) === FALSE) {
    		    $msg_type = "error";
    			$msg_content = "<b>Error:</b> File harus berjenis 'jpg','png' atau 'jpeg'.";
    		} else {
	            move_uploaded_file($file_tmp, '../../assets/img/konten/'.$upload);
	            $update = mysqli_query($db, "UPDATE config SET profile_gambar = '$url' WHERE id = '1'");
    		}
	    }
	    $update = mysqli_query($db, "UPDATE config SET profile = '$post_profile' WHERE id = '1'");
	    if ($update == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b> Profile berhasil diubah.";
		} else {
	    $msg_type = "error";
		$msg_content = "<b>Gagal:</b> Error system.";
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
                                    <div class="card-header text-uppercase">Profile</div>
                                        <div class="card-body">
    									<form class="form-horizontal" method="POST" enctype="multipart/form-data">
    										<div class="form-group">
    											<label class="col-md-12 control-label">Upload Foto (1:1)(Upload jika ingin mengubah foto)</label>
    											<div class="col-md-12">
    												<input type="file" name="file" class="form-control"/>
    											</div>
    										</div>
											<div class="form-group">
												<label class="col-md-12 control-label">Profile</label>
												<div class="col-md-12">
													<textarea rows="12" type="text" name="profile" class="form-control" placeholder="Profile"><?php echo $cfg['profile']; ?></textarea>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="update_profile">Ubah</button>
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