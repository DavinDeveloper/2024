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
	
	$total_pendaftar = mysqli_num_rows(mysqli_query($db, "SELECT * FROM ppdb"));
	
	include("../lib/header.php");
?>
						
   <div class="row">
        
        <div class="col-xl-12 col-md-4">
          <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget">
            <div class="ms-card-body media">
              <div class="media-body">
                <h6>Total</h6>
                <p class="ms-card-change"><?php echo number_format($total_pendaftar,0,',','.'); ?> Pendaftar</p>
              </div>
            </div>
            <i class="flaticon-stats"></i>
          </div>
        </div>
        
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><a href="<? echo $cfg_baseurl; ?>pendaftar/data" class="btn btn-success btn-bordered btn-sm waves-effect w-md waves-light">Download</a></div>
                                        <div class="card-body">
									<div class="table-responsive">
											<table id="data-table-1" class="table table-hover w-100">
												<thead>
													<tr>
													    <th></th>
														<th>Nama</th>
														<th>Telepon</th>
														<th>Waktu</th>
														<th>Lihat</th>
													</tr>
												</thead>
												<tbody>
												<?php

    $check_pendaftar = mysqli_query($db, "SELECT * FROM ppdb ORDER BY id ASC");
    $no = 1;
												while ($data_pendaftar = mysqli_fetch_assoc($check_pendaftar)) {
												?>      
												        <td><?php echo $no++; ?></td>
														<td><?php echo $data_pendaftar['nama']; ?></td>
														<td><?php echo $data_pendaftar['telepon']; ?></td>
														<td><?php echo $data_pendaftar['datetime']; ?></td>
														<td>
														    <a href="<?php echo $data_pendaftar['bukti']; ?>" target="_BLANK" class="btn btn-primary btn-bordered btn-sm waves-effect w-md waves-light">Bukti Transfer</a>
														    <a href="<?php echo $home; ?>pendaftaran/<?php echo $data_pendaftar['id']; ?>" target="_BLANK" class="btn btn-warning btn-bordered btn-sm waves-effect w-md waves-light">Formulir</a>
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