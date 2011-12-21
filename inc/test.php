<?php
require("./db-new.inc.php");
$db = new db("localhost", "oncall", "usbkubbur1", "oncall");

$args = array("id"=>2);

$sql = "SELECT * FROM staff where id=:id";

print "\n====== db->query() ======\n";
print_r($db->query($sql));
print "\n====== db->farr() =======\n";
$db->query($sql,$args);
print_r($db->farr());
print "\n====== db->frow() =======\n";
$db->query($sql,$args);
print_r($db->frow());
print "\n====== db->selectrow() =======\n";
print_r($db->selectrow($sql,$args));
print "\n====== db->selectarr() =======\n";
print_r($db->selectarr($sql,$args));
print "\n====== db->selectall_array() =======\n";
print_r($db->selectall_array($sql,$args));
print "\n====== db->selectall_array_by_key() =======\n";
print_r($db->selectall_array_by_key($sql, "id", $args));
print "\n====== db->selectall_row() =======\n";
print_r($db->selectall_row($sql,$args));
print "\n====== db->selectcol =======\n";
print_r($db->selectcol($sql,$args));
print "\n====== db->nrows() =======\n";
$db->query($sql,$args);
print_r($db->nrows());


?>
