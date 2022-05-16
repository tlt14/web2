<?php
    require_once('header.php');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/thongke.css">
    <script src="jquery.min.js"></script>
    <script src="thongke.js"></script>
    <script src="main.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="giaodienchung">
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
        <li class="app__category-list-item" id="managerProduct" style="text-align: left;"><i
                class="fab fa-product-hunt"></i> <span id="quanlysp" style="display: inline;">Quản lý
                sản phẩm</span></li>
    </a>
    <a href="quanlynguoidung.php">
        <li class="app__category-list-item" id="managerUser" style="text-align: left;"><i
                class="fas fa-users"></i> <span id="quanlynd" style="display: inline;">Quản lý người
                dùng</span></li>
    </a>
    <a href="xulydonhang.php">
        <li class="app__category-list-item" id="managerCart" style="text-align: left;"><i
                class="fas fa-cart-arrow-down"></i> <span id="xulydonhang" style="display: inline;">Xử
                lý đơn hàng</span></li>
    </a>
    <a href="loaisp.php">
        <li class="app__category-list-item" id="iconloaisp" style="text-align: left;"><i
                class="fab fa-product-hunt"></i> <span id="loaisp" style="display: inline;">Loại sản phẩm
                </span></li>
    </a>
    <a href="thongke.php">
        <li class="app__category-list-item" id="managerStatistic" style="text-align: left;"><i
                class="fas fa-chart-bar"></i> <span id="thongkedoanhthu" style="display: inline;">Thống
                kê doanh thu</span></li>
    </a>
</ul>
</div>
    </div>
    <div class="giaodien">
        <div class="panel_time">
            <div class="lbl_ngaybatdau">Ngày bắt đầu</div>
            <div class="lbl_ngayketthuc">Ngày kết thúc</div>
            <input type="date" name="" id="ngaybatdau">
            <input type="date" name="" id="ngayketthuc">
            <div id="changeloc"><div id="btn_loctime" onclick="locngaythang();">Lọc</div></div>
            <select name="" id="loc_loaisp" onchange="loc();">
                <option value="1">Loại</option>
                <option value="2">Sản Phẩm</option>
            </select>
        </div>
        <div id="tongdoanhthu"></div>
        <div id="doanhthucacloai"></div>
    </div>
</body>
</html>