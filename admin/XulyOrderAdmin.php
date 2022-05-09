<?php
        include_once 'config.php';
        if(isset($_GET['calendar1']) && isset($_GET['calendar1'])){
            $calendar1 = $_GET['calendar1'];
            $calendar2 = $_GET['calendar2'];
        }else{
            $calendar1 = "";
            $calendar2 = "";
        }
        $order_per_page = 3;
        if(isset($_GET['idorder'])){
        $idorder=$_GET['idorder'];
        }else{
        $idorder =1;
        }
        $start_from = ($idorder-1)*3;
        if(isset($_GET['act'])){
            if($_GET['act']== 'phantrangdonhang'){  
                if( $calendar1 == "" && $calendar2 == ""){
                $order = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai ORDER by MaDonHang DESC LIMIT $start_from,3";
                $order_pagi = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai  ORDER by MaDonHang DESC";
                
                }else{

                    $order = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai AND NgayDat BETWEEN '$calendar1' AND '$calendar2'  ORDER by MaDonHang DESC LIMIT $start_from,3";
                    $order_pagi = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai AND NgayDat BETWEEN '$calendar1' AND '$calendar2'  ORDER by MaDonHang DESC";
                
                }
                $result = mysqli_query($conn,$order); 
                $result1 = mysqli_query($conn,$order);
                loadOrder($conn,$order_pagi,$order,$result,$result1,$start_from,$order_per_page);
            }else if($_GET['act']=='deleteOrder'){
                $id= $_GET['idDeleteOrder'];
                $sql1 = "DELETE from tbl_donhang WHERE MaDonHang = $id";
                $query = mysqli_query($conn,$sql1);
                if($query){
                    echo '<script language="javascript">
                        swal({
                            title: "Delete success",
                            icon: "success",
                          })</script>';
                }else{
                    echo '<script language="javascript">
                        swal({
                            title: "Delete fail",
                            icon: "warning",
                          })</script>';
                }
             
                $order = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai  ORDER by MaDonHang DESC LIMIT $start_from,3";
                $order_pagi = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai  ORDER by MaDonHang DESC";
                $result = mysqli_query($conn,$order); 
                $result1 = mysqli_query($conn,$order);
                loadOrder($conn,$order_pagi,$order,$result,$result1,$start_from,$order_per_page);

            }else if($_GET['act'] == 'chitietdonhang'){
                $idCTDH= $_GET['idDetail'];
                $detail = "SELECT * FROM tbl_chitietdonhang,`tbl_donhang`,`tbl_sanpham` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_sanpham.MaSanPham = tbl_chitietdonhang.MaSanPham AND tbl_chitietdonhang.MaDonHang = $idCTDH";
                $result_detail = mysqli_query($conn,$detail);  
                $row_detail = mysqli_fetch_assoc($result_detail);
                showDetail($conn,$detail,$result_detail,$row_detail);
            }
            else if($_GET['act']== 'showcalendar'){ 
                $order = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai AND NgayDat BETWEEN '$calendar1' AND '$calendar2'  ORDER by MaDonHang DESC LIMIT $start_from,3";
                $order_pagi = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai AND NgayDat BETWEEN '$calendar1' AND '$calendar2'  ORDER by MaDonHang DESC";
                $result = mysqli_query($conn,$order); 
                $result1 = mysqli_query($conn,$order);
                loadOrder($conn,$order_pagi,$order,$result,$result1,$start_from,$order_per_page);
            }
        }else{
            $start_from = ($idorder-1)*3;
            $order = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai  ORDER by MaDonHang DESC LIMIT $start_from,3";
            $order_pagi = "SELECT * from tbl_donhang,tbl_trangthaidonhang where tbl_donhang.TrangThai = tbl_trangthaidonhang.MaTrangThai  ORDER by MaDonHang DESC";
            $result = mysqli_query($conn,$order); 
            $result1 = mysqli_query($conn,$order);
            loadOrder($conn,$order_pagi,$order,$result,$result1,$start_from,$order_per_page);
            }
            

    function showEdit($conn,$order,$result,$result1,$row,$rowd,$brand){
        $id = $_GET['idEditOrder'];
        $order = "SELECT * from tbl_donhang where MaDonHang = $id";
        $result = mysqli_query($conn,$order);
        $row = mysqli_fetch_assoc($result);
        echo'<div class="modal__add-product-overlay" onclick="hideModalEditOrder();"></div>
        <div class="modal__edit-order-content">

        <div class="modal__add-product-header">
            <p class="modal__add-product-header-heading">Cập nhật đơn hàng</p>
        </div>

        <div class="modal__add-product-user">
        <input title="'.$row['MaDonHang'].'" type="text" value="'.$row['MaDonHang'].'" readonly>
        </div>

        <div class="modal__add-product-user">
        <input title="'.$row['MaKhachHang'].'" type="text" value="'.$row['MaKhachHang'].'" readonly>
        </div>

        <div class="modal__add-product-type">
        <select id="editOrdertype" name="editOrdertype" >';
        
        $brand = "SELECT * from tbl_trangthaidonhang ";
        $result1 = mysqli_query($conn,$brand);  

        while($rowd = mysqli_fetch_assoc($result1)){
            echo'
                <option value="'.$rowd['MaTrangThai'].'">'.$rowd['TenTrangThai'].'</option>';
        }
        echo'</select>

        </div>

        <div class="modal__add-product-btn" id="btnadminupdate">
            <button id="editProduct" name="editOrder-btn">Cập nhật</button>
        </div>

        <div class="modal__add-product-btn-close" onclick="hideModalEditOrder();">
            <i class="fas fa-window-close"></i>
        </div>

            </div>';
    }

    function showDetail($conn,$detail,$result_detail,$row_detail){
        echo' <div class="modal__detail-bill-content">
        <div class="modal__detail-bill-header">
            <p>Chi tiết đơn hàng</p>
        </div>

        <div class="modal__detail-bill-id"> <p>Mã đơn hàng: 75f85993-2db4-4d8b-9024-d2ca9e9fbdb6</p></div>

        <div class="modal__detail-bill-product">

            <div class="modal__detail-bill-product-header">
                <p>Sản phẩm</p>
            </div>

            <div class="modal__detail-bill-title">
                <div class="modal__detail-bill-product-id-title">
                    <p>STT</p>
                </div>

                <div class="modal__detail-bill-product-name-title">
                    <p>Tên sản phẩm</p>
                </div>

                <div class="modal__detail-bill-product-img-title">
                    <p>Ảnh</p>
                </div>

                <div class="modal__detaill-bill-product-prices-title">
                    <p>Giá</p>
                </div>

                <div class="modal__detaill-bill-product-quantify-title">
                    <p>SL</p>
                </div>
            </div>';
            echo'<div class="modal__detail-bill-product-content">';
            $idCTDH= $_GET['idDetail'];
            $detail = "SELECT * FROM tbl_chitietdonhang,`tbl_donhang`,`tbl_sanpham` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_sanpham.MaSanPham = tbl_chitietdonhang.MaSanPham AND tbl_chitietdonhang.MaDonHang=$idCTDH";
            $result_detail = mysqli_query($conn,$detail);  
            while($row_detail = mysqli_fetch_assoc($result_detail)){
                echo'<div class="modal__detail-product-view">
                        
                <div class="modal__detail-bill-product-id" name="id">
                    <p>'.$row_detail['MaSanPham'].'</p>
                </div>
        
                <div class="modal__detail-bill-product-name" >
                    <p>'.$row_detail['TenSanPham'].'</p>
                </div>
        
                <div class="modal__detail-bill-product-img">
                    <img src="./uploads/'.$row_detail['HinhAnhSanPham'].'" alt="">
                </div>
        
                <div class="modal__detaill-bill-product-prices">
                    <p>'.$row_detail['GiaSanPham'].'</p>
                </div>
        
                <div class="modal__detaill-bill-product-quantify">
                    <p>'.$row_detail['SoLuongSP'].'</p>
                </div>
                
            </div>';
            }
            echo'</div>';
            $idCTDH= $_GET['idDetail'];
            $detail = "SELECT * FROM tbl_chitietdonhang,`tbl_donhang`,`tbl_sanpham` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_sanpham.MaSanPham = tbl_chitietdonhang.MaSanPham AND tbl_chitietdonhang.MaDonHang=$idCTDH";
            $result_detail = mysqli_query($conn,$detail);  
            $row_detail = mysqli_fetch_assoc($result_detail);
            echo'<div class="modal__detail-bill-product-time"> <p>Địa chỉ: '.$row_detail['DiaChiNguoiNhan'].'</p></div>

            <div class="modal__detail-bill-product-total"> <p>Tổng tiền : '.$row_detail['TongTien'].'</p></div>

            <div class="modal__detail-close" onclick="hideModalDetail();">
                <i class="fas fa-window-close"></i>
            </div>
       
        </div>
     </div>';
    }

                
  function loadOrder($conn,$order_pagi,$order,$result,$result1,$start_from,$order_per_page){
    echo'<div id="order-noti"></div>
    <div class="app__content-container-title hide-on-mobile">
                            <div class="app__content-title">
                                <div class="app__content-title_order-id">
                                    <p>ID</p>
                                </div>
    
                                <div class="app__content-title_order-user">
                                    <p>Mã Khách Hàng</p>
                                </div>
    
                                <div class="app__content-title_order-date">
                                    <p>Ngày đặt</p>
                                </div>
    
                                <div class="app__content-title_order-total">
                                    <p>Tổng tiền</p>
                                </div>
    
                                <div class="app__content-title_order-status">
                                    <p>Trạng thái</p>
                                </div>
    
                                <div class="app__content-title_order-detail">
                                    <p>Chi tiết đơn hàng</p>
                                </div>
    
                                <div class="app__content-title-tools">
                                    <p>Công cụ</p>
                                </div>
                            </div>
                        </div>';
            echo'<div class="app__content-container-show hide-on-mobile-admin">';
            while($row = mysqli_fetch_assoc($result)){
                echo'<div class="app__content-view">
                <div class="app__content-view_order-id">
                    <p>
                    '.$row['MaDonHang'].'
                    </p>
                </div>
                <div class="app__content-view_order-user">
                    <p title="'.$row['MaKhachHang'].'">
                    '.$row['MaKhachHang'].'</p>
                </div>

                <div class="app__content-view_order-date">
                    <p title="'.$row['NgayDat'].'">
                    '.$row['NgayDat'].'</p>
                </div>

                <div class="app__content-view_order-total">
                    <p title="'.$row['TongTien'].'">
                    '.$row['TongTien'].'</p>
                </div>

                <div class="app__content-view_order-status">
                    <p>
                    '.$row['TenTrangThai'].'
                    </p>
                    
                </div>

                <div class="app__content-view_order-detail">
                    <button  href="" onclick="view_detail('.$row['MaDonHang'].');showModalDetail();">Xem chi tiết</button>
                </div>

                <div class="app__content-view-tools">
                <button class="app__content-view-tools-update edit-order" onclick="editOrder('.$row['MaDonHang'].');displayModalEditOrder();" name="edit-order"  value="'.$row['MaDonHang'].'">
                        <i class="fas fa-pen"></i>
    </button>

                   
                    <button  class="app__content-view-tools-delete del-order" onclick="deleteOrder('.$row['MaDonHang'].');" name="delete-order" value="'.$row['MaDonHang'].'"> 
                        <i class="fas fa-trash-alt"></i>
              </button>

                </div>
            </div>';
            }
            echo '</div>';

            echo'<div class="app__content-mobile hide-on-pc display-on-mobile">';
            while($row1 = mysqli_fetch_assoc($result1)){
                echo'  <div class="app__content-mobile-view">
                <div class="app__content-mobile-view_order-id">
                    <p>
                    <i class="fas fa-radiation-alt"></i> ID: <span>
                    '.$row1['MaDonHang'].'
                        </span></p>
                    </p>
                </div>
                <div class="app__content-mobile-view_order-user">
                <p><i class="fas fa-user"></i> Mã Khách Hàng: <span>
                '.$row1['MaKhachHang'].'
                        </span></p>
                </div>

                <div class="app__content-mobile-view_order-date">
                <p><i class="ti-calendar"></i> Ngày đặt: <span>
                '.$row1['NgayDat'].'</p>
                        </span></p>
                    
                </div>

                <div class="app__content-mobile-view_order-total">
                <p><i class="ti-money"></i> Tổng tiền: <span>
                '.$row1['TongTien'].'</p>
                        </span></p>
                </div>

                <div class="app__content-mobile-view_order-status">
                <p><i class="ti-bookmark-alt"></i> Trạng thái: <span>
                '.$row1['TenTrangThai'].'</p>
                        </span></p>
                </div>

                
                <button class="app__content-mobile-view_order-tools-detail" onclick="view_detail('.$row1['MaDonHang'].');showModalDetail();" >Xem chi tiết</button>
                
                <div class="app__content-mobile-view-tools">
               
                    <button class="app__content-mobile-view-tools-update update-order" onclick="editOrder('.$row1['MaDonHang'].');displayModalEditOrder();" name="edit-order" value="'.$row1['MaDonHang'].'">
                        <i class="fas fa-pen"></i>
    </button>

                    <button class="app__content-mobile-view-tools-delete del-order" onclick="deleteOrder('.$row1['MaDonHang'].');" name="delete-order" value="'.$row1['MaDonHang'].'">
                        <i class="fas fa-trash-alt"></i>
    </button>
                    
                </div>
            </div>';
            }
            echo'</div>';
           
            $rs_result = mysqli_query($conn,$order_pagi);
            $order_of_row = mysqli_num_rows($rs_result);
            $number_of_page = ceil($order_of_row / $order_per_page);
            echo'  <div class="pagination">
            <div class="pagination__list">
                <a href="admin.php" class="pagination__list-link">
                    <div class="pagination__list-item">Home</div>
                </a>
                ';
        
            for($i = 1; $i<= $number_of_page;$i++){
            echo '    
                    <div class="pagination__list-item" onclick="phantrangdonhang('.$i.')">'.$i.'</div>
            ';
            }
        
            echo'
            </div>
        
            </div>';
         
        }
    

?>