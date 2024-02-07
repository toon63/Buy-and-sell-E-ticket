<?php
session_start();
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    // echo "Referrer URL: " . $referer;
	
} else {
    echo "No referrer URL";
	session_destroy();
	header("Location: ognzlogin.php");
}
include_once('config.php');
echo $_POST['ognz_id'];
$ognz_id=$_POST['ognz_id'];
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

    $imagePath = $_FILES['image']['tmp_name'];
			// Get the image data
    $imageData = file_get_contents($imagePath);

    $imageBlob = mysqli_real_escape_string($con , $imageData);
		
			// Prepare the SQL statement
$upload = "UPDATE ognz_profile SET ognz_image = '$imageBlob' WHERE ognz_id = $ognz_id;";
    if (mysqli_query($con , $upload)) {
        echo "Image uploaded and updated in the database.";
        header("Location: ognzprofile.php");
    } else {
        echo "Error updating image: " . mysql_error();
    }
} else {
    echo "No image file selected.";
}
?>