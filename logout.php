<?php
require_once("includes/config.php");
require_once("includes/global.php");
if (!empty($users['authed'])) {
	$_SESSION['catseye'] = '';
	$_SESSION['catseye_username'] = '';
}
?>
<a href=index.php>Home</a>
