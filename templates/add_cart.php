<?php
    session_start();
    // include_once __DIR__.'./classes/database.php';
    require_once ('./../classes/cart.php');
    $cart = new Cart();
    $cart->add_to_cart($_POST['masanpham'], 1);
   
