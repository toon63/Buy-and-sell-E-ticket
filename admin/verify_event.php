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
          header("Location: loginadmin.php");
        }
          if (isset($_SESSION['aid'])) {
            $admin_id = $_SESSION['aid'];
            $result = getadmin($_SESSION['aid']);
            if(mysqli_num_rows($result)>0)       
              {
              foreach($result as $aid)
              {
                if (isset($_GET['eid'])) {
                  $event_select = $_GET['eid'];
                  $event = getOne('event_detail', $event_select);
                  if(mysqli_num_rows($event)>0)       
                  {
                  foreach($event as $ev)
                  {      
                      if(isset($_POST['verify']) && isset($_POST['eid'])){
                          $eid = $_POST['eid'];
                          $vrf = "UPDATE event_detail SET event_status = 'accepted',event_admin = $admin_id WHERE event_id=$eid AND event_status = 'pending'";
                          $accept = mysqli_query($con, $vrf);
                          $acctk = "UPDATE ticket SET ticket_status = 'non' WHERE tk_event_id=$eid AND ticket_status = 'inactive'";
                          $accepttk = mysqli_query($con, $acctk);
                          $q_tk = "SELECT * FROM ticket WHERE ticket_status = 'non' AND tk_event_id=$eid";
                          $q_tk = mysqli_query($con, $q_tk);
                          foreach($q_tk as $q_tk){
                            $tid = $q_tk['ticket_id'];
                            $create_qr = "INSERT INTO qr(status,qr_ticket_id,qr_event_id) VALUE ('non-use','$tid','$eid')";
                            $create_qr = mysqli_query($con, $create_qr);
                          }
                          
                          header('Location: warn.php');
                        }elseif(isset($_POST['decline']) && isset($_POST['eid'])){
                          $eid = $_POST['eid'];
                          $dctk = "DELETE FROM ticket WHERE tk_event_id=$eid AND ticket_status = 'inactive'";
                          $canceltk = mysqli_query($con, $dctk);
                          $dc = "DELETE FROM event_detail WHERE event_id=$eid AND event_status = 'pending'";
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
    background-color:#000033;
    font-family: 'Athiti', sans-serif;
  }
  .navbar-vertical.bg-white .navbar-nav>.nav-item .nav-link.active {
    background-color: #483D8B;
    box-shadow: none;
    color: white;
  }
  .card .card-body {
    font-family: 'Athiti', sans-serif;
    padding: 1.5rem;
  }
</style>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 position-absolute w-100" style="background:  #000033;"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a href="#" class="navbar-brand m-0">
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
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
    <?php 
                    $pending=getPendingOneEvent($event_select);
                    if(mysqli_num_rows($pending)>0)       
                    {
                    foreach($pending as $pd)
                    {
                        $sell = strtotime($pd['event_sell']);
                        $end = strtotime($pd['event_endsell']);
                        $start= strtotime($pd['event_start']);
                        $end= strtotime($pd['event_end']);

                        $sellDatetime = date('d/m/y H:i', $sell);
                        $endsellDatetime = date('d/m/y H:i', $end);
                        $startDatetime = date('d/m/y H:i', $start);
                        $endDatetime = date('d/m/y H:i', $end);
                    ?>
    <div class="card mt-5">
              <h6 class="text-center pt-3" style="color: back; font-size:20px;">อนุมัติสร้างอีเว้นท์</h6>
            <div class="row">
              <div class="col-6">
              <div class="card-body p-3">
                  <img  src="data:image/jpeg;base64,<?php echo base64_encode($pd["event_image"]); ?>"alt="Base64 Image" style="width: 100%;">
                </div>
              </div>
              <div class="col-6 p-5 text-center">
            <div class="card">
              <div class="card-body p-5">
                <div class="table-responsive">
                 
                <h6 class="text-center " style="color: back; font-size:20px;">รายละเอียดอีเวนต์</h6>
                      
                    
                    
                        <td class="w-30">
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0">ชื่อผู้จัด : <?php echo $pd['ognz_firstname']; ?> <?php echo $pd['ognz_lastname']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0"> ชื่ออีเว้นท์ : <?php echo $pd['event_name']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-left">
                          <p class=" font-weight-bold mb-0">สถานะ : <?php echo $pd['event_status']; ?></p>
                          </div>
                        </td>
                        <td class="w-30">
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0">สถานที่จัด : <?php echo $pd['event_location']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-left">
                            <p class=" font-weight-bold mb-0">รายละเอียด : <?php echo $pd['event_caption']; ?></p>
                          </div>
                        </td>
                      </tr>

                          <?php 
                            }
                          }
                    ?>
                        </tr>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <h6 class="mb-3 mt-3 text-center" style="color: black;">กำหนดการอีเวนต์</h6>
            <div class="card">
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">วางขาย</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">หยุดการขาย</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">เริ่มงาน</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">สิ้นสุดงาน</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $sellDatetime; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $endsellDatetime; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                          <p class=" font-weight-bold mb-0"><?php echo $startDatetime; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                          <p class=" font-weight-bold mb-0"><?php echo $endDatetime; ?></p>
                          </div>
                        </td>
                      </tr>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-xl-0 mb-4 mt-3 text-center">
            <h6 style="color: black;">ข้อมูลบัตร</h6>
            <div class="card mb-4">
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">ประเภทบัตร</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">ราคา</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">จำนวน</p>
                          </div>
                        </td>
                      </tr>

                      
                        
                            <?php
                            $type1=getTicketType1($event_select);
                            if(mysqli_num_rows($type1)>0)       
                            {
                            foreach($type1 as $t1)
                            {
                            ?>
                        <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $t1['ticket_type']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $t1['ticket_price']; ?></p>
                          </div>
                        </td>
                        <?php
                            $ctype1=num_t1($t1['ticket_type'],$event_select);
                            if(mysqli_num_rows($ctype1)>0)       
                            {
                            foreach($ctype1 as $ct1)
                            {
                            ?>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $ct1['t1_left']; ?></p>
                          </div>
                        </td>
                        <?php
                            }
                            }

                            }
                            }
                            ?>
                            <?php
                            $type2=getTicketType2($event_select);
                            if(mysqli_num_rows($type2)>0)       
                            {
                            foreach($type2 as $t2)
                            {
                            ?>
                        <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $t2['ticket_type']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $t2['ticket_price']; ?></p>
                          </div>
                        </td>
                        <?php
                            $ctype2=num_t2($t2['ticket_type'],$event_select);
                            if(mysqli_num_rows($ctype2)>0)       
                            {
                            foreach($ctype2 as $ct2)
                            {
                            ?>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $ct2['t2_left']; ?></p>
                          </div>
                        </td>
                        <?php
                            }
                            }
                            }
                            }
                            ?>
                      </tr>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-xl-0 mb-4 mt-3 text-center">
            <div class="card mb-4">
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">ส่วนแบ่งจากรายได้</p>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $pd['event_share']; ?> %</p>
                          </div>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


            <div class="text-center">
                <form method="POST" action="">
                    <input type="hidden" name="eid" value="<?php echo $event_select ?>">
                    <input type="submit" name="verify" class="btn bg-success" style="color:white;" value="อนุมัติ">
                    <input type="submit" name="decline" class="btn bg" style="background-color:red; color:white;" value="ไม่อนุมัติ">
                </form>
            </div>


            </div>
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
}
          }
        ?>