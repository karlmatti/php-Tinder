<?php
require 'includes/db.php';

/**
 * Read and return sanitized _POST variable
 */
function post($data, $default = '') {
	if (!isset($_POST[$data])){
		return $default;
	}
	$value = sanitize($_POST[$data]);
	//echo $value;
	return $value;
}

/**
 * Read and return sanitized _GET variable
 */
function get($data, $default = '') {
	if (!isset($_GET[$data])){
		return $default;
	}

	$value = sanitize($_GET[$data]);

	return $value;
}

function sanitize($value) {
	return filter_var ($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
}

function upload_photo($fileid) {
//echo "starting";
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["photo"]["name"]);
  
  //echo "<p>$target_file " . $target_file;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  //echo "<p>$imageFileType " . $imageFileType;
  $saved_file = $target_dir . $fileid . "." . $imageFileType;
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["photo"]["tmp_name"]);
      if($check !== false) {
          //echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          //echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  //echo '<br>';

  //echo "all is fine before checks";
  // Check if file already exists
  if (file_exists($target_file)) {
      //echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["photo"]["size"] > 5000000) {
      //echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      //echo "Sorry, your file was not uploaded.";

  // if everything is ok, try to upload file
  } else {

      if (move_uploaded_file(
           $_FILES["photo"]["tmp_name"], $saved_file)) {
          //echo "<p>The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
      } else {
          //echo "<p>Sorry, there was an error uploading your file.";
          $uploadOk = 0;
      }
  }
  return array($uploadOk, $saved_file);
}

function get_swipeable($db, $gender) {
	
	$user = $_SESSION;
	$array = json_decode(json_encode($user), True);
	$query = 'SELECT * 
	FROM kamatt_users 
	WHERE gender=%s AND id NOT IN (
		SELECT other_id
		FROM kamatt_choices
		WHERE user_id=%s
	)
	LIMIT 1';
	$query = sprintf($query, $gender, $array['user']['id']);
	//die($query);

	$result = mysqli_query($db, $query);
	//echo '<hr>';


	if ( 0 == mysqli_num_rows($result)) {
		//$errors[] = 'Ei ole kedagi Swaipida';
		return false;
	}

	$swipeable_user = mysqli_fetch_object($result);
	if ($swipeable_user) {

		$swipeable_user = json_decode(json_encode($swipeable_user), True);
		//print_r($swipeable_user);
		
		return $swipeable_user;
	}
}
