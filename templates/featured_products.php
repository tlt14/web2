<?php
require_once(__DIR__ . './../classes/product.php');
$product = new Product();
$result = $product->get_featured_products();
?>
<div class="products__main">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['GiamGia']!=0?$giamgia='<div class="onsale">'.$row['GiamGia'].'%</div>':$giamgia='';
            echo '  <div class="product__item">
                        '.$giamgia.'
                        <a href="Detail/' . $row['MaSanPham'] . '">
                            <img src="admin/uploads/' . $row['HinhAnhSanPham'] . '" alt="" class="img_reponsive"/>
                            <div class="product__name">' . $row['TenSanPham'] . '</div>
                            <div class="product__price">' . number_format($row['GiaSanPham'], '0', ',', '.') . ' đ</div>
                        </a>
                    </div>';
                    // <button class="add_to_cart" data-maSanPham=' . $row['MaSanPham'] . '>Thêm vào giỏ</button>

                }
    }
    ?>
</div>