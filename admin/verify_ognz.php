<?php
session_start();
// echo $_SESSION['aid'];
ini_set('display_errors', 1);
include_once('config.php');
include_once('../function/myfunction.php');
     
          include('../comtop.php');
          if (isset($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
            // echo "Referrer URL: " . $referer;
          
        } else {
            echo "No referrer URL";
          session_destroy();
          header("Location: ../loginadmin.php");
        }
          if (isset($_SESSION['aid'])) {
            $admin_id = $_SESSION['aid'];
            $result = getadmin($_SESSION['aid']);
            if(mysqli_num_rows($result)>0)       
              {
              foreach($result as $aid)
              {
                if (isset($_GET['oid'])) {
                    $oid = $_GET['oid'];
                    $ognz_profile = getognzprofile($oid);
                    if(mysqli_num_rows($ognz_profile)>0)       
                    {
                    foreach($ognz_profile as $op)
                    {      
                        if(isset($_POST['verify']) && isset($_POST['oid'])){
                            $oid = $_POST['oid'];
                            $vrf = "UPDATE ognz_profile SET ognz_status = 'verified' WHERE ognz_id=$oid";
                            $accept = mysqli_query($con, $vrf);
                            header('Location: warn.php');
                          }elseif(isset($_POST['decline']) && isset($_POST['oid'])){
                            $oid = $_POST['oid'];
                            $dc = "UPDATE ognz_profile SET ognz_status = 'suspended' WHERE ognz_id=$oid";
                            $cancel = mysqli_query($con, $dc);
                            header('Location: warn.php');
                          }
                                        
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <title>
  </title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Athiti:wght@500&display=swap" rel="stylesheet">  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>
<style>
  body{
    background-color: #000033;
    font-family: 'Athiti', sans-serif;
  }
  .navbar-vertical.bg-white .navbar-nav>.nav-item .nav-link.active {
    background-color:   #483D8B;
    box-shadow: none;
    color: white;
  }
  .card .card-body {
    font-family: 'Athiti', sans-serif;
    padding: 1.5rem;
  }
</style>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300  position-absolute w-100"  style="background:  #000033;"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a href="../profileadmin.php" class="navbar-brand m-0">
        <i class="fa fa-user me-sm-1"></i>
    
        <span class="ms-1 font-weight-bold"><?php echo $aid['admin_firstname']; ?> <?php echo $aid['admin_lastname']; ?></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="warn.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-home text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">HOME</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="event.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-calendar text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">EVENT</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="sidenav-footer mx-3 " style="margin-top: 135px;">
      <a class="btn btn-primary btn-sm mt-5 w-100" href="logout_admin.php" type="button">LOGOUT</a>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
   <!-- Navbar -->
   <nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
        </div>

        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </li>
      </div>
    </nav>
    <!-- End Navbar -->
         
            <div class="card">
              <h6 class="text-center pt-3" style="color: back; font-size:20px;">ข้อมูลผู้จัด</h6>
            <div class="row">
              <div class="col-6">
                <div class="card-body p-5">
                  <img  src="data:image/jpeg;base64,<?php echo base64_encode($op["ognz_image"]); ?>"alt="Base64 Image" style="width: 100%;">
                </div>
              </div>
            <div class="col-6 p-5 text-center">
            <div class="card">
              <div class="card-body p-5">
                <div class="table-responsive">
                 
                      <h6 class="text-center " style="color: back; font-size:20px;">ID : <?php echo $op['ognz_id'];?></h6>
                      <tr>
                        <td class="w-30">
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0">ชื่อผู้จัด : <?php echo $op['ognz_firstname']; ?> <?php echo $op['ognz_lastname']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0">สถานะ : <?php echo $op['ognz_status']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0">แต้มรวม : <?php echo $op['point']; ?></p>
                          </div>
                        </td>
                        </tr>

                
                        <td class="w-30">
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0">ชื่อผู้จัด : <?php echo $op['ognz_firstname']; ?> <?php echo $op['ognz_lastname']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0">อีเมลผู้จัด : <?php echo $op['ognz_email']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-left">
                          <p class=" font-weight-bold mb-0">เบอร์ติดต่อผู้จัด : <?php echo $op['ognz_phone']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-left">
                          <p class=" font-weight-bold mb-0">สถานะผู้จัด : <?php echo $op['ognz_status']; ?></p>
                          </div>
                        </td>
                      </tr>
                        </tr>

            
                  </div>
</div>
            <div class="text-center">
                <p class=" font-weight-bold mb-0">จัดการสิทธิ์ผู้จัดงาน</p>
                <form method="POST" action="">
                    <input type="hidden" name="oid" value="<?php echo $op['ognz_id']; ?>">
                    <input type="submit" name="verify" class="btn bg-success" style="color:white;" value="verify">
                    <input type="submit" name="decline" class="btn bg" style="background-color:red; color:white;" value="suspended">
                </form>
            
            </div>
            </div>
            </div>
          
            </div>
          </div>

                                  <?php
                            }
                            }

                            ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    
  


  <div class="col-xl-12 col-md-12 mb-4">
      <h6 style=" padding-top:30px;">อีเวนต์ทั้งหมดของผู้จัด</h6> 
      <div class="row mt-3 ">
		<?php
			$oe = ognzEvent($_GET['oid']);
				if(mysqli_num_rows($oe)>0)       
					{
					foreach($oe as $oe)
					{
						if($oe['event_status'] == 'accepted'){
							?>
			 <div class="col-xl-2 col-sm-2 mb-m-0 mb-2">
				<div class="card" >
            		<div class="card-body p-1 text-center" >
          		
					<!-- <div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;"> -->
						<div class="row">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($oe["event_image"]);?>"  style="width:100%; height: 250px;" >
						</div>
						
					</div>
					<div>
						<a href="event_statis.php?eid=<?php echo $oe['event_id']; ?>" type="button" class="btn btn-count " style="background-color:green; margin-left:55px; color:white;">ดูสถิติ</a>
						</div>
					</div>
			</div> 
	<?php
						}elseif($oe['event_status'] == 'pending'){?>
		<div class="col-xl-2 col-sm-2 mb-m-0 mb-2">
           <div class="card" > 
		   		<div class="card-body p-1 text-center">
          		
				<!-- 	<div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;"> -->
						<div class="row ">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($oe["event_image"]);?>" style="width:100%; height: 250px;" >
						</div>
						
					</div>
					<div>
							<a href="#" type="button" class="btn btn-count  " style="background-color:orange; margin-left:45px; color:white;">กำลังตรวจสอบ</a>
      					</div>
					</div>
				</div> 
	<?php
						}elseif($oe['event_status'] == 'cancel'){?>
		<div class="col-xl-2 col-sm-2 mb-m-0 mb-2">
           <div class="card"> 
		   <div class="card-body p-1 text-center" >
					
						<!-- <div class="card-body" style="background-color: white; box-shadow: 1px 1px 1px #adadad; border-radius: 15px;"> -->
							<div class="row ">
								<img src="data:image/jpeg;base64,<?php echo base64_encode($oe["event_image"]);?>" style="width:100%; height: 250px;" >
							</div>
							
					</div> 
					<div>
								<a href="#" type="button" class="btn btn-count  ml-5" style="background-color:red; color:white;">ถูกยกเลิก</a>
							</div>
				</div>
				</div>
				
<?php

}
		
	}
}
?>
 </div>
  </div>
</div>
</div>
</main>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
<?php
                }
            }
          }
        }
        ?>