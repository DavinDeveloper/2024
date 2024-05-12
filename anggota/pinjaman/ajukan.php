<?
include '../../libs/main/config.php';
include '../session.php';
$pinjaman = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM nominal WHERE jenis = 'Pinjam'"));
if ($user['limit_pinjam'] < $pinjaman['nominal']) {
    $pinjam = $user['limit_pinjam'];
} else {
    $pinjam = $pinjaman['nominal'];
}

if (isset($_POST['ajukan'])) {
    $nominal = $_POST['nominal'];
    $angsuran = $_POST['angsuran'];
    $keperluan = $_POST['keperluan'];
    $check_pinjaman = mysqli_query($db, "SELECT * FROM pinjaman WHERE username = '".$user['username']."' AND status = 'Menunggu' AND keperluan = '$keperluan'");
    if (mysqli_num_rows($check_pinjaman) > 0) {
        $msg_error = "Anda masih memiliki pengajuan pinjaman yang pending, silahkan menunggu terlebih dahulu.";
    } else if ($keperluan == 'Pribadi' AND $nominal > $user['limit_pinjam']) {
        $msg_error = "Pinjaman lebih besar dari sisa limit pinjaman anda, silahkan isi lebih rendah dari limit anda.";
    } else {
        $insert = mysqli_query($db, "INSERT INTO pinjaman (username, nominal, angsuran, keperluan, datetime) VALUES ('".$user['username']."', '$nominal', '$angsuran', '$keperluan', '".date("Y-m-d H:i:s")."')");
        if ($keperluan == 'Pribadi') {
            $sisa_limit = $user['limit_pinjam']-$nominal;
        }
        $update = mysqli_query($db, "UPDATE users SET limit_pinjam = '$sisa_limit' WHERE username = '".$user['username']."'");
        if ($insert == TRUE) {
            $msg_success = "Pinjaman berhasil diajukan.";
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
                        <h5 class="card-header">Ajukan Pinjaman</h5>
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
                          <small class="text-light fw-semibold d-block">Identitas Pengaju Pinjaman</small>
                          <div class="input-group">
                            <span class="input-group-text">Nama</span>
                            <input type="text" aria-label="Nama" class="form-control" value="<? echo $user['nama']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">Tempat Lahir</span>
                            <input type="text" aria-label="Tempat Lahir" class="form-control" value="<? echo $user['tempat_lahir']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">Tanggal Lahir</span>
                            <input type="text" aria-label="Tanggal Lahir" class="form-control" value="<? echo $user['tanggal_lahir']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">Pekerjaan</span>
                            <input type="text" aria-label="Pekerjaan" class="form-control" value="<? echo $user['pekerjaan']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">Alamat</span>
                            <input type="text" aria-label="Alamat" class="form-control" value="<? echo $user['alamat']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">WhatsApp</span>
                            <input type="text" aria-label="WhatsApp" class="form-control" value="<? echo $user['whatsapp']; ?>" readonly>
                          </div>
    
                          <small class="text-light fw-semibold d-block">Jumlah Pinjaman</small>
                          <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" max="<? echo $pinjam; ?>" name="nominal" class="form-control" aria-label="Pinjaman" value="<? echo $pinjam; ?>" required>
                          </div>
    
                          <small class="text-light fw-semibold d-block">Lama Angsuran</small>
                          <div class="input-group">
                            <select class="form-select" name="angsuran" id="inputGroupSelect02">
                              <option value="10">10</option>
                            </select>
                            <label class="input-group-text" for="inputGroupSelect02">Bulan</label>
                          </div>
    
                          <small class="text-light fw-semibold d-block">Keperluan Pinjaman</small>
                          <div class="input-group">
                            <select class="form-select" name="keperluan" id="inputGroupSelect02" required>
                              <option value="Pribadi">Pribadi</option>
                              <option value="Kegiatan">Kegiatan</option>
                            </select>
                          </div>
                          
                          <div class="row justify-content-end">
                          <div class="col-sm-12">
                              
                            <div class="modal fade" id="syarat-pinjaman" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-fullscreen" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="modalFullTitle">Syarat & Ketentuan Pengajuan Pinjaman</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <p>
                                      <? 
                                      $syarat_pinjaman = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM ketentuan WHERE jenis = 'Pinjaman'"));
                                      echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($syarat_pinjaman['konten']))); ?>
                                    </p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                      Close
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="mb-3">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
                                <label class="form-check-label" for="terms-conditions">
                                  Saya sudah membaca
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#syarat-pinjaman">syarat & ketentuan pengajuan pinjaman</a>
                                </label>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="ajukan">Ajukan</button>
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