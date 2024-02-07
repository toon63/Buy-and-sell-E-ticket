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
    foreach($result as $u){
{
include('comtop.php'); ?>
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
	label{
		color: white;
	}
	h1{
		font-size: 25px;
		color: white;
	}
	small{
		color: white;
	}

	h4{
		color: white;
	}
	#img{
		width:20%;
		float:left;
	}
	@media screen and (max-width: 390px) {
	
	  h1{
		font-size: 20px;
		color: white;
		text-align:center;
		margin-top:30px;
	}
	#img{
		width:100%;
		
	}
}
</style>

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
			<h1>TRANSFER HISTORY</h1>
		</div>
	</div>

	<div class="row">
		<div class="col">
		<h1 style="text-align : center;">รายการส่ง</h1>
    <?php
$query = tfhistory_sender($_SESSION['id']);
// $query = "SELECT * FROM transfer_history tf,ticket t,event_detail e where transfer_user_id = $_SESSION['id'] AND t.ticket_id = tf.transfer_ticket_id AND t.tk_event_id = e.event_id order by tf.transfer_date DESC;";
// $query = mysqli_query($con,$query);
if(mysqli_num_rows($query)>0){
	foreach($query as $tfs){
		if($tfs['transfer_status'] == 'send'){?>
        <!-- <div class="row mt-2 mb-4">
            <div class="col-sm-2"></div>
                <div class="col-sm-8 text-center mt-2">
                        <div class="card-content-detail">
                            <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($tfs["event_image"]); ?>"alt="Base64 Image" style="width: 20%; float:left;">
                                <br><br><br><h1 style = "color:black;">ทำการส่งบัตร<br>
                                <?php echo $tfs['transfer_date'];?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div> -->

				<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-12 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;" >
					<img src="data:image/jpeg;base64,<?php echo base64_encode($tfs["event_image"]); ?>"alt="Base64 Image" id="img" >
                    <h1 style = "color:black; font-weight:bold;">ทำการส่งบัตร<br> </h1>
					<?php
					$left_sender_name = getUser($tfs["transfer_user_id"]);
					if(mysqli_num_rows($left_sender_name)>0){
						foreach($left_sender_name as $lsn){
							$left_receiver_name = getUser($tfs["customer_transfer_id"]);
							if(mysqli_num_rows($left_receiver_name)>0){
								foreach($left_receiver_name as $lrn){
					?>
					<h1 style = "color:black;"><?php echo $lsn['user_firstname'];?>(คุณ) <br>ส่งให้ <br><?php echo $lrn['user_firstname'];?></h1>
					<?php
								}
							}
						}
					}
					?>
					<h1 style = "color:black;">วันที่ทำรายการ:  <?php echo $tfs['transfer_date'];?></h1>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
        <?php
        }elseif($tfs['transfer_status'] == 'rejected'){?>
			<!-- <div class="row mt-2 mb-4">
				<div class="col-sm-2"></div>
					<div class="col-sm-8 text-center mt-2">
							<div class="card-content-detail">
								<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
									<img src="data:image/jpeg;base64,<?php echo base64_encode($tfs["event_image"]); ?>"alt="Base64 Image" style="width: 20%; float:left;">
									<br><br><br><h1 style = "color:red;">ส่งไม่สำเร็จ<br>
									<?php echo $tfs['transfer_date'];?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-2"></div>
					</div> -->
					<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-12 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;" >
					<img src="data:image/jpeg;base64,<?php echo base64_encode($tfs["event_image"]); ?>"alt="Base64 Image" id="img">
                    <h1 style = "color:red; font-weight:bold;">ส่งไม่สำเร็จ<br> </h1>
					<?php
					$left_sender_name = getUser($tfs["transfer_user_id"]);
					if(mysqli_num_rows($left_sender_name)>0){
						foreach($left_sender_name as $lsn){
							$left_receiver_name = getUser($tfs["customer_transfer_id"]);
							if(mysqli_num_rows($left_receiver_name)>0){
								foreach($left_receiver_name as $lrn){
					?>
					<h1 style = "color:black;"><?php echo $lsn['user_firstname'];?>(คุณ) <br>ส่งให้ <br><?php echo $lrn['user_firstname'];?></h1>
					<?php
								}
							}
						}
					}
					?>
					<h1 style = "color:black;">วันที่ทำรายการ: <?php echo $tfs['transfer_date'];?></h1>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
		<?php
        }elseif($tfs['transfer_status'] == 'received'){?>
			<!-- <div class="row mt-2 mb-4">
				<div class="col-sm-2"></div>
					<div class="col-sm-8 text-center mt-2">
							<div class="card-content-detail">
								<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
									<img src="data:image/jpeg;base64,<?php echo base64_encode($tfs["event_image"]); ?>"alt="Base64 Image" style="width: 20%; float:left;">
									<br><br><br><h1 style = "color:green;">ส่งสำเร็จ<br>
									<?php echo $tfs['transfer_date'];?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-2"></div>
					</div> -->
					<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-12 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
					<img src="data:image/jpeg;base64,<?php echo base64_encode($tfs["event_image"]); ?>"alt="Base64 Image" id="img">
                    <h1 style = "color:green; font-weight:bold;">ส่งสำเร็จ<br> </h1>
					<?php
					$left_sender_name = getUser($tfs["transfer_user_id"]);
					if(mysqli_num_rows($left_sender_name)>0){
						foreach($left_sender_name as $lsn){
							$left_receiver_name = getUser($tfs["customer_transfer_id"]);
							if(mysqli_num_rows($left_receiver_name)>0){
								foreach($left_receiver_name as $lrn){
					?>
					<h1 style = "color:black;"><?php echo $lsn['user_firstname'];?>(คุณ) <br>ส่งให้ <br><?php echo $lrn['user_firstname'];?></h1>
					<?php
								}
							}
						}
					}
					?>
					<h1 style = "color:black;">วันที่ทำรายการ: <?php echo $tfs['transfer_date'];?></h1>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
			<?php
                    	}
                	}
            	}?>
			</div>

			<div class="col">
			<h1 style="text-align : center;">รายการรับ</h1>
				<?php
				$query2 = tfhistory_receiver($_SESSION['id']);
				if(mysqli_num_rows($query2)>0){
					foreach($query2 as $tfr){
						if($tfr['transfer_status'] == 'send'){?>
						<div class="row mt-2 mb-4">
							<div class="col-sm-2"></div>
								<div class="col-sm-12 text-center mt-2">
										<div class="card-content-detail">
											<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
												<img src="data:image/jpeg;base64,<?php echo base64_encode($tfr["event_image"]); ?>"alt="Base64 Image"id="img">
												<h1 style = "color:orange; font-weight:bold;">ได้รับคำขอส่งบัตร<br></h1>
												<?php
												$right_sender_name = getUser($tfr["transfer_user_id"]);
												if(mysqli_num_rows($right_sender_name)>0){
													foreach($right_sender_name as $rsn){
														$right_receiver_name = getUser($tfr["customer_transfer_id"]);
														if(mysqli_num_rows($right_receiver_name)>0){
															foreach($right_receiver_name as $rrn){
												?>
												<h1 style = "color:black;"><?php echo $rsn['user_firstname'];?>(คุณ) <br>ได้รับคำขอจาก <br><?php echo $rrn['user_firstname'];?></h1>
												<?php
															}
														}
													}
												}
												?>
												<h1 style = "color:black;">วันที่ทำรายการ:<?php echo $tfr['transfer_date'];?></h1>
											</div>
										</div>
									</div>
									<div class="col-sm-2"></div>
								</div>
						<?php
						}elseif($tfr['transfer_status'] == 'rejected'){?>
							<div class="row mt-2 mb-4">
								<div class="col-sm-2"></div>
									<div class="col-sm-12 text-center mt-2">
											<div class="card-content-detail">
												<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
													<img src="data:image/jpeg;base64,<?php echo base64_encode($tfr["event_image"]); ?>"alt="Base64 Image" id="img">
													<h1 style = "color:red; font-weight:bold;">ปฏิเสธการรับบัตร<br></h1>
													<?php
													$right_sender_name = getUser($tfr["transfer_user_id"]);
													if(mysqli_num_rows($right_sender_name)>0){
														foreach($right_sender_name as $rsn){
															$right_receiver_name = getUser($tfr["customer_transfer_id"]);
															if(mysqli_num_rows($right_receiver_name)>0){
																foreach($right_receiver_name as $rrn){
													?>
													<h1 style = "color:black;"><?php echo $rsn['user_firstname'];?>(คุณ) <br>ปฎิเสธคำขอจาก <br><?php echo $rrn['user_firstname'];?></h1>
													<?php
																}
															}
														}
													}
													?>
													<h1 style = "color:black;">วันที่ทำรายการ:<?php echo $tfr['transfer_date'];?></h1>
												</div>
											</div>
										</div>
										<div class="col-sm-2"></div>
									</div>
						<?php
						}elseif($tfr['transfer_status'] == 'received'){?>
							<div class="row mt-2 mb-4">
								<div class="col-sm-2"></div>
									<div class="col-sm-12 text-center mt-2">
											<div class="card-content-detail">
												<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
													<img src="data:image/jpeg;base64,<?php echo base64_encode($tfr["event_image"]); ?>"alt="Base64 Image" id="img">
													<h1 style = "color:green; font-weight:bold;">ยืนยันการรับบัตร<br></h1>
													<?php
													$right_sender_name = getUser($tfr["transfer_user_id"]);
													if(mysqli_num_rows($right_sender_name)>0){
														foreach($right_sender_name as $rsn){
															$right_receiver_name = getUser($tfr["customer_transfer_id"]);
															if(mysqli_num_rows($right_receiver_name)>0){
																foreach($right_receiver_name as $rrn){
													?>
													<h1 style = "color:black;"><?php echo $rsn['user_firstname'];?>(คุณ) <br>ได้รับบัตรจาก <br><?php echo $rrn['user_firstname'];?></h1>
													<?php
																}
															}
														}
													}
													?>
													<h1 style = "color:black;">วันที่ทำรายการ:<?php echo $tfr['transfer_date'];?></h1>
												</div>
											</div>
										</div>
										<div class="col-sm-2"></div>
									</div>
									<?php					
        				}?>
						<?php
					}
				}
			}
		}
	}
}


?>