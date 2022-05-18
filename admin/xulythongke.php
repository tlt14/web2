<?php
    include_once('dataProvider.php');
    if(isset($_GET['ngaybatdau'])&&isset($_GET['ngayketthuc']))
    {
        $ngaybatdau=$_GET['ngaybatdau'];
        $ngayketthuc=$_GET['ngayketthuc'];
    }else{
        $ngaybatdau="";
        $ngayketthuc="";
    }
    if(isset($_GET['change']))
    {
        $check=$_GET['change'];
    }else{
        $check=0;
    }

    if(isset($_GET['idtrang']))
    {
        $idtrang=$_GET['idtrang'];
    }else{
        $idtrang=1;
    }
    $sltungtrang=6;
    $trangbatdau=($idtrang-1)*6;

    if(isset($_GET['act']))
    {
        if($_GET['act'] == 'loaddataloaibegin'){
            loadata($check,$ngaybatdau,$ngayketthuc,$trangbatdau,$sltungtrang);
        }
        else if($_GET['act'] == 'phantrang'){
            loadata($check,$ngaybatdau,$ngayketthuc,$trangbatdau,$sltungtrang);
        }
        else if($_GET['act'] == 'loc'){
            loadata($check,$ngaybatdau,$ngayketthuc,$trangbatdau,$sltungtrang);
        }
        else if($_GET['act'] == 'locngaythang'){
            loadata($check,$ngaybatdau,$ngayketthuc,$trangbatdau,$sltungtrang);
        }
        else if($_GET['act'] == 'loctongtien'){
            $tongtien=0;
            if($ngaybatdau==""&&$ngayketthuc==""){
                $query="SELECT SUM(tbl_donhang.TongTien) AS tongtien FROM `tbl_donhang` WHERE tbl_donhang.TrangThai=4 ";
            }else{
                $query="SELECT SUM(tbl_donhang.TongTien) AS tongtien FROM `tbl_donhang` WHERE tbl_donhang.TrangThai=4 AND tbl_donhang.NgayDat BETWEEN '$ngaybatdau'AND '$ngayketthuc'";
            }
            $result=dataProvider::executeQuery($query);
            while($row=mysqli_fetch_array($result)){
                $tongtien+=$row['tongtien'];
            }
            echo '<div class="txt_tien">Tổng thu nhập: '.$tongtien.' VND</div>';
        } else if($_GET['act'] == 'loaddataloai'){
            $query="SELECT * FROM `tbl_loaisanpham`";
            $result=dataProvider::executeQuery($query);
            while($row=mysqli_fetch_array($result)){
                echo '<option value="'.$row['MaLoai'].'">'.$row['TenLoai'].'</option>';
            }
            // echo'<div class="txt_tien">Tổng thu nhập: '.number_format($tongtien,'0',',',',').' VND</div>';
        }

    }else{
        $tongtien=0;
        $query="SELECT SUM(tbl_donhang.TongTien) AS tongtien FROM `tbl_donhang` WHERE tbl_donhang.TrangThai=4";
        $result=dataProvider::executeQuery($query);
        while($row=mysqli_fetch_array($result)){
            $tongtien=$row['tongtien'];
        }
        echo'<div class="txt_tien">Tổng thu nhập: '.number_format($tongtien,'0',',',',').' VND</div>';
    }


    function loadata($check,$ngaybatdau,$ngayketthuc,$trangbatdau,$sltungtrang){
        $d=0;
        $countProduct=0;
        if($ngaybatdau==""&&$ngayketthuc==""&&$check==0){
            $sql=dataProvider::executeQuery("SELECT tbl_loaisanpham.TenLoai, SUM(temp2.tongsl) AS soluongtungloai,SUM(temp2.tongtien) AS tongtientungloai FROM `tbl_loaisanpham`,(SELECT tbl_sanpham.LoaiSanPham,(temp1.tongsl*tbl_sanpham.GiaSanPham) AS tongtien,temp1.tongsl FROM `tbl_sanpham`,(SELECT tbl_chitietdonhang.MaSanPham,SUM(tbl_chitietdonhang.SoLuongSP) as tongsl FROM `tbl_donhang`,`tbl_chitietdonhang` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_donhang.TrangThai=4 GROUP by tbl_chitietdonhang.MaSanPham) AS temp1 WHERE temp1.MaSanPham=tbl_sanpham.MaSanPham) AS temp2 WHERE temp2.LoaiSanPham=tbl_loaisanpham.MaLoai AND tbl_loaisanpham.MaLoai GROUP BY tbl_loaisanpham.MaLoai LIMIT $trangbatdau,$sltungtrang");
            $sqlphantrang=dataProvider::executeQuery("SELECT tbl_loaisanpham.MaLoai, SUM(temp2.tongsl) AS soluongtungloai,SUM(temp2.tongtien) AS tongtientungloai FROM `tbl_loaisanpham`,(SELECT tbl_sanpham.LoaiSanPham,(temp1.tongsl*tbl_sanpham.GiaSanPham) AS tongtien,temp1.tongsl FROM `tbl_sanpham`,(SELECT tbl_chitietdonhang.MaSanPham,SUM(tbl_chitietdonhang.SoLuongSP) as tongsl FROM `tbl_donhang`,`tbl_chitietdonhang` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_donhang.TrangThai=4 GROUP by tbl_chitietdonhang.MaSanPham) AS temp1 WHERE temp1.MaSanPham=tbl_sanpham.MaSanPham) AS temp2 WHERE temp2.LoaiSanPham=tbl_loaisanpham.MaLoai GROUP BY tbl_loaisanpham.MaLoai");
        }else if($ngaybatdau!=""&&$ngayketthuc!=""&&$check==0){
            $sql=dataProvider::executeQuery("SELECT tbl_loaisanpham.TenLoai, SUM(temp2.tongsl) AS soluongtungloai,SUM(temp2.tongtien) AS tongtientungloai FROM `tbl_loaisanpham`,(SELECT tbl_sanpham.LoaiSanPham,(temp1.tongsl*tbl_sanpham.GiaSanPham) AS tongtien,temp1.tongsl FROM `tbl_sanpham`,(SELECT tbl_chitietdonhang.MaSanPham,SUM(tbl_chitietdonhang.SoLuongSP) as tongsl FROM `tbl_donhang`,`tbl_chitietdonhang` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_donhang.NgayDat BETWEEN '$ngaybatdau' AND '$ngayketthuc' AND tbl_donhang.TrangThai=4 GROUP by tbl_chitietdonhang.MaSanPham) AS temp1 WHERE temp1.MaSanPham=tbl_sanpham.MaSanPham) AS temp2 WHERE temp2.LoaiSanPham=tbl_loaisanpham.MaLoai AND tbl_loaisanpham.MaLoai GROUP BY tbl_loaisanpham.MaLoai LIMIT  $trangbatdau,$sltungtrang");
            $sqlphantrang=dataProvider::executeQuery("SELECT tbl_loaisanpham.MaLoai, SUM(temp2.tongsl) AS soluongtungloai,SUM(temp2.tongtien) AS tongtientungloai FROM `tbl_loaisanpham`,(SELECT tbl_sanpham.LoaiSanPham,(temp1.tongsl*tbl_sanpham.GiaSanPham) AS tongtien,temp1.tongsl FROM `tbl_sanpham`,(SELECT tbl_chitietdonhang.MaSanPham,SUM(tbl_chitietdonhang.SoLuongSP) as tongsl FROM `tbl_donhang`,`tbl_chitietdonhang` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_donhang.NgayDat BETWEEN '$ngaybatdau' AND '$ngayketthuc' AND tbl_donhang.TrangThai=4 GROUP by tbl_chitietdonhang.MaSanPham) AS temp1 WHERE temp1.MaSanPham=tbl_sanpham.MaSanPham) AS temp2 WHERE temp2.LoaiSanPham=tbl_loaisanpham.MaLoai GROUP BY tbl_loaisanpham.MaLoai");
        }else if($ngaybatdau==""&&$ngayketthuc==""&&$check=='sp'){
            $sql=dataProvider::executeQuery("SELECT tbl_sanpham.TenSanPham,(temp1.tongsl*tbl_sanpham.GiaSanPham) AS tongtien,(temp1.tongsl) tongsl FROM `tbl_sanpham`,(SELECT tbl_chitietdonhang.MaSanPham,SUM(tbl_chitietdonhang.SoLuongSP) as tongsl FROM `tbl_donhang`,`tbl_chitietdonhang` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_donhang.TrangThai=4 GROUP by tbl_chitietdonhang.MaSanPham) AS temp1 WHERE temp1.MaSanPham=tbl_sanpham.MaSanPham GROUP BY tbl_sanpham.MaSanPham ORDER BY tongsl DESC LIMIT 6");
        }else if($ngaybatdau!=""&&$ngayketthuc!=""&&$check=='sp'){
            $sql=dataProvider::executeQuery("SELECT tbl_sanpham.TenSanPham,(temp1.tongsl*tbl_sanpham.GiaSanPham) AS tongtien,(temp1.tongsl) tongsl FROM `tbl_sanpham`,(SELECT tbl_chitietdonhang.MaSanPham,SUM(tbl_chitietdonhang.SoLuongSP) as tongsl FROM `tbl_donhang`,`tbl_chitietdonhang` WHERE tbl_chitietdonhang.MaDonHang=tbl_donhang.MaDonHang AND tbl_donhang.NgayDat BETWEEN '$ngaybatdau'AND '$ngayketthuc' AND tbl_donhang.TrangThai=4 GROUP by tbl_chitietdonhang.MaSanPham) AS temp1 WHERE temp1.MaSanPham=tbl_sanpham.MaSanPham GROUP BY tbl_sanpham.MaSanPham ORDER BY tongsl DESC LIMIT 6");
        }else{
            $sql=dataProvider::executeQuery("SELECT tbl_loaisanpham.TenLoai,SUM(temp2.sl) as SoLuong,SUM(temp2.tongtien) as TongTien FROM tbl_loaisanpham,
            (SELECT tbl_loaisanpham.MaLoai,(SUM(tbl_chitietdonhang.SoLuongSP)) AS sl,(SUM(tbl_chitietdonhang.SoLuongSP)*tbl_sanpham.GiaSanPham) AS tongtien FROM `tbl_donhang`,`tbl_chitietdonhang`,`tbl_sanpham`,`tbl_loaisanpham` WHERE tbl_donhang.MaDonHang=tbl_chitietdonhang.MaDonHang AND tbl_donhang.TrangThai=4 AND tbl_sanpham.MaSanPham=tbl_chitietdonhang.MaSanPham AND tbl_loaisanpham.MaLoai=tbl_sanpham.LoaiSanPham AND tbl_loaisanpham.MaLoai=$check GROUP BY tbl_chitietdonhang.MaSanPham ) as temp2  WHERE tbl_loaisanpham.MaLoai=temp2.MaLoai GROUP BY temp2.MaLoai");
            $sqlphantrang=dataProvider::executeQuery("SELECT tbl_loaisanpham.TenLoai,SUM(temp2.sl) as SoLuong,SUM(temp2.tongtien) as TongTien FROM tbl_loaisanpham,
            (SELECT tbl_loaisanpham.MaLoai,(SUM(tbl_chitietdonhang.SoLuongSP)) AS sl,(SUM(tbl_chitietdonhang.SoLuongSP)*tbl_sanpham.GiaSanPham) AS tongtien FROM `tbl_donhang`,`tbl_chitietdonhang`,`tbl_sanpham`,`tbl_loaisanpham` WHERE tbl_donhang.MaDonHang=tbl_chitietdonhang.MaDonHang AND tbl_donhang.TrangThai=4 AND tbl_sanpham.MaSanPham=tbl_chitietdonhang.MaSanPham AND tbl_loaisanpham.MaLoai=tbl_sanpham.LoaiSanPham AND tbl_loaisanpham.MaLoai=$check GROUP BY tbl_chitietdonhang.MaSanPham ) as temp2  WHERE tbl_loaisanpham.MaLoai=temp2.MaLoai GROUP BY temp2.MaLoai");
        }
        if($check==0){
            while($row=mysqli_fetch_array($sql)){
                echo'<div id="panel_loai">
                    <div id="panel_tungloai">
                        <div id="tenloai">Tên loại: '.$row['TenLoai'].'</div>
                        <div id="sltungloai">Số lượng: '.$row['soluongtungloai'].'</div>
                        <div id="tongtientuwngloai">Tổng thu nhập của loại: '.number_format($row['tongtientungloai'],'0',',',',').' VND</div>
                    </div>
                </div>';
                }
                $countProduct=mysqli_num_rows($sql);
                if($countProduct==0){
                    echo '<div id="thongbao">Không có sản phẩm nào trong khoảng thời gian này !!!</div>';
                }
                $d=mysqli_num_rows($sqlphantrang);
                $sltrang=ceil($d/6);
                if($sltrang>1){
                    echo'<div class="trang">';
                for($i=1;$i<=$sltrang;$i++){
                    echo'<div class="trang_inner" onclick="phantrang('.$i.');">'.$i.'</div>';
                }
                echo'</div>';
            }
        }else if($check=='sp'){
            while($row=mysqli_fetch_array($sql)){
                echo'<div id="panel_loai">
                    <div id="panel_tungloai">
                    <div id="tenloai">Tên Sản phẩm: '.$row['TenSanPham'].'</div>
                    <div id="sltungloai">Số lượng sản phẩm: '.$row['tongsl'].'</div>
                    <div id="tongtientuwngloai">Tổng thu nhập của sản phẩm: '.number_format($row['tongtien'],'0',',',',').' VND</div>
                    </div>
                </div>';
            }
        }else{
            while($row=mysqli_fetch_array($sql)){
                echo'<div id="panel_loai">
                    <div id="panel_tungloai">
                        <div id="tenloai">Tên loại: '.$row['TenLoai'].'</div>
                        <div id="sltungloai">Số lượng: '.$row['SoLuong'].'</div>
                        <div id="tongtientuwngloai">Tổng thu nhập của loại: '.number_format($row['TongTien'],'0',',',',').' VND</div>
                    </div>
                </div>';
                }
                $countProduct=mysqli_num_rows($sql);
                if($countProduct==0){
                    echo '<div id="thongbao">Không có sản phẩm nào trong khoảng thời gian này !!!</div>';
                }
                $d=mysqli_num_rows($sqlphantrang);
                $sltrang=ceil($d/6);
                if($sltrang>1){
                    echo'<div class="trang">';
                for($i=1;$i<=$sltrang;$i++){
                    echo'<div class="trang_inner" onclick="phantrang('.$i.');">'.$i.'</div>';
                }
                echo'</div>';
            }
        }
    }
?>