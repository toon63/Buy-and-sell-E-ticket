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
    $uid = $_SESSION['id'];
  $result = getUser($_SESSION['id']);
  if(mysqli_num_rows($result)>0)       
    {
    foreach($result as $u)
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
<?php
    if(isset($_POST['edit'])){
        if($_POST['e_firstname']!=""){
            $e_firstname = $_POST['e_firstname'];
            $fn = "UPDATE user_profile SET user_firstname = '$e_firstname' WHERE user_id = '$uid'";
            $qfn = mysqli_query($con, $fn);
        }
        if($_POST['e_lastname']!=""){
            $e_lastname = $_POST['e_lastname'];
            $ln = "UPDATE user_profile SET user_lastname = '$e_lastname' WHERE user_id = '$uid'";
            $qln = mysqli_query($con, $ln);
        }
        if($_POST['e_email']!=""){
            $e_email = $_POST['e_email'];
            $em = "UPDATE user_profile SET user_email = '$e_email' WHERE user_id = '$uid'";
            $qem = mysqli_query($con, $em);
        }
        if($_POST['e_phone']!=""){
            $e_phone = $_POST['e_phone'];
            $p = "UPDATE user_profile SET user_phone = '$e_phone' WHERE user_id = '$uid'";
            $qp = mysqli_query($con, $p);
        }?>
        <script type="text/javascript">
	        window.location="profile.php";
        </script>
        <?php
    }
?>

<div class="container">
	<div class="row mt-3" style="">
		<div class="col-sm-6 col-4 mt-2">
			<a href="profile.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a>
		</div>
		<div class="col-sm-6 col-8 text-right">
			<button type="button" class="btn btn-count"><?php echo $u['point']; ?></button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="points.php" type="button" class="btn btn-count">+</a>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-sm-12 text-center mt-2">
			<h1>EDIT PROFILE</h1>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-sm-2">
			</div>
			<div style="float:right;">
					<?php 

	$imageData = $u['user_image'];
	
	if ($imageData == '') {?>
	<div class="row mt-2">
		<div class="col-sm-2"></div>
			<div class="col-sm-8 text-center mt-2">
				
				<h1>เพิ่มรูปโปรไฟล์ของคุณ</h1>
				<form action="upload.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
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
				<img src="data:image/jpeg;base64,<?php echo base64_encode($u["user_image"]); ?>" alt="Base64 Image" style="width: 50%;">
				<form action="upload.php" method="POST" enctype="multipart/form-data">

					<input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
					<input type="file" name="image" style="color : white;">
					<input type="submit" class="btn btn-count" value="Upload">
				</form>
				<form action="deleteimg.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>"><input type="submit" class="btn btn-count" value="ลบรูปโปรไฟล์" style="background-color : red;">
				</form>
			</div>
			<div class="col-sm-2">
			</div>
		</div>
	</div>
		<?php
	}?>
	<div class="row mt-2">
	<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">
			<div class="card-content" style="margin-bottom: 95px;">
            <form method="POST" action="">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">First Name : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
                            <input type="text" name="e_firstname" placeholder="<?php echo $u['user_firstname']; ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">Last Name : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
                            <input type="text" name="e_lastname" placeholder="<?php echo $u['user_lastname']; ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">E-mail : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
                            <input type="email" name="e_email" placeholder="<?php echo $u['user_email']; ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-5 col-form-label">Phone : </label>
						<div class="col-sm-10 col-7" style="margin-top:7px;">
                            <input type="tel" maxlength=10 name="e_phone" placeholder="<?php echo $u['user_phone']; ?>">
						</div>
					</div>

					<div class="col-sm-12 col-8 text-left">
                            <input type="submit" name="edit" value="ยืนยัน" class="btn btn-count" style="background-color:;">
                            <a href="profile.php" type="button" class="btn btn-login" style="background-color:red;">ยกเลิก</a>
                        </div>
				</div>    
			 </form>
				</div>
				
               
			</div>
		</div>
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

?>