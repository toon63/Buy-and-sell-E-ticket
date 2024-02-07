<?php
session_start();
session_destroy();
header("Location: /ognzlogin.php");
exit;
?>