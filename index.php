<?php

use aitsydney\Product;

require('vendor/autoload.php');

$products = new Product();
$products_result = $products -> getProducts();

//create twig loader
$loader = new Twig\Loader\FilesystemLoader('templates');

//create twig environment
$twig = new Twig\Environment($loader);

//load twig template
$template = $twig -> load('home.twig');

//pass values to twig
echo $template -> render([
    'products' => $products_result,
    'title' => 'Hello shop'
]);
?>