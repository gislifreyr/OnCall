<?php
require("ua_check.php");
session_cache_expire(30);
session_name("oncall");
session_start();
if ($_SESSION["logged_in"] != 1)
{
	header("Location: /oncall/login.php");
	exit(1);
}
?>
