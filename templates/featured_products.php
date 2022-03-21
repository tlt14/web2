<?php
require_once(__DIR__ . './../classes/database.php');
$db = new Database();
$sql = "SELECT *  FROM tbl_sanpham limit 12";
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (($_POST['dataPost'] == 'selling_products')) {
        //Tạo view
        // create view sanphambanchay as SELECT count(maSanPham) as msp,maSanPham FROM `tbl_chitietdonhang` GROUP by (maSanPham) ORDER by msp DESC limit 15
        $sql = "SELECT * from tbl_sanpham WHERE maSanPham IN (SELECT sanphambanchay.maSanPham FROM sanphambanchay)";
    } else
        if ($_POST['dataPost'] == 'popular_products') {
        $sql = "SELECT * FROM `tbl_sanpham`  ORDER by created_at DESC LIMIT 15";
    } else {
        $sql = "SELECT *  FROM tbl_sanpham limit 12";
    }
}
$result = $db->select($sql);

?>
<div class="products__main">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '  <div class="product__item">
                        <a href="single_page.php?id=' . $row['maSanPham'] . '">
                            <img src="admin/public/uploads/' . $row['hinhAnhSanPham'] . '" alt="" />
                            <div class="product__name">' . $row['tenSanPham'] . '</div>
                            <div class="product__price">' . number_format($row['giaSanPham'], '0', ',', '.') . ' đ</div>
                        </a>
                        <button class="add_to_cart" data-maSanPham='. $row['maSanPham'] .'>Thêm vào giỏ</button>
                    </div>';
        }
    }
    ?>
</div>