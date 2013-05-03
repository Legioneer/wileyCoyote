<?php

require_once __DIR__ . '/not_really_public/bootstrap.php';


/*
 * PROCESSING
 */

$loginValid = true;
$formSubmitted = isset($_POST['login']);
if ($formSubmitted) {
	$database = Registry::getDatabase();
	$users = $database->select('contact', array(
		'username' => $_POST['login']['username'],
		'password' => sha1($_POST['login']['password']),
	));
	$user = array_shift($users);

	$loginValid = is_array($user);
	if ($loginValid) {
		$_SESSION['user'] = $user;
		redirect($_SESSION['login_redirect']);
	}
}


/*
 * OUTPUT
 */

 // get template path
$templatePath = __DIR__ . '/not_really_public/templates';

// instantiate template for content
$content = new Template($templatePath . '/page/content/login.phtml', array('loginValid' => $loginValid));

// instantiate template for page, passing in content
$page = new Template($templatePath . '/page.phtml', array('content' => $content));

echo $page;
