<?php
$dbhost = "localhost";
$dbuser = "jofejke";
$dbpass = "okoska111!";
$dbname = "jofejke";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	echo "<a>Failed to connect</a>";
	die;
}
