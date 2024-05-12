<?
include '../../libs/main/config.php';
include '../session.php';
$jenis = "Pinjaman";
$data_konten = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM ketentuan WHERE jenis = '$jenis'"));
if (isset($_POST['ubah'])) {
    $post_konten = $_POST['konten'];
    $update = mysqli_query($db, "UPDATE ketentuan SET konten = '$post_konten' WHERE jenis = '$jenis'");
    if ($update == TRUE) {
        $msg_success = "$jenis berhasil diubah.";
    } else {
        $msg_error = "Gagal sistem.";
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
                        <h5 class="card-header">Ubah Ketentuan <? echo $jenis; ?></h5>
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
                            <div class="mb-3">
                              <label class="form-label" for="konten">Ketentuan <? echo $jenis; ?></label>
                              <div class="input-group input-group-merge">
                                <textarea rows="6" type="text" id="konten" class="form-control" name="konten" placeholder="Konten..." required><? echo $data_konten['konten']; ?></textarea>
                              </div>
                            </div>
                          
                          <div class="row justify-content-end">
                          <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
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