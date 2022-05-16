<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

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

    <title>Document</title>
</head>

<body>
<div class="header" >
            <div class="header__wrap">
            <div class="header__logo">
                <a href="">
                    <img src="./assets/img/logo.png" alt="" class="header__logo-img" id="logo">
                </a>
            </div>

            <div class="header__pane">
                <div class="header__btn" onclick="hideAdminBar();" id="hideAdmin">
                    <i class="fas fa-signal"></i>
                </div>

                <div class="header__btn" onclick="displayAdminBar();" id="displayAdmin" style="display:none">
                    <i class="fas fa-bars"></i>
                </div>
            </div>

            <div class="   header__content">
                <div class="header__content-left">
                    <div class="search-wrapper hide-on-tablet">
                        <div class="input-holder">
                        <input type="text" class="search-input" placeholder="Type to search">
                        <button class="search-icon" >
                           <i class="fa fa-search"  onclick="showSearch();"></i>
                            <span>

                            </span>
                        </button>
                        </div>

                        <button class="close-search ">
                            <i class="ti-close"></i>
                        </button>

                        
                       
                </div>

                

               

            </div>

        </div>

        <div class="header__form">
            <div class="header__main">
                <p class="header__main-text line-hover">HOME</p>
            </div>

            <div class="header__setting" >
                <div class="setting-btn" id="showFunction" onclick=" showFunction();">
                <i class="ti-settings setting-icon"></i>
            </div>

            <div class="setting-btn" id="hideFunction"  onclick="hideFunction();" style="display:none">
                <i class="ti-reload setting-icon" ></i>
            </div>


                <ul class="header__setting-noti" id="header__setting">
                    <li class="header__setting-noti-item">
                        <a href="admin.php" class="header__setting-noti-link">
                        <i class="fab fa-product-hunt"></i>
                             <p class="header__setting-noti-text">Quản lý sản phẩm</p>
                        </a>
                    </li>
                    <?php
                    if(isset($_SESSION['quyen']) && $_SESSION['quyen']==1){
                    ?>
                    <li class="header__setting-noti-item">
                        <a href="quanlynguoidung.php" class="header__setting-noti-link">
                        <i class="fas fa-users"></i>
                             <p class="header__setting-noti-text">Quản lý người
                                dùng</p>
                        </a>
                    </li>
                        <?php } ?>
                    <li class="header__setting-noti-item">
                        <a href="xulydonhang.php" class="header__setting-noti-link">
                        <i class="fas fa-cart-arrow-down"></i>
                             <p class="header__setting-noti-text">Xử lý đơn hàng</p>
                        </a>
                    </li>

                    <li class="header__setting-noti-item">
                        <a href="loaisp.php" class="header__setting-noti-link">
                        <i class="fas fa-cart-arrow-down"></i>
                             <p class="header__setting-noti-text">Loại sản phẩm</p>
                        </a>
                    </li>

                    <li class="header__setting-noti-item-end">
                        <a href="thongke.php" class="header__setting-noti-link">
                        <i class="fas fa-chart-bar"></i>
                             <p class="header__setting-noti-text">Thống kê doanh thu</p>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="header__admin__login">
                <img src="./assets/img/main.jpg" alt="">
                <span>ADMIN</span>
                
                <ul class="admin__login-list">
                    <li class="admin__login-item" id="admin"><a href="">Admin</a></li>
                    <li class="admin__login-item"><a href="">Giỏ hàng</a></li>
                    <li class="admin__login-item"><a href="">Đơn đặt hàng</a></li>
                    <li class="admin__login-item"><a href="./../pages/logout.php" id="logout" >Đăng xuất</a></li>
                </ul>
            </div>


            <div class="header__icon-item header__menu-map">
                <label for="map-checkbox">
                    <i class="header__icon-icon ti-map-alt"></i>
                </label>
                <input type="checkbox" id="map-checkbox" class="header__map-checkbox">
                <label for="map-checkbox" class="header__map-overlay">
                </label>
                <div class="header__map-container">
                    <label for="map-checkbox">
                        <i class="header__map-close-icon ti-close"></i>
                    </label>
                    <img src="./assets/img/logo.png" alt="logo" class="header__map-logo">
                    <img src="./assets/img/sologan.png" alt="sologan" class="header__map-sologan">
                    <a href="" class="header__map-link">
                        <img src="./assets/img/map.jpg" alt="map" class="header__map-img">
                    </a>
                    <p class="header__map-decs">Lorem ipsum dolor sit amet, consectetuer adipis cing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis theme natoque</p>
                    <h4 class="header__map-social-heading">Follow Me</h4>
                    <ul class="header__map-social-list">
                        <li class="header__map-social-item">
                            <a href="" class="header__map-social-link">
                                <i class="header__map-social-icon ti-twitter-alt"></i>
                            </a>
                        </li>
                        <li class="header__map-social-item">
                            <a href="" class="header__map-social-link">
                                <i class="header__map-social-icon ti-pinterest"></i>
                            </a>
                        </li>
                        <li class="header__map-social-item">
                            <a href="" class="header__map-social-link">
                                <i class="header__map-social-icon ti-facebook"></i>
                            </a>
                        </li>
                        <li class="header__map-social-item">
                            <a href="" class="header__map-social-link">
                                <i class="header__map-social-icon ti-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="header__bars" id="barsBtn" onclick="displayModalBars();">
                <i class="bars-btn ti-more"></i>
            </div>

            <div class="modal__bars">
                <div class="modal__bars-overlay" id="barsOverlay" onclick="hideModalBars();"></div>
    
                <div class="modal__bars-content" id="barsContent">
                    <div class="bars-close" id="barsClose" onclick="hideModalBars();">
                        <i class="bars-close-btn fas fa-times"></i>
                    </div>
    
                    <div class="bars-search">
                        <input type="text" placeholder="Search something...." class="search-form">
                    </div>
    
                    <div class="bars-category">
                        <ul class="bars__list">
                            <a href="index.html">
    
                                <li class="bars__list-item">Home</li>
                            </a>
                           
                        </ul>
                    </div>
                </div>
                
            </div>
    



        </div>
      
    </div>

    </div>



    </html>
