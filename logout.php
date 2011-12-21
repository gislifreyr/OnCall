<?php
require("inc/auth.inc.php");
session_destroy();
header("Location: login.php");
?>
