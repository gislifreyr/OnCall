<?php
require("../inc/auth.inc.php");
require("../inc/functions.inc.php");
require_once("../inc/db.inc.php");


if (!isset($_REQUEST["action"]))
	error("No action specified");
$action = $_REQUEST["action"];
$db = new db("localhost", "oncall", "usbkubbur1", "oncall");
switch($action)
{
	default:
		error("Invalid action");
	break;
	case 'save':
		// Input checking
		foreach (array("start", "end", "staff") as $var)
		{
			if (!isset($_REQUEST[$var]))
				error("Missing variable: ".$var);

			if ("".(int)$_REQUEST[$var]."" != "".$_REQUEST[$var]."")
				error("Invalid value for: ".$var);
		}
		list($staff,$start,$end) = array($_REQUEST["staff"], $_REQUEST["start"], $_REQUEST["end"]);	
		$from = date("Y-m-d", $_REQUEST["start"]);
		$to = date("Y-m-d", $_REQUEST["end"]);

		// let's check for optional shift id, used when modifying existing shifts..
		if (isset($_REQUEST["shift"]) && $_REQUEST["shift"] != "null")
		{
			$shift_id = (int)$_REQUEST["shift"];
		}

		// let's find out if there is another shift in this timeframe, and if so, we return an error!
		$sql = "SELECT id FROM shifts WHERE ((:from BETWEEN start AND end) OR (:to BETWEEN start AND end))";
		$args = array("from"=>$from, "to"=>$to);
		if ($shift_id)
		{
			$sql .= " AND id != :shift_id;";
			$args["shift_id"] = $shift_id;
		}
		$other_shift_id = $db->selectcol($sql, $args);
		
		if ($other_shift_id)
		{
			error("A staff member is already on call during this shift.");
			exit(1);
		}

		if ($shift_id)
		{
			$db->query("UPDATE shifts SET start=:from,end=:to WHERE id=:shift_id", $args);
		}
		else // we are adding a new shift
		{
			$db->query("INSERT INTO shifts (staff_id,start,end) VALUES (:staff,:from,:to)", array("staff"=>$staff, "from"=>$from, "to"=>$to));
		}
	
		print json_encode(array("ok"=>1));
	break;
	case 'delete':
		// Input checking
		foreach (array("shift") as $var)
		{
			if (!isset($_REQUEST[$var]))
				error("Missing variable: ".$var);

			if ("".(int)$_REQUEST[$var]."" != "".$_REQUEST[$var]."")
				error("Invalid value for: ".$var);
		}
		$shift_id = $_REQUEST["shift"];	
		$db->query("DELETE FROM shifts WHERE id=:shift_id", array("shift_id"=>$shift_id));
		print json_encode(array("ok"=>1));
	break;
}


?>
