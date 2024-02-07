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
		font-size: 30px;
		color: white;
	}
	small{
		color: white;
	}

	h4{
		color: white;
	}
	@media screen and (max-width: 390px) {
	
	  h1{
		font-size: 20px;
		color: white;
		text-align:center;
		margin-top:30px;
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
			<h1>TRANSACTION HISTORY</h1>
		</div>
	</div>
    <?php
$query = tshistory($_SESSION['id']);
if(mysqli_num_rows($query)>0){
	foreach($query as $ts){
		$ts_date= strtotime($ts['transaction_date']);
		$ts_date = date('d F y เวลา H:i น.', $ts_date);
        if($ts['status'] == 'buy'){?>
    <div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
					<img src="data:image/jpeg;base64,<?php echo base64_encode($ts["event_image"]); ?>"alt="Base64 Image" style="width: 50%; float:left;">
                    <h1 style = "color:red;">ซื้อบัตร<br> -<?php echo $ts['point'];?><br><br>
					วันที่ทำรายการ <br> <?php echo $ts_date;?></h1>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
        <?php
        }elseif($ts['status'] == 'selling'){?>
        <div class="row mt-2 mb-4">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
					<img src="data:image/jpeg;base64,<?php echo base64_encode($ts["event_image"]); ?>"alt="Base64 Image" style="width: 50%; float:left;">
                    <h1 style = "color:black;">ทำการขายบัตร<br><br>
					วันที่ทำรายการ <br><?php echo $ts_date;?></h1>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
        <?php
        }elseif($ts['status'] == 'sold'){?>
            <div class="row mt-2 mb-4">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 text-center mt-2">
                <div class="card-content-detail">
                    <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px; background-color:white;">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($ts["event_image"]); ?>"alt="Base64 Image" style="width: 50%; float:left;">
                        <h1 style = "color:green;">ขายบัตร <br>+<?php echo $ts['point'];?><br><br>
						วันที่ทำรายการ<br> <?php echo $ts_date;?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <?php
            }
        }
        }
    }
}
    }
}
?>