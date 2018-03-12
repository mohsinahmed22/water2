<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 12:47 PM
 */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'water_db');
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if(!$connection){
    die("Connection error: " . mysqli_connect_error());
}