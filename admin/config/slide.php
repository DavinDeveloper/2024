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
	   
	if (isset($_POST['ubah'])) {
	    $post_slide = trim($_POST['slide']);
	    $post_kecil = trim($_POST['kecil']);
	    $post_besar = trim($_POST['besar']);
	    $post_tombol = trim($_POST['tombol']);
	    $post_url = trim($_POST['url']);
		$extention	= array('png','jpg','jpeg');
		$file = $_FILES['file']['name'];
		$x = explode('.', $file);
		$ekstensi = strtolower(end($x));
		$size = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$upload = "slide".$post_slide.".".$ekstensi;
		$url = $home."assets/img/slide/".$upload;
		if (!empty($file)) {
		    if (in_array($ekstensi, $extention) === FALSE) {
    		    $msg_type = "error";
    			$msg_content = "<b>Error:</b> File harus berjenis 'jpg','png' atau 'jpeg'.";
    		} else {
	            move_uploaded_file($file_tmp, '../../assets/img/slide/'.$upload);
		        $update_slide = mysqli_query($db, "UPDATE slide SET gambar = '$url' WHERE id = '$post_slide'");
    		}
		}
		$update_slide = mysqli_query($db, "UPDATE slide SET kecil = '$post_kecil', besar = '$post_besar', tombol = '$post_tombol' WHERE id = '$post_slide'");
	    if ($update_slide == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b> Slide $post_slide berhasil diubah.";
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
                        
                            <?
                            $urut = '1';
                            $check_slide = mysqli_query($db, "SELECT * FROM slide WHERE id = '$urut'");
                            $data_slide = mysqli_fetch_assoc($check_slide);
                            ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header text-uppercase">Slide <? echo $urut; ?></div>
                                            <div class="card-body">
    										<form class="form-horizontal" method="POST" enctype="multipart/form-data">
    										    <input type="hidden" name="slide" value="<? echo $urut; ?>">
    										    
    											<div class="form-group">
    												<label class="col-md-12 control-label">Upload Foto (landscape)</label>
    												<div class="col-md-12">
    													<input type="file" name="file" class="form-control"/>
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tulisan Kecil</label>
    												<div class="col-md-12">
    													<input type="text" name="kecil" class="form-control" placeholder="Tulisan Kecil" value="<?php echo $data_slide['kecil']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tulisan Besar</label>
    												<div class="col-md-12">
    													<input type="text" name="besar" class="form-control" placeholder="Tulisan Besar" value="<?php echo $data_slide['besar']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tombol</label>
    												<div class="col-md-12">
    													<input type="text" name="tombol" class="form-control" placeholder="Tulisan Tombol" value="<?php echo $data_slide['tombol']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Url Tombol</label>
    												<div class="col-md-12">
    													<input type="text" name="url" class="form-control" placeholder="Url Tombol" value="<?php echo $data_slide['url']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<div class="col-md-offset-2 col-md-10">
    											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="ubah">Ubah</button>
    												</div>
    											</div>
        										</form>
                                        </div>
                                    </div>
                                </div>
                                
                            <?
                            $urut = '2';
                            $check_slide = mysqli_query($db, "SELECT * FROM slide WHERE id = '$urut'");
                            $data_slide = mysqli_fetch_assoc($check_slide);
                            ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header text-uppercase">Slide <? echo $urut; ?></div>
                                            <div class="card-body">
    										<form class="form-horizontal" method="POST" enctype="multipart/form-data">
    										    <input type="hidden" name="slide" value="<? echo $urut; ?>">
    										    
    											<div class="form-group">
    												<label class="col-md-12 control-label">Upload Foto (landscape)</label>
    												<div class="col-md-12">
    													<input type="file" name="file" class="form-control"/>
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tulisan Kecil</label>
    												<div class="col-md-12">
    													<input type="text" name="kecil" class="form-control" placeholder="Tulisan Kecil" value="<?php echo $data_slide['kecil']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tulisan Besar</label>
    												<div class="col-md-12">
    													<input type="text" name="besar" class="form-control" placeholder="Tulisan Besar" value="<?php echo $data_slide['besar']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tombol</label>
    												<div class="col-md-12">
    													<input type="text" name="tombol" class="form-control" placeholder="Tulisan Tombol" value="<?php echo $data_slide['tombol']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Url Tombol</label>
    												<div class="col-md-12">
    													<input type="text" name="url" class="form-control" placeholder="Url Tombol" value="<?php echo $data_slide['url']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<div class="col-md-offset-2 col-md-10">
    											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="ubah">Ubah</button>
    												</div>
    											</div>
        										</form>
                                        </div>
                                    </div>
                                </div>
                                
                            <?
                            $urut = '3';
                            $check_slide = mysqli_query($db, "SELECT * FROM slide WHERE id = '$urut'");
                            $data_slide = mysqli_fetch_assoc($check_slide);
                            ?>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header text-uppercase">Slide <? echo $urut; ?></div>
                                            <div class="card-body">
    										<form class="form-horizontal" method="POST" enctype="multipart/form-data">
    										    <input type="hidden" name="slide" value="<? echo $urut; ?>">
    										    
    											<div class="form-group">
    												<label class="col-md-12 control-label">Upload Foto (landscape)</label>
    												<div class="col-md-12">
    													<input type="file" name="file" class="form-control"/>
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tulisan Kecil</label>
    												<div class="col-md-12">
    													<input type="text" name="kecil" class="form-control" placeholder="Tulisan Kecil" value="<?php echo $data_slide['kecil']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tulisan Besar</label>
    												<div class="col-md-12">
    													<input type="text" name="besar" class="form-control" placeholder="Tulisan Besar" value="<?php echo $data_slide['besar']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Tombol</label>
    												<div class="col-md-12">
    													<input type="text" name="tombol" class="form-control" placeholder="Tulisan Tombol" value="<?php echo $data_slide['tombol']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<label class="col-md-12 control-label">Url Tombol</label>
    												<div class="col-md-12">
    													<input type="text" name="url" class="form-control" placeholder="Url Tombol" value="<?php echo $data_slide['url']; ?>">
    												</div>
    											</div>
    											
    											<div class="form-group">
    												<div class="col-md-offset-2 col-md-10">
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