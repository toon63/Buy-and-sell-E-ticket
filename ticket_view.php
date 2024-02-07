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


        if($event)
        {
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
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    // This button will increment the value
		$('.qtyplus').click(function(e){
        // Stop acting like a button
			e.preventDefault();
        // Get the field name
			var fieldName = $(this).prev();
        // Get its current value
			var currentVal = parseInt(fieldName.val());
        // If is not undefined
			if (!isNaN(currentVal )&& currentVal < 5) {
            // Increment
				fieldName.val(currentVal + 1);
			} else {
            // Otherwise put a 0 there
				fieldName.val(5);
			}
		});
    // This button will decrement the value till 0
		$(".qtyminus").click(function(e) {
        // Stop acting like a button
			e.preventDefault();
        // Get the field name
			var fieldName = $(this).next();
        // Get its current value
			var currentVal = parseInt(fieldName.val());
        // If it isn't undefined or its greater than 0
			if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
				fieldName.val(currentVal - 1);
			} else {
            // Otherwise put a 0 there
				fieldName.val(0);
			}
		});
	});
</script>
<div class="container">
    <div class="row mt-3">
 
        <div class="col-sm-6 col-4 mt-2">
			<a href="index.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a>
		</div>
		<div class="col-sm-6 col-8 text-right">
			<button type="button" class="btn btn-count"><?php echo $u['point'];?></button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="point.php" type="button" class="btn btn-count">+</a>
</div>
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

    <form method="post" action="checkout.php?event=<?php echo $event_slug;?>">
        <?php
        $result1 = getTicketType1($event_slug);
        if(mysqli_num_rows($result1)>0)
        {
            foreach($result1 as $tk1)
            {
                ?>
            <div class="row mt-2">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 text-center mt-2">
                    <div class="card-content-detail">
                        <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
                            <div class="row mt-2">
                                <div class="col-sm-6 col-6">
                                <?php
                                        $count1 = num_t1($tk1['ticket_type'], $event_slug);
                                            if(mysqli_num_rows($count1)>0)
                                            {foreach($count1 as $c1)
                                                {
                                                    ?>
                                        <input type="hidden" name="type1" id="type1" value="<?php echo $tk1['ticket_type']; ?>">
                                        <input type="hidden" name="hdf_price1" id="hdf_price1" value="<?php echo $tk1['ticket_price']; ?>"> 
                                        <input type="number" style=" margin-bottom:10px;  width:100px" id="txt_regular_num" name="txt_regular_num" value=0 min=0 max="<?php echo $c1['t1_left']; ?>" onchange="calulate_price()">

                                                        <p style="color:yellow; float:right;">คงเหลือ<?php echo $c1['t1_left']; ?></p>
                                                    <?php
                                                }
                                            }
                                        ?>
                                            <!-- <option value="0">Select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select> -->
                                </div>
                                <div class="col-sm-6 col-6">
                                    <?php echo $tk1['ticket_type']; ?> <?php echo $tk1['ticket_price']; ?> <img src="assets/img/icon/ticket.png" style="width: 40px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <?php
            }
        } else {?>
            <div class="row mt-2">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 text-center mt-2">
                    <div class="card-content-detail">
                        <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
                            <div class="row mt-2">
                                    <h1 style ="color:yellow; text-align:center;">บัตรประเภทนี้หมดแล้ว</h1>
                                    <input type="hidden" name="type1" id="type1" value="0">
                                    <input type="hidden" name="hdf_price1" id="hdf_price1" value="0">
                                    <input type="hidden" name="txt_regular_num" id="txt_regular_num" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        <?php
        };
        ?>

        <?php
        $result2 = getTicketType2($event_slug);
        if(mysqli_num_rows($result2)>0)
        {
            foreach($result2 as $tk2)
            {
                ?>
            <div class="row mt-2">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 text-center mt-2">
                    <div class="card-content-detail">
                        <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
                            <div class="row mt-2">
                                <div class="col-sm-6 col-6">
                                <?php
                                        $count2 = num_t2($tk2['ticket_type'], $event_slug);
                                            if(mysqli_num_rows($count1)>0)
                                            {foreach($count2 as $c2)
                                                {
                                                    ?>
                                        <input type="hidden" name="type2" id="type2" value="<?php echo $tk2['ticket_type']; ?>">
                                        <input type="hidden" name="hdf_price2" id="hdf_price2" value="<?php echo $tk2['ticket_price']; ?>"> 
                                        <input type="number" style=" margin-bottom:10px; width:100px;" id="txt_vip_num" name="txt_vip_num" value=0 min=0 max="<?php echo $c2['t2_left']; ?>" onchange="calulate_price()">

                                                        <p style="color:yellow; float:right;">คงเหลือ<?php echo $c2['t2_left']; ?></p>
                                                    <?php
                                                }
                                            }
                                        ?>
                                            <!-- <option value="0">Select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select> -->
                                </div>
                                <div class="col-sm-6 col-6">
                                    <?php echo $tk2['ticket_type']; ?> <?php echo $tk2['ticket_price']; ?> <img src="assets/img/icon/ticket.png" style="width: 40px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <?php
            }
        } else {?>
            <div class="row mt-2">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 text-center mt-2">
                    <div class="card-content-detail">
                        <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
                            <div class="row mt-2">
                                    <h1 style ="color:yellow; text-align:center;">บัตรประเภทนี้หมดแล้ว</h1>
                                    <input type="hidden" name="type2" id="type2" value="0">
                                    <input type="hidden" name="hdf_price2" id="hdf_price2" value="0">
                                    <input type="hidden" name="txt_vip_num" id="txt_vip_num" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        <?php
        };
        ?>
       <!-- <button class="w3-button w3-pink w3-border"> <input type="hidden" name="txt_price_total" id="txt_price_total"><span id="allprice">กรุณาเลือกบัตร</span></button> -->
        
        <div class="row mt-2 mb-4">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 text-center mt-2">
                <div class="card-content" style="margin-bottom: 62px;">
                    <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
                    <input type="hidden" name="txt_price_total" id="txt_price_total"><span id="allprice">กรุณาเลือกบัตร</span> <img src="assets/img/icon/ticket.png" style="width: 40px;">

                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-login">ชำระแต้ม</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    
    </form>
    </div>  
<script>
function calulate_price()
{   
    var regular_price = document.getElementById("hdf_price1").value;
    var vip_price = document.getElementById("hdf_price2").value;
    var regular_num = document.getElementById("txt_regular_num").value;
    var vip_num = document.getElementById("txt_vip_num").value;
    //กำหนดค่าตัวแปรเริ่มต้น
    var total_regular_price = 0;
    var total_vip_price = 0;
    var total_price = 0;

    //คำนวนราคา Regular
    if (regular_num != "")
    {
        total_regular_price = regular_price * regular_num;
    }

    //คำนวนราคา vip
    if (vip_num != "")
    {
        total_vip_price = vip_price * vip_num;
    }

    //คำนวณราคารวม
    total_price = total_regular_price + total_vip_price;
    
    //แสดงผลบน textbox เพื่อดึงค่าเก็บไว้ใน database
    document.getElementById("txt_price_total").value = total_price;
    // document.getElementById("total_price").textContent=txt_price_total;
    document.getElementById("allprice").innerHTML=total_price;
    
   }

</script>


<?php

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
}}
?>
</body>
</html>