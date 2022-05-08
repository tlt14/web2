<?php
require_once(__DIR__ . './../classes/product.php');
$product = new product();
$category = new Category();
$result = $product->getAll();

?>
<div class="shop-page-title">
    <div class="page-title-inner">
        <div>
            <a href="#">TRANG CHỦ</a>/ NAM
        </div>
        <div style="display:none;">
            <select name="sort" id="sort">
                <option value="">Sắp xếp</option>
                <option value="date_asc">Mới nhất</option>
                <option value="date_desc">Cũ nhất</option>
                <option value="price_asc">Giá tăng dần</option>
                <option value="price_desc">Giá giảm dần</option>
            </select>
        </div>
    </div>
</div>
<div class="main">
    <div class="category-page-row">
        <div class="main-left">
            <h3>LỌC THEO GIÁ</h3>
            <form action="" class=" filter-box_search">
                <div class="price_filter">
                    <input type="number" name="" id="price_from">
                    <i class="fas fa-arrow-right"></i>
                    <input type="number" name="" id="price_to">
                </div>
                <div class="check-box">
                    <h3>Loại giày</h3>
                    <!-- check box -->
                    <?php
                    $categories = $category->getAll();
                    if ($categories) {
                        while ($row = $categories->fetch_assoc()) {
                            echo '<div class="check-box__item">
                                    <input type="checkbox" name="category" id="' . $row['MaLoai'] . '" value="' . $row['MaLoai'] . '">
                                    <label for="' . $row['MaLoai'] . '">' . $row['TenLoai'] . '</label>
                                </div>';
                        }
                    }   
                    ?>
                    
                </div>

                <button type="submit" class="btn_sort_price">Lọc</button>
            </form>

            <div class="products-left">
                <div class="product-left__tiltle">
                    SẢN PHẨM
                </div>
                <div class="products-left__wrapper">
                    <?php
                    $result = $product->get_featured_products();
                    if ($result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            if ($i++ < 6) {
                                echo '  <div class="product-left__item">
                                            <div class="product-left__item-img">
                                                <img src="./admin/public/uploads/' . $row['HinhAnhSanPham'] . '" alt="">
                                            </div>
                                            <div class="product-left__item-name">
                                                <a href="?page=detail&id=' . $row['MaSanPham'] . '">' . $row['TenSanPham'] . '</a>
                                                <span>' . number_format($row['GiaSanPham'], 0, '.', ',') . ' đ</span>
                                            </div>
                                        </div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="main-content product-list">
            <?php
            require_once("./templates/product_items.php");
            ?>
        </div>
    </div>
</div>