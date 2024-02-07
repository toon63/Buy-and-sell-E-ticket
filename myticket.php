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
if (!isset($_SESSION['id'])) {
  header("Location: login.php");
}
else{
include('comtop.php');

?>
<style type="text/css">
	.btn-buy {
		border-radius: 15px;
		border: 2px solid white;
		background-color: #dc3545;
		color: #ffffff;
		font-size: 16px;
		cursor: pointer;
		/*color: #fff;
		background-color: #212529;
		border-color: #fff;*/
	}

	.btn-buy:hover {
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
		color: black;
	}
	a {
		color:black;
		text-decoration: none;
	}
	h5{
		text-decoration: none;
	}
</style>
<?php
$query = getUser($_SESSION['id']);
if(mysqli_num_rows($query)>0){
	foreach($query as $u)
	{?>
		<div class="container" style='padding-bottom : 100px;'>
	<div class="row mt-3" >
		<div class="col-sm-6 col-4 mt-2">
			<!-- <a href="event.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a> -->
		</div>
		<div class="col-sm-6 col-8 text-right">
			<button type="button" class="btn btn-count"><?php echo $u["point"]; ?></button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="points.php" type="button" class="btn btn-count">+</a>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-sm-12 text-center mt-2">
			<h1>บัตรของฉัน</h1>
		</div>
	</div>

<?php
	$result = getUserTicket($_SESSION['id']);
	$result2 = getUserSellingTicket($_SESSION['id']);
	$result3 = getUserSendingticket_sender($_SESSION['id']);
	$result4 = getUserSuspendedTicket($_SESSION['id']);
	if(mysqli_num_rows($result3)>0)
	{
    foreach($result3 as $mysendingticket)
    {
		$current_datetime = date("Y-m-d H:i:s");
		$start = date('d-m-Y H:i น.', strtotime($mysendingticket["event_start"]));
		if($mysendingticket["event_end"] > $current_datetime && $mysendingticket["event_start"] > $current_datetime){?>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">

			<div class="card-content">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-5 col-5">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($mysendingticket["event_image"]); ?>"alt="Base64 Image" style="width: 100%;">
						</div>
						<div class="col-sm-7 col-7">
							<h5 style="color : red;">อยู่ระหว่างการส่ง</h5>
					
							<h5><?php echo $mysendingticket["event_name"]; ?></h5>
							<h5><?php echo $start; ?></h5>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-sm-6 col-6 text-left">
						</div>
						<div class="col-sm-6 col-6 text-right">
							<?php echo $mysendingticket["ticket_type"]; ?>
							<?php echo $mysendingticket["ticket_price"]; ?>
							<img src="assets/img/icon/ticket.png" style="width: 40px;">
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-sm-12 text-center">
							<a href="cancelsend.php?tid=<?php echo $mysendingticket['ticket_id']; ?>" type="submit" class="btn btn-buy">ยกเลิกการส่ง</a>
						</div>
						<div class="col-sm-12 text-center">
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
			</div>
		</div>
		<div class="col-sm-2" ></div>
	</div>
<?php
		}
	}
}

	if(mysqli_num_rows($result2)>0)
	{
    foreach($result2 as $mysellticket)
    {
		$current_datetime = date("Y-m-d H:i:s");
		$start = date('d-m-Y H:i น.', strtotime($mysellticket["event_start"]));
		if($mysellticket["event_end"] > $current_datetime){?>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">

			<div class="card-content">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-5 col-5">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($mysellticket["event_image"]); ?>"alt="Base64 Image" style="width: 100%;">
						</div>
						<div class="col-sm-7 col-7">
							<h5 style="color : red;">อยู่ระหว่างการขาย</h5>
							<!-- <h5><?php echo $mysellticket["ticket_id"]; ?></h5> -->
							<h5><?php echo $mysellticket["event_name"]; ?></h5>
							<h5><?php echo $start; ?></h5>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-sm-6 col-6 text-left">
						</div>
						<div class="col-sm-6 col-6 text-right">
							<?php echo $mysellticket["ticket_type"]; ?>
							<?php echo $mysellticket["ticket_price"]; ?>
							<img src="assets/img/icon/ticket.png" style="width: 40px;">
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-sm-12 text-center">
							<a href="cancelsell.php?tid=<?php echo $mysellticket['ticket_id']; ?>" type="submit" class="btn btn-buy">ยกเลิกการขาย</a>
						</div>
						<div class="col-sm-12 text-center">
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
			</div>
		</div>
		<div class="col-sm-2" ></div>
	</div>
<?php
		}
	}
}

if(mysqli_num_rows($result4)>0)
{
foreach($result4 as $mysusticket)
{
	$current_datetime = date("Y-m-d H:i:s");
	$start = date('d-m-Y H:i น.', strtotime($mysusticket["event_start"]));
	if($mysusticket["event_end"] > $current_datetime){?>
<div class="row mt-2">
	<div class="col-sm-2"></div>
	<div class="col-sm-8 mt-2">

		<div class="card-content">
			<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				<div class="row">
					<div class="col-sm-5 col-5">
						<img src="data:image/jpeg;base64,<?php echo base64_encode($mysusticket["event_image"]); ?>"alt="Base64 Image" style="width: 100%;">
					</div>
					<div class="col-sm-7 col-7">
						<h5 style="color : red;">!!! ถูกระงับ !!!</h5>
						<!-- <h5><?php echo $mysusticket["ticket_id"]; ?></h5> -->
						<h5><?php echo $mysusticket["event_name"]; ?></h5>
						<h5><?php echo $start; ?></h5>
					</div>
				</div>

				<div class="row mt-2">
					<div class="col-sm-6 col-6 text-left">
					</div>
					<div class="col-sm-6 col-6 text-right">
						<?php echo $mysusticket["ticket_type"]; ?>
						<?php echo $mysusticket["ticket_price"]; ?>
						<img src="assets/img/icon/ticket.png" style="width: 40px;">
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
		</div>
	</div>
	<div class="col-sm-2" ></div>
</div>
<?php
	}
}
}

	if(mysqli_num_rows($result)>0)
	{
    foreach($result as $myticket)
    {
		$current_datetime = date("Y-m-d H:i:s");
		$start = date('d-m-Y H:i น.', strtotime($myticket["event_start"]));
	
		if($myticket["event_end"] > $current_datetime && $myticket["event_endsell"] > $current_datetime){?>
		<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">

			<div class="card-content" >
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-5 col-5">
						<a href="qr.php?tid=<?php echo $myticket['ticket_id']; ?>">	<img src="data:image/jpeg;base64,<?php echo base64_encode($myticket["event_image"]); ?>"alt="Base64 Image" style="width: 100%;">
								</a></div>
						<div class="col-sm-7 col-7">
							<!-- <h5><?php echo $myticket["ticket_id"]; ?></h5> -->
							<h5><?php echo $myticket["event_name"]; ?></h5>
							<h5><?php echo $start; ?></h5>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-sm-6 col-6 text-left">
							
						</div>
						<div class="col-sm-6 col-6 text-right">
							<?php echo $myticket["ticket_type"]; ?>
							<?php echo $myticket["ticket_price"]; ?>
							<img src="assets/img/icon/ticket.png" style="width: 40px;">
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-sm-12 text-center">
							<a href="sell.php?tid=<?php echo $myticket['ticket_id']; ?>" type="submit" class="btn btn-buy">ขาย</a>
							<a href="send.php?tid=<?php echo $myticket['ticket_id']; ?>" type="submit" class="btn btn-buy">ส่งต่อ</a>
						</div>
						<div class="col-sm-12 text-center">
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-3">
			</div>
		</div>
		<div class="col-sm-2" ></div>
	</div>
<?php
		}elseif($myticket["event_end"] > $current_datetime && $myticket["event_endsell"] <= $current_datetime){
			
			?>
		
			<div class="row mt-2">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 mt-2">
	
				<div class="card-content" >
					<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
						<div class="row">
							<div class="col-sm-5 col-5">
							<a href="qr.php?tid=<?php echo $myticket['ticket_id']; ?>">	<img src="data:image/jpeg;base64,<?php echo base64_encode($myticket["event_image"]); ?>"alt="Base64 Image" style="width: 100%;">
									</a></div>
							<div class="col-sm-7 col-7">
								<!-- <h5><?php echo $myticket["ticket_id"]; ?></h5> -->
								<h5><?php echo $myticket["event_name"]; ?></h5>
								<h5><?php echo $startDatetime; ?></h5>
							</div>
						</div>
	
						<div class="row mt-2">
							<div class="col-sm-6 col-6 text-left">
								
							</div>
							<div class="col-sm-6 col-6 text-right">
								<?php echo $myticket["ticket_type"]; ?>
								<?php echo $myticket["ticket_price"]; ?>
								<img src="assets/img/icon/ticket.png" style="width: 40px;">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-sm-12 text-center">
								<!-- <a href="sell.php?tid=<?php echo $myticket['ticket_id']; ?>" type="submit" class="btn btn-buy">ขาย</a> -->
								<a href="send.php?tid=<?php echo $myticket['ticket_id']; ?>" type="submit" class="btn btn-buy">ส่งต่อ</a>
							</div>
							<div class="col-sm-12 text-center">
							</div>
						</div>
					</div>
				</div>
	
				<div class="row mt-3">
				</div>
			</div>
			<div class="col-sm-2" ></div>
		</div>
	<?php
			}
	?>
	

<?php
	}
}

else{
			?>
	</div>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">

			<div class="card-content">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-12 text-center mt-2">
							<h2 style="color : red;">คุณยังไม่มีบัตร</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
			<?php
		}
}
?>
</div>

<div class="navbar">
	<a href="index.php">
		<img src="assets/img/icon/home.png" style="width: 30px;">
	</a>
	<a href="myticket.php" class="active">
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
	<a href="profile.php">
		<img src="assets/img/icon/user.png" style="width: 30px;">
	</a>
</div>
<script>
        function showQR() {
            var hiddenItem = document.getElementById('hiddenItem');
            hiddenItem.style.display = 'block';
        }
    </script>
<?php
}
else{?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>No ticket found (yet...)!</strong>
</div>
  <?php
}
}
?>

	
