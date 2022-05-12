<?php
require_once(__DIR__ . './../classes/product.php');
$product = new Product();
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$result = $product->get_products_by_id($id);
$result = $result->fetch_assoc();
?>

<main>
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="index.php">Trang chủ</a>
                </li>
                <span class="divider">/</span>
                <li>
                    <a href="index.php?page=products&idLoai=<?php echo $result["LoaiSanPham"]; ?>">
                        <?php echo $result["TenLoai"]; ?>
                    </a>
                </li>
                <span class="divider">/</span>
                <li>
                    <!-- <a href="index.php?page=detail&id=<?php echo $result["MaSanPham"]; ?>"> -->
                    <?php echo $result["TenSanPham"]; ?>
                    <!-- </a> -->
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="image">
                <img src="./admin/uploads/<?php echo $result["HinhAnhSanPham"]; ?>" alt="">
            </div>
            <div class="product_info">

                <div class="product_name">
                    <p><?php echo $result["TenSanPham"]; ?></p>
                </div>
                <div class="product_price">
                    <p><?php echo number_format($result["GiaSanPham"], '0', ',', ','); ?> VNĐ</p>
                </div>
                <div class="product_quantity">
                    <button class="quantity_sub">-</button>
                    <input type="number" name="quantity" class="quantity_input" value="1" min="1" max="100">
                    <button class="quantity_plus">+</button>
                </div>
                <div class="product_size">
                    <!-- size -->
                    <p>Size</p>
                    <select name="size" id="size">
                        <option value="-1">Chọn size giày</option>
                        <?php
                        $sizes = $product->getSize($_GET['id']);
                        if ($sizes && $sizes->num_rows > 0) {
                            while ($row = $sizes->fetch_assoc()) {
                                if ($row['SLSP'] != 0) {
                                    echo '<option value="' . $row['Size'] . '">' . $row['Size'] . '</option>';
                                }
                            }
                        }

                        ?>
                    </select>
                </div>
                <div class="product_add_cart">
                    <button class="add_cart">
                        Thêm vào giỏ
                    </button>
                </div>
                <div class="product_desc">
                    <p class="product_desc-title">
                        Mô tả:
                    </p>
                    <p class="product_desc-value">
                        <?php echo $result["MoTaSanPham"]; ?>
                    </p>
                </div>
            </div>

        </div>

        <!-- comment -->
        <?php
        require_once(__DIR__ . './../templates/comment.php');
        ?>
    </div>
    <hr />
    <div class="similar_product">
        <div class="similar_product-tiltle">
            <p>Sản Phẩm Tương Tự</p>
        </div>
        <div class="similar_product-wrapper">
            <?php
            $result = $product->getProductByCategory($result["LoaiSanPham"]);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '  <div class="product__item">
                                    <a href="?page=detail&id=' . $row['MaSanPham'] . '">
                                        <img src="./admin/uploads/' . $row['HinhAnhSanPham'] . '" alt="" />
                                        <div class="product__name">' . $row['TenSanPham'] . '</div>
                                        <div class="product__price">' . number_format($row['GiaSanPham'], '0', ',', '.') . ' đ</div>
                                    </a>
                                    <button class="add_to_cart" data-maSanPham=' . $row['MaSanPham'] . '>Thêm vào giỏ</button>
                                </div>';
                }
            }
            ?>
        </div>
    </div>

</main>