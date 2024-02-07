<?php
session_start();
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    // echo "Referrer URL: " . $referer;
	
} else {
    echo "No referrer URL";
	session_destroy();
	header("Location: loginadmin.php");
}

include_once('function/myfunction.php');
$result = getAll("event_detail"); 
$ognz = getognz("ognz_profile"); 
include_once('config.php');

include_once('comtop.php');
?>

<style>
  body{
    font-family: 'Athiti', sans-serif;
  }
  .navbar-vertical.bg-white .navbar-nav>.nav-item .nav-link.active {
    background-color: #5e72e4;
    box-shadow: none;
    color: white;
  }
  .card .card-body {
    font-family: 'Athiti', sans-serif;
    padding: 1.5rem;
  }
</style>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0">
        <i class="fa fa-user me-sm-1"></i>
        <span class="ms-1 font-weight-bold">Profile ADMIN</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " href="index.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-home text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">HOME</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="warn.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-bell text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">รายการคำขอ</span>
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
      <a class="btn btn-primary btn-sm mt-5 w-100" href="" type="button">LOGOUT</a>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Search artists, project">
            </div>
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
          <h6 style="color: white;">แจ้งเตือน</h6>
          <div class="row">
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
             <h6 style="color: white;">คำขอเบิก</h6> 
             <div class="card">
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">ชื่อผู้จัด</p>
                          </div>
                        </td> 
                       
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">ชื่ออีเว้นท์</p>
                          </div>
                        </td>
          
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">เงินที่ขอเบิก</p>
                          </div>
                        </td>
                      </tr>
                      <?php
                            if(mysqli_num_rows($ognz)>0)
                        {
                                foreach($ognz as $ognzdetail)
                            {
                                ?>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0"><?php echo $ognzdetail['ognz_firstname']; ?>&nbsp<?php echo $ognzdetail['ognz_lastname']; ?></p>
                          </div>
                        </td>
                        <?php
                                }
                            }
                        ?>
                        <?php
                            if(mysqli_num_rows($result)>0)
                        {
                                foreach($result as $event)
                            {
                                ?>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0"><?php echo $event['event_name']; ?></p>
                          </div>
                        </td>
                        <?php
                                }
                            }
                        ?>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0" style="color: red;">30,000</p>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">สถานะ </p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0" style="color: red;">รออนุมัติ</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <i class="fa fa-check text-dark text-sm opacity-10"></i> <i class="fa fa-close text-dark text-sm opacity-10"></i>
                          </div>
                        </td>
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
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">ชื่อผู้จัด</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">ชื่ออีเว้นท์</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">สถานะ</p>
                          </div>
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Flotsam</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0"><?php echo $event['event_name']; ?></p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0" style="color: red;"><?php echo $event['event_status']; ?>ติ</p>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-30">
                          <div class="text-center">
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <i class="fa fa-check text-success text-sm opacity-10"></i> <i class="fa fa-close text-danger text-sm opacity-10"></i>                          </div>
                          </td>
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
                  <h6>รายชื่อผู้จัดอีเว้นท์</h6>
                </div>
                <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                  <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search artists">
                  </div>
                </div>
              </div>

              <div class="card ">
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">ชื่อผู้จัดอีเว้นท์</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">สถานะ</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Ratings</p>
                          </div>
                        </td>
                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">จำนวนอีเว้นท์ทั้งหมด</p>
                          </div>
                        </td>

                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">ยอดขาย</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Bluenose</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <button class="btn bg-success"><h6 class="text-sm mb-0">Verified</h6></button>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                            <h6 class="text-sm mb-0">$230,900</h6>
                          </div>
                        </td>
                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">400</p>
                          </div>
                        </td>

                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">$400,000</p>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Pennywise</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <button class="btn bg-warning"><h6 class="text-sm mb-0">Pending</h6></button>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                            <h6 class="text-sm mb-0">$230,900</h6>
                          </div>
                        </td>
                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">200</p>
                          </div>
                        </td>

                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">$400,000</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Bluenose</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <button class="btn bg-success"><h6 class="text-sm mb-0">Verified</h6></button>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                            <h6 class="text-sm mb-0">$230,900</h6>
                          </div>
                        </td>
                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">400</p>
                          </div>
                        </td>

                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">$400,000</p>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Pennywise</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <button class="btn bg-warning"><h6 class="text-sm mb-0">Pending</h6></button>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                            <h6 class="text-sm mb-0">$230,900</h6>
                          </div>
                        </td>
                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">200</p>
                          </div>
                        </td>

                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">$400,000</p>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Bluenose</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <button class="btn bg-success"><h6 class="text-sm mb-0">Verified</h6></button>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                            <h6 class="text-sm mb-0">$230,900</h6>
                          </div>
                        </td>
                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">400</p>
                          </div>
                        </td>

                        <td class="align-middle text-sm">
                          <div class="col text-center">
                            <p class="text-xs font-weight-bold mb-0">$400,000</p>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <li class="page-item disabled">
                        <a class="page-link"><<</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">>></a>
                      </li>
                    </ul>
                  </nav>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-5 col-sm-5 mb-xl-0 mb-4">
          <div class="row mt-4 mb-3">
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
              <h6 style="color: white;">ประวัติทั้งหมด</h6>
            </div>
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
              <div class="input-group">
                <a class="btn btn-light btn-sm w-100" href="index.php" type="button">ดูประวัติทั้งหมด</a>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
              <div class="card ">
                <div class="text-center mt-3">
                  <h6>ประวัติการแลกพ้อย</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">ชื่อผู้ใช้</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">เวลาที่แลก</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">แต้มที่แลก</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Flotsam</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">01/06/2023</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">200 แต้ม</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Siuuuuu</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">01/06/2023</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">$1/4 m revenue</p>
                          </div>
                        </td>
                      </tr>
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
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">ผู้ส่ง</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">ชื่อีเว้นท์</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">ผู้รับ</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Flotsam</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Event Name</p>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Flotsam</p>
                            </div>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Astrom</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Event Name</p>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Astrom</p>
                            </div>
                          </div>
                        </td>
                      </tr>
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
                <div class="table-responsive">
                  <table class="table align-items-center ">
                    <tbody>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">ผู้จัด</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">ชื่ออีเว้นท์</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">จำนวนที่เบิก</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Flotsam</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Event Name</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">200 แต้ม</p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div>
                              <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Astrom</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Event Name</p>
                          </div>
                        </td>
                        <td>
                          <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">$1/4 m revenue</p>
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

