<?php
session_start();
require("../assets/config.php");
include '../assets/composer/google-api-client-php-7.4/config.php';
$ip = $_SERVER['REMOTE_ADDR'];
$id = random_number(7);
$code = $_GET['1'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE code = '$code'");
	$data_user = mysqli_fetch_assoc($check_user);

$key_uname = "97qfN3dmX5OoD3IxevSehKned5ZosIfg1nLzuPI2TdafcU38yE0Dx442T7KFPP6vMfBspMyM2lZjTwCajykciZLsNzNIrsOnRcYDl8PTcsdgNAUj7SE1WLjIFGQ04bZQ";
$key_pass = "RNlUtCVLYWfqy5xtUL8BV4Cuq1GmjZVoYyXNaK637GWiabe5c8IVVLw4wZF7ohL1fPtjdhBPCTFU9w2rfHSiWJapkuvKqVdySVRrfCDRIgDtVryzRZhaLhTZJITnU1jC";
    
    if (isset($_SESSION['user'])) {
    	header("Location: ".$cfg_baseurl);
    } else if (mysqli_num_rows($check_user) < 1) {
    	header("Location: ".$cfg_baseurl);
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
    
	if (isset($_POST['reset'])) {
		$post_password = mysqli_real_escape_string($db, trim($_POST['password']));
		$password = md5($post_password);
				mysqli_query($db, "UPDATE users SET password = '$password', code = '' WHERE code = '$code'");
			    $data = [
                'api_key' => ''.$cfg_apikey.'',
                'sender'  => ''.$cfg_bot.'',
                'number'  => ''.$data_user['phone'].'',
                'message' => '*Mitra Industri*
                
Nama : '.$data_user['asli'].'
Username : '.$data_user['username'].'
Password Baru : '.$post_password.'',
                'footer' => 'Anda baru saja mengganti password account Mitra Industri anda. Jika ini bukan anda, harap segera lakukan pengubahan dan pengamanan akun segera.',
        'template1' => 'url|Login|'.$home.'',
        'template2' => 'url|Reset Password|'.$cfg_baseurl.''
            ];
                
                $curl = curl_init();
                                                    
                curl_setopt_array($curl, array(
                  CURLOPT_URL => $cfg_waurl,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => json_encode($data),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
				$msg_type = "success";
				$msg_content = "<strong>Success : </strong>Password berhasil diubah, silahkan cek whatsapp untuk mengecek password baru anda.";
				}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $cfg_webname; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form method="POST" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-53">
						Reset Password
					</span>

					<!--<a href="#" class="btn-face m-b-20">-->
					<!--	<i class="fa fa-facebook-official"></i>-->
					<!--	Facebook-->
					<!--</a>-->

					<a href="<?php echo $google_client->createAuthUrl(); ?>" class="col-lg-12 btn-google m-b-20">
						<img src="images/icons/icon-google.png" alt="GOOGLE">
						Google
					</a>
                    <div class="col-md-12">
					<?php 
					if ($msg_type == "success") {
					?>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						<i class="fa fa-times-circle"></i>
						<?php echo $msg_content; ?>
					</div>
					<?php
					}
					?>
					<?php 
					if ($msg_type == "error") {
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
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							New Password
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="password" placeholder="Input New Password" required>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="col-lg-12 btn-google m-b-20" type="submit" name="reset">
							Change Password
						</button>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<a href="<?php echo $home; ?>?mode=tamu" class="login100-form-btn">
							Berkunjung sebagai Tamu
						</a>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							You have an account?
						</span>

						<a href="<?php echo $cfg_baseurl; ?>" class="txt2 bo1">
							Login now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/61f362f79bd1f31184d9baf0/1fqfbl6ef';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
<?php
}
?>