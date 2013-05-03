<?php

require_once __DIR__ . '/not_really_public/bootstrap.php';


/*
 * PROCESSING
 */

// none ...


/*
 * OUTPUT
 */

 // get template path
$templatePath = __DIR__ . '/not_really_public/templates';

// instantiate template for content
$content = new Template($templatePath . '/page/content/index.phtml');

// instantiate template for page, passing in content
$page = new Template($templatePath . '/page.phtml', array('content' => $content));

echo $page;
