<?php
require_once(__DIR__ . './../classes/cart.php');
require_once(__DIR__ . './../classes/product.php');
$cart = new Cart();
$product = new Product();
?>
<?php
    if(isset($_POST['idCart']) && $_POST['act']=='delete'){
        if($cart->delete_product_cart($_POST['idCart'])){
            echo($cart->get_quantity_product_cart());   
        }else{
            echo("Xóa sản phẩm thất bại");
        }
    }
    // if(isset($_POST['idsp']) && $_POST['act']=='update'){
    //     if($cart->update_product_cart($_POST['idsp'],$_POST['quantity'])){
    //         echo($cart->get_total_price());
    //     }else{
    //         echo("Cập nhật sản phẩm thất bại");
    //     }
    // }
?>


    <?php
    $cart_items  = $cart->getAll();
    if (empty($cart_items)) {
        echo '<tr><td colspan="6"><p>Your cart is empty!</p></td></tr>';
    } else
        foreach ($cart_items as $item) : ?>
        <tr data-idcart=<?= $item['MaGioHang']; ?>>
            <td><?php echo $item['TenSanPham']; ?></td>
            <td><img src="./admin/uploads/<?php echo $item['HinhAnhSanPham']; ?>" alt="<?php echo $item['TenSanPham']; ?>"></td>
            <td><?php echo $item['SizeSP'] ?></td>
            <td><?php echo number_format($item['GiaSanPham'], 0, ',', ','); ?> VNĐ</td>
            <td>
                <div class="product_quantity qty_cart">
                    <button class="cart_quantity_sub" onclick="handleSub(this)" data-idcart=<?= $item['MaGioHang']; ?>>-</button>
                    <input type="number" name="quantity" class="cartquantity_input" value="<?php echo $item['SoLuong']; ?>" min="0" max="<?php echo $product->getQuantity($item['MaSanPham'],$item['SizeSP']);?>">
                    <button class="cart_quantity_plus" onclick="handlePlus(this)" data-idcart=<?= $item['MaGioHang']; ?>>+</button>
                </div>
            </td>
            <td>
                <?php
                if ($item['GiamGia'] != 0) {
                    echo '<p>-' . $item["GiamGia"] . '%</p>';
                    echo '<span class="price">' . number_format($item['GiaSanPham'] * $item['SoLuong'] * (100 - $item['GiamGia']) / 100, 0, ',', ',') . ' VNĐ</span>';
                } else {
                    echo '<span class="price">' . number_format($item['GiaSanPham'] * $item['SoLuong'], 0, ',', ',') . ' VNĐ</span>';
                }
                ?></td>
            <td>
                <button class="btn-remove" onclick="deleteItemInCart(<?= $item['MaGioHang']; ?>);" >
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>