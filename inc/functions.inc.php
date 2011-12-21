<?php

function error($msg)
{
	die(json_encode(array("ok"=>0,"error"=>$msg)));
}


function htmlerror($msg)
{
	die("<h1 class=\"error\">" .$msg . "</h1>");
}
?>

