<?php
/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 4/9/2018
 * Time: 4:05 PM
 */


include('db/init.php');

$session->logout();
header("Location: login.php");