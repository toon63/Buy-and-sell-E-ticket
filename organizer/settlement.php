<?php
session_start();
 ini_set('display_errors', 1);  
 include_once('config.php');
  include_once('comtop.php');
  include_once('../function/myfunction.php');

if (!isset($_SERVER['HTTP_REFERER'])) {
	echo "No referrer URL";
	session_destroy();
	header("Location: ../ognzlogin.php");
 } 
else {
     $referer = $_SERVER['HTTP_REFERER'];
     echo "Referrer URL: " . $referer;
}
?>
<?php
$ognz_id=$_SESSION['ognz_id'];
if (!isset($_SESSION['ognz_id'])) {
    header("Location:../ognzlogin.php");
  }else{
    $result = getoneognz('ognz_profile',$_SESSION['ognz_id']);
    if(mysqli_num_rows($result)>0)       
          {
          foreach($result as $o)
          {
      {		

  if (isset($_POST['submit'])) {
      $errorMsg = "";

      $s_amount = mysqli_real_escape_string($con, $_POST['s_amount']);

    if (empty($s_amount)) {
        $errorMsg = "โปรดกรอกจำนวนที่ต้องการเบิก";
	}else{
            
            $query= "INSERT INTO settlement_history(settlement_status,total,sh_ognz_id) 
                    VALUES('pending','$s_amount','$ognz_id')";
            $result = mysqli_query($con, $query);

			if ($result == false) {    
                $errorMsg  = "Please Try again";
            }else{
                $errorMsg  = "Successful!";
            }
      }
  }

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="slide/slick/slick.css?v2022">
<link rel="stylesheet" type="text/css" href="slide/slick/slick-theme.css?v2022">
<style type="text/css">
	.slider {
		width: 100%;
		margin: 20px auto;
	}

	.slick-slide {
		margin: 0px 20px;
	}

	.slick-slide img {
		width: 100%;
	}

	.slick-prev:before,
	.slick-next:before {
		color: black;
	}


	.slick-slide {
		transition: all ease-in-out .3s;
		opacity: .2;
	}

	.slick-active {
		opacity: .5;
	}

	.slick-current {
		opacity: 1;
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
		color: red;
	}

	h4{
		color: white;
	}
	.btn-register {
		border-radius: 15px;
		border: 2px solid white;
		background-color: #7464a1;
		color: #ffffff;
		font-size: 16px;
		cursor: pointer;
		/*color: #fff;
		background-color: #212529;
		border-color: #fff;*/
	}

	.btn-register:hover {
		border-radius: 15px;
		border: 2px solid #212529;
		background-color: white;
		color: #212529;
		font-size: 16px;
		cursor: pointer;
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
<?php
            if (isset($errorMsg)) {
                echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $errorMsg
                      </div>";
            }
        ?>

<div class="container-fluid">
	<div class="row mt-3">
		<a href="../organizer/event.php">
			<div class="col-sm-3 text-center">
				<div class="card-content-detail">
					<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
						<img src="assets/img/icon/home_1.png" style="width: 30px;"> DASHBOARD
					</div>
				</div>
			</a>
	</div>	
		<div class="col-sm-2 text-left mt-3">
			<h4>ส่งคำขอเบิกเงิน</h4>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-3 text-center mt-2">
			
		</div>
		<div class="col-sm-1 mt-2">
			
		</div>
		
		<div class="col-sm-2 text-center">
			<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;" >
					MY POINT : <?php echo $o['point'];?><img src="assets/img/icon/ticket.png" style="width: 30px;">
				</div>
			</div>
		</div>
	</div>


	<div class="row mt-3">
		<div class=" col-3 " style="float:left;">
		<a href="../ognzprofile.php" style="text-decoration: none">
			<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row ">
						<div class="col-sm-2"></div>
							<div class="col-sm-8 text-center">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($o["ognz_image"]);?>" style="width: 60%" >
					
								<p class="card-text mt-3"><?php echo $o['ognz_firstname'];?> <?php echo $o['ognz_lastname'];?></p>
							</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</a>
		</div>
			
	</div>
	<form id="myform" method="POST" action="" enctype="multipart/form-data">
		<div class="col-9" style="float:right; margin-top:-200px;" >
			<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<!-- <div class="row"> -->
						<div class="col-sm-6">
								<div class="form-group">
									<label>จำนวนที่ต้องการเบิก : </label>
									<input type="number" max=<?php echo $o['point'];?> name="s_amount" class="form-control">
								</div>

                                <div class="form-group">
                                    <button type="submit" name='submit' class="btn btn-primary ">ส่งคำขอ</button>
								</div>
                                
                            </form>
		
						</div>
					<!-- </div> -->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col" style="padding:10px;">
          <div class="row mt-4" >
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
              <div class="card " >
                <div class="text-center mt-3" >
                  <h6>ประวัติการเบิกเงิน</h6>
                </div>
                <div class="table-responsive" style="height:300px; overflow:auto;">
                  <table class="table align-items-center" >
                    <tbody>
                      <tr>
                      <td >
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">ชื่อผู้จัด</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">จำนวนที่ขอเบิก</p>
                          </div>
                        </td>
						<td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">วันที่ขอเบิก</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">สถานะ</p>
                          </div>
                        </td>
                      </tr>
                      
                      <?php
                            $ss=getSettlement();
                            if(mysqli_num_rows($ss)>0)       
                            {
                            foreach($ss as $ss)
                            {
                              $s_date = strtotime($ss['settlement_date']);
                              $s_date = date('d F y H:i', $s_date);
                            ?>
                      <tr >
                        <td class="w-30">
                          <!-- <div class="d-flex px-2 py-1 align-items-center"> -->

                            <div class="text-center">
                              <p class=" font-weight-bold mb-0"><?php echo $ss['ognz_firstname'];?></p>
                            </div>
                          
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $ss['total'];?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $s_date;?></p>
                          </div>
                        </td>
						<td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $ss['settlement_status'];?></p>
                          </div>
                        </td>
                      </tr>
                      <?php
                            }
                            }
                            ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
<script type="text/javascript">
	$("#image").on('change',function(){  
		var $this = $(this);  
		const input = $this[0];  
		const fileName = $this.val().split("\\").pop();  
		$this.siblings(".custom-file-label").addClass("selected").html(fileName);  
		if (input.files && input.files[0]) {  
			var reader = new FileReader();  
			reader.onload = function (e) {  
				$('#preview').attr('src', e.target.result).fadeIn('slow');  
			}  
			reader.readAsDataURL(input.files[0]);  
		}  
	});
</script>
<?php
	  }}}}
	  ?>