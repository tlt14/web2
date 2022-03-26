<?php
require_once(__DIR__ . './../classes/product.php');
$product = new product();
// BƯỚC 2: TÌM TỔNG SỐ RECORDS
$maLoai = isset($_GET['idLoai']) ? $_GET['idLoai'] : $_POST['maloai'];
$result = $product->get_products_by_loai($maLoai, null, null);
$total_records = $result->num_rows;

// BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
$current_page = isset($_POST['p']) ? $_POST['p'] : 1;
$limit = 12;
// BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
// tổng số trang
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;

// BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
// Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
echo $current_page;
?>
<div class="shop-page-title">
    <div class="page-title-inner">
        <div>
            <a href="#">TRANG CHỦ</a>/ NAM
        </div>
        <div>
            <form action="">
                <select name="sort" id="sort">
                    <option value="">Sắp xếp</option>
                    <option value="">Mới nhất</option>
                    <option value="">Cũ nhất</option>
                    <option value="">Giá tăng dần</option>
                    <option value="">Giá giảm dần</option>
                </select>
            </form>
        </div>
    </div>
</div>
<div class="main">
    <div class="category-page-row">
        <div class="main-left">
            <div>LỌC THEO GIÁ</div>
            <form action="" class="filter-box">
                <input type="number" name="" id="">
                <i class="fas fa-arrow-right"></i>
                <input type="number" name="" id="">
            </form>
            <div class="products-left">
                <div class="product-left__tiltle">
                    SẢN PHẨM
                </div>
                <div class="products-left__wrapper">
                    <div class="product-left__item">
                        <div class="product-left__item-img">
                            <img src="./admin/public/uploads/1588064170.jpg" alt="">
                        </div>
                        <div class="product-left__item-name">
                            <a href="#">Giày Nam Bột</a>
                            <span>1.000.000đ</span>
                        </div>
                    </div>
                    <div class="product-left__item">
                        <div class="product-left__item-img">
                            <img src="./admin/public/uploads/1588064170.jpg" alt="">
                        </div>
                        <div class="product-left__item-name">
                            <a href="#">Giày Nam Bột</a>
                            <span>1.000.000đ</span>
                        </div>
                    </div>
                    <div class="product-left__item">
                        <div class="product-left__item-img">
                            <img src="./admin/public/uploads/1588064170.jpg" alt="">
                        </div>
                        <div class="product-left__item-name">
                            <a href="#">Giày Nam Bột</a>
                            <span>1.000.000đ</span>
                        </div>
                    </div>
                    <div class="product-left__item">
                        <div class="product-left__item-img">
                            <img src="./admin/public/uploads/1588064170.jpg" alt="">
                        </div>
                        <div class="product-left__item-name">
                            <a href="#">Giày Nam Bột</a>
                            <span>1.000.000đ</span>
                        </div>
                    </div>
                    <div class="product-left__item">
                        <div class="product-left__item-img">
                            <img src="./admin/public/uploads/1588064170.jpg" alt="">
                        </div>
                        <div class="product-left__item-name">
                            <a href="#">Giày Nam Bột</a>
                            <span>1.000.000đ</span>
                        </div>
                    </div>
                    <div class="product-left__item">
                        <div class="product-left__item-img">
                            <img src="./admin/public/uploads/1588064170.jpg" alt="">
                        </div>
                        <div class="product-left__item-name">
                            <a href="#">Giày Nam Bột</a>
                            <span>1.000.000đ</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="shop-container">
                <?php
                    require_once("./templates/product_items.php");
                ?>
            </div>
            <ul class="pagi">
                <?php
                    // require_once("./templates/pagination.php");
                    if($total_page>1){
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<li class="pagi-item is-active"  data-limit=' . $limit . ' data-p=' . $i . ' data-maloai=' . $maLoai . '>' . $i . '</li>';
                            } else {
                                echo '<li class="pagi-item" data-limit=' . $limit . ' data-p=' . $i . ' data-maloai=' . $maLoai . '>' . $i . '</li>';
                            }
                        }
                    }   
                ?>
            </ul>
        </div>
    </div>
</div>