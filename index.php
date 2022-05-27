<?php
require_once("includes/config.php");
require_once("includes/global.php");
require_once("theme/".$theme."/header.php");
require_once("theme/".$theme."/signin.php");
require_once("theme/".$theme."/content.php");

$username = '';
$password = '';

if (!empty($_POST['auth'])&&empty($_POST['reg'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$errors['form-help'][] = 'Missing required fields';
		if (empty($_POST['username'])) {
			$errors['form-help'][] = 'Username field required';
			$errors['username'] = 'Required';
		}
		else {
			$username = $_POST['username'];
		}
		if (empty($_POST['password'])) {
			//Password field required
		}
		else {
			$password = $_POST['password'];
		}
	}
	else {
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (!doLogin($username,$password)) {
			//Could not log in using the credentials provided
		}
		else {
			authenticate($username);
			$_SESSION['catseye'] = true;
			$_SESSION['catseye_username'] = $username;
		}
	}
}
?>