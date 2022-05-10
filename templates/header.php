<?php
session_start();
require_once(__DIR__ . './../classes/database.php');
require_once(__DIR__ . './../classes/cart.php');
$db = new Database();
$cart = new Cart();

?>
<!-- <header class="header">
    <div class="header_left"> -->

<!-- </div>
    <div class="logo">
        <a href="#">
            <img src="./admin/public/uploads/logo-mona.png" alt="" />
        </a>
    </div>
    <div class="header_right">
        <div class="header_search"> -->
<!-- <form action="" id="" class="form_search">
                <input type="search" name="123" id="search">
                <span class="close_search">x</span>
            </form> -->
<!-- <i class="fas fa-search btn_search"></i>
        </div>
        <div class="cart">
            <a href="?page=cart&act=show">
                <i class="fas fa-shopping-bag icon_cart"></i>
                <span class="qty_cart"> -->
<?php
// echo($cart->get_quantity_product_cart()); 
?>
<!-- </span>
            </a>
        </div>
    </div>
</header> -->
<header class="header">
    <div class="container_header">
        <div class="row_header align-items-center justify-content-between">
            <div class="logo">
                <a href="#">
                    <img src="./admin/uploads/logo-mona.png" alt="" class="logo_image" />
                </a>
            </div>
            <button type="button" class="nav-toggler">
                <span></span>
            </button>

            <nav class="nav">

                <ul>
                    <?php
                    require_once(__DIR__ . '/./../classes/category.php');
                    $category = new Category();
                    $result = $category->getAll();
                    $dropdown = $category->getAll();
                    ?>
                    <li>
                        <div class="search-box">
                            <div class="input-box">
                                <input type="search" id="search" value="<?=isset($_GET['key'])?$_GET['key']:''?>"placeholder="Search" />
                            </div>
                            <div class="search-button">
                                <i class="fas fa-search icon_search_submit"></i>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="?page=home">TRANG CHỦ</a>
                    </li>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            if ($i < 3) {
                                echo '  <li>
                                <a href="?page=products&idLoai=' . $row['MaLoai'] . '">GIÀY ' . $row['TenLoai'] . '</a>
                            </li>';
                            }
                        }
                    }
                    ?>
                    <li class="dropdown">
                        <a href="#">KHÁC</a>
                        <div class="drodown-mega-menu">
                            <div class="mega-menu-list">
                                <ul>
                                    <?php
                                    if ($dropdown->num_rows > 0) {
                                        $dem = 0;
                                        while ($row = $dropdown->fetch_assoc()) {
                                            $dem++;
                                            if ($dem >= 3) {
                                                echo '  <li>
                                                    <a href="?page=products&idLoai=' . $row['MaLoai'] . '">GIÀY ' . $row['TenLoai'] . '</a>
                                                </li>';
                                            }
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>

                    <div class="cart">
                        <a href="?page=cart&act=show">
                            <i class="fas fa-shopping-bag icon_cart"></i>
                            <span class="qty_cart">
                                <?php
                                echo ($cart->get_quantity_product_cart());
                                ?>
                            </span>
                        </a>
                    </div>
                </li>
                    <li>
                        <?php
                        if (isset($_COOKIE["maKhachHang"])) {
                            $maKhachHang = $_COOKIE["maKhachHang"];
                            $sql = "SELECT * FROM tbl_khachhang WHERE maKhachHang =" . $maKhachHang;
                            $result = $db->select($sql);
                            $result = $result->fetch_assoc();
                            echo ('
                                <div class="xt-ct-menu">
                                    <div class="xtlab-ctmenu-item">' . $result['TenDangNhap'] . '</div>
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
                    </li>
                    
                </ul>
                
            </nav>
        </div>
    </div>
</header>