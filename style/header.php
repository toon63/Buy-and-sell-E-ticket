
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #CCCCFF;
}
</style>
</head>
<body>
  
</body>
</html>
<?php
  session_start();
  if (!isset($_SESSION['id'])) {?>
  
  <ul>
  <li><a class="active" style="color:black;" href="index.php">E-ticket</a></li>
  <li style="float:right"><a href="login.php">Login</a></li>
  <li style="float:right"><a href="register.php">Sign up</a></li>
</ul>

  
<?php
  }
  else{
    include_once('function/myfunction.php');  
    $result = getUser("user_profile",$_SESSION['id']);
    if(mysqli_num_rows($result)>0)       
    {
    foreach($result as $u)
    {
      ?>
 <ul>
  <li><a class="active"  href="index.php">E-ticket</a></li>
  <li><a href="myticket.php">MY Ticket</a></li>
  <li><a href="myticket.php">Point: <?php echo $u["point"];?></a></li>
  <li style="float:right"><a href="profile.php" style="margin-top :5px;">Hello, <?php echo $u["user_firstname"]; ?></a></li>
    </ul>
<?php
    }
  }
};?>