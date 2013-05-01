<?php

/*
 * SETUP
 */

// autoloading
require_once __DIR__ . '/not_really_public/vendor/autoload.php';


/*
 * PROCESSING
 */

// get product id
$productId = isset($_GET['productId']) ? $_GET['productId'] : null;

// get database object
$database = Registry::getDatabase();

// get products
$products = $database->select('product');

// build product select options
$productSelectOptions = array();
foreach ($products as $product) {
	$productSelectOptions[$product['id']] = $product['name'];
}


/*
 * OUTPUT
 */

 // get template path
$templatePath = __DIR__ . '/not_really_public/templates';

// instantiate template for content
$content = new Template($templatePath . '/page/content/catalog.phtml', array(
	'productId'=>$productId, 
	'productSelectOptions'=>$productSelectOptions
));

// instantiate template for page, passing in content
$page = new Template($templatePath . '/page.phtml', array('content' => $content));

echo $page;
