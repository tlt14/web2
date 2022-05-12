<?php
    require_once ('./../classes/cart.php');
    $cart = new Cart();
    // var_dump($_POST);

    if(isset($_POST['idCart']) && $_POST['act']=='delete'){
        if($cart->delete_product_cart($_POST['idCart'])){
            echo($cart->get_quantity_product_cart());   
        }else{
            echo("Xóa sản phẩm thất bại");
        }
    }
    if(isset($_POST['idCart']) && $_POST['act']=='update'){
        if($cart->update_product_cart($_POST['idCart'],$_POST['quantity'])){
            echo($cart->get_total_price());
        }else{
            echo("Cập nhật sản phẩm thất bại");
        }
    }