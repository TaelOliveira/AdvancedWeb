<?php
namespace aitsydney;
use aitsydney\Database;
class ShoppingCart extends Database{
  private $auth_status;
  public function __construct(){
    parent::__construct();
    $this -> initSession();
  }
  private function initSession(){
    if( session_status() == PHP_SESSION_NONE ){
      session_start();
      $this -> auth_status = ( isset($_SESSION['auth']) ) ? true : false;
    }
  }
  private function setCartId(){
    
  }
  
  public function setItem( $product_id, $quantity ){
  }
}
?>