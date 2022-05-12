<?php
require_once(__DIR__ . './../classes/cart.php');
$cart = new Cart();
$cart_items  = $cart->getAll();
?>
<main>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="index.php">Trang chủ</a>
                    </li>
                    <span class="divider">/</span>
                    <li>
                        <a href="">
                            Cart
                        </a>
                    </li>
                </ul>
            </div>
            <table class="table table-bordered" style="margin-top:15px">
                <thead class="table_cart-header">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Size</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng phụ</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="table_cart">
                <?php
                    require_once(__DIR__ . './../templates/cartContent.php');
                ?>
                </tbody>
            </table>
        </div>
        <div class="cart_info">
            <?php
            require_once(__DIR__ . './../templates/cartInfo.php');
            ?>
        </div>
        <p>
            <button class="btn_continue">
                <i class="fas fa-arrow-left icon_left"></i>
                Trở lại mua hàng
            </button>
        </p>
    </div>
</main>