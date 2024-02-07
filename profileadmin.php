<?php

session_start();

ini_set('display_errors', 1);

include_once('config.php');
include_once('function/myfunction.php');
include_once('comtop.php');
if (isset($_SESSION['aid'])) {
  $result = getadmin($_SESSION['aid']);
  if(mysqli_num_rows($result)>0)       
    {
    foreach($result as $aid)
    {

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

	.card-content-detail {
		position: relative;
		display: flex;
		flex-direction: column;
		min-width: 0;
		word-wrap: break-word;
		backdrop-filter: blur(10px);
		background: #4c4c4c;
		box-sizing: border-box;
		border-radius: 15px;
		color: white;
	}

	.btn-count {
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
	.btn-count:hover {
		border-radius: 15px;
		border: 2px solid #212529;
		background-color: white;
		color: #212529;
		font-size: 16px;
		cursor: pointer;
	}
	h1{
		font-size: 30px;
		color: white;
	}
	small{
		color: white;
	}

	h4{
		color: white;
	}
</style>

<div class="container">
<div class="col-sm-5 col-5 mt-2">
			<a href="admin/warn.php"><img src="assets/img/icon/back.png"  style="width: 40px;"></a>
		</div>
	<div class="row mt-3">
		<div class="col-sm-12 text-center mt-2">
			<h1>ADMIN PROFILE</h1>
		</div>
	</div>
	

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">
			<div class="card-content" style="margin-bottom: 95px;">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">First Name : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
							<p><?php echo $aid['admin_firstname']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">Last Name : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
              <p><?php echo $aid['admin_lastname']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">E-mail : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
              <p><?php echo $aid['admin_email']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">Phone : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
              <p><?php echo $aid['admin_phone']; ?></p>
						</div>
					</div>
          <div class="col-sm-12 col-8 text-right">
            <a href="logout_admin.php" type="button" class="btn btn-count" style="background-color:red;">LOGOUT</a>
          </div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>



<?php
// }else{
//     echo "Something went wrong";    
// }

    }}}
?>