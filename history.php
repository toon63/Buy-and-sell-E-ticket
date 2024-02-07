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
		color: #ffc107;
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
			<h1>การแจ้งเตือน</h1>
		</div>
	</div>

<?php
	$result3 = getUserSendingticket_receiver($_SESSION['id']);
	if(mysqli_num_rows($result3)>0)
	{
    foreach($result3 as $myreceiveticket)
    {
?>
	<div class="row mt-2">
	<div class="col-sm-2"></div>
	<div class="col-sm-8 mt-2">

		<div class="card-content">
			<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				<div class="row">
					<div class="col-sm-5 col-5">
						<img src="data:image/jpeg;base64,<?php echo base64_encode($myreceiveticket["event_image"]); ?>"alt="Base64 Image" style="width: 100%;">
					</div>
					<div class="col-sm-7 col-7">
						<h5 style="color : red;">คุณได้รับบัตร</h5>
						<h5><?php echo$myreceiveticket["event_name"]; ?></h5>
						<?php echo $myreceiveticket["ticket_type"]; ?>
						<?php echo $myreceiveticket["ticket_price"]; ?>
						<img src="assets/img/icon/ticket.png" style="width: 40px;">
						<a href="receive_ticket.php?tid=<?php echo $myreceiveticket['ticket_id']; ?>" type="submit" class="btn btn-count">กดเพื่อดำเนินการ</a>
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
}else{
			?>
	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">

			<div class="card-content">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-12 text-center mt-2">
							<h2 style="color : red;">คุณไม่มีการแจ้งเตือน</h2>
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
	<a href="myticket.php" >
		<img src="assets/img/icon/ticket1.png" style="width: 30px;">
	</a>
	<?php
	$result3 = getUserSendingticket_receiver($_SESSION['id']);
	if(mysqli_num_rows($result3)>0)
	{
    foreach($result3 as $myreceiveticket)
    {
?>
	<a href="history.php" class="active">
		<img src="assets/img/icon/bell1r.png" style="width: 30px;">
	</a>
<?php
	}
}else{
			?>
	<a href="history.php" class="active">
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

	
