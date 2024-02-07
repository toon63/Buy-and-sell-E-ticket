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
    if(isset($_GET['event']))
    {
        $event_slug = $_GET['event'];
        $event_data = getOne("event_detail",$event_slug);
        $event = mysqli_fetch_array($event_data);

        $result = getUser($_SESSION['id']);
        $u = mysqli_fetch_array($result);

        include('comtop.php');

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
</head>
<div class="container">
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
                        <h3><?php echo $event['event_name']; ?></h3>
                        <span><?php echo $event['event_start']; ?></span><br>
                        <span><?php echo $event['event_location']; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 text-center mt-2">
                <div class="card-content">
                    <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
                            <h2 style="color : green; font-size : 210%;">สั่งซื้อสำเร็จ!</h2>
                            <p>รายการสั่งซื้อ</p>
                            <?php 
                                $buyer = $_SESSION['id'];
                                if($_SESSION['txt_regular_num'] > 0 && $_SESSION['txt_vip_num'] == '0'){?>
                                    <p><?php echo $_SESSION['type1']," จำนวน ",$_SESSION['txt_regular_num']," ใบ "?></p>
                                <?php 
                                }
                                elseif ($_SESSION['txt_regular_num'] == '0' && $_SESSION['txt_vip_num'] > '0'){?>
                                    <p><?php echo $_SESSION['type2']," จำนวน ",$_SESSION['txt_vip_num']," ใบ "?></p>
                                <?php 
                                }
                                elseif ($_SESSION['txt_regular_num'] > 0 && $_SESSION['txt_vip_num'] > '0'){?>
                                    <p><?php echo $_SESSION['type1']," จำนวน ",$_SESSION['txt_regular_num']," ใบ "?></p>
                                    <p><?php echo $_SESSION['type2']," จำนวน ",$_SESSION['txt_vip_num']," ใบ "?></p>
                                <?php 
                                }
                                transaction_history($con, $_SESSION['type1'] , $_SESSION['type2'] , $_SESSION['txt_regular_num'] , $_SESSION['txt_vip_num'] , $_SESSION['hdf_price1'] , $_SESSION['hdf_price2'] , $buyer, $event_slug)
                                ?>
                            <p>รวม <?php echo $_SESSION['txt_price_total']," แต้ม"?></p>
                            <a href="myticket.php">
                                <button class="btn btn-login">ไป My Ticket</button>
                            </a>
                    </div>
                    </div>
                </div>
                    
<?php
}
else
{
    echo "Something went wrong";    
}}
?>
</body>
</html>