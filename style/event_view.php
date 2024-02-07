<?php

include_once('config.php');
include_once('function/myfunction.php');

if(isset($_GET['event']))
{
    $event_slug = $_GET['event'];
    $event_data = getOne("event_detail",$event_slug);
    $event = mysqli_fetch_array($event_data);

    $ticket_data = getMinprice("ticket_price","ticket",$event_slug);
    $ticket = mysqli_fetch_array($ticket_data);

    if($event)
    {
        
        include_once('header.php');
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PHP Password hash Login in PHP Mysql</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body style= "background:#9966CC;">
        <div class="container">
            <!-- <div class="row">
                <div class="col-md-4"> -->
                        <div class="card" style="text-align:center; width:60%; hight:20%; max-margin-left:30%;">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($event["event_image"]); ?>" alt="Base64 Image">
                                <div class="card-body">
                            <h4><?php echo $event['event_name']; ?></h4>
                            <p>เริ่ม : <?php echo $event['event_start']; ?></p>
                            <p>สิ้นสุด :<?php echo $event['event_end']; ?></p>
                            <p>ราคาเริ่มต้น : <?php echo $ticket['MIN(ticket_price)']; ?> บาท</p>
                            <p><?php echo $event['event_caption']; ?></p>
                            <a href="ticket_view.php?event=<?php echo $event["event_id"]; ?>">
                                <button class="w3-button w3-pink w3-border" >BUY</button>
                            </a>
                            
                    </div>
                <!-- </div>
        </div> -->
    </div>
    </div>
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
}
?>
</body>
</html>

