<?php
require_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/quanlinguoidung.css">
    <link rel="stylesheet" href="./assets/css/admin.css">
    <script src="jquery.min.js"></script>
    <script src="quanlynguoidung.js"></script>
    <script src="main.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="giaodien">
        <div class="app__category">

            <div class="app__category-header">
                <a class="app__category-heading">
                    <img src="./assets/img/main.jpg" alt="">
                    <div class="app__category-text">
                        <p class="app__category-text--big">Nam Hải</p>
                        <p class="app__category-text--small">Project Manager</p>
                    </div>
                    <i class="app__category-heading--icon ti-check-box"></i>
                </a>
            </div>

            <ul class="app__category-list">
                <a href="admin.php">
                    <li class="app__category-list-item" id="managerProduct" style="text-align: left;"><i class="fab fa-product-hunt"></i> <span id="quanlysp" style="display: inline;">Quản lý
                            sản phẩm</span></li>
                </a>
                <a href="quanlynguoidung.php">
                    <li class="app__category-list-item" id="managerUser" style="text-align: left;"><i class="fas fa-users"></i> <span id="quanlynd" style="display: inline;">Quản lý người
                            dùng</span></li>
                </a>
                <a href="xulydonhang.php">
                    <li class="app__category-list-item" id="managerCart" style="text-align: left;"><i class="fas fa-cart-arrow-down"></i> <span id="xulydonhang" style="display: inline;">Xử
                            lý đơn hàng</span></li>
                </a>
                <a href="loaisp.php">
                    <li class="app__category-list-item" id="iconloaisp" style="text-align: left;"><i class="fab fa-product-hunt"></i> <span id="loaisp" style="display: inline;">Loại sản phẩm
                        </span></li>
                </a>
                <a href="thongke.php">
                    <li class="app__category-list-item" id="managerStatistic" style="text-align: left;"><i class="fas fa-chart-bar"></i> <span id="thongkedoanhthu" style="display: inline;">Thống
                            kê doanh thu</span></li>
                </a>
            </ul>
        </div>
        <div class="content_them_quanlinguoidung">
            <div class="danhsach">Danh sách</div>
            <div class="thanhsearch">
                <input type="search" name="" id="search_tenkhachhang" placeholder="Tìm kiếm theo tên">
                <div class="nuttimkiem" onclick="timkiemtenkhachhang();">tìm kiếm</div>
            </div>
            <select name="" id="check_block" onchange="locTrangthai()">
                <option value="macdinh">Mặc định</option>
                <option value="2">Nhân viên</option>
                <option value="3">khách hàng</option>
                <option value="Block">Tài khoản bị khóa</option>
                <option value="Active">Tài khoản không bị khóa</option>
            </select>
            <div class="add_khachhang" onclick="innerbangthemkh();">Thêm khách hàng</div>
        </div>
        <div id="nenden"></div>
        <div id="bangsuakh"></div>
        <div id="bangthemkh">
            <h2 class="title_khachhang">Thêm khách hàng</h2>
            <div><input type="text" placeholder="Tên khách hàng" id="txt_name"></div>
            <div><input type="number" placeholder="Số điện thoại" id="txt_phone"></div>
            <div><input type="text" placeholder="Địa chỉ" id="txt_address"></div>
            <div><input type="text" placeholder="Tài khoản" id="txt_user"></div>
            <div><input type="text" placeholder="Mật khẩu" id="txt_pasword"></div>
            <div><input type="date" id="txt_bdate"></div>
            <div><input type="text" placeholder="Email" id="txt_email"></div>
            <div><select name="" id="combobox_role">
                    <?php
                    include_once('dataProvider.php');
                    $result = dataProvider::executeQuery("SELECT * FROM `tbl_vaitro` WHERE tbl_vaitro.MaVaiTro=2 OR tbl_vaitro.MaVaiTro=3");
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="' . $row['MaVaiTro'] . '">' . $row['TenVaiTro'] . '</option>';
                    }
                    ?>

                </select></div>
            <div class="bottom_bangthemkh">
                <div class="back_themkhachhang" onclick="back_themkhachhang();">Back</div>
                <div class="xacnhanthem" onclick="xacnhanthem();">Xác nhận thêm</div>
            </div>
        </div>
        <div id="table_panel"></div>
    </div>
</body>
<script>
</script>

</html>