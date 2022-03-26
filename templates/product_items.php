
<?php
require_once(__DIR__.'./../classes/product.php');
$product = new product();
$maLoai = $_GET['idLoai'];
$result = $product->get_products_by_loai($maLoai, 0, 12);

if(isset($_GET['p'])&&$_GET['limit']&&$_GET['idLoai']){
    $p = $_GET['p'];
    $limit = $_GET['limit'];
    $maLoai = $_GET['idLoai'];
    $start = ($p - 1) * $limit;
    $result = $product->get_products_by_loai($maLoai, $start, $limit);
}
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product__item">
                    <a href="single_page.php?id=' . $row['MaSanPham'] . '">
                        <img src="admin/public/uploads/' . $row['HinhAnhSanPham'] . '" alt="" />
                        <div class="product__name">' . $row['TenSanPham'] . '</div>
                        <div class="product__price">' . number_format($row['GiaSanPham'], '0', ',', '.') . ' đ</div>
                    </a>
                    <button class="add_to_cart" data-maSanPham=' . $row['MaSanPham'] . '>Thêm vào giỏ</button>
                </div>';
    }
}

?>
