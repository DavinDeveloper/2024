<?
include 'lib/extend/config.php';
include 'lib/extend/header.php';
if (isset($_POST['daftar'])) {
    $post_jenis = $_POST['jenis'];
    $post_jalur = $_POST['jalur'];
    $post_jurusan = $_POST['jurusan'];
    $post_nama = strtoupper($_POST['nama']);
    $post_kelamin = $_POST['kelamin'];
    $post_tempat_lahir = $_POST['tempat_lahir'];
    $post_tanggal_lahir = $_POST['tanggal_lahir'];
    $post_agama = $_POST['agama'];
    $post_alamat = $_POST['alamat'];
    $post_kabupaten = $_POST['kabupaten'];
    $post_telepon = $_POST['telepon'];
    $post_kewarganegaraan = $_POST['kewarganegaraan'];
        
        $extention	= array('png','jpg','jpeg');
        $file_size = 1048576;
        
		$file_foto = $_FILES['foto']['name'];
		$x_foto = explode('.', $file_foto);
		$hasil_foto = str_replace(" ", "", $file_foto);
		$ekstensi_foto = strtolower(end($x_foto));
		$size_foto = $_FILES['foto']['size'];
		$file_tmp_foto = $_FILES['foto']['tmp_name'];
		$upload_foto = date("D-m-y-H-i-s")."-".$hasil_foto;
		$url_foto = $cfg['url']."assets/img/pendaftar/".$upload_foto;
		
		$file_bukti = $_FILES['bukti']['name'];
		$x_bukti = explode('.', $file_bukti);
		$hasil_bukti = str_replace(" ", "", $file_bukti);
		$ekstensi_bukti = strtolower(end($x_bukti));
		$size_bukti = $_FILES['bukti']['size'];
		$file_tmp_bukti = $_FILES['bukti']['tmp_name'];
		$upload_bukti = date("D-m-y-H-i-s")."-".$hasil_bukti;
		$url_bukti = $cfg['url']."assets/img/bukti/".$upload_bukti;
		
		if (empty($file_foto) OR empty($file_bukti)) {
			$msg_type = "error";
			$msg_content = "Mohon mengisi semua input.";
		} else if (in_array($ekstensi_foto, $extention) === FALSE OR in_array($ekstensi_bukti, $extention) === FALSE) {
		    $msg_type = "error";
			$msg_content = "File harus berjenis 'jpg','png' atau 'jpeg'.";
		} else if ($size_foto > $file_size || $size_bukti > $file_size) {
            $msg_type = "error";
            $msg_content = "Ukuran file tidak boleh lebih dari 1 MB.";
        } else {
	    move_uploaded_file($file_tmp_foto, 'assets/img/pendaftar/'.$upload_foto);
	    move_uploaded_file($file_tmp_bukti, 'assets/img/bukti/'.$upload_bukti);
        $insert = mysqli_query($db, "INSERT INTO ppdb (jenis, jalur, jurusan, nama, kelamin, tempat_lahir, tanggal_lahir, agama, alamat, kabupaten, telepon, kewarganegaraan, foto, bukti, datetime) VALUES ('$post_jenis', '$post_jalur', '$post_jurusan', '$post_nama', '$post_kelamin', '$post_tempat_lahir', '$post_tanggal_lahir', '$post_agama', '$post_alamat', '$post_kabupaten', '$post_telepon', '$post_kewarganegaraan', '$url_foto', '$url_bukti', '".date("Y-m-d H:i:s")."')");
        if ($insert == TRUE) {
        $id = mysqli_insert_id($db);
		$msg_type = "success";
		$msg_content = "Berhasil mendaftar.";
		echo "<script>window.location.href = '".$cfg['url']."pendaftaran/".$id."';</script>";
		} else {
	    $msg_type = "error";
		$msg_content = "Error system.";
			}
		}
}
?>
    <!-- Header Start -->
    <div class="container-fluid page-header" style="margin-bottom: 90px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
                <h3 class="display-4 text-white text-uppercase">PPDB</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">PPDB</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">PPDB</h5>
                <h1>Penerimaan Peserta Didik Baru</h1>
            </div>
            
            <div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="contact-form bg-secondary rounded p-5">
            <div id="success"></div>
            <form name="sentMessage" method="POST" enctype="multipart/form-data">

                        <div class="row">
						    <div class="col-lg-12">
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
							</div>
						</div>
						
                <div class="form-group row mb-2">
                    <label for="jenis" class="col-sm-12 control-label text-left">Jenis Pendaftaran <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <select name="jenis" class="custom-select custom-select-sm rounded-0 border border-secondary" id="jenis" required="required" data-validation-required-message="Please select registration type">
                            <option value="" selected="selected">Pilih</option>
                            <option value="Baru">Baru</option>
                            <option value="Pindahan">Pindahan</option>
                        </select>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group row mb-2">
                    <label for="jalur" class="col-sm-12 control-label text-left">Jalur Pendaftaran <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <select name="jalur" class="custom-select custom-select-sm rounded-0 border border-secondary" id="jalur" required="required" data-validation-required-message="Please select registration type">
                            <option value="" selected="selected">Pilih</option>
                            <option value="Umum">Umum</option>
                            <option value="Prestasi">Prestasi</option>
                        </select>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group row mb-2">
                    <label for="jurusan" class="col-sm-12 control-label text-left">Jurusan <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <select name="jurusan" class="custom-select custom-select-sm rounded-0 border border-secondary" id="jurusan" required="required" data-validation-required-message="Please select registration type">
                            <option value="" selected="selected">Pilih</option>
                            <?
                            $check_jurusan = mysqli_query($db, "SELECT * FROM jurusan ORDER BY nama ASC");
                            while($data_jurusan = mysqli_fetch_assoc($check_jurusan)) {
                            ?>
                            <option value="<? echo $data_jurusan['nama']; ?>"><? echo $data_jurusan['nama']; ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                
                <br>

                <div class="form-group row mb-2">
                    <label for="nama" class="col-sm-12 control-label text-left">Nama Lengkap <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control border-0 p-4" id="nama" name="nama" placeholder="Nama Lengkap" required="required" data-validation-required-message="Please enter your full name" />
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="kelamin" class="col-sm-12 control-label text-left">Jenis Kelamin <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <select name="kelamin" class="custom-select custom-select-sm rounded-0 border border-secondary" id="kelamin" required="required" data-validation-required-message="Please select your gender">
                            <option value="" selected="selected">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="tempat_lahir" class="col-sm-12 control-label text-left">Tempat Lahir <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control border-0 p-4" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required="required" data-validation-required-message="Please enter your birth place" />
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="tanggal_lahir" class="col-sm-12 control-label text-left">Tanggal Lahir <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="date" class="form-control border-0 p-4" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir (YYYY-MM-DD)" required="required" data-validation-required-message="Please enter your birth date" />
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="agama" class="col-sm-12 control-label text-left">Agama <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <select name="agama" class="custom-select custom-select-sm rounded-0 border border-secondary" id="agama" required="required" data-validation-required-message="Please select your religion">
                            <option value="" selected="selected">Pilih</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Khong Hu Cu">Khong Hu Chu</option>
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="alamat" class="col-sm-12 control-label text-left">Alamat Jalan <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <textarea rows="4" name="alamat" id="alamat" class="form-control border-0 py-3 px-4" placeholder="Alamat Jalan" required="required" data-validation-required-message="Please enter your street address"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="kabupaten" class="col-sm-12 control-label text-left">Kabupaten <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control border-0 p-4" id="kabupaten" name="kabupaten" placeholder="Kabupaten" required="required" data-validation-required-message="Please enter your district" />
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="telepon" class="col-sm-12 control-label text-left">Nomor Telepon <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control border-0 p-4" id="telepon" name="telepon" placeholder="Nomor Handphone" required="required" data-validation-required-message="Please enter your mobile phone number" />
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="kewarganegaraan" class="col-sm-12 control-label text-left">Kewarganegaraan <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <select name="kewarganegaraan" id="kewarganegaraan" class="custom-select custom-select-sm rounded-0 border border-secondary" required="required" data-validation-required-message="Please select your citizenship">
                            <option value="">Pilih</option>
                            <option value="WNI">Warga Negara Indonesia (WNI)</option>
                            <option value="WNA">Warga Negara Asing (WNA)</option>
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="file" class="col-sm-12 control-label text-left">Foto <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <input type="file" id="foto" name="foto" required="required" data-validation-required-message="Please upload your photo">
                        <small class="form-text text-muted">Foto harus JPG dan ukuran file maksimal 1 Mb</small>
                    </div>
                </div>
                
                <hr>
                
                <p><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($cfg['note_transfer']))); ?></p>

                <div class="form-group row mb-2">
                    <label for="file" class="col-sm-12 control-label text-left">Bukti Pembayaran <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <input type="file" id="bukti" name="bukti" required="required" data-validation-required-message="Please upload your photo">
                        <small class="form-text text-muted">Foto harus JPG dan ukuran file maksimal 1 Mb</small>
                    </div>
                </div>
                
                <hr>

                <div class="form-group row mb-2">
                    <label for="declaration" class="col-sm-12 control-label text-left">Pernyataan <span style="color: red">*</span></label>
                    <div class="col-sm-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="declaration" id="declaration" required="required" data-validation-required-message="Please accept the declaration">
                            <label class="form-check-label" for="declaration">
                                Saya yang bertandatangan dibawah ini menyatakan bahwa data yang tertera diatas adalah yang sebenarnya.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary py-3 px-5" type="submit" name="daftar">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>

        </div>
    </div>
    <!-- Contact End -->

<?
include 'lib/extend/footer.php'; 
?>