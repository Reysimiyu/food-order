<?php

session_start();

define('SITEURL', 'http://localhost/food-order/');
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'food-order');

$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);


?>