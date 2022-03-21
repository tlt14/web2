<?php
session_start();
if(!isset($_SESSION['mySession'])){
    header('location:index.php');
    exit();
}
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&amp;family=Satisfy&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/admin.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <title>Document</title>
</head>
<body>
    <div class="app">
        <div class="header">
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
                        <button class="search-icon">
                           <i class="fa fa-search"></i>
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
            <div class="header__cart">
                <i class="cart-btn fas fa-cart-plus"></i>
            </div>

            <div class="header__admin__login">
                <img src="./assets/img/main.jpg" alt="">
                <span>ADMIN</span>
                
                <ul class="admin__login-list">
                    <li class="admin__login-item" id="admin"><a href="">Admin</a></li>
                    <li class="admin__login-item"><a href="">Giỏ hàng</a></li>
                    <li class="admin__login-item"><a href="">Đơn đặt hàng</a></li>
                    <li class="admin__login-item"><a href="logout.php" id="logout" >Đăng xuất</a></li>
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
                        <input type="text" placeholder="Search something...." onchange="searchInfo('txtsearch2');" id="txtsearch2">
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


    <div class="app__container">
        <div class="app__category">

            <div class="app__category-header" >
                <a class="app__category-heading">
                    <img src="./assets/img/main.jpg" alt="">
                    <div class="app__category-text">
                    <p class="app__category-text--big">Nam Hải</p>
                    <p class="app__category-text--small">Project Manager</p>
                </div>
                <i class="app__category-heading--icon ti-check-box"></i>
            </a>
            </div>

            <ul class="apps__category-list">
                <a href=""><li class="apps__category-list-item" id="managerProduct" style="text-align: left;"><i class="fab fa-product-hunt"></i> <span id="quanlysp" style="display: inline;">Quản lý sản phẩm</span></li></a>
                <a href=""><li class="apps__category-list-item" id="managerUser" style="text-align: left;"><i class="fas fa-users"></i> <span id="quanlynd"  style="display: inline;">Quản lý người dùng</span></li></a>
                <a href=""><li class="apps__category-list-item" id="managerCart" style="text-align: left;"><i class="fas fa-cart-arrow-down"></i> <span id="xulydonhang" style="display: inline;">Xử lý đơn hàng</span></li></a>
                <a href=""><li class="apps__category-list-item" id="managerStatistic" style="text-align: left;"><i class="fas fa-chart-bar"></i> <span id="thongkedoanhthu" style="display: inline;">Thống kê doanh thu</span></li></a>
            </ul>
        </div>

        <div class="apps__content" onclick="hideAdminBar();">
                
            <div class="apps__content-header">
                <div class="apps__content-heading">
                    <p class="apps__content-heading-content">Danh sách</p>
                </div>

                <div class="apps__content-add-product"> <button onclick="addAdminProduct();"><i class="fas fa-cart-plus"></i> Thêm mới</button></div>
            </div>
            
            <div class="apps__content-container">
                <div class="apps__content-container-title hide-on-mobile"> <div class="apps__content-title">
<div class="apps__content-title-id">
    <p>ID</p>
</div>

<div class="apps__content-title-user">
    <p>Người bán</p>
</div>

<div class="apps__content-title-name">
    <p>Tên sản phẩm</p>
</div>

<div class="apps__content-title-img">
   <p>Ảnh sản phẩm</p>
</div>

<div class="apps__content-title-prices">
    <p>Giá bán</p>
</div>

<div class="apps__content-title-tools">
   <p>Công cụ</p>
</div>
</div></div>

    <div class="apps__content-container-show hide-on-mobile-admin"> <div class="apps__content-view">
    <div class="apps__content-view-id">
        <p>0</p>
    </div>

    <div class="apps__content-view-user">
        <p>ADMIN</p>
    </div>

    <div class="apps__content-view-name">
        <p>Macbook</p>
    </div>

    <div class="apps__content-view-img">
        <img src="./assets/img/macbook1.jpg" alt="">
    </div>

    <div class="apps__content-view-prices">
        <p>1200$</p>
    </div>

    <div class="apps__content-view-tools">
        <div class="apps__content-view-tools-update" onclick="updateAdminProduct(0);">
            <i class="fas fa-pen"></i>
        </div>

        <div class="apps__content-view-tools-delete" onclick="deleteAdminProduct(0)">
            <i class="fas fa-trash-alt"></i>
        </div>
    </div>
</div> 

