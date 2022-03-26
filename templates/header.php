<?php
session_start();
require_once(__DIR__ . './../classes/database.php');
require_once(__DIR__ . './../classes/cart.php');
$db = new Database();
$cart = new Cart();
var_dump($_COOKIE);
?>
<header>
    <div class="header_left">
        <?php
        if (isset($_SESSION["maKhachHang"])) {
            $sql = "SELECT * FROM tbl_khachhang WHERE maKhachHang =" . $_SESSION["maKhachHang"];
            $result = $db->select($sql);
            $result = $result->fetch_assoc();
            echo ('
                <div class="xt-ct-menu">
                    <div class="xtlab-ctmenu-item">' . $result['TenKhachHang'] . '</div>
                    <div class="xtlab-ctmenu-sub">
                        <a href="#">Profile</a>
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
            <i class="fas fa-search"></i>
        </div>
        <div class="cart">
            <a href="#">
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