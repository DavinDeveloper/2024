<?php
session_start();
require("../assets/config.php");
    
	if (isset($_POST['generate'])) {
		$post_password = $_POST['password'];
		$md5_password = md5($post_password);
			$msg_type = "success";
		    $msg_content = "<strong>Success : </strong>Password berhasil di generate.";
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
    <script type="text/javascript" src="https://davin.id/assets/js/sweetalert2.all.min.js"></script>
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form method="POST" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-53">
						Md5 Password
					</span>

					<!--<a href="#" class="btn-face m-b-20">-->
					<!--	<i class="fa fa-facebook-official"></i>-->
					<!--	Facebook-->
					<!--</a>-->

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
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Password
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="text" name="password" value="<?php echo $post_password; ?>" placeholder="Password" required>
						<span class="focus-input100"></span>
					</div>
					<?php if (isset($_POST['generate'])) { ?>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Md5 Password
						</span>
					</div>
					<!--<div class="wrap-input100 validate-input" data-validate = "Password is required">-->
					<!--	<input class="input100" type="text" name="md5" placeholder="Md5 Password" value="<?php echo $md5_password; ?>" required>-->
					<!--	<span class="focus-input100"></span>-->
					<!--</div>-->
					<td><div class="input-group mb-3"><input type="text" class="form-control" placeholder="" aria-label="" value="<?php echo $md5_password; ?>" id="link-<?php echo $md5_password; ?>" readonly>
                    <div class="input-group-append"><button class="btn btn-dark" data-toggle="tooltip" title="Link Copied" type="button" onclick="copy_to_clipboard('link-<?php echo $md5_password; ?>')"><i class="fa fa-copy"></i></button></div></div></td>
					<?php } ?>

					<div class="container-login100-form-btn m-t-17">
						<button class="col-lg-12 btn-google m-b-20" type="submit" name="generate">
							Generate Password
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Generate Md5 Password by
						</span>

						<a href="https://davinwardana.com?mitra=1" class="txt2 bo1">
							Davin Wardana
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

    <script type="text/javascript">
    	    function copy_to_clipboard(element) {
    	        var copyText = document.getElementById(element);
    	        copyText.select();
    	        document.execCommand("copy");
    	        Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Password Copied',
                  showConfirmButton: false,
                  timer: 1500
                })
    	    }
    </script>
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