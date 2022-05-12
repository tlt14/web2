<?php
require_once(__DIR__ . './../classes/cart.php');
$cart = new Cart();
if (isset($_POST['act']) && $_POST['act'] == "getInfo") { 
    echo '<div>
    <div class="total">
        <span  id="total">Tổng tiền: '. number_format($cart->get_total_price(), 0, ',', ',').' VNĐ</span>
    </div>
    <div class="total">
        <span id="qtyCart">Số Lượng: '. $cart->get_quantity_product_cart() .' sản phẩm</span>
    </div>
    <div class="total">
        <button class="check_out" onclick="btnCheckOut();">Thanh toán</button>
    </div>
</div>';
}
else{
    echo '<div>
    <div class="total">
        <span id="total">Tổng tiền: '. number_format($cart->get_total_price(), 0, ',', ',').' VNĐ</span>
    </div>
    <div class="total">
        <span id="qtyCart">Số Lượng: '. $cart->get_quantity_product_cart() .' sản phẩm</span>
    </div>
    <div class="total">
        <button class="check_out" onclick="btnCheckOut();">Thanh toán</button>
    </div>
</div>';
}
    