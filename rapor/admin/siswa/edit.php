<?php
session_start();
require("../../mainconfig.php");

if (isset($_SESSION['user'])) {
    $post_id = $_GET['1'];
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
    
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] != "Admin") {
		header("Location: ".$cfg_baseurl);
	} else {
			if (isset($_GET['1'])) {
	
		$check_siswa = mysqli_query($db, "SELECT * FROM users WHERE id = '$post_id'");
		$data_siswa = mysqli_fetch_assoc($check_siswa);
		if (mysqli_num_rows($check_siswa) == 0) {
		       $post_id = $_GET['1'];
		header("Location: ".$cfg_baseurl."admin/siswa");
			} else {
				if (isset($_POST['edit'])) {
				    $post_nama =  mysqli_real_escape_string($db,$_POST['nama']);
					$post_nis = $_POST['nis'];
					$post_nisn = $_POST['nisn'];
					$post_jurusan = $_POST['jurusan'];
					$post_kelas = $_POST['kelas'];
					    $update = mysqli_query($db, "UPDATE pts SET nis = '$post_nis', nama = '$post_nama' WHERE nis = '".$data_siswa['nis']."'");
					    $update = mysqli_query($db, "UPDATE pas SET nis = '$post_nis', nama = '$post_nama' WHERE nis = '".$data_siswa['nis']."'");
						$update_siswa = mysqli_query($db, "UPDATE users SET nomor = '$post_nis', nisn = '$post_nisn', nama = '$post_nama', jurusan = '$post_jurusan', kelas = '$post_kelas' WHERE id = '$post_id'");
				        if ($update_siswa == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Data siswa berhasil diubah.<br />";
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> Error system.";
							
						}
					}

				include("../../lib/header.php");
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Ubah Data Siswa</div>
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
											<?php echo  mysqli_errno($db); ?>
										</div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">NAMA *</label>
												<div class="col-md-12">
													<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="<? echo $data_siswa['nama']; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">NIS *</label>
												<div class="col-md-12">
													<input type="number" name="nis" class="form-control" placeholder="Masukkan NIS" value="<? echo $data_siswa['nomor']; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">NISN *</label>
												<div class="col-md-12">
													<input type="number" name="nisn" class="form-control" placeholder="Masukkan NISN" value="<? echo $data_siswa['nisn']; ?>" required>
												</div>
											</div>
											<div class="form-group">
                                              <label class="col-md-12 control-label">JURUSAN</label>
                                    			<select class="form-control" name="jurusan">
                                                <option value="<?php echo $data_siswa['jurusan'];?>"><?php echo $data_siswa['jurusan'];?> (Dipilih)</option>
                                                <?php
                                                $check_jurusan = mysqli_query($db, "SELECT * FROM jurusan WHERE nama != '".$data_siswa['jurusan']."' ORDER BY nama ASC");
                                                while ($data_jurusan = mysqli_fetch_assoc($check_jurusan)) {
                                                ?>
                                                <option value="<?php echo $data_jurusan['nama'];?>"><?php echo $data_jurusan['nama'];?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                    		</div>
											<div class="form-group">
                                              <label class="col-md-12 control-label">KELAS</label>
                                    			<select class="form-control" name="kelas">
                                                <option value="<?php echo $data_siswa['kelas'];?>"><?php echo $data_siswa['kelas'];?> (Dipilih)</option>
                                                <?php
                                                $check_kelas = mysqli_query($db, "SELECT * FROM kelas WHERE nama != '".$data_siswa['kelas']."' ORDER BY nama ASC");
                                                while ($data_kelas = mysqli_fetch_assoc($check_kelas)) {
                                                ?>
                                                <option value="<?php echo $data_kelas['nama'];?>"><?php echo $data_kelas['nama'];?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                    		</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin/siswa" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali</a>
											
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="edit">Ubah</button>
											
												</div>
											</div>
										</form>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->


                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->
<?php
				include("../../lib/footer.php");
			}
		} else {
			header("Location: ".$cfg_baseurl);
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>