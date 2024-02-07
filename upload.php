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
echo $_POST['uid'];
$uid=$_POST['uid'];
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

    $imagePath = $_FILES['image']['tmp_name'];
			// Get the image data
    $imageData = file_get_contents($imagePath);

    $imageBlob = mysqli_real_escape_string($con , $imageData);
		
			// Prepare the SQL statement
$upload = "UPDATE user_profile SET user_image = '$imageBlob' WHERE user_id = $uid;";
    if (mysqli_query($con , $upload)) {
        echo "Image uploaded and updated in the database.";
        header("Location:profile.php");
    } else {
        echo "Error updating image: " . mysql_error();
    }
} else {
    echo "No image file selected.";
}
?>