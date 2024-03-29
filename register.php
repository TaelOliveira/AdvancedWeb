<?php
require('vendor/autoload.php');
//get user's wishlist total
use aitsydney\WishList;
$wish = new WishList();
$wish_total = $wish -> getWishListTotal();
// create account
use aitsydney\Account;
if( $_SERVER['REQUEST_METHOD']=='POST' ){
  $email = $_POST['email'];
  $password = $_POST['password'];
  //create an instance of account class
  $acc = new Account();
  $register = $acc -> register( $email, $password );
}
else{
  $register='';
}
// create navigation
use aitsydney\Navigation;
$nav = new Navigation();
$navigation = $nav -> getNavigation();
// create twig loader for templates
$loader = new Twig_Loader_Filesystem('templates');
// create twig environment and pass the loader
$twig = new Twig_Environment($loader);
// call a twig template
$template = $twig -> load('register.twig');
//output the template and pass the data
echo $template -> render( array(
    'register' => $register,
    'wish' => $wish_total,
    'navigation' => $navigation,
    'title' => 'Register for an account'
) );
?>