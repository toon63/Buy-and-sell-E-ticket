<?php
session_start();
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    // echo "Referrer URL: " . $referer;
	
} else {
    echo "No referrer URL";
	session_destroy();
	header("Location: ognzlogin.php");
}
include_once('config.php');
include('comtop.php'); 
    // phpmailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT ognz_email FROM ognz_profile WHERE ognz_email='$email'";
  $results = mysqli_query($con, $query);

  if (empty($email)) {
    $errors = "Your email is required";
  }else if(mysqli_num_rows($results) <= 0) {
    $errors = "Sorry, no user exists on our system with that email";
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));
  if ($errors == "") {

    // store token in the password-reset database table against the user's email
    $sql = "UPDATE ognz_profile SET token='$token' WHERE ognz_email = '$email'";
    $results = mysqli_query($con, $sql);
    
    $subject = "Reset your e-ticket.su-digitech.net password";
    $msg = "Hi, $email click on this <a href=\"eticket.su-digitech.net/new_pass_ognz.php?token=" . $token . "\"><p>link</p></a> to reset your password on our site";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'thanin.cwtnk@gmail.com';
    $mail->Password = 'kfgvcefoqouejeqj';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('thanin.cwtnk@gmail.com');
    $mail->addAddress($email);
    $mail->Subject = ("$email($subject)");
    $mail->Body = $msg;
    $mail->send();

    header('location: pending.php?email=' . $email);


  }else{
    echo ('nothing here');
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
<div class="col-sm-6 col-4 mt-2">
			<a href="ognzlogin.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a>
		</div>
	<form class="login-form" action="" method="post">
  <div class="container">
		<h1 class="form-title text-center">Reset password</h1>
		<div class="form-group text-center">
			<label>Your email address</label><br>
			<input type="email" name="email">
		</div>
    <div class="row mt-3">
                    <div class="col-sm-12 text-center">
                    <button type="submit" name="reset-password" class="btn btn-login">Submit</button>
                      </div>
                  </div>
		
    </div>
	</form>
