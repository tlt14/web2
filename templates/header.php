<?php
// session_start();
require_once(__DIR__ . './../classes/database.php');
require_once(__DIR__ . './../classes/cart.php');
$db = new Database();
$cart = new Cart();

?>
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
                                <input type="text" id="search" value="<?= isset($_GET['key']) ? $_GET['key'] : '' ?>" placeholder="Search" />
                            </div>
                            <div class="search-button">
                                <i class="fas fa-search icon_search_submit"></i>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="Home">TRANG CHỦ</a>
                    </li>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            if ($i < 3) {
                                echo '  <li>
                                <a href="Products/' . $row['MaLoai'] . '">GIÀY ' . $row['TenLoai'] . '</a>
                            </li>';
                            }
                        }
                    }
                    ?>
                    <li class="dropdown">
                        <a href="#" onclick="return false;">KHÁC</a>
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
                                                    <a href="Products/' . $row['MaLoai'] . '">GIÀY ' . $row['TenLoai'] . '</a>
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
                            <a href="Cart">
                                <i class="fas fa-shopping-bag icon_cart"></i>
                                <span class="qty_cart" id="qty_cart">
                                    <?php
                                    require_once(__DIR__ . './../templates/quantityCart.php');
                                    ?>
                                </span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <?php
                        if (isset($_COOKIE['maKhachHang'])) {
                            $maKhachHang = $_COOKIE['maKhachHang'];
                            $sql = "SELECT * FROM tbl_khachhang WHERE MaKhachHang =" . $maKhachHang;
                            $result = $db->select($sql);
                            $result = $result->fetch_assoc();
                            echo ('
                                <div class="xt-ct-menu">
                                    <div class="xtlab-ctmenu-item">' . $result['TenDangNhap'] . '</div>
                                    <div class="xtlab-ctmenu-sub">
                                        <a href="Order">Đơn hàng</a>
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