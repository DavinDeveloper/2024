<?php
session_start();
require("../lib/extend/config.php");
$ip = $_SERVER['REMOTE_ADDR'];

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
    	header("Location: ".$cfg['url'].$_GET['target']);
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
    
	if (isset($_POST['login'])) {
		$post_username = mysqli_real_escape_string($db, trim($_POST['username']));
		$post_password = mysqli_real_escape_string($db, trim($_POST['password']));
		$post_username = strtolower($post_username);
		if (empty($post_username) || empty($post_password)) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
		} else {
			$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
			if (empty($post_password)) {
    			$msg_type = "error";
    			$msg_content = "<strong>Failed : </strong>Please fill all input.";
    		} else if (mysqli_num_rows($check_user) == 0) {
				$msg_type = "error";
				$msg_content = "<strong>Failed : </strong>Username or email not found/invalid.";
				$data_user = mysqli_fetch_assoc($check_user);
			} else if ($data_user['status'] == 'Suspended') {
				$msg_type = "error";
				$msg_content = "<strong>Failed : </strong>Your account has been suspended.";
			} else {
				$data_user = mysqli_fetch_assoc($check_user);
				if (md5($post_password) <> $data_user['password']) {
					$msg_type = "error";
					$msg_content = "<strong>Failed : </strong>Wrong username or password.";
				} else {
				    $_SESSION['user'] = $data_user;
					$until = "1000000000";
					$enc_uname = rcp_encode($post_username,$key_uname);
					$enc_pass  = rcp_encode($post_password,$key_pass);
					setcookie("cloudpa",$enc_uname,$until,"/");
					setcookie("cloudpad",$enc_pass,$until,"/");
			    header("Location: ".$cfg['url'].$_GET['target']);
				}
			}
		}
	}

    
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $cfg['name']; ?></title>
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
						Sign In
					</span>
                    <div class="col-md-12">
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
							Username
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Email/Username" required>
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

						<a href="forgot" class="txt2 bo1 m-l-5">
							Forgot?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="col-lg-12 btn-google m-b-20" type="submit" name="login">
							Sign In
						</button>
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

</body>
</html>
<?php
}
?>