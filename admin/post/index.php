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
	
	$total_post = mysqli_num_rows(mysqli_query($db, "SELECT * FROM post WHERE status = 'show'"));
	
	include("../lib/header.php");
?>
						
   <div class="row">
        
        <div class="col-xl-12 col-md-4">
          <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
            <div class="ms-card-body media">
              <div class="media-body">
                <h6>Total</h6>
                <p class="ms-card-change"><?php echo number_format($total_post,0,',','.'); ?> Postingan</p>
              </div>
            </div>
            <i class="flaticon-stats"></i>
          </div>
        </div>
        
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><a href="<?php echo $cfg_baseurl; ?>post/upload" class="btn btn-primary btn-bordered waves-effect w-md waves-light">Upload</a></div>
                                        <div class="card-body">
									<div class="table-responsive">
											<table id="data-table-1" class="table table-hover w-100">
												<thead>
													<tr>
													    <th></th>
														<th>ID</th>
														<th>Judul</th>
														<th>Konten</th>
														<th>Waktu</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												<?php

    $check_post = mysqli_query($db, "SELECT * FROM post WHERE status = 'show' ORDER BY id ASC");
    $no = 1;
												while ($data_post = mysqli_fetch_assoc($check_post)) {
													$preview = substr($data_post['konten'], 0, 165);
                                                    $preview .= "...";
												?>      
												        <td><?php echo $no++; ?></td>
														<td align="center"><span class="badge badge-primary"><?php echo $data_post['id']; ?></span></td>
														<td><?php echo $data_post['judul']; ?></td>
														<td><?php echo $preview; ?></td>
														<td><?php echo $data_post['datetime']; ?></td>
														<td>
														    <a href="<?php echo $cfg_baseurl; ?>post/edit?1=<?php echo $data_post['id']; ?>" class="btn btn-warning btn-bordered btn-sm waves-effect w-md waves-light">Ubah</a>
														    <a href="<?php echo $cfg_baseurl; ?>post/delete?1=<?php echo $data_post['id']; ?>" class="btn btn-danger btn-bordered btn-sm waves-effect w-md waves-light">Hapus</a>
														</td>
													</tr>
												<?php
												}
												?>
												</tbody>
											</table>
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