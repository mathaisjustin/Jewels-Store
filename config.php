<?php
// this is hosting for localhost on xammp
define('SITEURL', 'https://localhost/Jewels-Store/');
$server = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";


$conn = mysqli_connect($server,$username, $password,$dbname);

if(!$conn){
    die('connection failed');
}

?>