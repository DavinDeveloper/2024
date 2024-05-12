<?php
session_start();
require("../../mainconfig.php");
require("../../vendor/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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
	    
	    if (isset($_POST['update'])) {

            $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    if (isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
                        $arr_file = explode('.', $_FILES['berkas_excel']['name']);
                        $extension = end($arr_file);
                        if ('csv' == $extension) {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                        } else {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        }
                        $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
                        for ($i = 1; $i < count($sheetData); $i++) {
        
                    $id = $sheetData[$i]['0'];
                    $nis = $sheetData[$i]['1'];
                    $nisn = $sheetData[$i]['2'];
                    $nama = $sheetData[$i]['3'];
            	    $kelas = $sheetData[$i]['4'];
            	    $jurusan = $sheetData[$i]['5'];
        	    $check_nis = mysqli_query($db, "SELECT * FROM users WHERE nomor = '$nis'");
        	    if (mysqli_num_rows($check_nis) == 0) {
        	        if (!empty($nis)) {
        	            $update = mysqli_query($db, "INSERT INTO users (username, nomor, nisn, nama, password, kelas, jurusan, status) VALUES ('$nis', '$nis', '$nisn', '$nama', '".md5($nisn)."', '$kelas', '$jurusan', 'Siswa')");
        	        }
        	    } else {
        	        $update = mysqli_query($db, "UPDATE users SET username = '$nis', nomor = '$nis', nisn = '$nisn', nama = '$nama', password = '".md5($nisn)."', kelas = '$kelas', jurusan = '$jurusan' WHERE id = '$id' AND status = 'Siswa'");
        	    }
        	    if ($update == TRUE) {
        		$msg_type = "success";
        		$msg_content = "Data siswa berhasil disimpan.";
        		} else {
        	    $msg_type = "error";
        		$msg_content = "<b>Gagal:</b> Error system.";
        			}}
        	}
        } 

		include("../../lib/header.php");
?>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
					    <form method="post" enctype="multipart/form-data">
					    <div class="form-group">
							<label class="col-md-2 control-label">Upload Excel</label>
							<div class="col-md-12">
								<input type="file" name="berkas_excel" class="form-control" required>
							</div>
						</div>
					    <a href="<?php echo $cfg_baseurl; ?>admin/siswa/data" class="btn ms-btn-icon btn-success">Download Data</a>
					    <button type="submit" name="update" class="btn ms-btn-icon btn-primary">Update Data</button>
					    </form>
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
										<th>NIS</th>
										<th>NISN</th>
										<th>Nama</th>
										<th>Kelas</th>
										<th>Jurusan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query_list = "SELECT * FROM users WHERE status = 'Siswa' ORDER BY kelas ASC"; 
									$no = 1;
									$new_query = mysqli_query($db, $query_list);
									while ($data_show = mysqli_fetch_array($new_query)) {
									?>
										<tr>
										    <td><?php echo $no++; ?></td>
											<td><?php echo $data_show['nomor']; ?></td>
											<td><?php echo $data_show['nisn']; ?></td>
											<td><?php echo $data_show['nama']; ?></td>
											<td><?php echo $data_show['kelas']; ?></td>
											<td><?php echo $data_show['jurusan']; ?></td>
											<td align="center">
												<a href="<?php echo $cfg_baseurl; ?>admin/siswa/edit.php?1=<?php echo $data_show['id']; ?>" class="btn btn-sm ms-btn-icon btn-warning">Edit</a>
												<a href="<?php echo $cfg_baseurl; ?>admin/siswa/delete.php?1=<?php echo $data_show['id']; ?>" class="btn btn-sm ms-btn-icon btn-danger">Hapus</a>
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