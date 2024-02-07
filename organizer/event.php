<?php
  	session_start();
	include('comtop.php'); 
	include_once('../config.php');
	include_once('../function/myfunction.php');

	if (!isset($_SESSION['ognz_id'])) {
		header("Location:../ognzlogin.php");
	  }else{
		$result = getoneognz('ognz_profile',$_SESSION['ognz_id']);
		if(mysqli_num_rows($result)>0)       
			  {
			  foreach($result as $o)
			  {
	
?>
	
	  <div class="col-sm-12 col-8 text-right">
	  <a href="logout_ognz.php" type="button" class="btn btn-count" style="background-color:red;">LOGOUT</a>
	</div>

	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="slide/slick/slick.css?v2022">
<link rel="stylesheet" type="text/css" href="slide/slick/slick-theme.css?v2022">
<style type="text/css">
	.slider {
		width: 100%;
		margin: 20px auto;
	}

	.slick-slide {
		margin: 0px 20px;
	}

	.slick-slide img {
		width: 100%;
	}

	.slick-prev:before,
	.slick-next:before {
		color: black;
	}


	.slick-slide {
		transition: all ease-in-out .3s;
		opacity: .2;
	}

	.slick-active {
		opacity: .5;
	}

	.slick-current {
		opacity: 1;
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
	label{
		color: white;
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
	h6{
		font-size:25px;
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
</style>

<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-sm-3 text-center">
			<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<img src="assets/img/icon/home_1.png" style="width: 30px;"> DASHBOARD
				</div>
			</div>
		</div>
		<div class="col-sm-7 text-center">
		</div>
		<div class="col-sm-2 text-center">
			<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;" >
					MY POINT : <?php echo $o['point'];?><img src="assets/img/icon/ticket.png" style="width: 30px;">
				</div>
			</div>
		</div>
	</div>
	<?php if($o["ognz_status"] == "suspended"){?>	
		<div class="row mt-3">
		<div class="col-6 col-md-4">
			<div class="card-content-detail">
				<div class="card-body" style="background-color: red; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row mt-2">
						<div class="col-sm-2"></div>
						<div class="col-sm-8 text-center">
						<img src="data:image/jpeg;base64,<?php echo base64_encode($o["ognz_image"]);?>" style="width: 60%" >
							<!-- <img src="assets/img/icon/picture.png" style="width: 60%;"> -->
							<p style='font-size:20px;'class="card-text mt-3">บัญชีนี้ถูกระงับการใช้งาน</p>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</div>
		</div>
						<?php
						}elseif($o["ognz_status"] == "pending"){
						?>
		<div class="row mt-3">
		<div class="col-6 col-md-4">
			<div class="card-content-detail">
				<div class="card-body" style="background-color:yellow; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row mt-2">
						<div class="col-sm-2"></div>
						<div class="col-sm-8 text-center">
						<img src="data:image/jpeg;base64,<?php echo base64_encode($o["ognz_image"]);?>" style="width: 60%" >
							<!-- <img src="assets/img/icon/picture.png" style="width: 60%;"> -->
							<p style='font-size:20px;'class="card-text mt-3">กำลังตรวจสอบบัญชี</p>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</div>
		</div>	
						<?php
						}elseif($o["ognz_status"] == "verified"){
						?>

	<div class="row mt-3">
		<div class="col-6 col-md-4">
		<a href="../ognzprofile.php" style="text-decoration: none">
			<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row mt-2">
						<div class="col-sm-2"></div>
						<div class="col-sm-8 text-center">
						<img src="data:image/jpeg;base64,<?php echo base64_encode($o["ognz_image"]);?>" style="width: 60%" >
							<!-- <img src="assets/img/icon/picture.png" style="width: 60%;"> -->
							<p style='font-size:20px;'class="card-text mt-3"><?php echo $o['ognz_firstname'];?> <?php echo $o['ognz_lastname'];?></p>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</a></div>
			
		</div>
		<div class="col-6 col-md-4">
			<a href="add_event.php" style="text-decoration: none">
				<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row mt-2">
						<div class="col-sm-2"></div>
						<div class="col-sm-8 text-center">
							<img src="assets/img/icon/add.png" style="width: 60%;">
							<p style='font-size:20px;' class="card-text mt-3">สร้างอีเวนต์</p>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				</div>
			</a>
		</div>
		<?php
			$ops = getOgnzPendingSettlement($_SESSION['ognz_id']);
			if(mysqli_num_rows($ops)<=0)       
			{
							?>
		<div class="col-6 col-md-4">
			<a href="settlement.php" style="text-decoration: none">
				<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row mt-2">
						<div class="col-sm-2"></div>
						<div class="col-sm-8 text-center">
							<img src="assets/img/icon/settle_icon.png" style="width: 60%;">
							<p style='font-size:20px;' class="card-text mt-3">เบิกเงิน</p>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				</div>
			</a>
		</div>
		<?php
						}else{?>
			<div class="col-6 col-md-4">
				<a href="pending_settlement.php" style="text-decoration: none">
					<div class="card-content-detail">
						<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
							<div class="row mt-2">
								<div class="col-sm-2"></div>
								<div class="col-sm-8 text-center">
								<img src="assets/img/icon/settle_icon.png" style="width: 60%;">
								<p style='font-size:20px; color:red;' class="card-text mt-3">คุณมีรายการเบิกเงินไปแล้ว</p>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
				</div>
				</a>
		</div>

						<?php
						}
						
						?>


<!-- <div class="container-fluid"> -->
  <!-- <div class="row"> -->
    <div class="col-xl-12 col-md-12 mb-4">
      <h6 style="color: white; padding-top:30px;">อีเวนต์ทั้งหมดของคุณ</h6> 
      <div class="row mt-3 ">
		<?php
			$oe = ognzEvent($_SESSION['ognz_id']);
				if(mysqli_num_rows($oe)>0)       
					{
					foreach($oe as $oe)
					{
						if($oe['event_status'] == 'accepted'){
							?>
			 <div class="col-xl-2 col-sm-2 mb-m-0 mb-2">
				<div class="card" >
            		<div class="card-body p-1 text-center" >
          		
					<!-- <div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;"> -->
						<div class="row">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($oe["event_image"]);?>"  style="width:100%; height: 250px;" >
						</div>
						
					</div>
					<div>
						<a href="edit_event.php?eid=<?php echo $oe['event_id']; ?>" type="button" class="btn btn-count " style="background-color:green; margin-left:65px;">ดูสถิติ</a>
						</div>
					</div>
			</div> 
	<?php
						}elseif($oe['event_status'] == 'pending'){?>
		<div class="col-xl-2 col-sm-2 mb-m-0 mb-2">
           <div class="card" > 
		   		<div class="card-body p-1 text-center">
          		
				<!-- 	<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;"> -->
						<div class="row ">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($oe["event_image"]);?>" style="width:100%; height: 250px;" >
						</div>
						
					</div>
					<div>
							<a href="#" type="button" class="btn btn-count  " style="background-color:orange; margin-left:45px;">กำลังตรวจสอบ</a>
      					</div>
					</div>
				</div> 
	<?php
						}elseif($oe['event_status'] == 'cancel'){?>
		<div class="col-xl-2 col-sm-2 mb-m-0 mb-2">
           <div class="card"> 
		   <div class="card-body p-1 text-center" >
					
						<!-- <div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;"> -->
							<div class="row ">
								<img src="data:image/jpeg;base64,<?php echo base64_encode($oe["event_image"]);?>" style="width:100%; height: 250px;" >
							</div>
							
					</div> 
					<div>
								<a href="#" type="button" class="btn btn-count  ml-5" style="background-color:red;">ถูกยกเลิก</a>
							</div>
				</div>
				</div>
				
<?php

}
		
	}
}
?>
 </div>
  </div>
</div>
</div>

							<?php
						}
								}
							}
						}
						
							?>