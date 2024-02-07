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

$uid=$_POST['uid'];
if (isset($uid)) {
$delete = "UPDATE user_profile SET user_image = '' WHERE user_id = $uid;";
    if (mysqli_query($con , $delete)) {
        echo "Image delete in the database.";
        header("Location:profile.php");
    } else {
        echo "Error updating image: " . mysql_error();
    }
} else {
    echo "No image file selected.";
}
$ognz_id=$_POST['ognz_id'];
if (isset($ognz_id)) {
$delete = "UPDATE ognz_profile SET ognz_image = '' WHERE ognz_id = $ognz_id;";
    if (mysqli_query($con , $delete)) {
        echo "Image delete in the database.";
        header("Location:ognzprofile.php");
    } else {
        echo "Error updating image: " . mysql_error();
    }
} else {
    echo "No image file selected.";
}
?>