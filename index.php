<?php
require 'menu.php';
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/utils.php';

$isLoggedIn = isLoggedIn();
if ($isLoggedIn == 0) {
	header('Location: login.php');
}
  
/**
print_r($_SESSION);
echo '<br>';
**/
$user = $_SESSION;
$array = json_decode(json_encode($user), True);
//print_r($array);
//echo '<hr>';
//echo $array['user']['id'];


/**
* Logic of home page.
**/
if($array['user']['gender'] == 0) { // get opposite gender
	$opposite_gender = 1;
} else {
	$opposite_gender = 0;
}
$swipeable_user = get_swipeable($db, $opposite_gender);



$evaluate = post('evaluate');

if ($evaluate) {
	if ($evaluate == 'like') {
		$evaluate = 1;
	} else if ($evaluate == 'dislike') {
		$evaluate = 0;
	}
	$query = 'INSERT INTO kamatt_choices (user_id, other_id, is_liked) 
	VALUES (%s, %s, %s)';
	$query = sprintf($query, $array['user']['id'], $swipeable_user['id'], $evaluate);
	if (false == mysqli_query($db, $query)) { // Kas saab päringu ära teha?
          die( mysqli_error($db) );

        } else {
          
	        $query = 'SELECT * FROM kamatt_choices WHERE user_id=%s AND other_id=%s AND is_liked=1';
	        $query = sprintf($query, $swipeable_user['id'], $array['user']['id']);
	        $result = mysqli_query($db, $query);
	        if ( 0 == mysqli_num_rows($result)) {
				// Vastu pole laikitud, matchi ei toimu
			} else {
				$date = date('Y-m-d H:i:s');
				$query = "INSERT INTO kamatt_matches (user_id, other_id, created_at) 
				VALUES (%s, %s, '$date')";
				$query = sprintf($query, $swipeable_user['id'], $array['user']['id']);
				if (false == mysqli_query($db, $query)) { // Kas saab päringu ära teha?
          			die( mysqli_error($db) );

        		}
        		echo '<script>alert("Match! Te meeldite üksteisele!");</script>';
			}


          $swipeable_user = get_swipeable($db, $opposite_gender);
        }


}





//die($evaluate);


?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mini Tinder</title>
	<link rel="stylesheet" type="text/css" href="/assets/tinder.css">
</head>
<body>
	<h1>Avaleht</h1>
	 <?php // Display swipeable image
	 //TODO if / sql viga leida yles
	 if ($swipeable_user) {
	 	echo '<img src="' . $swipeable_user['photo'] .'" height=250><br>';
	 	echo '<p>Nimi: ' . $swipeable_user["name"];
	 	echo '<p>Kirjeldus: ' . $swipeable_user["description"];

	 
	 ?> 

	<br>
	<form method="post">

		<button type="submit" name="evaluate" value="like"><img src="img/like.png"></button>
		<button type="submit" name="evaluate" value="dislike"><img src="img/dislike.png"></button>

	</form>
	<?php
	} else {
	 	echo '<p>Ei ole kedagi swaipida hetkel!';
	} ?>
</body>
</html>