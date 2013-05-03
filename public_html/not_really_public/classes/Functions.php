<?php

class Functions
{
	public static function requireLogin()
	{
		if (!Functions::isLoggedIn()) {
			$_SESSION['login_redirect'] = $_SERVER['PHP_SELF'];
			Functions::redirect('/login.php');
		}
	}

	public function isLoggedIn()
	{
		return array_key_exists('user', $_SESSION);
	}

	public static function redirect($url)
	{
		header('location: ' . $url);
		exit;
	}
}