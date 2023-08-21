<?php

require_once ("../vendor/autoload.php");

use Croppa\View\View;

$view = new View();

$image = $view->process($_REQUEST);

if (null === $image) {
    header('X-PHP-Response-Code: 404', true, 404);
    die();
}

header("Content-Type: ". $image->getImageFormat());
echo $image;