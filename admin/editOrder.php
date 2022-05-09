<?php
        include_once 'config.php';
        $id = $_POST['id'];
        $order = "SELECT * from tbl_donhang where MaDonHang = $id";
        $result = mysqli_query($conn,$order);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="modal__add-product-overlay" onclick="hideModalEditOrder();"></div>
        <div class="modal__edit-order-content">

        <div class="modal__add-product-header">
            <p class="modal__add-product-header-heading">Cập nhật đơn hàng</p>
        </div>

        <div class="modal__add-product-user">
        <input title="<?php echo $row['MaDonHang']; ?>" type="text" value="<?php echo $row['MaDonHang']; ?>" name="id" readonly>
        </div>

        <div class="modal__add-product-user">
        <input title="<?php echo $row['MaKhachHang']; ?>" type="text" value="<?php echo $row['MaKhachHang']; ?>" readonly>
        </div>

        <div class="modal__add-product-type">
        <select id="editOrdertype" name="editOrdertype" >
        <?php
        $brand = "SELECT * from tbl_trangthaidonhang ";
        $result1 = mysqli_query($conn,$brand);  

        while($rowd = mysqli_fetch_assoc($result1)){
            ?>
                <option value="<?php echo $rowd['MaTrangThai']; ?>"><?php echo $rowd['TenTrangThai']; ?></option>
                <?php  }  ?>
        </select>

        </div>

        <div class="modal__add-product-btn" id="btnadminupdate">
            <button id="editProduct" name="editOrder-btn">Cập nhật</button>
        </div>

        <div class="modal__add-product-btn-close" onclick="hideModalEditOrder();">
            <i class="fas fa-window-close"></i>
        </div>

            </div>
    
    