<?php

/*
 * SETUP
 */

// autoloading
require_once __DIR__ . '/not_really_public/vendor/autoload.php';


/*
 * PROCESSING
 */

$isSubmitted = array_key_exists('contact', $_POST);
if ($isSubmitted) {
	$contact = new Contact($_POST['contact']);
	switch ($_POST['action']) {
		case 'save':
			$contact->save();
			break;
		case 'search':
			$contact->validate();
			$data = array_filter($contact->toArray(), function ($value) {
				return !empty($value);
			});
			$result = Registry::getDatabase()->select('contact', $data);
			$data = (count($result) > 0) ? array_shift($result) : array();
			$contact = new Contact($data);
			break;
	}
} else {
	$contact = new Contact(array());
}


/*
 * OUTPUT
 */
 
 // get template path
$templatePath = __DIR__ . '/not_really_public/templates';

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
