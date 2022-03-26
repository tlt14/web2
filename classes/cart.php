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
    public function add_to_cart($id, $qty)
    {
        // if(isset($_SESSION['cart']) && isset($_SESSION['cart'][$id])){
        //     $_SESSION['cart'][$id]+=$qty;
        // }else{
        //     $_SESSION['cart'][$id]=$qty;
        // }
        // $makh = '';
        // $sId=session_id();
        // if(isset($_COOKIE['maKhachHang'])){
        //     $makh = $_COOKIE['maKhachHang'];
        // }
        // foreach ($_SESSION['cart'] as $key => $value) {
        //     $que = "Select * from tbl_giohang where MaSanPham = '$key' AND (session_id = '$sId' OR MaKhachHang = '$makh')";
        //     $result = $this->db->select($que);
        //     // $result->fetch_assoc();
        //     if(isset($_COOKIE['maKhachHang'])){
        //         if($result!=null && $result->num_rows>0){
        //             $sql="UPDATE tbl_giohang SET SoLuong='$value', MaKhachHang='".$_COOKIE['maKhachHang']."' WHERE MaSanPham='$key' AND session_id='$sId'";
        //             $this->db->update($sql);
        //         }else{
        //             $sql="INSERT INTO tbl_giohang (session_id,MaKhachHang,MaSanPham,SoLuong) VALUES(null,'".$_COOKIE['maKhachHang']."','$key','$value')";
        //             $this->db->insert($sql);    
        //         }    
        //     }else{
        //         if($result!=null && $result->num_rows>0){
        //             $sql="UPDATE tbl_giohang SET SoLuong='$value' WHERE MaSanPham='$key' AND session_id='$sId'";
        //             $this->db->update($sql);
        //         }else{
        //             $sql="INSERT INTO tbl_giohang (session_id,MaKhachHang,MaSanPham,SoLuong) VALUES('$sId',null,'$key','$value')";
        //             $this->db->insert($sql);    
        //         }
        //     }
        // }
        //save cart to database
        $quantity = 0;    
        if(isset($_COOKIE['maKhachHang'])){
            $makh = $_COOKIE['maKhachHang'];
            $sql="SELECT * FROM tbl_giohang WHERE MaKhachHang = '$makh' AND MaSanPham = '$id'";
            $result = $this->db->select($sql);
            if($result!=null && $result->num_rows>0){
                $sql="UPDATE tbl_giohang SET SoLuong=SoLuong+'$qty' WHERE MaSanPham='$id' AND MaKhachHang='$makh'";
                $this->db->update($sql);
            }else{
                $sql = "INSERT INTO tbl_giohang (MaKhachHang,MaSanPham,SoLuong) VALUES('$makh','$id','$qty')";
                $this->db->insert($sql);
            }
            $quantity = $this->db->select("SELECT SUM(SoLuong) FROM tbl_giohang WHERE MaKhachHang = '$makh'")->fetch_assoc()['SUM(SoLuong)'];
        }else{
            $idCart=$_COOKIE['idCart'];
            $sql="SELECT * FROM tbl_giohang WHERE id='$idCart' AND MaSanPham = '$id'";
            $result = $this->db->select($sql);
            if($result!=null && $result->num_rows>0){
                $sql="UPDATE tbl_giohang SET SoLuong=SoLuong+'$qty' WHERE MaSanPham='$id' AND id='$idCart'";
                $this->db->update($sql);
            }else{
                $sql = "INSERT INTO tbl_giohang (id,MaSanPham,SoLuong) VALUES('$idCart','$id','$qty')";
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
            $idCart=$_COOKIE['idCart'];
            $qty = $this->db->select("SELECT SUM(SoLuong) FROM tbl_giohang WHERE id = '$idCart'")->fetch_assoc()['SUM(SoLuong)'];
        }
        return $qty;
    }
}