<?
include '../../libs/main/config.php';
include '../session.php';

if (isset($_POST['tambah'])) {
    $nama = strtoupper($_POST['nama']);
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $pekerjaan = $_POST['pekerjaan'];
    $alamat = $_POST['alamat'];
    $whatsapp = $_POST['whatsapp'];
    $username = strtolower($_POST['username']);
    $password = md5($_POST['password']);
    $check_username = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
    $check_whatsapp = mysqli_query($db, "SELECT * FROM users WHERE whatsapp = '$whatsapp'");
    if (mysqli_num_rows($check_username) > 0) {
        $msg_error = "Username $username telah terdaftar.";
    } else if (mysqli_num_rows($check_whatsapp) > 0) {
        $msg_error = "Nomor WhatsApp $whatsapp telah terdaftar.";
    } else {
        $insert = mysqli_query($db, "INSERT INTO users (nama, tempat_lahir, tanggal_lahir, pekerjaan, alamat, whatsapp, username, password, status, limit_pinjam) VALUES ('$nama', '$tempat_lahir', '$tanggal_lahir', '$pekerjaan', '$alamat', '$whatsapp', '$username', '$password', 'Bendahara', '0')");
        if ($insert == TRUE) {
            $msg_success = "Bendahara berhasil ditambahkan.";
        } else {
            $msg_error = "Gagal sistem.";
        }
    }
}
include '../../libs/main/header.php';
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <form class="mb-3" method="POST">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                      <div class="card mb-4">
                        <h5 class="card-header">Tambah Bendahara</h5>
                        <div class="card-body demo-vertical-spacing demo-only-element">
                        <? if (!empty($msg_error)) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                        <? echo $msg_error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <? } else if (!empty($msg_success)) { ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <? echo $msg_success; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <? } ?>
                          <small class="text-light fw-semibold d-block">Isi biodata bendahara</small>
                            <div class="mb-3">
                              <label for="nama" class="form-label">Nama</label>
                              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" required>
                            </div>
                            <div class="mb-3">
                              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                              <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir" required>
                            </div>
                            <div class="mb-3">
                              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                              <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                            <div class="mb-3">
                              <label for="pekerjaan" class="form-label">Pekerjaan</label>
                              <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Masukkan pekerjaan" required>
                            </div>
                            <div class="mb-3">
                              <label for="alamat" class="form-label">Alamat</label>
                              <textarea type="text" rows="3" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" required></textarea>
                            </div>
                            <div class="mb-3">
                              <label for="whatsapp" class="form-label">WhatsApp</label>
                              <input type="number" class="form-control" id="whatsapp" name="whatsapp" placeholder="Masukkan whatsapp" value="62" required>
                            </div>
                            <div class="mb-3">
                              <label for="username" class="form-label">Username</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                            </div>
                            <div class="mb-3 form-password-toggle">
                              <label class="form-label" for="password">Password</label>
                              <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                              </div>
                            </div>
                          
                          <div class="row justify-content-end">
                          <div class="col-sm-12">
                            <a href="<? echo cfg(url); ?>ketua/bendahara" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

<?
include '../../libs/main/footer.php';
?>