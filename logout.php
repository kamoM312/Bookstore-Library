<?php

include 'config.php';

session_start();
// remove session variables
session_unset();
// destroy the session
session_destroy();

header('location:login.php');

?>