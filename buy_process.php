<?php
session_start();
if (isset($_SERVER['HTTP_REFERER'])) {
  $referer = $_SERVER['HTTP_REFERER'];
  // echo "Referrer URL: " . $referer;

} else {
  echo "No referrer URL";
session_destroy();
header("Location: login.php");
}

include_once('config.php');
include_once('function/myfunction.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
  }
  else{
    if(isset($_GET['event']))
    {
        $event_slug = $_GET['event'];
        $event_data = getOne("event_detail",$event_slug);
        $event = mysqli_fetch_array($event_data);

        $result = getUser($_SESSION['id']);
        $u = mysqli_fetch_array($result);

        $type1_data = getTicketType1($event_slug);
        $type1 = mysqli_fetch_array($type1_data);

        $type2_data = getTicketType2($event_slug);
        $type2 = mysqli_fetch_array($type2_data);

        $count_t1 = num_t1($_SESSION['type1'] , $event_slug);
        $t1_left = mysqli_fetch_array($count_t1);

        $count_t2 = num_t2($_SESSION['type2'] , $event_slug);
        $t2_left = mysqli_fetch_array($count_t2);

        $buyer = $u['user_id'];

        if ($_SESSION['txt_regular_num'] > '0' && $_SESSION['txt_vip_num'] == '0' && $u['point'] >= $_SESSION['txt_price_total'] && $t1_left['t1_left'] >= $_SESSION['txt_regular_num']){
          for($r=0; $r<$_SESSION['txt_regular_num']; $r++){
            t1($con, $_SESSION['type1'] , $_SESSION['txt_regular_num'] , $_SESSION['hdf_price1'] , $_SESSION['txt_price_total'] , $buyer, $event_slug);
            clear_cus($con, $buyer, $event_slug);
            header("Location: slip.php?event=$event_slug");
          }
          }
          elseif($_SESSION['txt_regular_num'] == '0' && $_SESSION['txt_vip_num'] > '0' && $u['point'] >= $_SESSION['txt_price_total'] && $t2_left['t2_left'] >= $_SESSION['txt_vip_num']){
            for($v=0; $v<$_SESSION['txt_vip_num']; $v++){
              t2($con, $_SESSION['type2'] , $_SESSION['txt_vip_num'] , $_SESSION['hdf_price2'] , $_SESSION['txt_price_total'] , $buyer, $event_slug);
              clear_cus($con, $buyer, $event_slug);
              header("Location: slip.php?event=$event_slug");
            }
          }
          elseif($_SESSION['txt_regular_num'] > '0' && $_SESSION['txt_vip_num'] > '0' && $u['point'] >= $_SESSION['txt_price_total'] && $t1_left['t1_left'] >= $_SESSION['txt_regular_num'] && $t2_left['t2_left'] >= $_SESSION['txt_vip_num']){
            for($r=0; $r<$_SESSION['txt_regular_num']; $r++){
              t1($con, $_SESSION['type1'] , $_SESSION['txt_regular_num'] , $_SESSION['hdf_price1'] , $_SESSION['txt_price_total'] , $buyer, $event_slug);
              clear_cus($con, $buyer, $event_slug);
              header("Location: slip.php?event=$event_slug");
            }
            for($v=0; $v<$_SESSION['txt_vip_num']; $v++){
              t2($con, $_SESSION['type2'] , $_SESSION['txt_vip_num'] , $_SESSION['hdf_price2'] , $_SESSION['txt_price_total'] , $buyer, $event_slug);
              clear_cus($con, $buyer, $event_slug);
              header("Location: slip.php?event=$event_slug");
            }
          }else{?>
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
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body style="background:  #000033;">
        <div class="container">
          
            <h1 class="w3-monospace w3-container w3-center w3-wide w3-panel w3-orange" style= "color:white;">Error while transaction</h1>
            <div style="background:#FFCC99; padding:20px;">
              <p>failed while transaction OR out of ticket</p>
            <a href='ticket_view.php?event=<?php echo $event_slug ?>'>
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-danger">Back to ticket view</button>
                </div>
              </a>
          </div>
        </div>
</body>
</html>
          <?php
        }
    }
  }
    // }header("Location: slip.php?event=$event_slug"); 
?>
</body>
</html>