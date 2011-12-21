<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>%title%</title>
</head>
<body>
	<div id="login-container">
		<div id="login-header">
			<h1>OnCall</h1>
		</div>	
		<div id="login">
			<form action="login.php" method="post">
			<input type="hidden" name="act" value="login" />
			<input type="text" name="user" id="user" value="username" />
			<input type="password" name="pass" id="pass" value="password" />
			<input type="submit" name="submit" value="Login" />
			</form>
		<div class="error softborder" style="display: %error_display%">%error_message%</div>
		</div>
	</div>
	<div id="top-login">
	</div>
	<div id="bottom-login">
	</div>
</body>
</html>
