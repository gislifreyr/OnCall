<?php
if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']))
{
	header("Location: /oncall/ie.html");
	exit(1);
}
?>
