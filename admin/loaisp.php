<?php
       require_once('header.php');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/loaisp.css">
    <script src="jquery.min.js"></script>
    <script src="loaisp.js"></script>
    <script src="main.js"></script>
    <title>Document</title>
</head>
<body>
    
    <div id="nenden"></div>
    <div id="bangsuakh"></div>
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
        <div class="header_loaisp"></div>
        <div class="content_them_loaisp">
          <div class="danhsach">Danh sách</div>
          <div class="panel_themloai">
              <input type="text" name="" id="search_tenkhachhang" placeholder="Thêm loại sản phẩm mới">
              <div class="nutthem" onclick="themloaisp();">Thêm</div>
          </div>
      </div>
      <div id="table_panel"></div>
    </div>
</body>
</html>