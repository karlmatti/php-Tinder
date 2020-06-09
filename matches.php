<?php
require 'menu.php';
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/utils.php';

$isLoggedIn = isLoggedIn();
if ($isLoggedIn == 0) {
	header('Location: login.php');
}

if (isset($_POST['op'])) {
	$message = post('messagers');
	echo 'messagepost is ' . $messagers;


}


$user = $_SESSION;
$array = json_decode(json_encode($user), True);
 
$query = 'SELECT * FROM kamatt_matches WHERE user_id=%s OR other_id=%s 
ORDER BY created_at';
$query = sprintf($query, $array['user']['id'], $array['user']['id']);

$result = mysqli_query($db, $query);
//print_r($result);


$matches = mysqli_fetch_all ($result, MYSQLI_ASSOC);

?>

<html>
<head>
	<meta charset="utf-8">
	<title>Mini Tinder</title>
	<link rel="stylesheet" type="text/css" href="/assets/tinder.css">
</head>
<body>
	<h1>Matchid</h1>

<?php
echo '<hr>';
for ($i=0; $i<count($matches); $i++) {
	if($matches[$i]['user_id'] != $array['user']['id']) {
		$match_id = $matches[$i]['user_id'];
	} else {
		$match_id = $matches[$i]['other_id'];
	}

	$query = 'SELECT * FROM kamatt_users WHERE id=%s';
	$query = sprintf($query, $match_id);
	$result = mysqli_query($db, $query);
	$match = mysqli_fetch_all ($result, MYSQLI_ASSOC);
	
?>


<img src="<?php echo $match[0]['photo'] ?>" width="40">
<a href="messages.php?other_id=<?php echo $match_id;?>">
  <?php echo $match[0]['name'];?>
</a>

<hr>
<?php
}
?>
</body>
</html>