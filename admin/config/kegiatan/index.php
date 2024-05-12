<?php
session_start();
require("../../mainconfig.php");

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
	
	$total_kegiatan = mysqli_num_rows(mysqli_query($db, "SELECT * FROM kegiatan WHERE status = 'show'"));
	
	include("../../lib/header.php");
?>
						
   <div class="row">
        
        <div class="col-xl-12 col-md-4">
          <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
            <div class="ms-card-body media">
              <div class="media-body">
                <h6>Total</h6>
                <p class="ms-card-change"><?php echo number_format($total_kegiatan,0,',','.'); ?> Kegiatan</p>
              </div>
            </div>
            <i class="flaticon-stats"></i>
          </div>
        </div>
        
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><a href="<?php echo $cfg_baseurl; ?>config/kegiatan/tambah" class="btn btn-primary btn-bordered waves-effect w-md waves-light">Tambah</a></div>
                                        <div class="card-body">
									<div class="table-responsive">
											<table id="data-table-1" class="table table-hover w-100">
												<thead>
													<tr>
													    <th></th>
														<th>Gambar</th>
														<th>Waktu</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												<?php

    $check_post = mysqli_query($db, "SELECT * FROM kegiatan WHERE status = 'show' ORDER BY id ASC");
    $no = 1;
												while ($data_post = mysqli_fetch_assoc($check_post)) {
												?>      
												        <td><?php echo $no++; ?></td>
														<td><a href="<?php echo $data_post['gambar']; ?>" target="_BLANK" class="btn btn-primary btn-bordered btn-sm waves-effect w-md waves-light">Lihat</a></td>
														<td><?php echo $data_post['datetime']; ?></td>
														<td>
														    <a href="<?php echo $cfg_baseurl; ?>config/kegiatan/delete?1=<?php echo $data_post['id']; ?>" class="btn btn-danger btn-bordered btn-sm waves-effect w-md waves-light">Hapus</a>
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
		include("../../lib/footer.php");
	}
} else {
	header("Location: " . $cfg_baseurl);
}
?>