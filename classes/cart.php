<?php

include_once 'database.php';
?>



<?php
class Cart
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    } 
    public function add_to_cart($id, $qty,$size)
    {
        
        //save cart to database
        $quantity = 0;    
        if(isset($_COOKIE['maKhachHang'])){
            $makh = $_COOKIE['maKhachHang'];
            $sql="SELECT * FROM tbl_giohang WHERE MaKhachHang = '$makh' AND MaSanPham = '$id' AND SizeSP = '$size'";
            $result = $this->db->select($sql);
            if($result!=null && $result->num_rows>0){
                $sql="UPDATE tbl_giohang SET SoLuong=SoLuong+'$qty' WHERE MaSanPham='$id' AND MaKhachHang='$makh' AND SizeSP = '$size'";
                $this->db->update($sql);
            }else{
                $sql = "INSERT INTO tbl_giohang (MaKhachHang,MaSanPham,SoLuong,SizeSP) VALUES('$makh','$id','$qty','$size')";
                $this->db->insert($sql);
            }
            $quantity = $this->db->select("SELECT SUM(SoLuong) FROM tbl_giohang WHERE MaKhachHang = '$makh'")->fetch_assoc()['SUM(SoLuong)'];
        }else{
            $idCart=$_COOKIE['idCart'];
            $sql="SELECT * FROM tbl_giohang WHERE id='$idCart' AND MaSanPham = '$id' AND SizeSP = '$size'";
            $result = $this->db->select($sql);
            if($result!=null && $result->num_rows>0){
                $sql="UPDATE tbl_giohang SET SoLuong=SoLuong+'$qty' WHERE MaSanPham='$id' AND id='$idCart' AND SizeSP = '$size'";
                $this->db->update($sql);
            }else{
                $sql = "INSERT INTO tbl_giohang (id,MaSanPham,SoLuong,SizeSP) VALUES('$idCart','$id','$qty','$size')";
                $this->db->insert($sql);
            }
            $quantity = $this->db->select("SELECT SUM(SoLuong) FROM tbl_giohang WHERE id = '$idCart'")->fetch_assoc()['SUM(SoLuong)'];
        }
        echo ($quantity);
    }
    public function get_quantity_product_cart(){
        $qty=0;
        if(isset($_COOKIE['maKhachHang'])){
            $qty = $this->db->select("SELECT SUM(SoLuong) FROM tbl_giohang WHERE MaKhachHang = '$_COOKIE[maKhachHang]'")->fetch_assoc()['SUM(SoLuong)'];
        }else{
            $idCart=isset($_COOKIE['idCart'])?$_COOKIE['idCart']:null;
            $qty = $this->db->select("SELECT SUM(SoLuong) FROM tbl_giohang WHERE id = '$idCart'")->fetch_assoc()['SUM(SoLuong)'];
        }
        return $qty!=null ? $qty :0;
    }
    public function getAll(){
        if(isset($_COOKIE['maKhachHang'])){
            $makh = $_COOKIE['maKhachHang'];
            $sql = "SELECT * FROM tbl_giohang,tbl_sanpham WHERE tbl_giohang.MaSanPham = tbl_sanpham.MaSanPham AND MaKhachHang = '$makh'";
        }else{
            $idCart=$_COOKIE['idCart'];
            $sql="SELECT * FROM tbl_giohang,tbl_sanpham WHERE tbl_giohang.MaSanPham = tbl_sanpham.MaSanPham AND id='$idCart'";
        }
        // echo($sql);
        $result = $this->db->select($sql);
        return $result?$result:false;
    }
    public function get_total_price(){
        if(isset($_COOKIE['maKhachHang'])){
            $makh = $_COOKIE['maKhachHang'];
            $sql = "SELECT SUM((tbl_sanpham.GiaSanPham*tbl_giohang.SoLuong)-(tbl_giohang.SoLuong*tbl_sanpham.GiaSanPham * ((tbl_sanpham.GiamGia)/100))) AS 'Total' 
                    FROM tbl_giohang,tbl_sanpham 
                    WHERE tbl_giohang.MaSanPham = tbl_sanpham.MaSanPham AND MaKhachHang = '$makh'";
        }else{
            $idCart=$_COOKIE['idCart'];
            $sql="SELECT SUM((tbl_sanpham.GiaSanPham*tbl_giohang.SoLuong)-(tbl_giohang.SoLuong*tbl_sanpham.GiaSanPham * ((tbl_sanpham.GiamGia)/100))) AS 'Total' 
            FROM tbl_giohang,tbl_sanpham 
            WHERE tbl_giohang.MaSanPham = tbl_sanpham.MaSanPham AND id='$idCart'";
        }
        $result = $this->db->select($sql)->fetch_assoc()['Total'];
        return $result?$result:0;
    }
    public function delete_product_cart($id){
        if(isset($_COOKIE['maKhachHang'])){
            $makh = $_COOKIE['maKhachHang'];
            $sql = "DELETE FROM tbl_giohang WHERE MaGioHang = '$id' ";
        }else{
            $idCart=$_COOKIE['idCart'];
            $sql = "DELETE FROM tbl_giohang WHERE MaGioHang = '$id'";
        }
        return $this->db->delete($sql)?true:false;
    }
    public function update_product_cart($idCart,$qty){
        if(isset($_COOKIE['maKhachHang'])){
            $makh = $_COOKIE['maKhachHang'];
            $sql = "UPDATE tbl_giohang SET SoLuong = '$qty' WHERE MaGioHang = '$idCart' AND MaKhachHang = '$makh'";
        } else{
            $idTmp=$_COOKIE['idCart'];
            $sql = "UPDATE tbl_giohang SET SoLuong = '$qty' WHERE MaGioHang = '$idCart' AND id = '$idTmp'";
        }
        return $this->db->update($sql)?true:false;
    }
    public function add_order($makh,$tongtien,$cart,$address,$name,$phone,$note,$email){
        $check="";
        if($cart!=null){
            foreach($cart as $item){
                $sql = 'SELECT * FROM tbl_sanpham,tbl_size WHERE tbl_sanpham.MaSanPham = tbl_size.MaSanPham AND tbl_sanpham.MaSanPham = '.$item['MaSanPham'].' AND tbl_size.Size = '.$item['SizeSP'].'  AND tbl_sanpham.MaSanPham = '.$item['MaSanPham'].'';
                $result = $this->db->select($sql);
                $row = $result->fetch_assoc();
                if($row['SLSP']==0){
                    echo '<script>
                            Toast.fire({
                                icon: "error",
                                title:"Sản phẩm '.$row['TenSanPham'].' đã hết hàng",
                              });
                            </script>';
                    return false;
                }else
                if($item['SoLuong']>$row['SLSP']){
                    echo '<script>
                        Toast.fire({
                            icon: "error",
                            title: "Số lượng sản phẩm '.$row['TenSanPham'].' không đủ chỉ còn '.$row['SLSP'].' sản phẩm",
                          });
                    </script>
                    ';
                    return false;
                } 
            }
        }


        $sql = "INSERT INTO tbl_donhang (MaKhachHang,TongTien,TenNguoiNhan,SDTNguoiNhan,DiaChiNguoiNhan) VALUES('$makh','$tongtien','$name','$phone','$address')";
        $this->db->insert($sql);
        $last_id = $this->db->last_id();
        if($cart!=null){
            foreach($cart as $item){
                $sql='INSERT INTO `tbl_chitietdonhang` ( `MaDonHang`, `GhiChu`, `MaSanPham`, `SoLuongSP`,`SizeSanPham`)
                VALUES ('.$last_id.',"'.$note.'",'.$item['MaSanPham'].','.$item['SoLuong'].','.$item['SizeSP'].')';
                $this->db->insert($sql);
            }
        }
        $sql="DELETE FROM tbl_giohang WHERE MaKhachHang='$makh'";
        $this->db->delete($sql);
        return true;
    }
    //get cart by id
    public function get_cart_by_id($id){
        $sql = "SELECT * FROM tbl_giohang,tbl_sanpham WHERE tbl_giohang.MaSanPham = tbl_sanpham.MaSanPham AND MaGioHang = '$id'";
        $result = $this->db->select($sql);
        return $result?$result:false;
    }
    
}
