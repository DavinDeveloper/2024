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
				    $post_jurusan =  mysqli_real_escape_string($db,$_POST['jurusan']);
					$check_kelas = mysqli_query($db, "SELECT * FROM kelas WHERE nama = '$post_nama'");
					if (mysqli_num_rows($check_kelas) > 0) {
					    $msg_type = "error";
						$msg_content = "<b>Gagal:</b> Kelas dengan nama tersebut sudah ada.";
					} else {
						$insert_kelas = mysqli_query($db, "INSERT INTO kelas (nama, jurusan) VALUES ('$post_nama', '$post_jurusan')");
				        if ($insert_kelas == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Data kelas berhasil ditambahkan.
							<br><br>
							Nama: ".$post_nama."<br>
							Jurusan: ".$post_jurusan."";
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
                                    <div class="card-header text-uppercase">Tambah Data Kelas</div>
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
												<label class="col-md-2 control-label">NAMA KELAS *</label>
												<div class="col-md-12">
													<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Kelas" required>
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
												<div class="col-md-offset-2 col-md-10">
											<a href="<?php echo $cfg_baseurl; ?>admin/kelas" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali</a>
											
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