</div>

    <div class="apps__content-mobile hide-on-pc display-on-mobile">
    <div class="apps__content-mobile-view">
    <div class="apps__content-mobile-view-id">
        <p><i class="fas fa-radiation-alt"></i> ID: <span>0</span></p>
    </div>

    <div class="apps__content-mobile-view-user">
        <p><i class="fas fa-user"></i> Người bán: <span>ADMIN</span> </p>
    </div>

    <div class="apps__content-mobile-view-name">
        <p><i class="fab fa-product-hunt"></i> Tên sản phẩm: <span>Macbook</span></p>
    </div>

    <div class="apps__content-mobile-view-img">
       <div class="apps__content-mobile-view-img-content"><p><i class="far fa-image"></i> Ảnh: </p></div>

       <div class="apps__content-mobile-view-img-img">
            <img src="./assets/img/macbook1.jpg" alt="">
       </div>
    </div>
    
    <div class="apps__content-mobile-view-prices">
        <p><i class="fas fa-dollar-sign"></i> Giá: <span>1200$</span></p>
    </div>

    <div class="apps__content-mobile-view-tools">
        <div class="apps__content-mobile-view-tools-update" onclick="updateAdminProduct(0)">
            <i class="fas fa-pen"></i>
        </div>

        <div class="apps__content-mobile-view-tools-delete" onclick="deleteAdminProduct(0)">
            <i class="fas fa-trash-alt"></i>
        </div>
    </div>
</div>

</div>

                <div class="pagination">
                    <div class="pagination__list">
                        <a href="admin.html" class="pagination__list-link"><div class="pagination__list-item">Home</div></a>
                        <a href="admin.html?manager=product&amp;page=1#" id="prePage" class="pagination__list-link"><div class="pagination__list-item">Prev</div></a>
                        <a href="admin.html?manager=product&amp;page=1" class="pagination__list-link" id="page1" ><div class="pagination__list-item">1</div></a>
                        <a href="admin.html?manager=product&amp;page=2" class="pagination__list-link" id="page2"><div class="pagination__list-item">2</div></a>
                        <a href="admin.html?manager=product&amp;page=3" class="pagination__list-link" id="page3"><div class="pagination__list-item">3</div></a> 
                        <a href="admin.html?manager=product&amp;page=2" id="nextPage" class="pagination__list-link"><div class="pagination__list-item">Next</div></a>                      
                    </div>
                </div>

            </div>

        </div>

    </div>

    </div>
</body>
<script>
    const searchbtn= document.querySelector('.search-icon');
    const formSearch = document.querySelector('.search-wrapper');
    const searchInput = document.querySelector('.search-input');
    const Inputholder = document.querySelector('.input-holder');
    const closebtn = document.querySelector('.close-search');
    searchbtn.onclick = function() {
        formSearch.classList.add('active')
}
    closebtn.onclick = function() {
        formSearch.classList.remove('active')
    }

    function displayModalBars()
{
    document.getElementById('barsOverlay').style.display = "block";
    document.getElementById('barsContent').style.display = "block";
}

function hideModalBars()
{
    document.getElementById('barsOverlay').style.display = "none";
    document.getElementById('barsContent').style.display = "none";
    hideCategoryBars();
}

function hideAdminBar()
{
    document.querySelector('.app__category-heading').style.display = "none";
    document.querySelector('.app__category').style.width = "70px";
    document.getElementById('quanlysp').style.display = "none";
    document.getElementById('quanlynd').style.display = "none";
    document.getElementById('xulydonhang').style.display = "none";
    document.getElementById('thongkedoanhthu').style.display = "none";
    document.getElementById('managerProduct').style.textAlign = "center";
    document.getElementById('managerUser').style.textAlign = "center";
    document.getElementById('managerCart').style.textAlign = "center";
    document.getElementById('managerStatistic').style.textAlign = "center";
    document.querySelector('.app__category-header').style.justifyContent = "center";
    document.getElementById('hideAdmin').style.display = "none";
    document.getElementById('displayAdmin').style.display = "block";
}
function displayAdminBar()
{
    document.querySelector('.app__category-heading').style.display = "flex";
    document.querySelector('.app__category').style.width = "253px";
    document.getElementById('quanlysp').style.display = "inline";
    document.getElementById('quanlynd').style.display = "inline";
    document.getElementById('xulydonhang').style.display = "inline";
    document.getElementById('thongkedoanhthu').style.display = "inline";
    document.getElementById('managerProduct').style.textAlign = "left";
    document.getElementById('managerUser').style.textAlign = "left";
    document.getElementById('managerCart').style.textAlign = "left";
    document.getElementById('managerStatistic').style.textAlign = "left";
    document.querySelector('.app__category-header').display = "flex";
    document.getElementById('hideAdmin').style.display = "block";
    document.getElementById('displayAdmin').style.display = "none";
}
</script>
</html>
