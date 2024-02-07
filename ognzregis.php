<?php
      
  include_once('config.php');
  
  if (isset($_POST['submit'])) {
    $errorMsg = "";
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['bank']) || empty($_POST['bank_num']) || empty($_POST['bank_name']) || empty($_POST['password']) || empty($_POST['cf_password'])){
      $errorMsg = "กรอกข้อมูลไม่ครบ";
      }
          else{
      
      $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
      $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
      $email    = mysqli_real_escape_string($con, $_POST['email']);
      $phone = mysqli_real_escape_string($con, $_POST['phone']);
      $bank = mysqli_real_escape_string($con, $_POST['bank']);
	    $bank_num = mysqli_real_escape_string($con, $_POST['bank_num']);
	    $bank_name = mysqli_real_escape_string($con, $_POST['bank_name']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $cf_password = mysqli_real_escape_string($con, $_POST['cf_password']);

      
      $sql = "SELECT * FROM ognz_profile WHERE ognz_email = '$email'";
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
            $query= "INSERT INTO ognz_profile(ognz_status,ognz_firstname,ognz_lastname,ognz_password,ognz_email,ognz_phone,bank,bank_acc_number,bank_acc_name,point) 
                    VALUES('pending','$firstname','$lastname','$password','$email','$phone','$bank','$bank_num','$bank_name','0')";
            if (mysqli_query($con, $query)) {    
                $errorMsg  = "Register Successful!";
                header("Location:ognzlogin.php");
            }else{
                $errorMsg  = "You are not Registred..Please Try again";
              }
            }
          }
        }
      
      ?>
<!Doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<body style="background:#130f26;">
<div class="container" style="margin-top:50px">
<h1 style="text-align: center; font-size:50px; font-weight:bold; color:white;">ORGANIZER REGISTER</h1><br>
  <div class="row">
    <div class="col-md-4"></div>
      <div class="col-md-4">
      <?php
            if (isset($errorMsg)) {   //ถ้าerrorมีค่าจะแสดงค่าของerrorออกมา
                echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $errorMsg
                      </div>";
            }
        ?>
        <form action="" method="POST">
        <p style="color:white; font-weight:bold; font-size:20px;">Firstname</p>
          <div class="form-group">
             <input type="text" class="form-control" name="firstname" placeholder="ชื่อ" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">Lastname</p>
          <div class="form-group">
             <input type="text" class="form-control" name="lastname" placeholder="นามสกุล" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">Email</p>
          <div class="form-group">
             <input type="email" class="form-control" name="email" placeholder="อีเมล" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">Phone</p>
          <div class="form-group">
             <input type="tel" class="form-control" name="phone" placeholder="เบอร์ติดต่อ" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">ธนาคารรับเงิน</p>
          <div class="form-group">
             <input type="text" class="form-control" name="bank" placeholder="ชื่อธนาคาร" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">เลขบัญชีธนาคารรับเงิน</p>
          <div class="form-group">
             <input type="text" class="form-control" name="bank_num" placeholder="เลขบัญชีธนาคาร" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">ชื่อบัญชีธนาคารรับเงิน</p>
          <div class="form-group">
             <input type="text" class="form-control" name="bank_name" placeholder="ชื่อบัญชีธนาคาร" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">Password</p>
          <div class="form-group">
             <input type="password" class="form-control" name="password" placeholder="Password" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">Confirm Password</p>
          <div class="form-group">
             <input type="password" class="form-control" name="cf_password" placeholder="Password" required="">
          </div>
          
          <p style="color:white;">If you have account <a href="ognzlogin.php" style="color:red;">Login</a></p>
          <input type="submit" class="w3-btn w3-xxmedium w3-button w3-black w3-round-medium" style="margin-left:35%" name="submit" value="Sign Up">  
        </form>
      </div>
    </div>
  </div>
  
</body>
</html>