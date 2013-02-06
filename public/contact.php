<?php

/*
 * SETUP
 */

// autoloading
require_once __DIR__ . '/../vendor/autoload.php';


/*
 * PROCESSING
 */

$isSubmitted = array_key_exists('contact', $_POST);

// do stuff


/*
 * OUTPUT
 */

 // get template path
$templatePath = __DIR__ . '/../templates';

// instantiate template for content
$content = new Template($templatePath . '/page/content/contact.phtml');

// instantiate template for page, passing in content
$page = new Template($templatePath . '/page.phtml', array('content' => $content));

echo $page;

echo "<pre>";
if ($isSubmitted) {
	var_dump($_POST);
}
echo "</pre>";
