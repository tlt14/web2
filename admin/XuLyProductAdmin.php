<?php
        include_once 'config.php';
        $product_per_page = 10;
       if(isset($_GET['idtrang'])){
        $idtrang=$_GET['idtrang'];
       }else{
        $idtrang =1;
         }
         
         if(isset($_GET['txtP'])){
            $txtP = $_GET['txtP'];
         }else{
            $txtP = "";
         }

         if(isset($_GET['sizeP'])){
            $sizeP = $_GET['sizeP'];
         }else{
            $sizeP = "";
         }

       $start_from = ($idtrang-1)*10;
        if(isset($_GET['act'])){
            if($_GET['act']== 'phantrangsanpham'){ 
                if($txtP == "" ){  
                $product = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1  ORDER BY tbl_sanpham.MaSanPham DESC LIMIT $start_from,10";
                $product_pagi = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 ORDER BY tbl_sanpham.MaSanPham DESC ";
            }else{
                $product = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 and tbl_sanpham.TenSanPham like'%$txtP%' ORDER BY tbl_sanpham.MaSanPham DESC LIMIT $start_from,10";
                $product_pagi = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 and tbl_sanpham.TenSanPham like'%$txtP%' ORDER BY tbl_sanpham.MaSanPham DESC ";
            }
                $result = mysqli_query($conn,$product); 
                $result1 = mysqli_query($conn,$product);
                $sql ="SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai ORDER by MaSanPham";
                loadProduct($conn,$sql,$product,$product_pagi,$result,$result1,$start_from,$product_per_page);
            } if($_GET['act']== 'phantrangsanphamSize'){ 
                if($sizeP == "macdinh"){  
                $product = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1  ORDER BY tbl_sanpham.MaSanPham DESC LIMIT $start_from,10";
                $product_pagi = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 ORDER BY tbl_sanpham.MaSanPham DESC ";
                $result = mysqli_query($conn,$product); 
                $result1 = mysqli_query($conn,$product);
                $sql ="SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai ORDER by MaSanPham";
                loadProduct($conn,$sql,$product,$product_pagi,$result,$result1,$start_from,$product_per_page);
            }else{
                $productSize = "SELECT * from tbl_sanpham,tbl_loaisanpham,tbl_size where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 and tbl_sanpham.TenSanPham like'%$txtP%' AND tbl_sanpham.MaSanPham = tbl_size.MaSanPham  and tbl_size.Size = '$sizeP' ORDER BY tbl_sanpham.MaSanPham DESC LIMIT $start_from,10";
                $product_pagiSize = "SELECT * from tbl_sanpham,tbl_loaisanpham,tbl_size where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 and tbl_sanpham.TenSanPham like'%$txtP%' AND tbl_sanpham.MaSanPham = tbl_size.MaSanPham  and tbl_size.Size = '$sizeP' ORDER BY tbl_sanpham.MaSanPham DESC";
                $result = mysqli_query($conn,$productSize); 
                $result1 = mysqli_query($conn,$productSize);
                $sql ="SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai ORDER by MaSanPham";
                loadProductSize($conn,$sql,$productSize,$product_pagiSize,$result,$result1,$start_from,$product_per_page);
            }
                
            }else if($_GET['act']== 'searchProduct'){ 
                $product = "SELECT * from tbl_sanpham,tbl_loaisanpham,tbl_size where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 and tbl_sanpham.TenSanPham like'%$txtP%' AND tbl_sanpham.MaSanPham = tbl_size.MaSanPham  and tbl_size.Size = '$sizeP' ORDER BY tbl_sanpham.MaSanPham DESC LIMIT $start_from,10";
                $product_pagi = "SELECT * from tbl_sanpham,tbl_loaisanpham,tbl_size where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 and tbl_sanpham.TenSanPham like'%$txtP%' AND tbl_sanpham.MaSanPham = tbl_size.MaSanPham  and tbl_size.Size = '$sizeP' ORDER BY tbl_sanpham.MaSanPham DESC";
                $result = mysqli_query($conn,$product); 
                $result1 = mysqli_query($conn,$product);
                $sql ="SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai ORDER by MaSanPham";
                loadProductSize($conn,$sql,$product,$product_pagi,$result,$result1,$start_from,$product_per_page);
            }else if($_GET['act']== 'deleteProduct'){
                $id= $_GET['idDeleteProduct'];
                $sql1 = "UPDATE tbl_sanpham SET tbl_sanpham.TrangThaiSanPham = 0 WHERE MaSanPham = $id";
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
                
                $product = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 ORDER BY tbl_sanpham.MaSanPham DESC LIMIT $start_from,10";
                $product_pagi = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 ORDER BY tbl_sanpham.MaSanPham DESC ";
                $result = mysqli_query($conn,$product); 
                $result1 = mysqli_query($conn,$product);
                $sql ="SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai ORDER by MaSanPham";
                loadProduct($conn,$sql,$product,$product_pagi,$result,$result1,$start_from,$product_per_page);
            }
        }else{
            $product = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 ORDER BY tbl_sanpham.MaSanPham DESC LIMIT $start_from,10";
            $product_pagi = "SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai AND tbl_sanpham.TrangThaiSanPham = 1 ORDER BY tbl_sanpham.MaSanPham DESC ";    
            $result = mysqli_query($conn,$product); 
                $result1 = mysqli_query($conn,$product);
                $sql ="SELECT * from tbl_sanpham,tbl_loaisanpham where tbl_sanpham.LoaiSanPham = tbl_loaisanpham.MaLoai ORDER by MaSanPham";
                loadProduct($conn,$sql,$product,$product_pagi,$result,$result1,$start_from,$product_per_page);
            }
    





  function loadProductSize($conn,$sql,$productSize,$product_pagiSize,$result,$result1,$start_from,$product_per_page){

    echo'<div id="del-noti"></div>
    <div class="app__content-container-title hide-on-mobile">
                            <div class="app__content-title">
                                <div class="app__content-title-id">
                                    <p>ID</p>
                                </div>
    
                                <div class="app__content-title-user">
                                    <p>Người bán</p>
                                </div>
    
                                <div class="app__content-title-name">
                                    <p>Tên sản phẩm</p>
                                </div>
    
                                <div class="app__content-title-quantity">
                                    <p>Số lượng</p>
                                </div>
    
                                <div class="app__content-title-type">
                                    <p>Loại</p>
                                </div>
    
                                <div class="app__content-title-description">
                                    <p>Mô Tả</p>
                                </div>
    
                                <div class="app__content-title-img">
                                    <p>Ảnh sản phẩm</p>
                                </div>
    
                                <div class="app__content-title-prices">
                                    <p>Giá bán</p>
                                </div>
    
                                <div class="app__content-title-tools">
                                    <p>Công cụ</p>
                                </div>
                            </div>
                        </div>';
    echo'<div class="app__content-container-show hide-on-mobile-admin">';
    while($row = mysqli_fetch_array($result)){
        echo' <div class="app__content-view">
        <div class="app__content-view-id">
            <p>
            '.$row['MaSanPham'].'
            </p>
        </div>
        <div class="app__content-view-user">
            <p>ADMIN</p>
        </div>
        <div class="app__content-view-name">
            <p title='.$row['TenSanPham'].'>
           '.$row['TenSanPham'].'</p>
        </div>

        <div class="app__content-view-quantity">
            <p>
            '.$row['SLSP'].'
            </p>
        </div>

        <div class="app__content-view-type">
            <p>
            '.$row['TenLoai'].'
            </p>
        </div>

        <div class="app__content-view-description">
            <p title=' .$row['MoTaSanPham'].'>
            ' .$row['MoTaSanPham'].'
            </p>
        </div>

        <div class="app__content-view-img">
            <img class="overflow-hidden object-cover aspect-video" src="./uploads/' .$row['HinhAnhSanPham'].'" alt="">
        </div>

        <div class="app__content-view-prices">
            <p>
            ' .$row['GiaSanPham'].'
            </p>
        </div>
        
        <div class="app__content-view-tools">
            <button class="app__content-view-tools-update edit-product" name="edit-product" onclick="editProduct('.$row['MaSanPham'].');displayModalEdit();" value="' .$row['MaSanPham'].'">
                <i class="fas fa-pen"></i>
    </button>
           
            <button  class="app__content-view-tools-delete del-product" name="delete-product" onclick="deleteProduct(' .$row['MaSanPham'].');" value="' .$row['MaSanPham'].'"> 
                <i class="fas fa-trash-alt"></i>
    </button>

        </div>
    </div>';
    }
    echo '</div>';
   
    echo'<div class="app__content-mobile hide-on-pc display-on-mobile">';
    while($row1 = mysqli_fetch_assoc($result1)){
        echo' <div class="app__content-mobile-view">
        <div class="app__content-mobile-view-id">
            <p><i class="fas fa-radiation-alt"></i> ID: <span>
            '.$row1['MaSanPham'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-user">
            <p><i class="fas fa-user"></i> Người bán: <span>ADMIN</span> </p>
        </div>

        <div class="app__content-mobile-view-name">
            <p><i class="fab fa-product-hunt"></i> Tên sản phẩm: <span>
            ' .$row1['TenSanPham'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-quantity">
            <p><i class="ti-pie-chart"></i> Số Lượng: <span>
            ' .$row1['SLSP'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-type">
            <p><i class="ti-info-alt"></i> Loại: <span>
            ' .$row1['TenLoai'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-description">
            <p><i class="ti-info-alt"></i> Mô tả: <span>
            ' .$row1['MoTaSanPham'].'
                </span></p>
        </div>

 

        <div class="app__content-mobile-view-img">
            <div class="app__content-mobile-view-img-content">
                <p><i class="far fa-image"></i> Ảnh: </p>
            </div>

            <div class="app__content-mobile-view-img-img">
                <img src="./uploads/' .$row1['HinhAnhSanPham'].'" alt="">
            </div>
        </div>

        <div class="app__content-mobile-view-prices">
            <p><i class="fas fa-dollar-sign"></i> Giá: <span>
            ' .$row1['GiaSanPham'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-tools">
            <button class="app__content-mobile-view-tools-update" name="edit-product" onclick="editProduct('.$row1['MaSanPham'].');displayModalEdit();" value=" '.$row1['MaSanPham'].'" >
                <i class="fas fa-pen"></i>
    </button>


            <button class="app__content-mobile-view-tools-delete del-product" name="delete-product" onclick="deleteProduct(' .$row1['MaSanPham'].'); value=" '.$row1['MaSanPham'].'">
                <i class="fas fa-trash-alt"></i>
    </button>
        </div>
    </div>';
    }


    echo'</div>';
    $rs_result = mysqli_query($conn,$product_pagiSize);
    $product_of_row = mysqli_num_rows($rs_result);
    $number_of_page = ceil($product_of_row / $product_per_page);
    echo'  <div class="pagination">
    <div class="pagination__list">
        <a href="admin.php" class="pagination__list-link">
            <div class="pagination__list-item">Home</div>
        </a>
        ';

    for($i = 1; $i<= $number_of_page;$i++){
    echo '    
            <div class="pagination__list-item" onclick="phantrangsanphamSize('.$i.')">'.$i.'</div>
    ';
    }

    echo'
    </div>

    </div>';
 
  }

  function loadProduct($conn,$sql,$product,$product_pagi,$result,$result1,$start_from,$product_per_page){
    echo'<div id="del-noti"></div>
    <div class="app__content-container-title hide-on-mobile">
                            <div class="app__content-title">
                                <div class="app__content-title-id">
                                    <p>ID</p>
                                </div>
    
                                <div class="app__content-title-user">
                                    <p>Người bán</p>
                                </div>
    
                                <div class="app__content-title-name">
                                    <p>Tên sản phẩm</p>
                                </div>
    
                                <div class="app__content-title-quantity">
                                    <p>Số lượng</p>
                                </div>
    
                                <div class="app__content-title-type">
                                    <p>Loại</p>
                                </div>
    
                                <div class="app__content-title-description">
                                    <p>Mô Tả</p>
                                </div>
    
                                <div class="app__content-title-img">
                                    <p>Ảnh sản phẩm</p>
                                </div>
    
                                <div class="app__content-title-prices">
                                    <p>Giá bán</p>
                                </div>
    
                                <div class="app__content-title-tools">
                                    <p>Công cụ</p>
                                </div>
                            </div>
                        </div>';
    echo'<div class="app__content-container-show hide-on-mobile-admin">';
    while($row = mysqli_fetch_array($result)){
        echo' <div class="app__content-view">
        <div class="app__content-view-id">
            <p>
            '.$row['MaSanPham'].'
            </p>
        </div>
        <div class="app__content-view-user">
            <p>ADMIN</p>
        </div>
        <div class="app__content-view-name">
            <p title='.$row['TenSanPham'].'>
           '.$row['TenSanPham'].'</p>
        </div>

        <div class="app__content-view-quantity">
            <p>
            '.$row['SoLuongSanPham'].'
            </p>
        </div>

        <div class="app__content-view-type">
            <p>
            '.$row['TenLoai'].'
            </p>
        </div>

        <div class="app__content-view-description">
            <p title=' .$row['MoTaSanPham'].'>
            ' .$row['MoTaSanPham'].'
            </p>
        </div>

        <div class="app__content-view-img">
            <img class="overflow-hidden object-cover aspect-video" src="./uploads/' .$row['HinhAnhSanPham'].'" alt="">
        </div>

        <div class="app__content-view-prices">
            <p>
            ' .$row['GiaSanPham'].'
            </p>
        </div>
        
        <div class="app__content-view-tools">
            <button class="app__content-view-tools-update edit-product" name="edit-product" onclick="editProduct('.$row['MaSanPham'].');displayModalEdit();" value="' .$row['MaSanPham'].'">
                <i class="fas fa-pen"></i>
    </button>
           
            <button  class="app__content-view-tools-delete del-product" name="delete-product" onclick="deleteProduct(' .$row['MaSanPham'].');" value="' .$row['MaSanPham'].'"> 
                <i class="fas fa-trash-alt"></i>
    </button>

        </div>
    </div>';
    }
    echo '</div>';
   
    echo'<div class="app__content-mobile hide-on-pc display-on-mobile">';
    while($row1 = mysqli_fetch_assoc($result1)){
        echo' <div class="app__content-mobile-view">
        <div class="app__content-mobile-view-id">
            <p><i class="fas fa-radiation-alt"></i> ID: <span>
            '.$row1['MaSanPham'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-user">
            <p><i class="fas fa-user"></i> Người bán: <span>ADMIN</span> </p>
        </div>

        <div class="app__content-mobile-view-name">
            <p><i class="fab fa-product-hunt"></i> Tên sản phẩm: <span>
            ' .$row1['TenSanPham'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-quantity">
            <p><i class="ti-pie-chart"></i> Số Lượng: <span>
            ' .$row1['SoLuongSanPham'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-type">
            <p><i class="ti-info-alt"></i> Loại: <span>
            ' .$row1['TenLoai'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-description">
            <p><i class="ti-info-alt"></i> Mô tả: <span>
            ' .$row1['MoTaSanPham'].'
                </span></p>
        </div>

 

        <div class="app__content-mobile-view-img">
            <div class="app__content-mobile-view-img-content">
                <p><i class="far fa-image"></i> Ảnh: </p>
            </div>

            <div class="app__content-mobile-view-img-img">
                <img src="./uploads/' .$row1['HinhAnhSanPham'].'" alt="">
            </div>
        </div>

        <div class="app__content-mobile-view-prices">
            <p><i class="fas fa-dollar-sign"></i> Giá: <span>
            ' .$row1['GiaSanPham'].'
                </span></p>
        </div>

        <div class="app__content-mobile-view-tools">
            <button class="app__content-mobile-view-tools-update" name="edit-product" onclick="editProduct('.$row1['MaSanPham'].');displayModalEdit();" value=" '.$row1['MaSanPham'].'" >
                <i class="fas fa-pen"></i>
    </button>


            <button class="app__content-mobile-view-tools-delete del-product" name="delete-product" onclick="deleteProduct(' .$row1['MaSanPham'].'); value=" '.$row1['MaSanPham'].'">
                <i class="fas fa-trash-alt"></i>
    </button>
        </div>
    </div>';
    }


    echo'</div>';
    $rs_result = mysqli_query($conn,$product_pagi);
    $product_of_row = mysqli_num_rows($rs_result);
    $number_of_page = ceil($product_of_row / $product_per_page);
    echo'  <div class="pagination">
    <div class="pagination__list">
        <a href="admin.php" class="pagination__list-link">
            <div class="pagination__list-item">Home</div>
        </a>
        ';

    for($i = 1; $i<= $number_of_page;$i++){
    echo '    
            <div class="pagination__list-item" onclick="phantrangsanpham('.$i.')">'.$i.'</div>
    ';
    }

    echo'
    </div>

    </div>';
 
  }         
?>