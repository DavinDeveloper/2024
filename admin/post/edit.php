<?php
session_start();
require("../mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
    
    $post_id = $_GET['1'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	$check_post = mysqli_query($db, "SELECT * FROM post WHERE id = '$post_id'");
	$data_post = mysqli_fetch_assoc($check_post);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: " . $cfg_baseurl . "logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: " . $cfg_baseurl . "logout.php");
	} else if ($data_user['status'] != "Admin") {
		header("Location: " . $home);
	} else if (mysqli_num_rows($check_post) == 0) {
		header("Location: " . $cfg_baseurl . "post");
	} else {
	    
	   
	if (isset($_POST['ubah'])) {
		$extention	= array('png','jpg','jpeg');
		$file = $_FILES['file']['name'];
		$x = explode('.', $file);
		$hasil = str_replace(" ", "", $file);
		$ekstensi = strtolower(end($x));
		$size = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$upload = $date."-".date("H-i-s")."-".$hasil;
		$url = $home."assets/img/post/".$upload;
	    $post_judul = trim($_POST['judul']);
	    $post_konten = trim($_POST['konten']);
		if (!empty($file)) {
		    if (in_array($ekstensi, $extention) === FALSE) {
    		    $msg_type = "error";
    			$msg_content = "<b>Error:</b> File harus berjenis 'jpg','png' atau 'jpeg'.";
    		} else {
	            move_uploaded_file($file_tmp, '../../assets/img/post/'.$upload);
		        $update_post = mysqli_query($db, "UPDATE post SET gambar = '$url' WHERE id = '$post_id'");
    		}
		}
		$update_post = mysqli_query($db, "UPDATE post SET judul = '$post_judul', konten = '$post_konten' WHERE id = '$post_id'");
	    if ($update_post == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b> Postingan berhasil diubah.";
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
                                    <div class="card-header text-uppercase">Upload Postingan</div>
                                        <div class="card-body">
										<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-md-12 control-label">Judul</label>
												<div class="col-md-12">
													<input type="text" name="judul" class="form-control" placeholder="Judul" value="<? echo $data_post['judul']; ?>">
												</div>
											</div>
											
											<div class="form-group">
    											<label class="col-md-12 control-label">Gambar</label>
    											<div class="col-md-12">
    												<input type="file" name="file" class="form-control"/>
    											</div>
    										</div>
    											
    										<div class="form-group">
												<label class="col-md-12 control-label">Konten</label>
												<div class="col-md-12">
													<textarea rows="12" type="text" name="konten" class="form-control" placeholder="Konten"><? echo $data_post['konten']; ?></textarea>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<? echo $cfg_baseurl; ?>post" class="btn btn-primary btn-bordered waves-effect w-md waves-light">Kembali</a>
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="ubah">Ubah</button>
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