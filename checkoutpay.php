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
// ini_set('display_errors', 1);
// print('<pre>');
// print_r($_POST);
// print('</pre>');
// echo $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header("Location:login.php");
  }else{
	$result = getUser($_SESSION['id']);
	if(mysqli_num_rows($result)>0)       
  	{
	foreach($result as $u)
	{
        $total=$_POST['total'].'00';
        


// exit();

require_once dirname(__FILE__).'/omise-php/lib/Omise.php';
define('OMISE_API_VERSION', '2015-11-17');
// define('OMISE_PUBLIC_KEY', 'PUBLIC_KEY');
// define('OMISE_SECRET_KEY', 'SECRET_KEY');
define('OMISE_PUBLIC_KEY', 'pkey_test_5wb6njkn3rwlgam0dft');
define('OMISE_SECRET_KEY', 'skey_test_5wb6njlmwyqo6p888wn');

$charge = OmiseCharge::create(array(
  'amount' => $total,
  'currency' => 'thb',
  'card' => $_POST["omiseToken"]
));

$status=($charge['status']);
// echo $status; 
// print('<pre>');
// print_r($charge);
// print('</pre>');

if ($status=='successful'){


topup_point($con,$_POST['total'],$_SESSION['id']);

echo'<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
echo' <script>
setTimeout(function() {
 swal({
     title: "ชำระเงินสำเร็จ",
     text: "รอตรวจสอบ",
     type: "success"
 }, function() {
     window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
 });
}, 1000);
</script>';
}else{
  echo "ไม่สำเร็จ";
  echo'<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
  echo' <script>
  setTimeout(function() {
 swal({
     title: "เกิดข้อผิดพลาด",
     text: "รอตรวจสอบ",
     type: "error"
 }, function() {
     window.location = "point.php"; //หน้าที่ต้องการให้กระโดดไป
 });
}, 1000);
</script>';
}
}
}
}
?>


<?php 
$public_key = 'pkey_test_5wb6njkn3rwlgam0dft';
$secret_key = 'skey_test_5wb6njlmwyqo6p888wn';
if(!empty($_REQUEST['source'])){    
//echo $_SESSION['charge_id'].'<br>';
     $url = 'https://api.omise.co/charges';
    //$url = 'https://api.omise.co/sources/'.$_REQUEST['soure'];
    require_once dirname(__FILE__) . '/omise-php/lib/Omise.php';
    define('OMISE_API_VERSION', '2019-05-29');
    define('OMISE_PUBLIC_KEY',$public_key);
    define('OMISE_SECRET_KEY', $secret_key);

    $event = OmiseCharge::retrieve($_SESSION['charge_id']);
    
   // var_dump($event);exit();
    if($event["source"]["charge_status"] == 'successful'){
         header( "location: ".$event['authorize_uri']);
         exit(0);
    }else{
         $img_qr = $event['source']['scannable_code']["image"]["download_uri"];
        $aa = $event['return_uri'];
        echo "<img src='".$img_qr."' style='width:600px;height:600px;' ><br><a href='./index.html' >กลับหน้าหลัก</a>";
        exit(0);
    }
   //$url = 'https://api.omise.co/events/'.$_REQUEST['chg'];
    
}else{
if(!empty($_REQUEST['omiseToken'])){
    $key_token = $_REQUEST['omiseToken'];
    $url = 'https://api.omise.co/charges';
    $type_omise = 1;
}else if(!empty($_REQUEST['omiseSource'])){
    $key_token = $_REQUEST['omiseSource'];
    $url = 'https://api.omise.co/sources/'.$key_token;
    $type_omise = 2;
}
require_once dirname(__FILE__) . '/omise-php/lib/Omise.php';
define('OMISE_API_VERSION', '2019-05-29');
define('OMISE_PUBLIC_KEY', $public_key);
define('OMISE_SECRET_KEY', $secret_key);
if(!empty($type_omise)){
        switch ($type_omise){ //Card
            case(1):
                 $charge = \OmiseCharge::create(array(
                                'amount' => $total,
                                'currency' => 'THB',
                                'card' => $key_token,
                                'description' => 'ทดสอบ',

                    ));
            break;
            case(2): //PromtPay
                    /* เรียกใช้ Source API กับ Charge API เหมาะกับใช้ Payment type (รูปแบบชำระอื่นๆ) */
                     $source = \OmiseSource::create(array(
                                                           'amount' => $total,
                                                           'currency' => 'THB',
                                                           'type' => 'promptpay'

                                               ));
                          //   var_dump($source);exit();              
                  /* เรียกใช้ Source API*/
                   $charge2 = \OmiseCharge::create(array(
                                                           'amount' => $total,
                                                           'currency' => 'THB',
                                                           'return_uri' =>'http://localhost/omise-test/test_promtpay.php?soure='.$source['id'],
                                                           'source' => $source['id'],

                                               ));
                     $_SESSION['charge_id'] = $charge2['id'];
                    // var_dump($charge2['source']['scannable_code']['image']['download_uri']);exit();
                     $img_qr = $charge2['source']['scannable_code']['image']['download_uri'];
                   if($charge2['status'] == 'successful'){
                                   echo "<img src='".$img_qr."'  >";
                   }else if($charge2['status'] == 'pending'){
                             echo "<img src='".$img_qr."'  >";
                           header( "location: ".$charge2['authorize_uri'] );
                            exit(0);
                   }

            break;
        }
}
}
//echo $_REQUEST['soure'];exit();
?>