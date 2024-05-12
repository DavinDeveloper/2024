<?
include '../../libs/main/config.php';
include '../session.php';
$check_pinjaman = mysqli_query($db, "SELECT * FROM pinjaman WHERE id = '".$_GET['1']."'");
if (mysqli_num_rows($check_pinjaman) == 0) {
    header("Location: ".cfg(url)."ketua/pinjaman");
} else {
    $data_pinjaman = mysqli_fetch_assoc($check_pinjaman);
    $data_peminjam = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_pinjaman['username']."'"));
}

if (isset($_POST['tolak'])) {
    $post_alasan = $_POST['alasan'];
    $check_pinjaman = mysqli_query($db, "SELECT * FROM pinjaman WHERE id = '".$_GET['1']."' AND status = 'Menunggu'");
    if (mysqli_num_rows($check_pinjaman) == 0) {
        $msg_error = "Pengajuan sudah pernah ditolak atau disetujui.";
    } else {
        if ($data_pinjaman['keperluan'] == 'Pribadi') {
            $sisa_limit = $data_peminjam['limit_pinjam']+$data_pinjaman['nominal'];
        }
        $update = mysqli_query($db, "UPDATE users SET limit_pinjam = '$sisa_limit' WHERE username = '".$data_pinjaman['username']."'");
        $update = mysqli_query($db, "UPDATE pinjaman SET alasan = '$post_alasan', status = 'Ditolak', pengajuan = 'Ditolak' WHERE id = '".$_GET['1']."'");
        if ($update == TRUE) {
            $msg_success = "Pinjaman berhasil ditolak.";
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
                        <h5 class="card-header">Tolak Pinjaman</h5>
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
                            <input type="text" aria-label="Nama" class="form-control" value="<? echo $data_peminjam['nama']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">Tempat Lahir</span>
                            <input type="text" aria-label="Tempat Lahir" class="form-control" value="<? echo $data_peminjam['tempat_lahir']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">Tanggal Lahir</span>
                            <input type="text" aria-label="Tanggal Lahir" class="form-control" value="<? echo $data_peminjam['tanggal_lahir']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">Pekerjaan</span>
                            <input type="text" aria-label="Pekerjaan" class="form-control" value="<? echo $data_peminjam['pekerjaan']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">Alamat</span>
                            <input type="text" aria-label="Alamat" class="form-control" value="<? echo $data_peminjam['alamat']; ?>" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-text">WhatsApp</span>
                            <input type="text" aria-label="WhatsApp" class="form-control" value="<? echo $data_peminjam['whatsapp']; ?>" readonly>
                          </div>
    
                          <small class="text-light fw-semibold d-block">Jumlah Pinjaman</small>
                          <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="nominal" class="form-control" aria-label="Pinjaman" value="<? echo $data_pinjaman['nominal']; ?>" readonly>
                          </div>
    
                          <small class="text-light fw-semibold d-block">Lama Angsuran</small>
                          <div class="input-group">
                            <input type="number" name="angsuran" class="form-control" aria-label="Angsuran" value="<? echo $data_pinjaman['angsuran']; ?>" readonly>
                            <span class="input-group-text">Bulan</span>
                          </div>
    
                          <small class="text-light fw-semibold d-block">Alasan</small>
                          <div class="input-group">
                            <textarea rows="6" type="number" name="alasan" class="form-control" aria-label="Alasan..." placeholder="Alasan..." required></textarea>
                          </div>
                          
                          <div class="row justify-content-end">
                          <div class="col-sm-12">
                            <a href="<? echo cfg(url); ?>ketua/pinjaman" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-danger" name="tolak">Tolak</button>
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