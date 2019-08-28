<?php

require('vendor/autoload.php');

use aitsydney\Navigation;
use aitsydney\Account;

$nav = new Navigation();
$nav_items = $nav -> getNavigation();

//if request_method == post, user is submitting the register form
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    //create instance of account class
    $account = new Account();
    $register = $account -> register($email, $password);
}
else{
    $register = '';
}

//create twig loader
$loader = new Twig_Loader_Filesystem('templates');

//create twig environment
$twig = new Twig_Environment($loader);

//load twig template
$template = $twig -> load('register.twig');

//pass values to twig
echo $template -> render([
    'navigation' => $nav_items,
    'response' => $register,
    'title' => 'Register Account'
]);

?>