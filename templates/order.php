<?php
    require_once __DIR__ .'./../classes/cart.php';
    $cart = new Cart();
    $makh = $_COOKIE['maKhachHang'];

    
    if($_POST['act']=='add_order'){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $phone  = $_POST['phone'];
        $email = $_POST['email'];
        $tongtien = $cart->get_total_price();
        $cart_items = $cart->getAll();
        if($cart->add_order($makh,$tongtien,$cart_items,$address,$name,$phone,$note,$email) ){
            echo('Đặt hàng thành công');
        }
    }
    // $result = $cart->getAll();
    // if($result!=null && $result->num_rows>0){
    //     $sql = "SELECT SUM(SoLuong) FROM tbl_giohang WHERE MaKhachHang = '$makh'";
    //     $result = $cart->get_quantity_product_cart();
    // }

    // if($result!=null && $result->num_rows>0){
    //     $sql = "DELETE FROM tbl_giohang WHERE MaKhachHang = '$makh'";
    //     $this->db->delete($sql);
    // }