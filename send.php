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

include('comtop.php');
if (!isset($_SESSION['id'])) {
  header("Location: login.php");
}
else{
  $result = getUser($_SESSION['id']);
  if(mysqli_num_rows($result)>0)       
  {
  foreach($result as $u)
  {
    if (!isset($_GET['tid']))
    {
      header("Location: c.php");
    }
    else{
      $tid = $_GET['tid'];
      $check = getOneUserTicket($_SESSION['id'],$tid);
      if (mysqli_num_rows($check)>0){
        foreach($check as $c){
          if ($_SESSION['id'] != $c['tk_user_id']){
            header("Location: myticket.php");
          }
          else{
            if(isset($_POST['submit'])){
              $errorMsg = "";

              $reciveremail = $_POST['send_to'];
              $password = mysqli_real_escape_string($con, $_POST['password']);

              $query  = "SELECT * FROM user_profile WHERE user_email = '$reciveremail'";
              $rc = mysqli_query($con, $query);
                if (mysqli_num_rows($rc)>0) {
                  foreach($rc as $r){
                  $reciver = $r['user_id'];
                  $point = $c['ticket_price'];
                  if (password_verify($password, $u['user_password'])) {
                    if ($reciveremail == $u['user_email']){
                      $errorMsg = "Cannot send to yourself";
                    }else{
                      $qrref = bin2hex(random_bytes(10));
                      $resetqr = "UPDATE qr SET qr_ref_id = '$qrref' WHERE qr_ticket_id = '$tid';";
                      mysqli_query($con, $resetqr);

                      send($con,$tid,$_SESSION['id'],$reciver,$point);
                      header("Location: myticket.php");
                  }
            }else{
                $errorMsg = "Password is invalid";
            }    
          }
        }else{
            $errorMsg = "This email doesn't exists";
          }
        }
        }
    }


            ?>
<style type="text/css">
	.btn-buy {
		border-radius: 15px;
		border: 2px solid white;
		background-color: #dc3545;
		color: #ffffff;
		font-size: 16px;
		cursor: pointer;
		/*color: #fff;
		background-color: #212529;
		border-color: #fff;*/
	}

	.btn-buy:hover {
		border-radius: 15px;
		border: 2px solid #212529;
		background-color: white;
		color: #212529;
		font-size: 16px;
		cursor: pointer;
	}

	.btn-login {
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

	.btn-login:hover {
		border-radius: 15px;
		border: 2px solid #212529;
		background-color: white;
		color: #212529;
		font-size: 16px;
		cursor: pointer;
	}

	.card-content-detail {
		position: relative;
		display: flex;
		flex-direction: column;
		min-width: 0;
		word-wrap: break-word;
		backdrop-filter: blur(10px);
		background: #4c4c4c;
		box-sizing: border-box;
		border-radius: 15px;
		color: white;
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

	h3{
		color: white;
	}
</style>
</head>
<div class="container">
            <?php
            if (isset($errorMsg)) {
                echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        $errorMsg
                      </div>";
            }
            ?>
           <div class="row mt-3" >
            <div class="col-sm-6 col-4 mt-2">
              <a href="myticket.php"><img src="assets/img/icon/back.png" style="width: 40px;"></a>
            </div>
            <div class="col-sm-6 col-8 text-right">
              <button type="button" class="btn btn-count"><?php echo $u["point"]; ?></button> 
              <img src="assets/img/icon/ticket.png" style="width: 60px;"> 
              <a href="points.php" type="button" class="btn btn-count">+</a>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-sm-12 text-center mt-2">
              <h1>ส่งต่อบัตร</h1>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 text-center mt-2">
              <h3>สถานะ : <?php echo $c['ticket_status']?></h3>
            </div>
            <div class="col-sm-2"></div>
          </div>

          <div class="row mt-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 mt-2">
              <div class="card-content">
                <div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
                  <div class="row">
                    <div class="col-sm-5 col-5">
                      <img  src="data:image/jpeg;base64,<?php echo base64_encode($c["event_image"]); ?>"alt="Base64 Image" style="width: 100%;">
                    </div>
                    <div class="col-sm-7 col-7">
                      <h5><?php echo $c["event_name"]; ?></h5>
                      <h5><?php echo $c["event_start"]; ?></h5>
                      <h5> <?php echo $c['ticket_type']?></h5>
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-sm-6 col-6 text-left">
                      กดเพื่อดูข้อมูล
                    </div>
                    <div class="col-sm-6 col-6 text-right">
                    <p><?php echo "TID : ", $_GET['tid']?></p>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-sm-12 text-center">
                      ราคาบัตร<?php echo $c["ticket_price"]; ?> <img src="assets/img/icon/ticket.png" style="width: 40px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <hr>

               
            
                         
          <div class="row mt-2">
                  <div class="w3-container" >
                              <div class="w3-card " id="fill">
                                <div class="w3-container w3-center">
                                  <h1>Fill your friend email</h1>
                                  <form action="" method="POST">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required=""> 
                                    <button type="submit" name="search" class="btn btn-count">ค้นหา</button>
                                  </form>
                                  <?php
                                    if(isset($_POST['search'])){
                                      $search_result = find_User($_POST['email']);
                                  ?>
                                  <?php
                                          if(mysqli_num_rows($search_result)>0)
                                        {
                                            foreach($search_result as $es)
                                            {
                                    ?>
                                            <div>
                                              <h1><img src="data:image/jpeg;base64,<?php echo base64_encode($es["user_image"]);?>" style="width:10%;"> <?php echo $es["user_firstname"]," ",$es["user_lastname"]," (",$es["user_email"],")";?> </h1>
                                              <?php
                                                if($es["user_id"] == $_SESSION['id']){
                                                  ?>
                                                  <h1>ไม่สามารถส่งให้ตัวเองได้!</h1>
                                                  <?php
                                                }else{
                                              ?>
                                                <button type="button" class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#exampleModal">Submit</button>
                                              <?php
                                                }
                                              ?>
                                            </div>
                                    <?php
                                        }
                                      }else{
                                        ?>
                                        <h1>ไม่พบอีเมลนี้ในระบบ</h1>
                                      <?php
                                      }
                                    }
                                    ?>
                                    <div class="form-group">
                                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Confirm by your password</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <input type="password" class="form-control" id="recipient-name" name="password" placeholder="password">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                              <input type="hidden" name="send_to" value="<?php echo $es["user_email"];?>">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit" value="submit">Send</button>
                                            </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
            </div>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
            <?php


          
        }
      }
    }
  }
}
?>