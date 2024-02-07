<?php 

include_once('config.php');
include('comtop.php'); 
if (isset($_POST['new_password'])){
	$new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
	$new_pass_c = mysqli_real_escape_string($con, $_POST['new_pass_c']);
	$token = $_GET['token'];
  
	// Grab to token that came from the email link
	if (empty($new_pass) || empty($new_pass_c)) $errors ="Password is required";
	if ($new_pass !== $new_pass_c) $errors ="Password do not match";
	$sql = "SELECT * FROM user_profile WHERE token='$token'";
	if($result = mysqli_query($con, $sql)){
		foreach($result as $email) {
			$email = $email['user_email'];
			$new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
			$up = "UPDATE user_profile SET user_password = '$new_pass' WHERE user_email = '$email'";
				if($execute = mysqli_query($con, $up)){
					header("Location:login.php");
				}else{
					echo 'error';
				}
		}
}
}
?>

<style type="text/css">
	.btn-login {
		border-radius: 15px;
		border: 2px solid white;
		background-color: #212529;
		color: #ffffff;
		font-size: 16px;
		cursor: pointer;
		/*color: #fff;
		background-color: #212529;
		border-color: #fff;*/
	}

	.btn-login:hover {
		border-radius: 15px;
		border: 2px solid #212529;
		background-color: white;
		color: #212529;
		font-size: 16px;
		cursor: pointer;
	}

	.btn-register {
		border-radius: 15px;
		border: 2px solid white;
		background-color: #7464a1;
		color: #ffffff;
		font-size: 16px;
		cursor: pointer;
		/*color: #fff;
		background-color: #212529;
		border-color: #fff;*/
	}

	.btn-register:hover {
		border-radius: 15px;
		border: 2px solid #212529;
		background-color: white;
		color: #212529;
		font-size: 16px;
		cursor: pointer;
	}

	label{
		color: white;
	}
	h1{
		font-size: 50px;
		color: white;
	}
	small{
		color: white;
	}
</style>
<!-- <div class="col-sm-6 col-4 mt-2">
			<a href="login.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a>
		</div> -->
	<form class="login-form" action="" method="post">
  <div class="container">
		<h1 class="form-title text-center">Reset password</h1>
		<?php include('messages.php'); ?>
		<div class="form-group text-center">
			<label>New password</label><br>
			<input type="password" name="new_pass">
		</div>
		<div class="form-group text-center">
			<label>Confirm new password</label><br>
			<input type="password" name="new_pass_c">
    <div class="row mt-3">
                    <div class="col-sm-12 text-center">
                    <button type="submit" name="new_password" class="btn btn-login">Submit</button>
                      </div>
                  </div>
		<!-- <div class="form-group">
			<button type="submit" name="reset-password" class="login-btn">Submit</button>
		</div> -->
    </div>
	</form>
