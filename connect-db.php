<?php

//STEP 1: CREATE DATABASE VARIABLES
$host = 'localhost';
$user = 'root';
$pwd = '';
$dbname = 'kfu_events';

//STEP 2: MAKE THE CONNECTION
$con = mysqli_connect($host,$user,$pwd,$dbname);

//STEP 3: ERROR HANDLING
if(mysqli_connect_errno($con))
{
	echo mysqli_connect_error();
	exit;
	
}

?>