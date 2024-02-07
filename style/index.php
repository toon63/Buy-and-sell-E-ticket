<?php
include_once('config.php');
include_once('function/myfunction.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body style= "background:#9966CC;">

<?php include('header.php');?>
<div class="w3-content w3-section" style="max-width:500px">
<img src="data:image/jpeg;base64,<?php echo base64_encode($event["event_image"]); ?>"alt="Base64 Image">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>

<main>
  <div class="album py-5 ">
    <div class="container">

<?php
$result = getAll("event_detail");
if(mysqli_num_rows($result)>0)
{
    // Create an HTML table to display the product data
    // Output the product data row by row
    // while ($row = $result->fetch_assoc()) 
    foreach($result as $event)
    {
        ?>
        <div class="container px-4">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 border bg-light">
     <a href="event_view.php?event=<?php echo $event["event_id"]; ?>">
     <div class="card shadow-sm" style="margin-bottom: 50px;" >
            <img src="data:image/jpeg;base64,<?php echo base64_encode($event["event_image"]); ?>"alt="Base64 Image">
                <div class="card-body" >
                    <p class="card-text"><?= $event['event_name']?></p>
                </div>
          </div>
    </a>
     </div>
    </div>
  </div>
</div>

      <!-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" >
        <div class="col">
        <a href="event_view.php?event=<?php echo $event["event_id"]; ?>">
          <div class="card shadow-sm" style="margin-bottom: 50px;" >
            <img src="data:image/jpeg;base64,<?php echo base64_encode($event["event_image"]); ?>"alt="Base64 Image">
                <div class="card-body" >
                    <p class="card-text"><?= $event['event_name']?></p>
                </div>
          </div>
        </a>
        </div>
        
      </div> -->
      <?php
    }
} else {
    echo "No products found.";
};
?>
    </div>
  </div>
  </main>
</body>
</html>