<?php
    require_once (__DIR__.'./../classes/cart.php');
    $cart = new Cart();
    if(isset($_POST['act']) && $_POST['act']=='plus'){
        if($cart->update_product_cart($_POST['idCart'],$_POST['quantity'])){
            $cartItem = $cart->get_cart_by_id($_POST['idCart']);
            $subTotal = 0;
            while($item = $cartItem->fetch_assoc()){
                
                if ($item['GiamGia'] != 0) {
                    $subTotal = $item['GiaSanPham'] * $item['SoLuong'] * (100 - $item['GiamGia']) / 100;;
                } else {
                    $subTotal = $item['GiaSanPham'] * $item['SoLuong'];
                }
            }
            echo($cart->get_quantity_product_cart()."-".number_format($subTotal,0,',',',')." VNĐ-".number_format($cart->get_total_price(),0,',',',')." VNĐ");
        }else{
            echo("Fail");
        }
    }
    if(isset($_POST['act']) && $_POST['act']=='sub'){
        if($cart->update_product_cart($_POST['idCart'],$_POST['quantity'])){
            $cartItem = $cart->get_cart_by_id($_POST['idCart']);
            $subTotal = 0;
            while($item = $cartItem->fetch_assoc()){
                
                if ($item['GiamGia'] != 0) {
                    $subTotal = $item['GiaSanPham'] * $item['SoLuong'] * (100 - $item['GiamGia']) / 100;;
                } else {
                    $subTotal = $item['GiaSanPham'] * $item['SoLuong'];
                }
            }
            echo($cart->get_quantity_product_cart()."-".number_format($subTotal,0,',',',')." VNĐ-".number_format($cart->get_total_price(),0,',',',')." VNĐ");
        }else{
            echo("Fail");
        }
    }
    