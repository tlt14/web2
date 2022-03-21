<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web2";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `tbl_sanpham` WHERE giamGia <>-1";
    $result = $conn->query($sql);
?>

<div class="sales row">
    <div class="sale_title">
        SẢN PHẨM GIẢM GIÁ
    </div>
    <div class="products row">
        <div class="sale__wrapper">
            <div class="sale__main">
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="sale__item">
                            <div class="onsale">'.$row['giamGia'].'%</div>
                            <a href="">
                                <img src="admin/public/uploads/'.$row['hinhAnhSanPham'].'" alt="" />
                                <div class="product__name">'.$row['tenSanPham'].'</div>
                                <div class="sale__price">
                                    <span class="amount giacu">'.number_format($row['giaSanPham'],'0',',','.').'đ</span>
                                    <span class="amount giagiam">'.number_format($row['giaSanPham']-($row['giaSanPham']*$row['giamGia']/100),'0',',','.').'đ</span>
                                </div>
                            </a>
                            <button class="add_to_cart">Thêm vào giỏ</button>
                        </div>';
                        }}
                ?>
            </div>
        </div>
    </div>
</div>