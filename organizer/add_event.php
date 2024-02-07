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
if (!isset($_SESSION['ognz_id']) && $_SESSION['ognz_status']!="verified") {
    header("Location:../ognzlogin.php");
  }else{
    $result = getoneognz('ognz_profile',$_SESSION['ognz_id']);
    if(mysqli_num_rows($result)>0)       
          {
          foreach($result as $o)
          {
      {		

	  

//   session_start();
//   ini_set('display_errors', 1);
// if (isset($_SERVER['HTTP_REFERER'])) {
//     $referer = $_SERVER['HTTP_REFERER'];
//     // echo "Referrer URL: " . $referer;
// }else {

// 	session_destroy();
// 	header("Location: ../ognzlogin.php");
// }
// if(!isset($_SESSION['ognz_id'])){
// 	header("Location: ../ognzlogin.php");
// }else {
//     echo "No referrer URL";
// 	session_destroy();
// 	// header("Location: ../ognzlogin.php");
// }


 



  if (isset($_POST['submit'])) {
	if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

		$imagePath = $_FILES['image']['tmp_name'];
				// Get the image data
		$imageData = file_get_contents($imagePath);
	
		$imageBlob = mysqli_real_escape_string($con , $imageData);
			
				// Prepare the SQL statement
	// $upload = "UPDATE event_detail SET event_image = '$imageBlob' WHERE event_id = $eid;";
		// if (mysqli_query($con , $upload)) {
		// 	echo "Image uploaded and updated in the database.";
		// 	header("Location:add_event.php");
		// } else {
		// 	echo "Error updating image: " . mysql_error();
		// }
		
	} else {
		echo "No image file selected.";
	}
      $errorMsg = "";

	  $eventname = mysqli_real_escape_string($con, $_POST['eventname']);
	  $eventlocation = mysqli_real_escape_string($con, $_POST['eventlocation']);
      $date_eventstart  = mysqli_real_escape_string($con, $_POST['date_eventstart']);
	  $time_eventstart  = mysqli_real_escape_string($con, $_POST['time_eventstart']);
      $date_eventend = mysqli_real_escape_string($con, $_POST['date_eventend']);
	  $time_eventend = mysqli_real_escape_string($con, $_POST['time_eventend']);
      $eventcaption = mysqli_real_escape_string($con, $_POST['eventcaption']);

	  $date_sellstart  = mysqli_real_escape_string($con, $_POST['date_sellstart']);
	  $time_sellstart  = mysqli_real_escape_string($con, $_POST['time_sellstart']);
      $date_sellend = mysqli_real_escape_string($con, $_POST['date_sellend']);
	  $time_sellend = mysqli_real_escape_string($con, $_POST['time_sellend']);
      
      

	  $nameticket1 = mysqli_real_escape_string($con, $_POST['nameticket1']);
	  $numticket1 = mysqli_real_escape_string($con, $_POST['quantity1']);
	  $priceticket1 = mysqli_real_escape_string($con, $_POST['price1']);
	  $nameticket2 = mysqli_real_escape_string($con, $_POST['nameticket2']);
	  $numticket2 = mysqli_real_escape_string($con, $_POST['quantity2']);
	  $priceticket2 = mysqli_real_escape_string($con, $_POST['price2']);
	  $share = mysqli_real_escape_string($con, $_POST['share']);

      
    if (empty($eventname)) {
        $errorMsg = "Event Name is empty please try again";
    }else if(empty($eventlocation)) {                 
        $errorMsg  = "Event Location is empty please try again";
    }else if(empty($date_eventstart)) {                   
        $errorMsg  = "Start date is empty please try again";
    }else if(empty($time_eventstart)) {                   
        $errorMsg  = "Start time is empty please try again";
    }else if(empty($date_eventend)) {                   
        $errorMsg  = "End date is empty please try again";
	}else if(empty($time_eventend)) {                 
        $errorMsg  = "End time is empty please try again";
    }else if(empty($eventcaption)) {                   
        $errorMsg  = "Caption is empty please try again";
    }else if(empty($date_sellstart)) {                   
        $errorMsg  = "Sell start date is empty please try again";
    }else if(empty($time_sellstart)) {                   
        $errorMsg  = "Sell start time is empty please try again";
	}else if(empty($date_sellend)) {                   
        $errorMsg  = "Sell end date is empty please try again";
    }else if(empty($time_sellend)) {                   
        $errorMsg  = "Sell end time is empty please try again";
	}else if(empty($nameticket1 && $numticket1 && $priceticket1) && empty($nameticket2 && $numticket2 && $priceticket2)) {                   
        $errorMsg  = "Please create at least 1 type if ticket";
	}else if(empty($share)) {                   
        $errorMsg  = "Share is empty please try again";
    }else{

		$eventstart = $date_eventstart . ' ' . $time_eventstart;
		$eventstart = date('Y-m-d H:i:s', strtotime($eventstart));

		$eventend = $date_eventend . ' ' . $time_eventend;
		$eventend = date('Y-m-d H:i:s', strtotime($eventend));

		$sellstart = $date_sellstart . ' ' . $time_sellstart;
		$sellstart = date('Y-m-d H:i:s', strtotime($sellstart));

		$sellend = $date_sellend . ' ' . $time_sellend;
		$sellend = date('Y-m-d H:i:s', strtotime($sellend));

            $query= "INSERT INTO event_detail(event_sell,event_endsell,event_start,event_end,event_caption,event_name,event_location,event_image,event_status,event_share,event_ognz) 
                    VALUES('$sellstart','$sellend','$eventstart','$eventend','$eventcaption','$eventname','$eventlocation','$imageBlob','pending','$share','$ognz_id')";
            $result = mysqli_query($con, $query);
            

			if ($result == false) {    
                $errorMsg  = "You are not Create..Please Try again";
            }else{
                $errorMsg  = "Create Event Successful!";
				$ev="SELECT event_id FROM event_detail WHERE event_ognz=$ognz_id ORDER BY event_id DESC LIMIT 1 ";
				$ev = mysqli_query($con, $ev);
				foreach($ev as $e ){
					$eventid=$e['event_id'];

				for($t1=0; $t1<$numticket1; $t1++){
					$query1= "INSERT INTO ticket(ticket_status,ticket_price,ticket_type,tk_event_id) 
                    VALUES('inactive',' $priceticket1','$nameticket1','$eventid')";
            	$result = mysqli_query($con, $query1);
				}
				for($t2=0; $t2<$numticket2; $t2++){
					$query2= "INSERT INTO ticket(ticket_status,ticket_price,ticket_type,tk_event_id) 
                    VALUES('inactive',' $priceticket2','$nameticket2','$eventid')";
            	$result = mysqli_query($con, $query2);
				}
				}
				
				
				
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
			<h4>ADD EVENT</h4>
		</div>
		<div class="col-sm-4"></div>
		
		
		<div class="col-sm-2 text-center">
			<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<img src="assets/img/icon/ticket.png" style="width: 30px;"><?php echo $o['point']; ?>point
				</div>
			</div>
		</div>
	</div>


	<div class="row mt-3">
		<div class="col-3" style="float:left;">
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
	<form id="myform" method="POST" action=" " enctype="multipart/form-data">
		<div class="col-9" style="float:right; margin-top:-200px;">
			<div class="card-content-detail">
				<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<div class="row">
						<div class="col-sm-6">
							<img src="no-img.jpg" id="preview" style="width: 100%;">  
							<div class="custom-file">  
							<input type="file" class="custom-file-input" name="image" id="image"> 
							<label class="custom-file-label mt-3" for="image">เพิ่มโปสเตอร์</label>  
							</div>
						</div>
		
		

						<div class="col-sm-6">
							
							
								<div class="form-group">
									<label>ชื่ออีเวนต์ : </label>
									<input type="text" name="eventname" class="form-control">
								</div>
								<div class="form-group">
									<label>สถานที่จัด : </label>
									<input type="text" name="eventlocation"class="form-control">
								</div>
								<div class="form-group">
									<label>วันที่เริ่ม : </label>
									<input type="date" name="date_eventstart" min="<?php echo date('Y-m-d'); ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>เวลาที่เริ่ม : </label>
									<input type="time" name="time_eventstart" class="form-control">
								</div>
								<div class="form-group">
									<label>วันที่สิ้นสุด : </label>
									<input type="date" name="date_eventend" min="<?php echo date('Y-m-d'); ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>เวลาที่สิ้นสุด : </label>
									<input type="time" name="time_eventend" class="form-control">
								</div>
								<div class="form-group">
									<label>รายละเอียดต่างๆ : </label>
									<textarea type="text" name="eventcaption" class="form-control"></textarea>
								</div>
								<br>
								<div class="form-group">
									<label>วันที่ขายบัตร : </label>
									<input type="date" name="date_sellstart" min="<?php echo date('Y-m-d'); ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>เวลาที่ขายบัตร : </label>
									<input type="time" name="time_sellstart" class="form-control">
								</div>
								<div class="form-group">
									<label>วันที่สิ้นสุดขายบัตร : </label>
									<input type="date" name="date_sellend" min="<?php echo date('Y-m-d'); ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>เวลาที่สิ้นสุดขายบัตร : </label>
									<input type="time" name="time_sellend" class="form-control">
								</div>


								<div style="float:left;">
								<div style="font-weight:bold;">บัตร ประเภทที่1 : </div>
								ชื่อบัตร : 
								<input type="text" name="nameticket1" style="width: 150px;">
								<br>
								<br>
								จำนวนบัตร :
								<input type="number" name="quantity1" min="0" value="0" style="width: 80px;">
								<br>
								<br>
								ราคาบัตร :
								<input type="number" name="price1" min="0" value="0" style="width: 80px;">
								</div>
								<div style="float:right;">
								<div style="font-weight:bold;">บัตร ประเภทที่2 : </div> 
								
								ชื่อบัตร : 
								<input type="text" name="nameticket2" style="width: 150px;">
								<br>
								<br>
								จำนวนบัตร :
								<input type="number" name="quantity2" min="0" value="0" style="width: 80px;">
								<br>
								<br>
								ราคาบัตร :
								<input type="number" name="price2" min="0" value="0" style="width: 80px;">
								<br>
								<br>
								</div>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<div class="form-group" style="align:center;">
									<label>หักส่วนแบ่งจากรายได้(เป็น %) : </label>
									<input type="number" name="share" min="0" max="100" class="form-control" style="width: 200px;">
								</div>
								<button type="submit" name='submit' class="btn btn-count" style="margin-top:50px; margin-left:40px; font-size:30px; background-color:green;">บันทึก</button>
							</form>
		
						</div>
					</div>
				</div>
			</div>
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