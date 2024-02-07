<?php
  	session_start();
	// ini_set('display_errors', 1);
	include('../comtop.php'); 
	include_once('../config.php');
	include_once('../function/myfunction.php');

	
	

      if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
        // echo "Referrer URL: " . $referer;
      
    } else {
        echo "No referrer URL";
      session_destroy();
      header("Location: ../loginadmin.php");
    }

if (!isset($_SESSION['aid'])) {
		header("Location: ../loginadmin.php");
	  }
if(isset($_GET['eid'])){
	$event_select = getOne('event_detail', $_GET['eid']);
	if(mysqli_num_rows($event_select)>0)       
			  {
			  foreach($event_select as $es)
			  {
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
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
		font-size: 20px;
		font-weight:bold;
	}
	h2{
		font-size: 18px;
		font-weight:bold;
	}
	small{
		color: white;
	}

	h4{
		color: black;
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

<div class="row ">

 
	<div class="col-8">
	<div class="col" style="padding-left: 40px;">
		<a href="event_ticket.php?event=<?php echo $_GET['eid'];?>"><img src="assets/back.png" style="width: 40px;"></a>
	</div> 

	<div class="col-sm text-center mb-3" style="padding: 40px;">
		<div class="card-content-detail">
			<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				<h4 style="color: black;">Event Detail</h4>
				<!-- <div class="card-body p-3" > -->
              <img src="data:image/jpeg;base64,<?php echo base64_encode($es["event_image"]);?>" style="height: 40%; width:40%">
          <!-- </div> -->
		  				<h4>ชื่ออีเวนต์ : <?php echo $es['event_name'] ?></h4>
						<p class="card-text">วันที่เริ่ม : <?php echo $es['event_start'] ?></h2>
						<p class="card-text">วันที่สิ้นสุด : <?php echo $es['event_end'] ?></h2>
						<p class="card-text">สถานที่จัด : <?php echo $es['event_location'] ?></h2>
						<!-- <a href="#" type="button" class="btn btn-count" style="background-color:green;">แก้ไข</a> -->
			</div>
		</div>
	</div>

</div>
  <div class="col-4">
	<div   style="padding-top: 40px; padding-right:10px;">
		<div class="card-content-detail"  style="padding-top: 40px;">
			<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				<h5 class="text-left"><b>จำนวนบัตรทั้งหมด</b></h5>
				<div style="max-width: 100%;">
					<div class="row no-gutters">
						<div class="col-md-8">
							<div class="card-body text-left">
								<?php
								$count_all_ticket = ognzEventCountAllTicket($_GET['eid']);
								if(mysqli_num_rows($count_all_ticket)>0)       
										{
										foreach($count_all_ticket as $cat)
										{
											?>
								<h1 style="color:red;">จำนวนบัตรทั้งหมด : <?php echo $cat['ticket_all_count'] ?> ใบ</h1>
								<?php
										}
									}
										?>
								<?php
								$type_ticket = getalltickettype($_GET['eid']);
								if(mysqli_num_rows($type_ticket)>0)       
										{
										foreach($type_ticket as $tt)
										{
											$num_type_ticket = countAllTicketType($tt['ticket_type'],$_GET['eid']);
												if(mysqli_num_rows($num_type_ticket)>0)       
														{
														foreach($num_type_ticket as $ntt)
														{
											?>
									<h2>รวม <?php echo $tt['ticket_type'] ?> : <?php echo $ntt['t_all'] ?> ใบ</h2>
								<?php
													}
												}
											}
										}
										?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div  style="padding-top: 20px; padding-right:10px;">
		<div class="card-content-detail">
			<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				<h5 class="text-left"><b>ยอดขาย</b></h5>
				<div class="card mb-3" style="max-width: 100%;">
					<!-- <div class="row no-gutters"> -->
						<!-- <div class="col-md-8"> -->
							<div class="card-body text-left">
							<?php
								$count_all_sold_ticket = ognzEventCountAllSoldTicket($_GET['eid']);
								if(mysqli_num_rows($count_all_sold_ticket)>0)       
										{
										foreach($count_all_sold_ticket as $cast)
										{
											?>
								<h1 style="color:red;">ขายบัตรไปได้ทั้งหมด : <?php echo $cast['ticket_sold_all_count'] ?> ใบ</h1><br>
								<?php
										}
									}
										?>
							
								
								<?php
								$type_ticket = getalltickettype($_GET['eid']);
								if(mysqli_num_rows($type_ticket)>0)       
										{
										foreach($type_ticket as $tt)
										{
											$num_sold_ticket = countSoldTicketType($tt['ticket_type'],$_GET['eid']);
												if(mysqli_num_rows($num_sold_ticket)>0)       
														{
														foreach($num_sold_ticket as $nst)
														{
											?>
									<!-- <div class="card-body "> -->
										<div style="float:left;">
											<h2>ขาย <?php echo $tt['ticket_type'] ?> : <?php echo $nst['t_sold'] ?> ใบ</h2> 
											<?php 
											$total_type = $nst['t_sold'] * $tt['ticket_price'];
											?>
											<h2>รวมเป็นแต้ม : <?php echo $total_type; ?> แต้ม</h2><br>
										
									<?php
													}
												}
											}
										}?>
										</div>
										
										<?php
										$ticket_type1 = getTicketType1($_GET['eid']);
										if(mysqli_num_rows($ticket_type1 )>0)       
											{
												foreach($ticket_type1 as $tt1)
												{
													$cstk1 = countSoldTicketType1($tt1['ticket_type'],$_GET['eid']);
													if(mysqli_num_rows($cstk1)>0)       
														{
															foreach($cstk1 as $cstk1)
															{
																$ticket_type2 = getTicketType2($_GET['eid']);
																if(mysqli_num_rows($ticket_type2)>0)       
																	{
																		foreach($ticket_type2 as $tt2)
																		{
																			$cstk2 = countSoldTicketType2($tt2['ticket_type'],$_GET['eid']);
																			if(mysqli_num_rows($cstk2)>0)       
																				{
																					foreach($cstk2 as $cstk2)
																					{
																					$total_t1 = $tt1['ticket_price'] * $cstk1['t1_sold'];
																					$total_t2 = $tt2['ticket_price'] * $cstk2['t2_sold'];

																					$total_all = $total_t1+$total_t2;
																					$left = ((100-$es['event_share'])/100)*$total_all
																					?>
																					<h2>รวม <?php echo $total_all; ?> แต้ม</h2>

																					

																					<h2>หักส่วนแบ่ง <?php echo $es['event_share']; ?>% <br> เหลือ <?php echo $left; ?> แต้ม</h2>
																					<?php
																					}
																				}
																		}
																	}
															}
														}
												}
											}
										?>

							
						<!-- </div> -->
					<!-- </div> -->
				</div>
			</div>
		</div>
	</div>
	</div>
	<div  style="padding-top: 20px; padding-right:10px;">
		<div class="card-content-detail">
			<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
				<h5 class="text-left"><b>คงเหลือ</b></h5>
				<div class="card mb-3" style="max-width: 100%;">
					<!-- <div class="row no-gutters"> -->
						<!-- <div class="col-md-8"> -->
							<div class="card-body text-left">
							<?php
								$count_all_ticket = ognzEventCountAllTicket($_GET['eid']);
								if(mysqli_num_rows($count_all_ticket)>0)       
										{
										foreach($count_all_ticket as $cat)
										{
											$count_all_sold_ticket = ognzEventCountAllSoldTicket($_GET['eid']);
											if(mysqli_num_rows($count_all_sold_ticket)>0)       
													{
													foreach($count_all_sold_ticket as $cast)
													{
														$all_left = $cat['ticket_all_count'] - $cast['ticket_sold_all_count'];
											?>
								<h1 style="color:red;">คงเหลือทั้งหมด : <?php echo $all_left; ?> ใบ</h1><br>
								<?php
												}
											}
										}
									}
										?>
							
								
								<?php
								$type_ticket = getTicketType($_GET['eid']);
								if(mysqli_num_rows($type_ticket)>0)       
										{
										foreach($type_ticket as $tt)
										{
											$num_ticket = countAllTicketType($tt['ticket_type'],$_GET['eid']);
												if(mysqli_num_rows($num_ticket)>0)       
														{
														foreach($num_ticket as $nt)
														{
														$num_sold_ticket = countSoldTicketType($tt['ticket_type'],$_GET['eid']);
															if(mysqli_num_rows($num_sold_ticket)>0)       
																	{
																	foreach($num_sold_ticket as $nst)
																	{
																		$type_left = $nt['t_all'] - $nst['t_sold'];
											?>
									<!-- <div class="card-body "> -->
										<div style="float:left;">
											<h2>เหลือ <?php echo $tt['ticket_type'] ?> : <?php echo $type_left ?> ใบ</h2> 
										
									<?php
															}
														}
													}
												}
											}
										}?>
										</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
</div>
<?php
			  }
			  }
}

        
?>