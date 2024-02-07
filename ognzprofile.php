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
include_once('function/myfunction.php');

if (!isset($_SESSION['ognz_id'])) {
    header("Location:ognzlogin.php");
  }else{
    $result = getoneognz('ognz_profile',$_SESSION['ognz_id']);
    if(mysqli_num_rows($result)>0)       
          {
          foreach($result as $o)
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
</style>

<div class="container">
	<div class="row mt-3" style="">
		<div class="col-sm-6 col-4 mt-2">
			<a href="organizer/event.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a>
		</div>
		<div class="col-sm-6 col-8 text-right">
			<!-- <button type="button" class="btn btn-count">0</button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="#" type="button" class="btn btn-count">+</a> -->
		</div>
	</div>
    <div class="row mt-3" style="">
		<div class="col-sm-6 col-4 mt-2">
			<!-- <a href="event.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a> -->
		</div>
		<div class="col-sm-6 col-8 text-right">
			<button type="button" class="btn btn-count"><?php echo $o['point']; ?></button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
		</div>
	</div>
  
	
	<div class="row mt-3">
		<div class="col-sm-12 text-center mt-2">
			<h1>ORGANIZER PROFILE</h1>
		</div>
	</div>
	<?php 

	$imageData = $o['ognz_image'];
	
	if ($imageData == '') {?>
	<div class="row mt-2">
		<div class="col-sm-2"></div>
			<div class="col-sm-8 text-center mt-2">
				<h1>เพิ่มรูปโปรไฟล์ของคุณ</h1>
				<form action="upload_ognz.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="ognz_id" value="<?php echo $_SESSION['ognz_id']; ?>">
					<input type="file" name="image" style="color : white;">
					<input type="submit" class="btn btn-count" value="Upload">
				</form>
			</div>
		</div>
		<?php
	} else{
		?>
		<div class="row mt-2">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 text-center mt-2">
				<img src="data:image/jpeg;base64,<?php echo base64_encode($o["ognz_image"]); ?>" alt="Base64 Image" style="width: 50%;">
				<form action="upload_ognz.php" method="POST" enctype="multipart/form-data">
					<h1>เปลี่ยนรูปโปรไฟล์</h1>
					<input type="hidden" name="ognz_id" value="<?php echo $_SESSION['ognz_id']; ?>">
					<input type="file" name="image" style="color : white;">
					<input type="submit" class="btn btn-count" value="Upload">
				</form>
				<form action="deleteimg.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="ognz_id" value="<?php echo $_SESSION['ognz_id']; ?>"><input type="submit" class="btn btn-count" value="ลบรูปโปรไฟล์" style="background-color : red;">ง
				</form>
			</div>
			<div class="col-sm-2">
			</div>
		</div>
		<?php
	}
		?>


	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">
			<div class="card-content" style="margin-bottom: 95px;">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">First Name : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
							<p><?php echo $o['ognz_firstname']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">Last Name : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
              <p><?php echo $o['ognz_lastname']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">E-mail : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
              <p><?php echo $o['ognz_email']; ?></p>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">Phone : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
              <p><?php echo $o['ognz_phone']; ?></p>
						</div>
					</div>
          <div class="col-sm-12 col-8 text-right">
            <a href="logout.php" type="button" class="btn btn-count" style="background-color:red;">LOGOUT</a>
          </div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
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