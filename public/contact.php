<?php

/*
 * SETUP
 */

// autoloading
require_once __DIR__ . '/../vendor/autoload.php';


/*
 * PROCESSING
 * PROCESS contact if form submitted
 */ 
$isSubmitted = array_key_exists('contact', $_POST);
if ($isSubmitted){
	$contact = new Contact($_POST['contact']);
	$contact->save();
} else {
	$contact = new Contact(array());
}


/*
 * OUTPUT
 */
 
 // get template path
$templatePath = __DIR__ . '/../templates';

// instantiate template for content
$content = new Template($templatePath . '/page/content/contact.phtml', array(
	'contact' => $contact->toArray(),
));

// instantiate template for page, passing in content
$page = new Template($templatePath . '/page.phtml', array('content' => $content));

echo $page;

echo "<pre>";
if ($isSubmitted) {
	var_dump($_POST);
}
echo "</pre>";
