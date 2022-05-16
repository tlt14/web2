        <?php
        include_once 'config.php';
        $id = $_POST['id'];
        $sql_up = "SELECT * from tbl_sanpham where MaSanPham = $id";
        $query_up = mysqli_query($conn, $sql_up);
        $row_up = mysqli_fetch_assoc($query_up);
        ?>
        <div class="modal__add-product-overlay" onclick="hideModalEdit();"></div>
        <div class="modal__edit-product-content">

            <div class="modal__add-product-header">
                <p class="modal__add-product-header-heading">Sửa sản phẩm</p>
            </div>

            <div class="modal__add-product-user">
                <input title=' <?php echo $row_up['MaSanPham']; ?>' type="text" placeholder="Tên sản phẩm ....." value="<?php echo $row_up['MaSanPham']; ?>" name="id" readonly>
            </div>

            <div class="modal__add-product-name">
                <input title=' <?php echo $row_up['TenSanPham']; ?>' type="text" placeholder="Tên sản phẩm ....." value="<?php echo $row_up['TenSanPham']; ?>" name="productname">
            </div>

            <div class="modal__add-product-quantity">
                <input type="number" placeholder="Số lượng sản phẩm" value="<?php echo $row_up['SoLuongSanPham']; ?>" id="txtadminquantity" name="productquantity">
            </div>

            <div class="modal__add-product-type">
                <select id="txtadmintype" name="producttype">
                    <?php
                    $brand = "SELECT * from tbl_loaisanpham ";
                    $result = mysqli_query($conn, $brand);

                    while ($rowd = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value="<?php echo $rowd['MaLoai']; ?>"><?php echo $rowd['TenLoai']; ?></option>
                    <?php  }  ?>
                </select>

            </div>


            <div class="modal__add-product-description">
                <input title='<?php echo $row_up['MoTaSanPham']; ?>' type="text" placeholder="Mô tả sản phẩm" value="<?php echo $row_up['MoTaSanPham']; ?>" id="txtadmindescription" name="productdescription">
            </div>

            <div class="modal__add-product-img">
                <input type="file" name="productimg" id="editProductimg" accept="image/gif, image/jpeg,image/png" onchange="chooseFile(this)">
                <img id="editIMG" width="50" height="50" alt="">
            </div>

            <div class="modal__add-product-prices">
                <input type="number" placeholder="Giá sản phẩm" value="<?php echo $row_up['GiaSanPham']; ?>" id="txtadminprices" name="productprice">
            </div>

            <div class="modal__add-product-btn" id="btnadminupdate">
                <button id="editProduct" name="editProduct-btn">Cập nhật</button>
            </div>

            <div class="modal__add-product-btn-close" onclick="hideModalEdit();">
                <i class="fas fa-window-close"></i>
            </div>

        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="main.js"></script>
        <script>
            function chooseFile(fileInput) {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#editIMG').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        </script>