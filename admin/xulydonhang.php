<!DOCTYPE html>
<html lang="en">
<?php
include'config.php';
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&amp;family=Satisfy&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/admin.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet"
        href="./assets/fonts/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="app" >
    <?php
       require_once('header.php');
    ?>

    <div class="modal__detail-bill" id="show_detail" style="display: none;">
            <div class="modal__detail-bill-overlay" onclick="hideModalDetail();"></div>
            
            
        </div>

        <?php
     if(isset($_POST['editOrder-btn'])){
        $ordertype = $_POST['editOrdertype'];
        $id = $_POST['id'];
        echo '<script language="javascript">
            swal({
                title: "Update success",
                icon: "success",
            })</script>';
            $sql = "UPDATE tbl_donhang set TrangThai = '$ordertype' where MaDonHang = '$id'";
            $query = mysqli_query($conn,$sql);
    }
    
        ?>
        
        <form action="" method="POST" enctype="multipart/form-data" >
        <div class="modal__edit-order" id="show_editOrder" style="display:none; ">
        

        </div>
    </form>

   
        <div class="app__container" >

      
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

            

            <div class="app__content" onclick="hideAdminBar();">

                <div class="app__content-header">
                    <div class="app__content-heading">
                        <p class="app__content-heading-content">Danh sách</p>
                    </div>
                    
                    <div class="app__content-header--calender">
                        <input type="date" name="" class="calendar-a">
                        <input type="date" name="" class="calendar-b">
                        <button class="calendar-btn" onclick="showCalendar();">Tìm</button>
                    </div>
               
                </div>

                <div class="app__content-container" id="loadOrder">

                   
                  
                    
                    
                   

                </div>

            </div>

        </div>

    </div>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="main.js"></script>

</html>