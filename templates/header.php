<?php
session_start();
require_once(__DIR__ . './../classes/database.php');
$db = new Database();
var_dump($_COOKIE);
?>
<header>
    <div class="header_left">
        <?php
            if (isset($_SESSION["maKhachHang"])){
                $sql = "SELECT * FROM tbl_khachhang WHERE maKhachHang =".$_SESSION["maKhachHang"];
                $result = $db->select($sql);
                $result = $result->fetch_assoc();
                echo('
                <div class="xt-ct-menu">
                    <div class="xtlab-ctmenu-item">'.$result['TenKhachHang'].'</div>
                    <div class="xtlab-ctmenu-sub">
                        <a href="#">Profile</a>
                        <a href="./pages/logout.php">Logout</a>
                        </div>
                </div>
                ');
            }
            else{
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
            <?php
                if(isset($_COOKIE['maKhachHang'])){
                    $sql="select SUM(SoLuong) from tbl_giohang where MaKhachHang = '".$_COOKIE['maKhachHang']."'";
                    $result = $db->select($sql);
                    if($result->num_rows > 0){
                        $result = $result->fetch_assoc();
                        echo '<span><i class="fas fa-shopping-cart"></i>'.$result['SUM(SoLuong)'].'</span>';
                    }
                }
                else if(isset($_SESSION['cart'])){
                    $sql="select SUM(SoLuong) from tbl_giohang where session_id = '".session_id()."'";
                    $result = $db->select($sql);
                    if($result->num_rows > 0){
                        $result = $result->fetch_assoc();
                        echo '<span><i class="fas fa-shopping-cart"></i>'.$result['SUM(SoLuong)'].'</span>';
                    }
                }else{
                    echo'<a href="">Giỏ hàng / 0đ</a>';
                }
            ?>
        </div>
    </div>
</header>