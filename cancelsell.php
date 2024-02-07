<?php
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    // echo "Referrer URL: " . $referer;
	
} else {
    echo "No referrer URL";
	session_destroy();
	header("Location: login.php");
}

session_start();

echo $_SESSION['id'];
echo $_GET['tid'];
include_once('config.php');
include_once('function/myfunction.php');

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
      header("Location: myticket.php");
    }
    else{
      $tid = $_GET['tid'];
      $check = getOneUserSellingTicket($_SESSION['id'],$tid);
      if (mysqli_num_rows($check)>0){
        foreach($check as $c){
          if ($_SESSION['id'] != $c['tk_customer_id']){
            header("Location: myticket.php");
          }
          else{
			if(isset($_POST['submit'])){
				$errorMsg = "";

				$password = mysqli_real_escape_string($con, $_POST['password']);

				$point = $c['ticket_price'];
				$event = $c['tk_event_id'];

				if (password_verify($password, $u['user_password'])) {
                    cancelsell($con,$tid,$_SESSION['id'],$event,$point);
					  header("Location: myticket.php");
					}else{
				  $errorMsg = "Password is invalid";
			  }
		  }else{
		  }
            ?>
<?php include('comtop.php'); ?>
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

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

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
			<h1>ยกเลิกการขายบัตร</h1>
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

	<div class="row mt-2" style="margin-bottom: 100px;">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 mt-2 text-center">
			<div class="card-content-detail">
				<div class="card-body" style="box-shadow: 1px 1px 1px #adadad; border-radius: 15px;">
					<h1>ยกเลิกการขายบัตร</h1>
					<hr>
					เงื่อนไข
					<div class="text-left">
						- บัตรจะเปลี่ยนสถานะให้กลับมาใช้งานได้<br>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-2">
							<div class="col-sm-12 text-center">
							<form action="" method="POST">
                                    <div class="form-group">
                                      <button type="button" class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#exampleModal">ยกเลิกการขาย</button>

                                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Confirm by your password</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <input type="password" class="form-control" id="recipient-name" name="password" placeholder="password">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit" value="submit">Send</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
							</div>
						</div>
		<div class="col-sm-2"></div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <?php
          }
        }
      }else{
        header("Location: myticket.php");
      }
    }
    }
  }else{
    echo "no user";
  }
};
?>