<?php

require 'includes/db.php';

if (!session_id()) {
	session_start();
}

function login($db, $email, $password){

	$query = 'SELECT * FROM kamatt_users WHERE email ="%s" AND password="%s"';


	$query = sprintf($query, $email, md5($password));
	//echo '<hr>';
	//echo 'Query: ' . $query;
	$result = mysqli_query($db, $query);
	//echo '<hr>';


	if ( 0 == mysqli_num_rows($result)) {
		$errors[] = 'Sellist emaili ei leidu!';
		//echo "noh";
		return false;
	}

	$user = mysqli_fetch_object($result);
	if ($user) {

		$_SESSION['user'] = $user;
	}
	header('Location: index.php');
	return true;
}

function isLoggedIn() {
	return isset($_SESSION['user']) ? true : false;
}

function logOut() {
	unset($_SESSION['user']);
}