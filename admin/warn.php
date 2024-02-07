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
            $result = getadmin($_SESSION['aid']);
            if(mysqli_num_rows($result)>0)       
              {
              foreach($result as $aid)
              {
          
                      
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
  p{
    font-size:15px;
  }
 
</style>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300  position-absolute w-100" style="background: #000033;"></div>
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
        <li class="nav-item active">
          <a class="nav-link" href="warn.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-home text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">HOME</span>
          </a>
        </li>
        <li class="nav-item ">
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
      <a class=" btn-sm mt-5 w-100"  style="background:  #483D8B;" href="logout_admin.php" type="button">LOGOUT</a>
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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-7 col-sm-7 mb-xl-0 mb-4">
          <div class="row">
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
             <h6 style="color: white;">อนุมัติคำขอเบิก</h6> 
             <div class="card">
              <div class="card-body">
                <div class="table-responsive" style="height:100px; overflow:auto;">
                  <table class="table align-items-center">
                    <tbody>
                      <tr>
                        <td class="w-30">
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
                            <p class=" font-weight-bold mb-0">วันที่ต้องการรับ</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">สถานะ</p>
                          </div>
                        </td>
                      </tr>
                      
                      <tr>
                     <?php 
                    $settlement_pending=getPendingSettlement();
                    if(mysqli_num_rows($settlement_pending)>0)       
                    {
                    foreach($settlement_pending as $spd)
                    {
                      // $datetimeFromDatabase = ;
                      $timestamp = strtotime($spd['settlement_receive_date']);
                      $S_Date = date("d-M-Y", $timestamp);

                    ?>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $spd['ognz_firstname']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $spd['total']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $S_Date; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <a class="btn btn-light btn-sm w-100" href="verify_settlement.php?sid=<?php echo $spd['settlement_id']; ?>" type="button">ดูคำขอ</a>
                          </div>
                        </td>
                      </tr>

                          <?php 
                            }
                          }
                    ?>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <h6 style="color: white;">อนุมัติสร้างอีเว้นท์</h6>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive" style="height:100px; overflow:auto;">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">ชื่อผู้จัด</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">ชื่ออีเว้นท์</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">สถานะ</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                     <?php 
                    $pending=getPendingEvent();
                    if(mysqli_num_rows($pending)>0)       
                    {
                    foreach($pending as $pd)
                    {
                    ?>
                        <td class="w-30">
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $pd['ognz_firstname']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $pd['event_name']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <a class="btn btn-light btn-sm w-100" href="verify_event.php?eid=<?php echo $pd['event_id']; ?>" type="button">ดูคำขอ</a>
                          </div>
                        </td>
                      </tr>

                          <?php 
                            }
                          }
                    ?>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
              <div class="row mt-4 mb-3">
                <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                  <h6 style="color:white;">รายชื่อผู้จัดอีเว้นท์</h6>
                </div>
                <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                  <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search artists">
                  </div>
                </div>
              </div>
              <div class="card ">
                <div class="table-responsive" style="height:500px; overflow:auto;">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                      <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class="font-weight-bold mb-0">แก้ไขสิทธื์</p>
                            </div>
                          </div>
                        </td>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class=" font-weight-bold mb-0">ชื่อผู้จัดอีเว้นท์</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">สถานะ</p>
                          </div>
                        </td>
                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class=" font-weight-bold mb-0">จำนวนอีเว้นท์ทั้งหมด</p>
                          </div>
                        </td>

                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class=" font-weight-bold mb-0">แต้มทั้งหมด</p>
                          </div>
                        </td>
                      </tr>
                      <?php
          $ognz_profile=getallognz();
          if(mysqli_num_rows($ognz_profile)>0)       
          {
          foreach($ognz_profile as $ognz)
          {
      
          ?>
                      <tr>
                      <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <a href="verify_ognz.php?oid=<?php echo $ognz['ognz_id'];?>" class="btn btn-count" style="background-color:black; color:white;"><h6 class="text-sm mb-0" style="color:white;">แก้ไข</h6></a>
                            </div>
                          </div>
                        </td>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class=" font-weight-bold mb-0"><?php echo $ognz['ognz_firstname'];?> <?php echo $ognz['ognz_lastname'];?></p>
                            </div>
                          </div>
                        </td>
                        <?php
                          if($ognz['ognz_status'] == 'verified'){
                          ?>
                        <td>
                          <div class="text-center">
                            <p class="text-l font-weight-bold mb-0" style="color:green;"><?php echo $ognz['ognz_status'];?></p>
                          </div>
                        </td>
                        <?php
                          }elseif($ognz['ognz_status'] == 'pending'){
                            ?>
                        <td>
                          <div class="text-center">
                          <p class="text-l font-weight-bold mb-0" style="color:blue;"><?php echo $ognz['ognz_status'];?></p>
                          </div>
                        </td>
                            <?php
                          }elseif($ognz['ognz_status'] == 'suspended'){
                          ?>
                          <td>
                          <div class="text-center">
                          <p class="text-l font-weight-bold mb-0" style="color:red;"><?php echo $ognz['ognz_status'];?></p>
                          </div>
                        </td>
                        <?php
                          }
                          $ognz_id = $ognz['ognz_id'];
                          $event_count=countEventOgnz($ognz_id);
                          if(mysqli_num_rows($event_count)>0)       
                          {
                          foreach($event_count as $ec)
                          {
                      
                          ?>
                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $ec['event_ognz_count'];?></p>
                          </div>
                        </td>
                        <?php
                            }
                          }
                      ?>

                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $ognz['point'];?></p>
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
          </div>
        </div>

        <div class="col-xl-5 col-sm-5 ">
          <div class="row ">
            <div class="col-xl-6 col-sm-6 ">
              <h6 style="color: white;">ประวัติทั้งหมด</h6>
            </div>
            <div class="col-xl-6 col-sm-6 ">
              <div class="input-group ">
                <a class="btn btn-light "  href="all_history.php" type="button">ดูประวัติทั้งหมด</a>
              </div>
            </div>
          </div>
          
          <div class="row ">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
              <div class="card ">
                <div class="text-center mt-3">
                  <h6>ประวัติการแลกแต้ม</h6>
                </div>
                <div class="table-responsive" style="height:200px; overflow:auto;">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class=" font-weight-bold mb-0">ชื่อผู้ใช้</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">เวลาที่แลก</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">แต้มที่แลก</p>
                          </div>
                        </td>
                      </tr>
                      <?php
          $history_point=history_all_point();
          if(mysqli_num_rows($history_point)>0)       
          {
          foreach($history_point as $p)
          {
      
          ?>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <!-- <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div> -->
                            <div class="ms-4">
                              <p class=" font-weight-bold mb-0"><?php echo $p['user_firstname'];?> <?php echo $p['user_lastname'];?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $p['transaction_date'];?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $p['point'];?></p>
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
          </div>
         

          <div class="row mt-4">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
              <div class="card ">
                <div class="text-center mt-3">
                  <h6>ประวัติการแลกบัตร</h6>
                </div>
                <div class="table-responsive" style="height:200px; overflow:auto;">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class=" font-weight-bold mb-0">ผู้ส่ง</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">บัตรอีเว้นท์</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">ผู้รับ</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">วันที่ทำการแลกเปลี่ยน</p>
                          </div>
                        </td>
                      </tr>
                      <?php
                            $tfs=admin_tfhistory_sender();
                            if(mysqli_num_rows($tfs)>0)       
                            {
                            foreach($tfs as $tfs)
                            {
                              $tf_date = strtotime($tfs['transfer_date']);
                              $tf_date = date('d F y H:i', $tf_date);
                            ?>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class=" font-weight-bold mb-0"><?php echo $tfs['user_firstname'];?></p>
                            </div>
                          </div>
                        </td>

                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $tfs['event_name'];?></p>
                            <p class=" font-weight-bold mb-0">TID <?php echo $tfs['ticket_id'];?> : <?php echo $tfs['ticket_type'];?></p>
                          </div>
                        </td>
                        <?php
                            $tfr=admin_tfhistory_receiver();
                            if(mysqli_num_rows($tfr)>0)       
                            {
                            foreach($tfr as $tfr)
                            {
                            ?>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-6">
                              <p class=" font-weight-bold mb-0"><?php echo $tfr['user_firstname'];?></p>
                            </div>
                          </div>
                        </td>

                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0"><?php echo $tf_date;?></p>
                          </div>
                        </td>
                        <?php
                              }
                            }
                              ?>
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
          </div>

          <div class="row mt-4">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
              <div class="card ">
                <div class="text-center mt-3">
                  <h6>ประวัติการเบิกเงิน</h6>
                </div>
                <div class="table-responsive" style="height:190px; overflow:auto;">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class=" font-weight-bold mb-0">ผู้จัด</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">จำนวนที่เบิก</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class=" font-weight-bold mb-0">วันที่ทำรายการเบิกเงิน</p>
                          </div>
                        </td>
                      </tr>
                      <?php
                            $ss=getSuccessSettlement();
                            if(mysqli_num_rows($ss)>0)       
                            {
                            foreach($ss as $ss)
                            {
                              $s_date = strtotime($ss['settlement_date']);
                              $s_date = date('d F y H:i', $s_date);
                            ?>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">

                            <div class="ms-4">
                              <p class=" font-weight-bold mb-0"><?php echo $ss['ognz_firstname'];?></p>
                            </div>
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
        ?>