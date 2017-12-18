<?php
require_once("core/Login.php");
session_start();
$login = new Login();
if ($login->isUserLoggedIn() == true) {
	include("sec_index.php");
} else {
	include("login.php");
}
?>