
<?php
require_once(__DIR__.'./../classes/product.php');
$product = new product();
$total_page = 0;
if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $price_from = $_GET['price_from'];
    $price_to = $_GET['price_to'];
    $maLoai = $_GET['idLoai'];
    $limit=8;
    $p=1;
    if(isset($_GET['limit'])&&isset($_GET['p'])){    
        $limit = $_GET['limit'];
        $p= $_GET['p'];
    }
    $start = ($p - 1) * $limit;
    if($sort!="" && $price_from=="" && $price_to==""){
        $result = $product->get_products_by_loai($maLoai, $start, $limit,$sort,"","");
    }else if($sort=="" && $price_from!="" && $price_to!=""){
        $result = $product->get_products_by_loai($maLoai, $start, $limit,"",$price_from,$price_to);
    }else if($sort=="" && $price_from=="" && $price_to=="" && $limit!=0){
        $result = $product->get_products_by_loai($maLoai, $start, $limit,"","","");
    }else{
        $result = $product->get_products_by_loai($maLoai, $start, $limit,$sort,$price_from,$price_to);
    }
}else{
    // var_dump($_GET);
    $maLoai = $_GET['idLoai'];
    $limit=8;
    $result = $product->get_products_by_loai($maLoai, 0, $limit,"","","");
    $total_records = $result->num_rows;
    $current_page = isset($_GET["p"]) ? $_GET['p'] : 1;
    $total_page = ceil($total_records / $limit);
    if ($current_page > $total_page) {
        $current_page = $total_page;
    } else if ($current_page < 1) {
        $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
}
if($result){
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product__item">
                        <a href="?page=detail&id=' . $row['MaSanPham'] . '">
                            <img src="admin/public/uploads/' . $row['HinhAnhSanPham'] . '" alt="" />
                            <div class="product__name">' . $row['TenSanPham'] . '</div>
                            <div class="product__price">' . number_format($row['GiaSanPham'], '0', ',', '.') . ' đ</div>
                        </a>
                        <button class="add_to_cart" data-maSanPham=' . $row['MaSanPham'] . '>Thêm vào giỏ</button>
                    </div>';
        }
    }    
}else{
    echo('Không có sp nào:)))))))');
}

if ($total_page > 1) {
    echo '</div>
    <ul class="pagi">';
    for ($i = 1; $i <= $total_page; $i++) {
        if ($i == $current_page) {
            echo '<li class="pagi-item is-active"  data-limit=8 data-p=' . $i . ' data-maloai=' . $maLoai . '>' . $i . '</li>';
        } else {
            echo '<li class="pagi-item" data-limit=8 data-p=' . $i . ' data-maloai=' . $maLoai . '>' . $i . '</li>';
        }
    }
    echo '</ul>';
}?>