<?php
require("../inc/auth.inc.php");
require_once("../inc/db.inc.php");

function error($msg)
{
	die(json_encode(array("error"=>$msg)));
}

if (!isset($_REQUEST["start"]))
	error("No start time specified");

if (!isset($_REQUEST["end"]))
	error("No end time specified");

if ((int)$_REQUEST["start"] != $_REQUEST["start"])
	error("Invalid start time specified");

if ((int)$_REQUEST["end"] != $_REQUEST["end"])
	error("Invalid end time specified");

$db = new db("localhost", "oncall", "usbkubbur1", "oncall");
$from = date("Y-m-d", $_REQUEST["start"]);
$to = date("Y-m-d", $_REQUEST["end"]);

// return value format: [ {'id':x, 'title':x, 'start':x, 'end':x}, ... ]
// no need for addslashes as from/to are generated
$sql  = "SELECT 
		s.id,
		st.id as staffid,
		st.name as title,
		start,
		end
	FROM
		shifts s,
		staff st
	WHERE
		s.staff_id = st.id
	AND ( 	(start BETWEEN :from AND :to)
		OR 
		(end BETWEEN :from AND :to)
	)";
$shifts = $db->selectall_array($sql, array("from"=>$from, "to"=>$to));

print json_encode($shifts);

?>
