
<?php
require_once(__DIR__ . './../classes/product.php');
$product = new product();
$limit = 8;
$start = 0;
$total_page = 0;
$idLoai = isset($_GET['idLoai']) ? $_GET['idLoai'] :"";
if (!isset($_GET['key']) || $_GET['page'] != "search" ) {
    $result = $product->get_products_by_category($_GET['idLoai']);
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['price_from']) && $_GET['price_from'] != '') {
            $result = $product->get_count_filter($_GET['idLoai'], $_GET['price_from'], $_GET['price_to']);
        }
    }
    if ($result) {
        $total_records = $result->num_rows;
        $current_page = isset($_GET['p']) ? $_GET['p'] : 1;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
    }
} else {
    // $maLoai ="";
    $result = $product->get_products_by_search($_GET['key']);
    if (isset($_GET['price_from']) && $_GET['price_from'] != '') {
        $result = $product->filter_product_by_search_count($_GET['key'], $_GET['price_from'], $_GET['price_to']);
    }
    if (isset($_GET['categories']) && $_GET['categories'] != '') {
        $result = $product->search_product_by_categories_count($_GET['key'], $_GET['categories']);
    }
    if(isset($_GET['price_from']) && $_GET['price_from'] != '' && isset($_GET['categories']) && $_GET['categories'] != ''){ 
        $result = $product->filter_product_by_search_categories_count($_GET['key'], $_GET['price_from'], $_GET['price_to'], $_GET['categories']);
    }

    if ($result) {
        $total_records = $result->num_rows;
        $current_page = isset($_GET['p']) ? $_GET['p'] : 1;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['key']) && $_GET['page']=="search" ) {
        if (isset($_GET['sort']) && $_GET['sort'] != '') {
            $products = $product->sort_products_by_search($_GET['key'], $start, $limit, $_GET['sort']);
        } else if (isset($_GET['price_from']) && $_GET['price_from'] != '') {
            $products = $product->filter_product_by_search($_GET['key'], $_GET['price_from'], $_GET['price_to'], $start, $limit);
        } else if (isset($_GET['categories']) && $_GET['categories'] != '') {
            $products = $product->search_product_by_categories_pagination($_GET['key'], $_GET['categories'], $start, $limit);
        }else{
            $products = $product->get_products_by_search_pagination($_GET['key'], $start, $limit);
        }
        if(isset($_GET['categories']) && $_GET['categories'] != '' && isset($_GET['price_from']) && $_GET['price_from'] != ''){
            $products = $product->filter_product_by_search_categories_pagination($_GET['key'], $_GET['price_from'], $_GET['price_to'], $_GET['categories'], $start, $limit);
        }

    } else {
        $products = $product->get_products_by_category_pagination($_GET['idLoai'], $start, $limit);
        if (isset($_GET['sort']) && $_GET['sort'] != '') {
            $products = $product->sort_products_by_category($_GET['idLoai'], $start, $limit, $_GET['sort']);
        } else if (isset($_GET['price_from']) && $_GET['price_from'] != '') {
            $products = $product->filter_product_by_price($_GET['idLoai'], $start, $limit, $_GET['price_from'], $_GET['price_to']);
        }
        if(isset($_GET['price_from']) && $_GET['price_from'] != '' && isset($_GET['sort']) && $_GET['sort'] != ''){
            $products = $product->filter_product_by_price_and_sort($_GET['idLoai'], $start, $limit, $_GET['price_from'], $_GET['price_to'], $_GET['sort']);
        }
    }
}
echo ('<div class="shop-container">');

if ($products) {
    if ($products->num_rows > 0) {
        while ($row = $products->fetch_assoc()) {
            $row['GiamGia']!=0?$giamgia='<div class="onsale">'.$row['GiamGia'].'%</div>':$giamgia='';
            
            echo '<div class="product__item">
                        '.$giamgia.'
                        <a href="Detail/' . $row['MaSanPham'] . '">
                            <img src="./admin/uploads/' . $row['HinhAnhSanPham'] . '" alt="" />
                            <div class="product__name">' . $row['TenSanPham'] . '</div>
                            <div class="product__price">' . number_format($row['GiaSanPham'], '0', ',', '.') . ' đ</div>
                        </a>

                    </div>';
                    // <button class="add_to_cart" data-maSanPham=' . $row['MaSanPham'] . '>Thêm vào giỏ</button>
        
        }
        if ($total_page > 1) {
            echo '</div>
            <ul class="pagi">';
            if ($current_page > 1 && $total_page > 1) {
                echo '<li class="pagi-item " onclick="pagi(' . $current_page - 1 .  ','.$idLoai.');">
                <i class="fas fa-angle-double-left"></i>
                </li>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $current_page) {
                    echo '<li class="pagi-item is-active" onclick="pagi(' . $i .  ','.$idLoai.');" >' . $i . '</li>';
                } else {
                    echo '<li class="pagi-item" onclick="pagi(' . $i .  ','.$idLoai.');" >' . $i . '</li>';
                }
            }
            if ($current_page < $total_page && $total_page > 1) {
                echo '<li class="pagi-item " onclick="pagi(' . $current_page + 1 .  ','.$idLoai.');">
                <i class="fas fa-angle-double-right"></i>
                </li>';
            }
            echo '</ul></div>';
        }
    }
} else {
    echo ('
    <img class="no_result" src="https://raw.githubusercontent.com/Ren0503/zenzen-js-share-video/master/client/src/assets/noresults.png">
    <img class="no_result" src="https://raw.githubusercontent.com/Ren0503/zenzen-js-share-video/master/client/src/assets/noresults.png">
    <img class="no_result" src="https://raw.githubusercontent.com/Ren0503/zenzen-js-share-video/master/client/src/assets/noresults.png">
    <img class="no_result" src="https://raw.githubusercontent.com/Ren0503/zenzen-js-share-video/master/client/src/assets/noresults.png">
    <img class="no_result" src="https://raw.githubusercontent.com/Ren0503/zenzen-js-share-video/master/client/src/assets/noresults.png">
    <img class="no_result" src="https://raw.githubusercontent.com/Ren0503/zenzen-js-share-video/master/client/src/assets/noresults.png">
    <img class="no_result" src="https://raw.githubusercontent.com/Ren0503/zenzen-js-share-video/master/client/src/assets/noresults.png">
    <img class="no_result" src="https://raw.githubusercontent.com/Ren0503/zenzen-js-share-video/master/client/src/assets/noresults.png">
    
    ');
}


?>