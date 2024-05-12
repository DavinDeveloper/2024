<?
include '../libs/main/config.php';
$key_uname = "97qfN3dmX5OoD3IxevSehKned5ZosIfg1nLzuPI2TdafcU38yE0Dx442T7KFPP6vMfBspMyM2lZjTwCajykciZLsNzNIrsOnRcYDl8PTcsdgNAUj7SE1WLjIFGQ04bZQ";
$key_pass = "RNlUtCVLYWfqy5xtUL8BV4Cuq1GmjZVoYyXNaK637GWiabe5c8IVVLw4wZF7ohL1fPtjdhBPCTFU9w2rfHSiWJapkuvKqVdySVRrfCDRIgDtVryzRZhaLhTZJITnU1jC";
function rcp_encode($input, $key) {
    $keyArray = array_unique(str_split($key));
    sort($keyArray);
    $inputArray = str_split($input);
    $sortedInput = '';
    foreach ($keyArray as $char) {
        $index = array_search($char, $inputArray);
        if ($index !== false) {
            $sortedInput .= $inputArray[$index];
            unset($inputArray[$index]);
        }
    }
    $sortedInput .= implode('', $inputArray);
    return $sortedInput;
}
if (isset($_POST['daftar'])) {
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
        $pokok = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM nominal WHERE jenis = 'Pokok'"));
        $wajib = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM nominal WHERE jenis = 'Wajib'"));
        $bulan = date("Y-m", strtotime(date("Y-m-d")));
        if (date("d", strtotime(date("Y-m-d"))) < 20) {
            $bulan = date("Y-m", strtotime($bulan));
        } else {
            $bulan = date("Y-m", strtotime($bulan . "+1 month"));
        }
        $tenggat = $bulan."-25";
        $notifikasi_tanggal = $bulan."-20";
        $insert = mysqli_query($db, "INSERT INTO simpanan (username, jenis, nominal, bulan, tenggat, notifikasi_tanggal, datetime) VALUES ('$username', 'Pokok', '".$pokok['nominal']."', '$bulan', '$tenggat', '$notifikasi_tanggal', '".date("Y-m-d H:i:s")."')");
        $insert = mysqli_query($db, "INSERT INTO simpanan (username, jenis, nominal, bulan, tenggat, notifikasi_tanggal, datetime) VALUES ('$username', 'Wajib', '".$wajib['nominal']."', '$bulan', '$tenggat', '$notifikasi_tanggal', '".date("Y-m-d H:i:s")."')");
        $insert = mysqli_query($db, "INSERT INTO users (nama, tempat_lahir, tanggal_lahir, pekerjaan, alamat, whatsapp, username, password, limit_pinjam) VALUES ('$nama', '$tempat_lahir', '$tanggal_lahir', '$pekerjaan', '$alamat', '$whatsapp', '$username', '$password', '0')");
        $check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
		$data_user = mysqli_fetch_assoc($check_user);
        if ($insert == TRUE) {
            $msg_success = "Pendaftaran anggota sukses.";
            $_SESSION['user'] = $data_user;
			    $until = "1000000000";
			    $enc_uname = rcp_encode($post_username,$key_uname);
			    $enc_pass  = rcp_encode($post_password,$key_pass);
			    setcookie("cloudpa",$enc_uname,$until,"/");
			    setcookie("cloudpad",$enc_pass,$until,"/");
			header("Location: ".cfg(url));
        } else {
            $msg_error = "Gagal sistem.";
        }
    }
}
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<? echo cfg(url); ?>assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><? echo cfg(nama); ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<? echo cfg(logo); ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="<? echo cfg(url); ?>assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<? echo cfg(url); ?>assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="<? echo cfg(url); ?>" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="<? echo cfg(logo); ?>" height="30px">
                  </span>
                  <span class="demo text-body fw-bolder"><? echo cfg(nama); ?></span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Daftar Keanggotaan</h4>
              <p class="mb-4">Silahkan isi data dibawah untuk daftar keanggotaan</p>

              <form class="mb-3" method="POST">
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
                
                
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
                    <label class="form-check-label" for="terms-conditions">
                      Saya sudah membaca
                      <a href="#" data-bs-toggle="modal" data-bs-target="#syarat-keanggotaan">syarat & ketentuan daftar keanggotaan</a>
                    </label>
                  </div>
                </div>
                <button type="submit" name="daftar" class="btn btn-primary d-grid w-100">Daftar</button>
              </form>

              <p class="text-center">
                <span>Sudah punya akun?</span>
                <a href="<? echo cfg(url); ?>auth/masuk">
                  <span>Masuk</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>
                <div class="modal fade" id="syarat-keanggotaan" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-fullscreen" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalFullTitle">Syarat & Ketentuan Pengajuan Pinjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>
                          <? 
                          $syarat_keanggotaan = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM ketentuan WHERE jenis = 'Keanggotaan'"));
                          echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($syarat_keanggotaan['konten']))); ?>
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
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<? echo cfg(url); ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<? echo cfg(url); ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<? echo cfg(url); ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<? echo cfg(url); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<? echo cfg(url); ?>assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<? echo cfg(url); ?>assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
