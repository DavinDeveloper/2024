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
				if (isset($_POST['tambah'])) {
				    $post_nama =  mysqli_real_escape_string($db,$_POST['nama']);
					$post_username = $_POST['username'];
					$post_nip = $_POST['nip'];
					$post_jurusan = $_POST['jurusan'];
					$post_kelas = $_POST['kelas'];
					$post_pelajaran = $_POST['pelajaran'];
					$check_guru = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
					if (mysqli_num_rows($check_guru) > 0) {
					    $msg_type = "error";
						$msg_content = "<b>Gagal:</b> Guru dengen username tersebut sudah ada.";
					} else {
						$insert_guru = mysqli_query($db, "INSERT INTO users (username, nomor, password, unhash, status, nama, kelas, pelajaran, jurusan) VALUES ('$post_username', '$post_nip', '".md5($post_nip)."', '$post_nip', 'Guru', '$post_nama', '$post_kelas', '$post_pelajaran', '$post_jurusan')");
				        if ($insert_guru == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Data guru berhasil ditambahkan.
							<br><br>
							Nama: ".$post_nama."<br>
							Username: ".$post_username."<br>
							Password : ".$post_nip."<br>
							NIP : ".$post_nip."<br>
							Jurusan : ".$post_jurusan."<br>
							Kelas : ".$post_kelas."<br>
							Pelajaran : ".$post_pelajaran."";
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> Error system.";
							
						}
					}
				}

				include("../../lib/header.php");
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Tambah Data Guru</div>
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
												<label class="col-md-2 control-label">USERNAME *</label>
												<div class="col-md-12">
													<input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">NAMA *</label>
												<div class="col-md-12">
													<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">NIP *</label>
												<div class="col-md-12">
													<input type="text" name="nip" class="form-control" placeholder="Masukkan Nik" required>
												</div>
											</div>
											<div class="form-group">
                                              <label class="col-md-12 control-label">JURUSAN</label>
                                    			<select class="form-control" name="jurusan">
                                    			<option value="">Pilih</option>
                                                <?php
                                                $check_jurusan = mysqli_query($db, "SELECT * FROM jurusan ORDER BY nama ASC");
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
                                    			<option value="">Pilih</option>
                                                <?php
                                                $check_kelas = mysqli_query($db, "SELECT * FROM kelas ORDER BY nama ASC");
                                                while ($data_kelas = mysqli_fetch_assoc($check_kelas)) {
                                                ?>
                                                <option value="<?php echo $data_kelas['nama'];?>"><?php echo $data_kelas['nama'];?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                    		</div>
											<div class="form-group">
                                              <label class="col-md-12 control-label">MATA PELAJARAN</label>
                                    			<select class="form-control" name="pelajaran">
                                    			<option value="">Pilih</option>
                                                <?php
                                                $check_pelajaran = mysqli_query($db, "SELECT * FROM pelajaran ORDER BY nama ASC");
                                                while ($data_pelajaran = mysqli_fetch_assoc($check_pelajaran)) {
                                                ?>
                                                <option value="<?php echo $data_pelajaran['nama'];?>"><?php echo $data_pelajaran['nama'];?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                    		</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin/guru" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali</a>
											
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="tambah">Tambah</button>
											
												</div>
											</div>
										</form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
<?php
				include("../../lib/footer.php");
			}
} else {
	header("Location: ".$cfg_baseurl);
}
?>