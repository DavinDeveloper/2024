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
	} else if ($data_user['status'] != "Guru") {
		header("Location: " . $cfg_baseurl);
	} else {
	    
		include("../lib/header.php");
?>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header text-uppercase">Rapor Kelas <?php echo $post; ?></div>
					<div class="card-body">
						<div class="col-md-6">
						</div>
						<div class="clearfix"></div>
						<br />
											<div class="table-responsive">
											<table id="data-table-1" class="table table-hover w-100 table-striped table-hover">
								<thead>
									<tr>
									    <th>No</th>
										<th>Nama</th>
										<th>PTS 1</th>
										<th>PAS 1</th>
										<th>PTS 2</th>
										<th>Kenaikan 2</th>
										<th>PTS 3</th>
										<th>PAS 3</th>
										<th>PTS 4</th>
										<th>Kenaikan 4</th>
										<th>PTS 5</th>
										<th>PAS 5</th>
										<th>PTS 6</th>
										<th>PAS 6</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query_list = "SELECT * FROM users WHERE kelas = '$post' AND status = 'Siswa' ORDER BY nama ASC";
									$new_query = mysqli_query($db, $query_list);
									$no = 1;
									while ($data_show = mysqli_fetch_array($new_query)) {
									?>
										<tr>
										    <td><?php echo $no++ ?></td>
										    <td><?php echo $data_show['nama']; ?></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_show['nomor']; ?>/1" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_show['nomor']; ?>/1" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_show['nomor']; ?>/2" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_show['nomor']; ?>/2" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_show['nomor']; ?>/3" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_show['nomor']; ?>/3" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_show['nomor']; ?>/4" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_show['nomor']; ?>/4" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_show['nomor']; ?>/5" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_show['nomor']; ?>/5" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_show['nomor']; ?>/6" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
											<td><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_show['nomor']; ?>/6" target="_blank" class="ms-btn-icon btn-primary">Cek</a></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<br />
					
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