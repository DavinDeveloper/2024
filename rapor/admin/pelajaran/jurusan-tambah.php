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
					$post_jurusan = $_POST['jurusan'];
					$post_code = $_POST['code'];
					$check_code = mysqli_query($db, "SELECT * FROM pelajaran WHERE jurusan = '$post_jurusan' AND code = '$post_code'");
					if (mysqli_num_rows($check_code) > 0) {
					    $msg_type = "error";
						$msg_content = "<b>Gagal:</b> Pelajaran jurusan $post_jurusan dengan code ".strtoupper($post_code)." sudah ada, harap ubah dari yang sudah ada atau hapus terlebih dahulu yang sudah ada.";
					} else {
						$insert_pelajaran = mysqli_query($db, "INSERT INTO pelajaran (nama, jurusan, code) VALUES ('$post_nama', '$post_jurusan', '$post_code')");
				        if ($insert_pelajaran == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Data pelajaran berhasil ditambahkan.
							<br><br>
							Nama Pelajaran: ".$post_nama."<br>
							Jurusan: ".$post_jurusan."<br>
							Code : ".strtoupper($post_code)."";
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
                                    <div class="card-header text-uppercase">Tambah Data Pelajaran</div>
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
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">NAMA PELAJARAN*</label>
												<div class="col-md-12">
													<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Pelajaran" required>
												</div>
											</div>
											<div class="form-group">
                                              <label class="col-md-12 control-label">JURUSAN *</label>
                                    			<select class="form-control" name="jurusan" required>
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
                                              <label class="col-md-12 control-label">CODE *</label>
                                    			<select class="form-control" name="code" required>
                                    			<option value="">Pilih</option>
                                                <option value="c1">C1</option>
                                                <option value="c2">C2</option>
                                                <option value="c3">C3</option>
                                                <option value="c4">C4</option>
                                                <option value="c5">C5</option>
                                                </select>
                                    		</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin/pelajaran/jurusan" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali</a>
											
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