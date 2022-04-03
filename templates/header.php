<?php
session_start();
require_once(__DIR__ . './../classes/database.php');
require_once(__DIR__ . './../classes/cart.php');
$db = new Database();
$cart = new Cart();

?>
<header class="header">
    <div class="header_left">
        <?php
        if (isset($_COOKIE["maKhachHang"])) {
            $maKhachHang=$_COOKIE["maKhachHang"];
            $sql = "SELECT * FROM tbl_khachhang WHERE maKhachHang =" . $maKhachHang;
            $result = $db->select($sql);
            $result = $result->fetch_assoc();
            echo ('
                <div class="xt-ct-menu">
                    <div class="xtlab-ctmenu-item">' . $result['TenKhachHang'] . '</div>
                    <div class="xtlab-ctmenu-sub">
                        <a href="?page=order">Đơn hàng</a>
                        <a href="./pages/logout.php">Logout</a>
                        </div>
                </div>
                ');
        } else {
            echo ('
                    <a href="./pages/login.php">Đăng nhập/ Đăng ký</a>                
                ');
        }
        ?>
    </div>
    <div class="logo">
        <a href="#">
            <img src="http://mauweb.monamedia.net/converse/wp-content/uploads/2019/05/logo-mona.png" alt="" />
        </a>
    </div>
    <div class="header_right">
        <div class="header_search">
            <!-- <input type="search" name="123" id=""> -->
            <i class="fas fa-search"></i>
        </div>
        <div class="cart">
            <a href="?page=cart&act=show">
                <i class="fas fa-shopping-bag icon_cart"></i>
                <span class="qty_cart">
                    <?php
                        echo($cart->get_quantity_product_cart()); 
                    ?>
                </span>
            </a>
        </div>
    </div>
</header>