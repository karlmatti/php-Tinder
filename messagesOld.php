<?php
require 'menu.php';
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/utils.php';

$isLoggedIn = isLoggedIn();
if ($isLoggedIn == 0) {
	header('Location: login.php');
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

<?php

$other_id = get('other_id');

//Male to user_id and female to other_id
$user = $_SESSION;
$array = json_decode(json_encode($user), True);

//Get match array
$query = 'SELECT * FROM kamatt_users WHERE id=%s';
$query = sprintf($query, $other_id);
$result = mysqli_query($db, $query);
$match = mysqli_fetch_all ($result, MYSQLI_ASSOC);



if($array['user']['gender'] == 1) {// if user is a female
	$query = 'SELECT * FROM kamatt_messages WHERE user_id=%s AND other_id=%s ORDER BY created_at';
	$query = sprintf($query, $array['user']['id'], $match[0]['id']);
	
} else {
	$query = 'SELECT * FROM kamatt_messages WHERE user_id=%s AND other_id=%s ORDER BY created_at';
	$query = sprintf($query, $match[0]['id'], $array['user']['id']);

}
//die($query);

$result = mysqli_query($db, $query);



$matches = mysqli_fetch_all ($result, MYSQLI_ASSOC);
?>
<h1>Sõnumid kasutajaga '<?php echo $match[0]['name'] ?>' </h1>
<hr>

<?php

for ($i=0; $i<count($matches); $i++) {
	echo $matches[$i]['messager'] . ': ';
	echo $matches[$i]['message'];
?>
<hr>

<?php

}
?>
<form method="post" enctype="multipart/form-data">

      <input type="hidden" name="op" value="sendMessage">
      
      <label>Sõnum: </label>
      <textarea name="sentMessage" rows="1" cols="40"  value="<?php echo $sentMessage; ?>"></textarea>
		<br>


      <button name="sendMessage" type="submit">Saada</button>
    </form>




<?php
if (isset($_POST['op'])) {
	echo 'op is set';
	$sentMessage = post('sentMessage');

	if($array['user']['gender'] == 1) {// if user is a female
		$query = 'INSERT INTO kamatt_messages (user_id, other_id, message, created_at, messager) VALUES (%s, %s, "%s", CURRENT_TIMESTAMP, "%s")';
		$query = sprintf($query, $array['user']['id'], $match[0]['id'], $sentMessage, $array['user']['name']);
	} else {
		$query = 'INSERT INTO kamatt_messages (user_id, other_id, message, created_at, messager) VALUES (%s, %s, "%s", CURRENT_TIMESTAMP, "%s")';
		$query = sprintf($query, $match[0]['id'], $array['user']['id'], $sentMessage, $array['user']['name']);
	}
	


if (false == mysqli_query($db, $query)) { // Kas saab päringu ära teha?
          die( mysqli_error($db) );

} else {
	header("Refresh:0");
}
}
	?>

	</body>
</html>