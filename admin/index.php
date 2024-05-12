<?php
session_start();
require("mainconfig.php");
if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
    
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."auth/logout.php");
	} else if ($data_user['status'] != "Admin") {
		header("Location: " . $home);
	}
    
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('#Mozilla/4.05 [fr] (Win98; I)#',$ua) || preg_match('/Java1.1.4/si',$ua) || preg_match('/MS FrontPage Express/si',$ua) || preg_match('/HTTrack/si',$ua) || preg_match('/IDentity/si',$ua) || preg_match('/HyperBrowser/si',$ua) || preg_match('/Lynx/si',$ua)) 
    {
    header('Location:http://shafou.com');
    die();
    }
} else {
	header("Location: ".$home."auth/login?target=admin");
}
	
	include("lib/header.php");
	
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
                    </div>
                    </div>
                </div>
<?php
include("lib/footer.php");
?> 