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
    if(isset($_GET['event']) && $_POST['txt_price_total']>0)
    {
        $result = getUser($_SESSION['id']);
        $u = mysqli_fetch_array($result);

        $event_slug = $_GET['event'];
        $event_data = getOne("event_detail",$event_slug);
        $event = mysqli_fetch_array($event_data);
        
        $_SESSION['type1'] = $_POST['type1'];
        $_SESSION['type2'] = $_POST['type2'];
        $_SESSION['hdf_price1'] = $_POST['hdf_price1'];
        $_SESSION['txt_regular_num'] = $_POST['txt_regular_num'];
        $_SESSION['hdf_price2'] = $_POST['hdf_price2'];
        $_SESSION['txt_vip_num'] = $_POST['txt_vip_num'];
        $_SESSION['txt_price_total'] = $_POST['txt_price_total'];

        $redirectURL = "ticket_view.php?event=$event_slug";

        $countdownDuration = 50;

        ob_start();

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
<script>
        // Countdown function
        function countdown() {
            var seconds = <?php echo $countdownDuration; ?>;
            var countdownElement = document.getElementById("countdown");

            var countdownInterval = setInterval(function() {
                countdownElement.textContent = seconds;

                if (seconds <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = "<?php echo $redirectURL; ?>";
                }

                seconds--;
            }, 1000);
        }
    </script>
<body onload="countdown()">
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
                                    <h>สรุปรายการสั่งซื้อ</h>
                    <?php
                     if ($_SESSION['txt_regular_num'] != 0){
                        $result1 = getTicketType1($event_slug);
                        if(mysqli_num_rows($result1)>0)
                        {
                            foreach($result1 as $tk1)
                            {?>
                                <!-- <div class="card"> -->
                                    <div class="card-body">
                                        <h2><?php echo $tk1['ticket_type']; ?></h2>
                                        <p>ราคา <?php echo $_SESSION['hdf_price1'] ?> X <?php echo $_SESSION['txt_regular_num']?></p>
                                    </div>
                                <!-- </div> -->
                            <?php
                            }
                        } 
                        else {
                            echo "not found";
                        };
                    }
                    else if($_SESSION['txt_regular_num'] = 0){
                        echo " ";
                    }
                    ?>
                    </div>
                    <div class="card-body">
                    <?php
                     if ($_SESSION['txt_vip_num'] != 0){
                        $result2 = getTicketType2($event_slug);
                        if(mysqli_num_rows($result2)>0)
                        {
                            foreach($result2 as $tk2)
                            {?>
                                <!-- <div class="card"> -->
                                    <div class="card-body">
                                        <h2><?php echo $tk2['ticket_type']; ?></h2>
                                        <p>ราคา <?php echo $_SESSION['hdf_price2'] ?> X <?php echo $_SESSION['txt_vip_num']?></p>
                                    </div>
                                <!-- </div> -->
                            <?php
                            }
                        } 
                        else {
                            echo "not found";
                        };
                    }
                    else if($_SESSION['txt_vip_num'] = 0){
                        echo " ";
                    }
                    ?>
                    <div class="w3-panel w3-padding-16 w3-orange">
                        <div class="card-body">
                            <h1 style="color:black;">รวมสุทธิ <?php echo $_SESSION['txt_price_total'] ?> บาท</h1>
                        </div>
                    </div>
                    
                <?php if ($u["point"] < $_SESSION['txt_price_total']){?>
                    <p>จำนวนแต้มไม่เพียงพอ</p>
                    <a href="point.php">
                        <button class="btn btn-login">เติมแต้ม</button>
                    </a>
                    <?php
                    }else{?>
                        <p style="color:black;">กรุณายืนยันคำสั่งซื้อก่อน <span id="countdown"><?php echo $countdownDuration; ?></span> วินาที</p>
                        <a href="buy_process.php?event=<?php echo $event["event_id"]; ?>">
                            <button class="btn btn-login">ยืนยันคำสั่งซื้อ</button>
                        </a>
                    <?php
                    };
                 ?>
                
                </div>
                   
<?php
}
else
{
    header("Location: ticket_view.php?event=$_GET[event]");
    echo "กรุณาเลือกจำนวนบัตร";
}}
?>
</body>
</html>