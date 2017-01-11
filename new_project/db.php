<?php

include("db.class.php");

// Open the base (construct the object):
$base = "salon_db";
$server = "localhost";
$user = "root";
$pass = "mysql";
$db = new DB($base, $server, $user, $pass);
//
//$base = "id480102_salon_db";
//$server = "localhost";
//$user = "id480102_root";
//$pass = "mysql";
//$db = new DB($base, $server, $user, $pass);
/*


$base="arstock";
$server="arstock.db.5298872.hostedresource.com";
$user="arstock";
$pass="Reset123";
$db = new DB($base, $server, $user, $pass);
*/
?>