<?php

require_once __DIR__ . '/not_really_public/bootstrap.php';


/*
 * PROCESSING
 */

// get database object
$database = Registry::getDatabase();

// get products
$products = array();
foreach ($database->select('product') as $product) {
	$products[$product['id']] = $product;
}

// get the cart
$data = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$cart = new Cart($data);

// process submit buttons
if (isset($_POST['cart_action'])) {
	$productId = isset($_POST['productId']) ? $_POST['productId'] : null;
	switch ($_POST['cart_action']) {
		case 'add':
			$cart->add($productId);
			break;
		case 'remove':
			$cart->remove($productId);
			break;
		case 'clear':
			$cart->clear();
			break;
		default:
			// nothing
	}
}

// save cart in session
$cart = $cart->toArray();
$_SESSION['cart'] = $cart;


/*
 * OUTPUT
 */

 // get template path
$templatePath = __DIR__ . '/not_really_public/templates';

// instantiate template for content
$content = new Template($templatePath . '/page/content/catalog.phtml', array(
	'productId' => $productId, 
	'products' => $products,
	'cart' => $cart,
));

// instantiate template for page, passing in content
$page = new Template($templatePath . '/page.phtml', array('content' => $content));

echo $page;
