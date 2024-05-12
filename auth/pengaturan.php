<?
include '../libs/main/config.php';
include '../libs/main/session.php';

if (isset($_POST['ubah'])) {
    $post_password = $_POST['password'];
    $post_npassword = $_POST['npassword'];
    $post_cnpassword = $_POST['cnpassword'];
    if (md5($post_password) <> $user['password']) {
		$msg_error = "Password lama salah.";
	} else if (strlen($post_npassword) < 5) {
		$msg_error = "Password baru telalu pendek, minimal 5 karakter.";
	} else if ($post_cnpassword <> $post_npassword) {
		$msg_error = "Konfirmasi password baru tidak sesuai.";
	} else {
        $post_cnpassword = md5($post_cnpassword);
        $update = mysqli_query($db, "UPDATE users SET password = '$post_cnpassword' WHERE username = '".$user['username']."'");
        if ($update == TRUE) {
            $msg_success = "Password berhasil diubah.";
        } else {
            $msg_error = "Gagal sistem.";
        }
    }
}
include '../libs/main/header.php';
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <form class="mb-3" method="POST">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                      <div class="card mb-4">
                        <h5 class="card-header">Ubah Password</h5>
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
                            <div class="mb-3 form-password-toggle">
                              <label class="form-label" for="password">Password Lama</label>
                              <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                              </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                              <label class="form-label" for="password">Password Baru</label>
                              <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="npassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                              </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                              <label class="form-label" for="password">Konfirmasi Password Baru</label>
                              <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="cnpassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
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
include '../libs/main/footer.php';
?>