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
function rcp_decode($input, $key) {
    $keyArray = array_unique(str_split($key));
    sort($keyArray);
    $sortedInput = '';
    $remainingInput = '';
    foreach (str_split($input) as $char) {
        if (in_array($char, $keyArray)) {
            $sortedInput .= $char;
        } else {
            $remainingInput .= $char;
        }
    }
    $inputArray = str_split($input);
    $decoded = '';
    foreach ($keyArray as $char) {
        $index = array_search($char, $sortedInput);
        if ($index !== false) {
            $decoded .= $inputArray[$index];
            unset($inputArray[$index]);
        }
    }
    $decoded .= $remainingInput;
    return $decoded;
}
    if (isset($_SESSION['user'])) {
    	header("Location: ".cfg(url));
    } else {
    if( isset($_COOKIE['cloudpa']) AND isset($_COOKIE['cloudpad']) ){
    if( !empty($_COOKIE['cloudpa']) AND !empty($_COOKIE['cloudpad']) ){
        $_POST = [
            "login" => true,
            "username"  => rcp_decode($_COOKIE['cloudpa'],$key_uname),
            "password"  => rcp_decode($_COOKIE['cloudpad'],$key_pass),
            "remember"  => "year"
            ];
        }
    }
    }
if (isset($_POST['masuk'])) {
    $username = strtolower($_POST['username']);
    $password = md5($_POST['password']);
    $check_users = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
    $data_user = mysqli_fetch_assoc($check_users);
    if (mysqli_num_rows($check_users) == 0) {
        $msg_error = "Username $username tidak terdaftar.";
    } else if ($data_user['keanggotaan'] == 'Nonaktif') {
        $msg_error = "Username $username status keanggotaan nonaktif.";
    } else if ($data_user['keanggotaan'] == 'Keluar') {
        $msg_error = "Username $username status keanggotaan keluar.";
    } else if ($password <> $data_user['password']) {
        $msg_error = "Password yang anda masukkan untuk $username salah.";
    } else {
        $msg_success = "Login berhasil.";
        $_SESSION['user'] = $data_user;
		$until = "1000000000";
		$enc_uname = rcp_encode($username,$key_uname);
		$enc_pass  = rcp_encode($password,$key_pass);
		setcookie("cloudpa",$enc_uname,$until,"/");
		setcookie("cloudpad",$enc_pass,$until,"/");
		header("Location: ".cfg(url));
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
              <h4 class="mb-2">Masuk</h4>
              <p class="mb-4">Silahkan isi data dibawah untuk masuk</p>

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

                <button type="submit" name="masuk" class="btn btn-primary d-grid w-100">Masuk</button>
              </form>

              <p class="text-center">
                <span>Belum punya akun?</span>
                <a href="<? echo cfg(url); ?>auth/daftar">
                  <span>Daftar</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
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
