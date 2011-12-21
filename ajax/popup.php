<?php
require("../inc/auth.inc.php");
require("../inc/functions.inc.php");
require("../inc/tpl.inc.php");
require("../inc/db.inc.php");
$tpl = new tpl("../tpl/");
$db = new db("localhost","oncall","usbkubbur1","oncall");


if (!isset($_REQUEST["id"]))
	htmlerror("Missing id");

$data = $db->selectarr("SELECT name,email,regno,phonenr from staff where id=:staff_id", array("staff_id"=>$_REQUEST["id"]));
$tpl->load_vars($data);
$tpl->display("popup.tpl");

?>
