<?php
session_start();
require("../../mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];

	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: " . $cfg_baseurl . "logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: " . $cfg_baseurl . "logout.php");
	} else if ($data_user['status'] != "Admin") {
		header("Location: " . $cfg_baseurl);
	} else {

		include("../../lib/header.php");
?>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
					    <a>Pelajaran Umum</a>
					</div>
					<div class="card-body">
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
						<div class="col-md-6">
						</div>
						<div class="clearfix"></div>
						<br />
											<div class="table-responsive">
											<table id="data-table-1" class="table table-hover w-100">
								<thead>
									<tr>
									    <th>No</th>
										<th>Nama</th>
										<th>Code</th>
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									$new_query = mysqli_query($db, "SELECT * FROM pelajaran WHERE jurusan IS NULL ORDER BY code ASC");
									while ($data_show = mysqli_fetch_array($new_query)) {
									?>
										<tr>
										    <td><?php echo $no++; ?></td>
											<td><?php echo $data_show['nama']; ?></td>
											<td><?php echo strtoupper($data_show['code']); ?></td>

											<td align="center">
												<a href="<?php echo $cfg_baseurl; ?>admin/pelajaran/umum-edit.php?1=<?php echo $data_show['id']; ?>" class="btn btn-sm ms-btn-icon btn-warning">Edit</a>
											</td>
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
				<!-- end col -->
			</div>
			<!-- end row -->


		</div>
		<!-- end container -->

<?php
		include("../../lib/footer.php");
	}
} else {
	header("Location: " . $cfg_baseurl);
}
?>