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
include_once('comtop.php'); 
if(isset($_GET['event']))
{
    $event_slug = $_GET['event'];
    $event_data = getOne("event_detail",$event_slug);
    $event = mysqli_fetch_array($event_data);

    $ticket_data = getMinprice("ticket_price","ticket",$event_slug);
    $ticket = mysqli_fetch_array($ticket_data);

    if($event)
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
	p{
		font-size:20px;
	}
	span{
		font-size:20px;
	}
	@media screen and (max-width: 390px) {
	p{
		font-size:18px;
	}
	span{
		font-size:18px;
	}
	
}
	
</style>
<script>
    function updateCountdown() {
      $.ajax({
        url: 'event_view.php?event=<?php echo $event_slug ?>', // Replace with the actual filename of your PHP file
        method: 'GET',
        success: function(response) {
          $('#countdown').html(response); // Update the countdown in the HTML element
        },
        error: function(xhr, status, error) {
          console.error(error); // Log any errors to the console
        },
        complete: function() {
          setTimeout(updateCountdown, 1000); // Call the function again after 1 second (1000 milliseconds)
        }
      });
    }

    // Call the function initially
    updateCountdown();
  </script>
<!-- <body  style="background:#9999CC;"> -->
<div class="container">
	<div class="row mt-3">
		<!-- <div class="col-sm-6 col-4 mt-2">
			<a href="index.php"><img src="assets/img/icon/back.png"  style="width: 40px;"></a>
		</div> -->
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
		?>
		
		<div class="col-sm-6 col-4 mt-2">
			<a href="index.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a>
		</div>
		<div class="col-sm-6 col-8 text-right">
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
			<h1>EVENT</h1>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<img src="data:image/jpeg;base64,<?php echo base64_encode($event["event_image"]); ?>" alt="Base64 Image" style="width: 50%;">
		</div>
		<div class="col-sm-2"></div>
	</div>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				<?php 
                    $sell = strtotime($event['event_sell']);
                    $end = strtotime($event['event_endsell']);
                    $start = strtotime($event['event_start']);
                    $end= strtotime($event['event_end']);

				    $sellDatetime = date('d F y / H:i', $sell);
					$endsellDatetime = date('d F y / H:i', $end);
					$startDatetime = date('d F y / H:i', $start);
					$endDatetime = date('d F y / H:i', $end);
				?>
					<h3><?php echo $event['event_name']; ?></h3>
					<span>วางขาย : <?php echo $sellDatetime; ?></span><br>
					<span>หยุดขาย : <?php echo $endsellDatetime; ?></span><br>
					<span>เริ่ม : <?php echo $startDatetime; ?><br>สิ้นสุด :<?php echo $endDatetime; ?></span><br>
					<span><?php echo $event['event_location']; ?></span>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<span><?php echo $event['event_caption']; ?></span><br>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
	<?php 
$current_datetime = date("Y-m-d H:i:s");
if($event['event_sell'] <= $current_datetime && $current_datetime <= $event['event_endsell']){
	
	// Calculate the remaining time
	$targetDate = strtotime($event['event_endsell']); // Replace with your target date and time
	$currentDate = time();
	$remainingTime = $targetDate - $currentDate;

	// Format the remaining time as desired (e.g., days, hours, minutes, seconds)
	$days = floor($remainingTime / (60 * 60 * 24));
	$hours = floor(($remainingTime % (60 * 60 * 24)) / (60 * 60));
	$minutes = floor(($remainingTime % (60 * 60)) / 60);
	$seconds = $remainingTime % 60;

	// Create the countdown string
	$countdown = sprintf('%02d วัน %02d ชั่วโมง %02d นาที %02d วินาที', $days, $hours, $minutes, $seconds);
?>
	<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content" style="margin-bottom: 62px;">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				<p style="color:red; font-size:16px;">หยุดขายใน <?php echo $countdown; ?></p>
        		<span>ราคาเริ่มต้น : <?php echo $ticket['MIN(ticket_price)']; ?> บาท</span><img src="assets/img/icon/ticket.png" style="width: 40px;">

					<div class="row">
						<div class="col-sm-12 text-center">
							<a href="ticket_view.php?event=<?php echo $event["event_id"]; ?>" type="submit" class="btn btn-login">ซื้อ</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
<?php
    }elseif($event['event_sell'] >= $current_datetime && $current_datetime <= $event['event_endsell']){
		// Calculate the remaining time
	$targetDate = strtotime($event['event_sell']); // Replace with your target date and time
	$currentDate = time();
	$remainingTime = $targetDate - $currentDate;

	// Format the remaining time as desired (e.g., days, hours, minutes, seconds)
	$days = floor($remainingTime / (60 * 60 * 24));
	$hours = floor(($remainingTime % (60 * 60 * 24)) / (60 * 60));
	$minutes = floor(($remainingTime % (60 * 60)) / 60);
	$seconds = $remainingTime % 60;

	// Create the countdown string
	$countdown = sprintf('%02d วัน %02d ชั่วโมง %02d นาที %02d วินาที', $days, $hours, $minutes, $seconds);

		?>
<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content" style="margin-bottom: 62px;">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
  					<div>
						<h2>เริ่มวางขายใน</h2>
						<p  style="color:red; font-size:16px;"><?php echo $countdown; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
	<?php
}elseif($event['event_endsell'] < $current_datetime){
	// Calculate the remaining time
$targetDate = strtotime($event['event_sell']); // Replace with your target date and time
$currentDate = time();
$remainingTime = $targetDate - $currentDate;

// Format the remaining time as desired (e.g., days, hours, minutes, seconds)
$days = floor($remainingTime / (60 * 60 * 24));
$hours = floor(($remainingTime % (60 * 60 * 24)) / (60 * 60));
$minutes = floor(($remainingTime % (60 * 60)) / 60);
$seconds = $remainingTime % 60;

// Create the countdown string
$countdown = sprintf('%02d วัน %02d ชั่วโมง %02d นาที %02d วินาที', $days, $hours, $minutes, $seconds);

	?>
<div class="row mt-2 mb-4">
	<div class="col-sm-2"></div>
	<div class="col-sm-8 text-center mt-2">
		<div class="card-content" style="margin-bottom: 62px;">
			<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				  <div>
					<h2  style="color:red;">หมดเวลาวางขายแล้ว</h2>
					</div>
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
    else
    {
        echo "$event";
        echo "event not found";
    }
}
else
{
    echo "Something went wrong";    
}
?>

