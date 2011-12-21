<?php
require("inc/auth.inc.php");
require_once("inc/db.inc.php");
require_once("inc/tpl.inc.php");

$tpl = new tpl();
$db = new db("localhost","oncall","usbkubbur1","oncall");

$staff = $db->selectall_array("SELECT id,name FROM staff");
$all_staff = "";
$on_call = $db->selectarr("SELECT staff.name FROM staff, shifts WHERE staff.id=shifts.staff_id AND now() BETWEEN start AND end + interval 1 day ORDER BY shifts.id DESC");
if (!$on_call)
	$on_call = "ENGINN";
else
	$on_call = $on_call["name"];
foreach($staff as $s)
{
	$name = explode(" ",$s["name"]);
	$tpl->set_var("id",$s["id"]);
	$tpl->set_var("name",$name[0]);
	$tpl->set_var("class","staff-".$s["id"]);
	$all_staff .= $tpl->process("staff_row.tpl");
}
$tpl->set_var("all_staff", $all_staff);


$tpl->set_var("s_name",$_SESSION["name"]);
$tpl->set_var("s_email",$_SESSION["email"]);
$tpl->set_var("s_simi",$_SESSION["phonenr"]);
$tpl->set_var("title","OnCall");
$tpl->set_var("oncall",$on_call);
$tpl->display("home.tpl");

?>
