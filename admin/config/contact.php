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
	
	if (isset($_POST['ubah'])) {
	    $post_code = trim($_POST['code']);
	    $post_url = trim($_POST['url']);
	    $data_contact = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM contact WHERE id = '$post_code'"));
	    $update = mysqli_query($db, "UPDATE contact SET url = '$post_url' WHERE id = '$post_code'");
	    if ($update == TRUE) {
		$msg_type = "success";
		$msg_content = "<b>Berhasil:</b> Contact ".$data_contact['nama']." berhasil diubah.";
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
                        $code = '1';
                        $data_contact = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM contact WHERE id = '$code'"));
                        ?>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase"><? echo $data_contact['nama']; ?></div>
                                        <div class="card-body">
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<div class="col-md-12">
												    <input type="hidden" name="code" value="<? echo $code; ?>">
													<input type="text" name="url" class="form-control" placeholder="Url <? echo $data_contact['nama']; ?>" value="<? echo $data_contact['url']; ?>" required>
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
                        $code = '2';
                        $data_contact = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM contact WHERE id = '$code'"));
                        ?>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase"><? echo $data_contact['nama']; ?></div>
                                        <div class="card-body">
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<div class="col-md-12">
												    <input type="hidden" name="code" value="<? echo $code; ?>">
													<input type="text" name="url" class="form-control" placeholder="Url <? echo $data_contact['nama']; ?>" value="<? echo $data_contact['url']; ?>" required>
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