<?php

  session_start();

  include_once('config.php');
 
  if (isset($_POST['submit'])) {

      $errorMsg = "";

      $email    = mysqli_real_escape_string($con, $_POST['email']);
      $password = mysqli_real_escape_string($con, $_POST['password']); 
      
  if (!empty($email) || !empty($password)) {
        $query  = "SELECT * FROM admin_profile WHERE admin_email = '$email'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 1){
          while ($row = mysqli_fetch_assoc($result)) {
            if (($password = $row['admin_password'])) {
                $_SESSION['aid'] = $row['admin_id'];
                header("Location:admin/warn.php");
                echo $_SESSION['aid'];
            }else{
                $errorMsg = "Email or Password is invalid";
            }    
          }
        }else{
          $errorMsg = "No user found on this email";
        } 
    }else{
      $errorMsg = "Email and Password is required";
    }
  }

?>
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
        <form action="" method="POST">
          <div class="container-fluid">
            <div class="row mt-5" style="">
              <div class="col-sm-12 text-center">
                <h1>LOGIN ADMIN</h1>
              </div>
            </div>
            <div class="row mt-3 mb-5">
              <div class="col-sm-3"></div>
              <div class="col-sm-6 col-12">
                <form>
                  <div class="form-row">
                    <div class="col-sm-6 col-12 mt-3">
                      <label for="inputEmail4">อีเมล</label>
                      <input type="text" class="form-control" name="email" placeholder="อีเมล..">
                    </div>
                    <div class="col-sm-6 col-12 mt-3">
                      <label for="inputEmail4">รหัสผ่าน</label>
                      <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน...">
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-sm-12 text-center">
                      <input type="submit" name="submit" value="L O G I N" class="btn btn-login"></input>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-sm-3"></div>
            </div>
           
            
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>