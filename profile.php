<?php
require 'menu.php';
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/utils.php';

$isLoggedIn = isLoggedIn();
if ($isLoggedIn == 0) {
	header('Location: login.php');
}
$errors = [];
if (isset($_POST['op'])) {
	$user = $_SESSION;
	$array = json_decode(json_encode($user), True);
	list($uploadOk, $saved_file) = upload_photo($array['user']['email']);

  	if ($uploadOk == 1) { // Kas saab faili üles laadida?
    
		$description = post('description'); // Kirjelduse turvaline post

	

		$query = 'UPDATE kamatt_users SET description="%s", photo="%s" WHERE id=%s';
    
		$query = sprintf($query, $description, $saved_file, $array['user']['id']);

		//echo "<hr>";
    
		if (false == mysqli_query($db, $query)) { // Kas saab päringu ära teha?
			die( mysqli_error($db) );
		} else {
      
      	echo "<p color:green>Andmete uuendamine õnnestus!</p>";
      	//header('Location: index.php');
    	}

  	} else {
    	$errors[] = 'Lae parem pilt üles!';
  	}
    
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mini Tinder</title>
	<link rel="stylesheet" type="text/css" href="/assets/tinder.css">
</head>
<body>
<h1>Profiili uuendamine</h1>
<?php 
if ($errors) { 
?>

<div style="color: red;">Viga andmete uuendamisel: <?php print_r($errors[0]); ?> </div>
<?php 
} 
?>

<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="op" value="register">

	<label>Foto</label>
    <input type="file" name="photo" id="photoUpdate">
    <br><br>

    <label>Kirjeldus</label>
    <textarea name="description" rows="5" cols="40"></textarea>
    <br><br>

	<button name="update" type="submit">Uuenda</button>
</form>
</body>
</html>