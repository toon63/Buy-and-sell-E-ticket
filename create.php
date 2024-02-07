<?php
session_start();
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    // echo "Referrer URL: " . $referer;
	
} else {
    echo "No referrer URL";
	session_destroy();
	header("Location: ognzlogin.php");
}
  include_once('config.php');
  
  if (isset($_POST['submit'])) {
      
      $errorMsg = "";

      $eventstart  = mysqli_real_escape_string($con, $_POST['eventstart']);
      $eventend = mysqli_real_escape_string($con, $_POST['eventend']);
      $eventcaption = mysqli_real_escape_string($con, $_POST['eventcaption']);
      $eventname = mysqli_real_escape_string($con, $_POST['eventname']);
      $eventlocation = mysqli_real_escape_string($con, $_POST['eventlocation']);
      $eventseat = mysqli_real_escape_string($con, $_POST['eventseat']);

      
    if (empty($eventname)) {
        $errorMsg = "Event Name is empty please try again";
    }else if(empty($eventlocation)) {                 
        $errorMsg  = "Event Location is empty please try again";
    }else if(empty($eventcaption)) {                   
        $errorMsg  = "Event Caption is empty please try again";
    }else if(empty($eventstart)) {                   
        $errorMsg  = "Event Start is empty please try again";
    }else if(empty($eventend)) {                   
        $errorMsg  = "Event End is empty please try again";
    }else if(empty($eventseat)) {                   
        $errorMsg  = "Event Seat is empty please try again";
        }else{
            
            $query= "INSERT INTO event_detail(event_start,event_end,event_caption,event_name,event_location,event_max,event_status) 
                    VALUES('$eventstart','$eventend','$eventcaption','$eventname','$eventlocation','$eventseat','pending')";
            $result = mysqli_query($con, $query);
            if ($result == true) {    
                $errorMsg  = "Create Event Successful!";
            }else{
                $errorMsg  = "You are not Create..Please Try again";
            }
      }
  }

?>
<!Doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<body style="background:#660099;">
<div class="container" style="margin-top:50px">
<h1 style="text-align: center; font-size:50px; font-weight:bold; color:white;">CREATE EVENT</h1><br>
  <div class="row">
    <div class="col-md-4"></div>
      <div class="col-md-4">
      <?php
            if (isset($errorMsg)) {   //ถ้าerrorมีค่าจะแสดงค่าของerrorออกมา
                echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $errorMsg
                      </div>";
            }
        ?>
        <form action="" method="POST">
        <p style="color:white; font-weight:bold; font-size:20px;">Event Name</p>
          <div class="form-group">
             <input type="text" class="form-control" name="eventname" placeholder="Event Name" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">Event Caption</p>
          <div class="form-group">
             <input type="text" class="form-control" name="eventcaption" placeholder="Event Caption" required="">
          </div>
          <p style="color:white; font-weight:bold; font-size:20px;">Event Location</p>
          <div class="form-group">
             <input type="text" class="form-control" name="eventlocation" placeholder="Event Location" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">Event Start</p>
          <div class="form-group">
             <input type="datetime" class="form-control" name="eventstart" placeholder="Event Start" required="">
          </div>
          <p style="color:white; font-weight:bold; font-size:20px;">Event End</p>
          <div class="form-group">
             <input type="datetime" class="form-control" name="eventend" placeholder="Event End" required="">
          </div>
        <p style="color:white; font-weight:bold; font-size:20px;">Event Seat</p>
          <div class="form-group">
             <input type="number" class="form-control" name="eventseat" placeholder="Event Seat" required="">
          </div>
        
          <input type="submit" class="w3-btn w3-xxmedium w3-button w3-black w3-round-medium" style="margin-left:35%" name="submit" value="Submit">  
        </form>
      </div>
    </div>
  </div>
</body>
</html>