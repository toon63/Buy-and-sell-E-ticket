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
					<!-- <form>
						<input type="text" class="form-control text-center" placeholder="ใส่จำนวนแต้ม...">
						<small>*ขั้นต่ำ 100*</small><br>
						<small style="color: red;">*ยังไม่รวมค่าธรรมเนียม*</small>

						<div class="row mt-2">
							<div class="col-sm-12 text-center">
								<a href="pay.php" type="submit" class="btn btn-login">เติมแต้ม</a>
							</div>
						</div>
					</form> -->
					<form name="checkoutForm" method="POST" action="pay.php">
						<small>*ขั้นต่ำ 100*</small><br>
						
						<input type="number" name="total" id="total" min="100" class="form-control text-center" style='margin-bottom:10px;' placeholder="ใส่จำนวนแต้ม...">
						<!-- <input type="submit" name="submit" value="เติมเงิน" /> -->
						<small style="color: red;">*ยังไม่รวมค่าธรรมเนียม*</small>
						<div class="col-sm-12 text-center">
						<input type="submit" name="submit" class="btn btn-login" value="เติมเงิน" />
						<!-- <a href="pay.php" type="submit" class="btn btn-login">เติมแต้ม</a> -->
						</div>
					</form>

				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>

	<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-6 col-6 mt-1">
							100 แต้ม
						</div>
						<div class="col-sm-6 col-6">
						<form name="checkoutForm" method="POST" action="pay.php">
						
							<input type="hidden" name="total" id="total" value="100">
							<input type="submit" name="submit" class="btn btn-login" value="เติมเงิน" />
						</form>
						<!-- <a href="pay.php" type="submit" class="btn btn-login" name="submit" value="100" >เติมแต้ม</a> -->
						
					</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>

	<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-6 col-6 mt-1">
							200 แต้ม
						</div>
						<div class="col-sm-6 col-6">
						<form name="checkoutForm" method="POST" action="pay.php">
						
						<input type="hidden" name="total" id="total" value="200">
						<input type="submit" name="submit" class="btn btn-login" value="เติมเงิน" />
					</form>
					<!-- <a href="pay.php" type="submit" class="btn btn-login" name="submit" value="100" >เติมแต้ม</a> -->
					
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>

	<div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content-detail" style="margin-bottom: 62px;">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-6 col-6 mt-1">
							300 แต้ม
						</div>
						<div class="col-sm-6 col-6">
					<form name="checkoutForm" method="POST" action="pay.php">
						<input type="hidden" name="total" id="total" value="300">
						<input type="submit" name="submit" class="btn btn-login" value="เติมเงิน" />
					</form>
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
};
?>