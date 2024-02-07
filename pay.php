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
$total=$_POST['total'];

include_once('config.php');
include_once('function/myfunction.php');
include('comtop.php');

if (!isset($_SESSION['id'])) {
    header("Location:login.php");
  }else{
	$result = getUser($_SESSION['id']);
	if(mysqli_num_rows($result)>0)       
  	{
	foreach($result as $u)
	{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>


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
</style>
</head>
<body>
<div class="container">
	<div class="row mt-3" style="">
		<div class="col-sm-6 col-4 mt-2">
			<a href="index.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a>
		</div>
		<div class="col-sm-6 col-8 text-right">
			<!-- <button type="button" class="btn btn-count">0</button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="#" type="button" class="btn btn-count">+</a> -->
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-sm-12 text-center mt-2">
			<div class="row" style="">
				<div class="col-sm-5 col-3"></div>
				<div class="col-sm-1 col-3 text-center">
					<h1>POINTS</h1>
				</div>
				<div class="col-sm-1 col-3 text-center">
					<img src="assets/img/icon/ticket.png" style="width: 40px;">
				</div>
				<div class="col-sm-5 col-3"></div>
			</div>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<h5>Your Points</h5>
					<?php echo $u['point'] ?> <img src="assets/img/icon/ticket.png" style="width: 40px;">
				</div>
			</div>
			<small style="color: red;">*แต้มของคุณไม่สามารถแลกกลับเป็นเงินจริงได้ โปรดเติมแต้มอย่างระมัดระวัง*</small>
		</div>
		<div class="col-sm-2"></div>
	</div>

	<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<h5>เติมแต้ม</h5>
					1 <img src="assets/img/icon/ticket.png" style="width: 40px;"> = 1 บาท<br>
                    <?php echo'ราคารวม'.$total; ?>
<form name="checkoutForm" method="POST" action="checkoutpay.php">
		<input type="hidden" name='total' value=<?php echo $total;?> >

 
 <script type="text/javascript" src="https://cdn.omise.co/omise.js"
              data-key="pkey_test_5wb6njkn3rwlgam0dft"
              data-image="https://cdn.omise.co/assets/dashboard/images/omise-logo.png"
              data-amount="<?php echo $total;?>00"
              data-currency="thb"
              data-button-label="ชำระเงิน"
              data-frame-label="E-ticket"
              data-submit-label="ชำระเงิน"
		data-other-payment-methods="promptpay">
      </script>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
    






  <!--the script will render <input type="hidden" name="omiseToken"> for you automatically-->
</form>
<!-- data-key="YOUR_PUBLIC_KEY" -->
</body>
<script>
  $(function() {
      $(':button').click();
  });
</script>

</html>
<?php 
    }
  }
};
?>