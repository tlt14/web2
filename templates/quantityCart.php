<?php
require_once (__DIR__.'./../classes/cart.php');
$cart = new Cart();
if(isset($_POST['act']) && $_POST['act']=='getQuantity'){
echo ($cart->get_quantity_product_cart());
}else{
echo ($cart->get_quantity_product_cart());
}
