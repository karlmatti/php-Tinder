<?php
require 'menu.php';
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/utils.php';

$errors = [];

$email = post('email');
$password = post('password');

logOut();

if ('login' == post('op')) {
	
	if (empty($errors)) {
		login($db, $email, $password);
		//echo "." . $password . ".";
		
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
<h1>Sisselogimine</h1>
<?php 
	if ($errors) { 
?>

	<div style="color: red;">Viga sisselogimisel: <?php print_r($errors); ?> </div>
<?php	
} 



?>

<form method="post">

	<input type="hidden" name="op" value="login">

	<label>Email</label>
	<input type="text" name="email" value="<?php echo $email; ?>">
	<br><br>

	<label>Password</label>
	<input type="password" name="password" value="<?php echo $password; ?>">
	<br><br>

	<button name="login" type="submit">Logi sisse</button>
	
</form>
<br>
<button name="goRegister" type="submit" onclick="window.location='register.php'">Registreeri</button>
</body>
</html>