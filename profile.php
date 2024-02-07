<?php
session_start();
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    // echo "Referrer URL: " . $referer;
	
} else {
    echo "No referrer URL";
	session_destroy();
	header("Location: login.php");
}



include_once('config.php');
include_once('function/myfunction.php');

if (isset($_SESSION['id'])) {
  $result = getUser($_SESSION['id']);
  if(mysqli_num_rows($result)>0)       
    {
    foreach($result as $u)
    {
{
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
	#edit{
		margin-bottom:80px;
	}
	@media screen and (max-width: 390px) {
		#edit{
		margin-bottom:100px;
		margin-left:55px;
		
	}
	#from{
		margin-top:50px;
	}
	}

</style>

<div class="container">
	<div class="row mt-3" style="">
		<div class="col-sm-6 col-4 mt-2">
			<!-- <a href="event.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a> -->
		</div>
		<div class="col-sm-6 col-8 text-right">
			<button type="button" class="btn btn-count"><?php echo $u['point']; ?></button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="point.php" type="button" class="btn btn-count">+</a>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-sm-12 text-center mt-2">
			<h1>MY PROFILE</h1>
		</div>
	</div>
	<?php 

	$imageData = $u['user_image'];
	
	if ($imageData != '') {?>
	<div class="row mt-2">
		<div class="col-sm-2"></div>
			<div class="col-sm-8 text-center mt-2">
				
			
                <img src="data:image/jpeg;base64,<?php echo base64_encode($u["user_image"]); ?>" alt="Base64 Image" style="width: 50%;">
        
			</div>
		</div>

		<?php
	}
		?> 
		


	<div class="row mt-2" style="margin-bottom:80px;">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">
			<div class="card-content" >
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="col-sm-12 col-8" style="margin-bottom:10px;" id="edit">
           	 	<a href="edit_profile.php" type="button" class="btn btn-count " style="margin-bottom:10px;">แก้ไขข้อมูลส่วนตัว</a>
				<a href="logout.php" type="button" class="btn btn-count" style="background-color:red; float:right;  width:180px;">LOGOUT</a>
       		
</div>
<div class="form-group row"  id="from" >
						<label class="col-sm-2 col-5 col-form-label">First Name : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
							<p><?php echo $u['user_firstname']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">Last Name : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
             				<p><?php echo $u['user_lastname']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">E-mail : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
              				<p><?php echo $u['user_email']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">Phone : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
              				<p><?php echo $u['user_phone']; ?></p>
						</div>
					</div>
				<div class="col-sm-12 text-center mt-2" style="padding:10px;">
					<a href="point_history.php" type="button" class="btn btn-login">ประวัติการเติมแต้ม</a>
            		<a href="ts_history.php" type="button" class="btn btn-login">ประวัติการซื้อ-ขาย</a>
					<a href="tf_history.php" type="button" class="btn btn-login">ประวัติการรับ-ส่ง</a>
				</div>
			
			</div>
		</div>
			
				
			
		</div>
	</div>
</div>


<?php //include('menu.php'); ?>

<div class="navbar" >
	<a href="index.php">
		<img src="assets/img/icon/home.png" style="width: 30px;">
	</a>
	<a href="myticket.php">
		<img src="assets/img/icon/ticket1.png" style="width: 30px;">
	</a>
	<?php
	$result3 = getUserSendingticket_receiver($_SESSION['id']);
	if(mysqli_num_rows($result3)>0)
	{
    foreach($result3 as $myreceiveticket)
    {
?>
	<a href="history.php">
		<img src="assets/img/icon/bell1r.png" style="width: 30px;">
	</a>
<?php
	}
}else{
			?>
	<a href="history.php">
		<img src="assets/img/icon/bell1.png" style="width: 30px;">
	</a>
			<?php
		}
?>
	<a href="profile.php" class="active">
		<img src="assets/img/icon/user.png" style="width: 30px;">
	</a>
</div>



<?php
}
}
}
else
{
    echo "Something went wrong";    
}
}
?>