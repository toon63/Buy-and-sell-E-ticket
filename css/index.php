<?php
include_once('config.php');
include_once('function/myfunction.php');?>
<?php include('comtop.php'); ?>
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
  <style>.mySlides {display:none;}</style>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body >
<!-- 
<?php include('header.php');
if (!isset($_SESSION['id'])) {
  $result = getAll("event_detail"); 
  ?>
  <main class="container">
    <div class="album py-5 ">

  <div class=" px-4">
    <div class="row gx-5" >
  <?php

  if(mysqli_num_rows($result)>0)
    {
        foreach($result as $event)
        {
            ?>

        <div class="col-md-4">
          <a href="event_view.php?event=<?php echo $event["event_id"]; ?>">
              <div class="card shadow-sm" style="margin-bottom: 50px;" >
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($event["event_image"]); ?>"alt="Base64 Image" style=" max-width:500px; max-height:800px;">
                      <div class="card-body" style="width:100%;" >
                          <p class="card-text"><?= $event['event_name']?></p>
                      </div>
              </div>
            </a>
        </div>

      
          <?php
        }
    } else {
        echo "No products found.";
    }
}
else{
  $result = getAll("event_detail"); 
  ?>
  <div class="image-container">
    <div class="text" style="font-size:50px;">WELCOME "<?php echo $u["user_firstname"];?>" </div>
  </div>

  <main class="container">
    <div class="album py-5 ">

  <div class=" px-4">
    <div class="row gx-5" >
  <?php

  if(mysqli_num_rows($result)>0)
    {
        foreach($result as $event)
        {
            ?>

        <div class="col-md-4">
          <a href="event_view.php?event=<?php echo $event["event_id"]; ?>">
              <div class="card shadow-sm" style="margin-bottom: 50px;" >
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($event["event_image"]); ?>"alt="Base64 Image" style=" max-width:500px; max-height:800px;">
                      <div class="card-body" style="width:100%;" >
                          <p class="card-text"><?= $event['event_name']?></p>
                      </div>
              </div>
            </a>
        </div>

      
          <?php
        }
    } else {
        echo "No products found.";
    }
}
?>
   
</div>
</div>
  </div>
  </main> -->

  <div class="container">
	<div class="row mt-3" style="">
		<div class="col-sm-6 col-4 mt-2">
			<img src="assets/img/icon/bell.png" style="width: 40px;">
		</div>
		<div class="col-sm-6 col-8 text-right">
			<button type="button" class="btn btn-count">0</button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="points.php" type="button" class="btn btn-count">+</a>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-sm-12 text-center mt-2">
			<h1>ค้นหาอีเวนต์ที่น่าสนใจ</h1>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 text-center mt-2">
			<input type="text" class="form-control" placeholder="Search..">
		</div>
		<div class="col-sm-2"></div>
	</div>

	<div class="row mt-2">
		<div class="col-sm-12 text-left">
			<h4>NEW!</h4>
			<section class="regular slider">
      <?php
      if(mysqli_num_rows($result)>0)
    {
        foreach($result as $event)
        {
            ?>
				<div>
					<a href="event_view.php?event=<?php echo $event["event_id"]; ?>">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($event["event_image"]); ?>"alt="Base64 Image" style="width: 100%;"></a>
				</div>
				
			</section>
      
		</div>
	</div>
  <?php
      
    }
} else {
    echo "No products found.";
}
?>


<script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>
<script src="slide/slick/slick.js?v2022" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$(document).on('ready', function() {
		$(".regular").slick({
			dots: true,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 4
		});
	});
</script>
<script>
	try {
		fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
			return true;
		}).catch(function(e) {
			var carbonScript = document.createElement("script");
			carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
			carbonScript.id = "_carbonads_js";
			document.getElementById("carbon-block").appendChild(carbonScript);
		});
	} catch (error) {
		console.log(error);
	}
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1VDDWMRSTH"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'G-1VDDWMRSTH');
</script>

<?php include('header.php'); ?>

<div class="navbar" >
	<a href="event.php" class="active">
		<img src="assets/img/icon/home.png" style="width: 30px;">
	</a>
	<a href="ticket.php">
		<img src="assets/img/icon/ticket1.png" style="width: 30px;">
	</a>
	<!-- <a href="#"> -->
		<img src="assets/img/icon/bell1.png" style="width: 30px;">
	<!-- </a> -->
	<a href="profile.php">
		<img src="assets/img/icon/user.png" style="width: 30px;">
	</a>
</div>
</body>
</html>