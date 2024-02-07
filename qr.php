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
include_once "library/phpqrcode/qrlib.php" ;

if (!isset($_SESSION['id'])) {
  header("Location: login.php");
}
else{
  $result = getUser($_SESSION['id']);
  if(mysqli_num_rows($result)>0)       
  {
  foreach($result as $u)
  {
    if (!isset($_GET['tid']))
    {
      header("Location: myticket.php");
    }
    else{
      $tid = $_GET['tid'];
	  $uid = $_SESSION['id'];
      $check = getOneUserTicket($_SESSION['id'],$tid);
      if (mysqli_num_rows($check)>0){
        foreach($check as $c){
          if ($_SESSION['id'] != $c['tk_user_id']){
            header("Location: myticket.php");
          }
          else{
			$start = date('d-m-Y H:i น.', strtotime($c["event_start"]));
			?>

<?php include('comtop.php'); ?>
<?php include('comtop.php'); ?>
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
	#eimage{
		margin-left:70px;
	}
	
	h6{
		font-size:25px;
		margin-left:40px;
		margin-top:20px;
		text-align:center;
	}
	@media screen and (max-width: 390px) {
		#head {
			margin-top:-50px; 
			margin-left:120px;
	}
	#eimage{
		margin-left:30px;
	}
	h6{
		text-align:center;
		font-size:16px;
		margin-top:5px;
		margin-left:10px;
		
	}
	
	}
</style>

<div class="container" >
<div class="row mt-3">
		
		<?php

		if (!isset($_SESSION['id'])) {
		?>
		<div class="col-sm-6 col-4 mt-2">
			<a href="index.php"><img src="assets/img/icon/back.png"  style="width: 40px;"></a>
		</div>
		<div class="col-sm-6 col-8 text-right">
			<a href="register.php" type="button" class="btn btn-count">
				REGISTER
			</a>
			<a href="login.php" type="button" class="btn btn-count">
				LOGIN 
			</a>
		</div>

		<?php
		}else{
		$query = getUser($_SESSION['id']);
		if(mysqli_num_rows($query)>0){
		foreach($query as $u)
		{
			if(isset($_POST['back'])){
				$qrref = bin2hex(random_bytes(10));
				$resetqr = "UPDATE qr SET qr_ref_id = '$qrref' WHERE qr_ticket_id = '$tid';";
				mysqli_query($con, $resetqr);
				$back = "back";		
					if($back!=""){?>
						<script type="text/javascript">
							window.location="myticket.php";
						</script>
				<?php
					}
			}else{
				$back = "";
			}
		?>
		<div class="col-sm-5 col-5 mt-2">
			<form action="" method="post">
				<button type="submit" name="back" style="font-size:210%; border-radius:40px; background:none; color:white;"><img src="assets/img/icon/back.png"  style="width: 40px; margin-bottom:8px;"></button>
			</form>
			<!-- <a href="myticket.php"><img src="assets/img/icon/back.png"  style="width: 40px;"></a> -->
		</div>
		
		<div class="col-sm-6 col-8 text-right" id="head" >
			<button type="button" class="btn btn-count"><?php echo $u['point'];?></button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="point.php" type="button" class="btn btn-count">+</a>
		</div>
		<?php
		}
		}
		}
		?>
	</div>

	
	<div class="row mt-3">
		<div class="col-sm-12 text-center mt-2">
			<h1>MY TICKET</h1>
		</div>
	</div>


	<?php
	$qrref = bin2hex(random_bytes(10));
	$resetqr = "UPDATE qr SET qr_ref_id = '$qrref' WHERE qr_ticket_id = '$tid';";
	mysqli_query($con, $resetqr);

	$qr = "SELECT e.event_image,e.event_name,e.event_start,e.event_location,t.ticket_id,t.ticket_type,t.ticket_price,t.ticket_status,t.tk_event_id,t.tk_user_id,t.tk_customer_id,q.qr_ref_id FROM event_detail e,ticket t,qr q where t.ticket_id = '$tid' AND t.tk_user_id = '$uid' and q.qr_ticket_id = t.ticket_id and e.event_id = t.tk_event_id;";
	$rqr = mysqli_query($con, $qr);
	if(mysqli_num_rows($rqr)>0){
  		foreach($rqr as $q){
	$item = $q['qr_ref_id'];
	ob_start(); // Start output buffering
	QRcode::png($item, null, QR_ECLEVEL_L, 10, 0); // Generate QR code, but don't output to file
	$imageData = ob_get_clean(); // Get and clean (delete) the output buffer

	// Output the image as a data URI
	?>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2">
			<div class="card-content text-center">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-10 col-10">
							<!-- <img src="assets/img/icon/picture.png" style="width: 100%;"> -->
							<img src="data:image/jpeg;base64,<?php echo base64_encode($c["event_image"]);?>" style=" width:100%; " id="eimage">
        
						</div>
					</div>
					<hr style="border-top: 6px dotted black;">
					<div class="row mt-2">
						<div class="col-sm-12 col-12 text-center">
							<h1 style="color:black;"><?php echo $c["event_name"]; ?></h1>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-sm-8 col-8 text-left">
							<h6>เริ่มงาน :<br><?php echo $start;?><br>
							
							TYPE : <?php echo $c['ticket_type']?><br>
							TID : <?php echo $_GET['tid']?><br>
							PRICE:<?php echo $c['ticket_price']; ?></h6>
						</div>
						 <div class="col-sm-4 col-4 text-right" style="width: 100%;">
							<!-- <img src="assets/img/icon/picture.png" "> -->
					
							<?php echo '<img src="data:image/png;base64,' . base64_encode($imageData) . '" alt="QR Code" style="width: 30%; margin-top:-140px;" >';?> 
				
						</div>

				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>


            <?php
        }
?>
            <?php
	}
		  		}
		  	}
          }
        }
      }
	}
}

?>