<?php

$host = 'localhost';
$user = 'st2014';
$pass = 'progress';
$base = 'st2014';
//die($_SERVER['SERVER_NAME']);
$db = mysqli_connect($host, $user, $pass, $base)
	or die('Cannot connect to DB');