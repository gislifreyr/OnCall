<?php
require_once("inc/tpl.inc.php");
require_once("inc/db.inc.php");

$tpl = new tpl();
$db = new db("localhost", "oncall", "usbkubbur1","oncall");
	
$tpl->set_var("error_display", "none");


if ($_POST)
{
	$pass = md5($_POST["pass"]);
	$user = $_POST["user"];
	$check = $db->selectrow("SELECT * FROM staff WHERE username=:user AND password=:pass", array("user"=>$user, "pass"=>$pass));
	if ($db->nrows())
	{
		//create session! and allow!
		session_cache_expire(30);
		session_name("oncall");
		session_start();
		$_SESSION["logged_in"] = 1;
		$_SESSION["name"] = $check[1];
		$_SESSION["regno"] = $check[2];
		$_SESSION["email"] = $check[3];
		$_SESSION["phonenr"] = $check[6];
		header("Location: index.php");
	}
	else
	{
		$tpl->set_var("error_display", "block");
		$tpl->set_var("error_message","Invalid login");
	}
	
}
$tpl->set_var("title","OnCall");
$tpl->display("login.tpl");


?>
