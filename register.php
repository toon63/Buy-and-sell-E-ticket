<?php

session_start();

  include_once('config.php');
  // Include database connectivity
      
  if (isset($_SESSION['id'])) {
    header("Location:index.php");
  }

  
  
  if (isset($_POST['submit'])) {
    $errorMsg = "";
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['password']) || empty($_POST['cf_password'])){
      $errorMsg = "กรอกข้อมูลไม่ครบ";
      }else{
        if (empty($_POST['ckAccept'])){
          $errorMsg = "โปรดยินยอมนโยบายการคุ้มครองข้อมูลส่วนบุคคล";
          }
          else{

      $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
      $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
      $email    = mysqli_real_escape_string($con, $_POST['email']);
      $phone = mysqli_real_escape_string($con, $_POST['phone']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $cf_password = mysqli_real_escape_string($con, $_POST['cf_password']);

      $sql = "SELECT * FROM user_profile WHERE user_email = '$email'";
      $execute = mysqli_query($con, $sql);

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {   //ถ้าโครงสร้างemailไม่ถูกต้องจะขึ้นerror
          $errorMsg = "Email in not valid try again";
      }else if(strlen($password) < 6) {                   //ถ้าใส่ไม่ครบ6ตัว
          $errorMsg  = "Password should be six digits";
      }else if(strlen($password) !== strlen($cf_password)) {
          $errorMsg  = "Password not confirm";
      }else if($execute->num_rows > 0){   //ถ้าrowในdataมากกว่า0แปลว่าemailนั้นมีคนใช้แล้ว
          $errorMsg = "This Email is already exists";
      }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query= "INSERT INTO user_profile(point,user_firstname,user_lastname,user_email,user_phone,user_password) 
                    VALUES(0,'$firstname','$lastname','$email','$phone','$password')";
            if (mysqli_query($con, $query)) {
                $errorMsg  = "Register Successful!";
                header("Location:index.php");
              }else{
                  $errorMsg  = "You are not Registred..Please Try again";
        }
      }
    }
  }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<?php include('comtop.php'); ?>
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
<?php
            if (isset($errorMsg)) {
                echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $errorMsg
                      </div>";
            }
        ?>
<div class="container-fluid">
	<div class="row mt-5" style="">
		<div class="col-sm-12 text-center">
			<h1>REGISTER</h1>
		</div>
	</div>
	<div class="row mt-3 mb-5">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 col-12">
      
      <form action="register.php" method="POST">
				<div class="form-row">
					<div class="col-sm-6 col-12 mt-3">
						<label for="inputEmail4">ชื่อ</label>
						<input type="text" class="form-control" name="firstname" placeholder="ชื่อ...">
					</div>
					<div class="col-sm-6 col-12 mt-3">
						<label for="inputEmail4">นามสกุล</label>
						<input type="text" class="form-control" name="lastname" placeholder="นามสกุล...">
					</div>
        </div>
        <div class="form-row">
				  <div class="col-sm-4 col-12 mt-3">
						<label for="inputEmail4">อีเมล</label>
						<input type="email" class="form-control" name="email" placeholder="อีเมล...">
					</div>
          <div class="col-sm-4 col-12 mt-3">
						<label for="inputEmail4">เบอร์โทรศัพท์</label>
						<input type="tel" class="form-control" name="phone" placeholder="เบอร์โทรศัพท์...">
					</div>
        </div>
				<div class="form-row">
					<div class="col-sm-6 col-12 mt-3">
						<label for="inputEmail4">รหัสผ่าน</label>
						<input type="password" class="form-control" name="password" placeholder="รหัสผ่าน...">
					</div>
					<div class="col-sm-6 col-12 mt-3">
						<label for="inputEmail4">ยืนยันรหัสผ่าน</label>
						<input type="password" class="form-control" name="cf_password" placeholder="ยืนยันรหัสผ่าน...">
					</div>
				</div>
        <br>
        <div class="form-check form-check-inline">
					<input class="form-check-input" name="ckAccept" type="checkbox" id="ckAccept" value="checkbox" onClick="Enable()"> <label class="form-check-label" for="inlineCheckbox1">ยินยอม<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModalLong">นโยบายการคุ้มครองข้อมูลส่วนบุคคล</button></label>
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">นโยบายการคุ้มครองข้อมูลส่วนบุคคล (Privacy Policy)</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                สำหรับบริการบริษัทเป็นบริษัทที่ดำเนินธุรกิจด้านซอฟต์แวร์และบริการออนไลน์ของประเทศไทย ยึดมั่นการดำเนินธุรกิจอย่างมีจรรยาบรรณ เคารพและปฏิบัติตามกฎหมายที่บังคับใช้ และตระหนักถึงการได้รับความไว้วางใจจากท่านที่ใช้ผลิตภัณฑ์และบริการของบริษัทฯ ให้ความสำคัญด้านการเคารพสิทธิในความเป็นส่วนตัวของท่านและการรักษาความปลอดภัยของข้อมูลส่วนบุคคลของท่าน จึงได้กำหนดนโยบาย ระเบียบ และหลักเกณฑ์ต่างๆ ในการดำเนินงานของบริษัทฯ ด้วยมาตรการที่เข้มงวดในการรักษาความปลอดภัยของข้อมูลส่วนบุคคล เพื่อให้ท่านได้มั่นใจว่า ข้อมูลส่วนบุคคลของท่านที่บริษัทฯ ได้รับจะถูกนำไปใช้ตรงตามความต้องการของท่านและถูกต้องตามกฎหมาย
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-12 mt-3">
          <p style="color:white;">If you have account <a href="login.php" style="color:red;">Login</a></p>
        </div>
				<div class="col-sm-12 text-center">
					<input type="submit" name="submit" value="R E G I S T E R" class="btn btn-register"></input>
				</div>
			</form>
      </div>
		<div class="col-sm-3"></div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>