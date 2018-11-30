<?php

session_start();

// Check if user is logged in using the session variable
if (!isset($_SESSION['admin_email'])) {

  header('location: index.php');

}else {

  $adminEmail = $_SESSION['admin_email'];
}


session_unset();
session_destroy();


header('location: login.php?3og2g90eed5u7t')

 ?>
