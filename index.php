<?php 
session_start();
include('comtop.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="slide/slick/slick.css?v2022">
<link rel="stylesheet" type="text/css" href="slide/slick/slick-theme.css?v2022">
<style type="text/css">
	#head{
		margin-left:800px;
	}
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
	h2{
		font-size: 30px;
		color: white;
		margin-right:300px;
	}
	small{
		color: white;
	}

	h4{
		color: white;
		
	}
	.event_list{
		width: 40vh;
		height: 40vh;
		position: relative;
  	}
	section{
		height: 100%;
	}
	@media screen and (max-width: 390px) {
	.slick-slide img {
		width: 360%;
		padding-right : 100px ;
	}
  	.event_list{
		width: 100%; 
		height: 130px;
  	}
	  h1{
		font-size: 25px;
		color: white;
	}
	#head{
		margin-left:0px;
	}
	h2{
		font-size: 25px;
		color: white;
		margin-left:15px;
	}
	
}

</style>
<?php

include_once('function/myfunction.php');
$result = getAllStartEvent("event_detail"); 
$result2 = getAllSellingEvent("event_detail"); 
$result3 = getAllSoonEvent("event_detail"); 
$result5 = getAll("event_detail"); 

?>
<div class="container">
	<div class="row mt-3">
<?php
if (isset($_SERVER['HTTP_REFERER'])) {
	$referer = $_SERVER['HTTP_REFERER'];
	// echo "Referrer URL: " . $referer;
	
} else {
	unset($_SESSION['id']);
	// echo "No referrer URL";
	session_destroy();
	// header("Location: login.php");
}

		if (!isset($_SESSION['id'])) {
?>
		<div class="col-sm-6 col-4 mt-2">
		</div>
		<div class="col-sm-6 col-8 text-right">
			<a href="register.php" type="button" class="btn btn-count">
				REGISTER
			</a>
			<a href="login.php" type="button" class="btn btn-count">
				LOGIN 
			</a>
		</div>
	
<?php
	}else{
		$query = getUser($_SESSION['id']);
		if(mysqli_num_rows($query)>0){
        foreach($query as $u)
        {
?>		
		<div class="col-sm-5 col-12 text-right" id="head" >
			<button type="button" class="btn btn-count"><?php echo $u['point'];?></button> 
			<img src="assets/img/icon/ticket.png" style="width: 60px;"> 
			<a href="point.php" type="button" class="btn btn-count">+</a>
		</div>

		<div class="col-sm-5 col-4 mt-2">
		</div>
		<div class="col-sm-5 col-4 text-center mt-2">
			<h2>สวัสดี <?php echo $u['user_firstname'];?></h2>
		</div>

		

<?php
		}
	}
}

?>

	</div>
	
	
	<div class="row mt-2">
		<div class="col-sm-12 text-center mt-2">
			<h1>ค้นหาอีเวนต์ที่น่าสนใจ</h1>
		</div>
	</div>
	
	<form method="POST" action="">
		<div class="row mt-2">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 text-center mt-2">
				<input type="text" name="input_search" class="form-control" placeholder="Search..">
			</div>
			<div class="col-sm-1 text-center mt-2">
				<button type="submit" name="search" class="btn btn-count">ค้นหา</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
		
	</form>
	<?php
	if(isset($_POST['search'])){
		$search_result = findEvent($_POST['input_search']);
		?>
		<div class="row mt-2">
		<div class="col-sm-12 text-left">
			<h4>Search Result</h4>
			<section class="regular slider ">
<?php
			if(mysqli_num_rows($search_result)>0)
    {
        foreach($search_result as $es)
        {
?>
				<div>
					<a href="event_view.php?event=<?php echo $es["event_id"]; ?>"><img src="data:image/jpeg;base64,<?php echo base64_encode($es["event_image"]); ?>" class="event_list"></a>
				</div>
<?php
		}
	}
?>
			</section>
		</div>
	</div>
	<?php
	}
?>
<div class="row">
		<div class="col-sm-12 text-left">
			<h4>Coming Soon!</h4>
			<section class="regular slider">
<?php
			if(mysqli_num_rows($result3)>0)
    {
        foreach($result3 as $event3)
        {
?>
				<div>
					<a href="event_view.php?event=<?php echo $event3["event_id"]; ?>"><img src="data:image/jpeg;base64,<?php echo base64_encode($event3["event_image"]); ?>" class="event_list"></a>
				</div>
<?php
		}
	}
?>
			</section>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-left">
			<h4>Selling!</h4>
			<section class="regular slider">
<?php
			if(mysqli_num_rows($result2)>0)
    {
        foreach($result2 as $event2)
        {
?>
				<div>
					<a href="event_view.php?event=<?php echo $event2["event_id"]; ?>"><img src="data:image/jpeg;base64,<?php echo base64_encode($event2["event_image"]); ?>" class="event_list"></a>
				</div>
<?php
		}
	}
?>
			</section>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-left">
			<h4>All event</h4>
			<section class="regular slider">
<?php
			if(mysqli_num_rows($result5)>0)
    {
        foreach($result5 as $event5)
        {
?>
				<div>
					<a href="event_view.php?event=<?php echo $event5["event_id"]; ?>"><img src="data:image/jpeg;base64,<?php echo base64_encode($event5["event_image"]); ?>" class="event_list"></a>
				</div>
<?php
		}
	}
?>
			</section>
		</div>
	</div>
</div>

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

<?php //include('menu.php'); ?>
<?php

if (isset($_SESSION['id'])) {
?>
<div class="navbar">
	<a href="index.php" class="active">
		<img src="assets/img/icon/home.png" style="width: 30px;">
	</a>
	<a href="myticket.php">
		<img src="assets/img/icon/ticket1.png" style="width: 30px;">
	</a>
	<?php
	$result3 = getUserSendingticket_receiver($_SESSION['id']);
	if(mysqli_num_rows($result3)>0)
	{
    foreach($result3 as $myreceiveticket)
    {
?>
	<a href="history.php">
		<img src="assets/img/icon/bell1r.png" style="width: 30px;">
	</a>
<?php
	}
}else{
			?>
	<a href="history.php">
		<img src="assets/img/icon/bell1.png" style="width: 30px;">
	</a>
			<?php
		}
?>
	<a href="profile.php">
		<img src="assets/img/icon/user.png" style="width: 30px;">
	</a>
</div>

<?php
}
?>