<?php

session_start();
require("mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
    
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") { 
		header("Location: ".$cfg_baseurl."logout.php");
	}
        
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('#Mozilla/4.05 [fr] (Win98; I)#',$ua) || preg_match('/Java1.1.4/si',$ua) || preg_match('/MS FrontPage Express/si',$ua) || preg_match('/HTTrack/si',$ua) || preg_match('/IDentity/si',$ua) || preg_match('/HyperBrowser/si',$ua) || preg_match('/Lynx/si',$ua)) 
    {
    header('Location:http://shafou.com');
    die();
    }
} else {
	header("Location: ".$home."auth/login?target=rapor");
}
if ($data_user['status'] == 'Siswa') {
    $data_guru = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE status = 'Guru' AND kelas = '".$data_user['kelas']."'"));
}

include("lib/header.php");
if (isset($_SESSION['user'])) {
?>
            <div class="row">
				<div class="col-lg-12 mx-auto">			
                                <div class="card">
                                    <div class="card-body">
                                        <div class="member-card">

                                        <div class="text-center w-75 m-auto">
                                            <h4 class="m-b-5 mt-2"><?php echo $data_user['nama']; ?></h4>
                                        </div> 

									<div class="table-responsive">
										<table class="table table-bordered">
                                                <tr>
													<td>Akses</td>
													<td><?php echo $data_user['status']; ?></td>
												</tr>
										        <?php if ($data_user['status'] == 'Siswa') { ?>
                                                <tr>
													<td>Kelas</td>
													<td><?php echo $data_user['kelas']; ?></td>
												</tr>
                                                <tr>
													<td>Wali Kelas</td>
													<td><?php echo $data_guru['nama']; ?></td>
												</tr>
												<?php } else if ($data_user['status'] == 'Guru') { ?>
                                                <tr>
													<td>Kelas</td>
													<td><?php echo $data_user['kelas']; ?></td>
												</tr>
												<?php } ?>
										</table>
									</div>

                                    </div>

                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
			    </div>
             
<?php
}
include("lib/footer.php");
?> 
