<?php

include_once 'database.php';
?>



<?php
class product
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAll()
    {
        $sql = "SELECT * FROM `tbl_sanpham` WHERE TrangThaiSanPham = 1";
        $result = $this->db->select($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function get_products_by_category($category){
        $sql = "SELECT * FROM `tbl_sanpham` WHERE LoaiSanPham IN ($category) AND TrangThaiSanPham = 1";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function get_products_by_category_pagination($category, $start, $limit){
        $sql = "SELECT * FROM `tbl_sanpham` WHERE LoaiSanPham = ($category) AND TrangThaiSanPham = 1 LIMIT $start,$limit ";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function filter_product_by_price($category,$start, $limit,$price_from,$price_to){
        $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND GiaSanPham between $price_from and $price_to AND TrangThaiSanPham = 1 limit $start,$limit";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function get_count_filter($category,$price_from,$price_to){
        $sql = "SELECT * FROM `tbl_sanpham` WHERE LoaiSanPham = $category AND GiaSanPham between $price_from and $price_to AND TrangThaiSanPham = 1";
        $result = $this->db->select($sql);
        // echo($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function sort_products_by_category($category,$start,$limit,$sort){
        if ($sort == 'price_asc') { //Tang dan
            $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND TrangThaiSanPham = 1 ORDER by GiaSanPham ASC  limit $start,$limit";
        } else if ($sort == 'price_desc') { //Giam
            $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND TrangThaiSanPham = 1 ORDER by GiaSanPham DESC limit $start,$limit";
        } else if ($sort == 'date_asc') {
            $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND TrangThaiSanPham = 1 ORDER by created_at ASC limit $start,$limit";
        } else if ($sort == 'date_desc') {
            $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND TrangThaiSanPham = 1 ORDER by created_at DESC limit $start,$limit";
        }
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function filter_product_by_price_and_sort($category, $start, $limit, $price_from, $price_to,$sort) {
        if ($sort == 'price_asc') { //Tang dan
            $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND TrangThaiSanPham = 1 AND GiaSanPham between $price_from and $price_to  ORDER by GiaSanPham ASC limit $start,$limit";
        } else if ($sort == 'price_desc') { //Giam
            $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND TrangThaiSanPham = 1 AND GiaSanPham between $price_from and $price_to ORDER by GiaSanPham DESC limit $start,$limit";
        } else if ($sort == 'date_asc') {
            $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND TrangThaiSanPham = 1 AND GiaSanPham between $price_from and $price_to ORDER by created_at ASC limit $start,$limit";
        } else if ($sort == 'date_desc') {
            $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $category AND TrangThaiSanPham = 1 AND GiaSanPham between $price_from and $price_to ORDER by created_at DESC limit $start,$limit";
        }
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function get_products_by_search($key){
        $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function get_products_by_search_pagination($key,$start,$limit){
        $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 limit $start,$limit";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function get_featured_products()
    {
        $sql = "SELECT * FROM `tbl_sanpham` where TrangThaiSanPham = 1  ORDER by created_at DESC LIMIT 15";
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (($_POST['dataPost'] == 'selling_products')) {
                //Tạo view
                // create view sanphambanchay as SELECT count(maSanPham) as msp,maSanPham FROM `tbl_chitietdonhang` GROUP by (maSanPham) ORDER by msp DESC limit 15
                $sql = "SELECT * from tbl_sanpham WHERE MaSanPham IN (SELECT sanphambanchay.MaSanPham FROM sanphambanchay) AND TrangThaiSanPham = 1";
            } else
                    if ($_POST['dataPost'] == 'popular_products') {
                $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham IN(1,2,3) AND TrangThaiSanPham = 1 ORDER by RAND()  DESC LIMIT 15 ";
            }
        }
        return $this->db->select($sql) ? $this->db->select($sql) : false;
    }
    public function get_products_by_id($id){
        $sql = "SELECT * FROM tbl_sanpham,tbl_loaisanpham where MaLoai=LoaiSanPham AND TrangThaiSanPham = 1 AND MaSanPham =".$id;
        // echo($sql);
        return $this->db->select($sql) ? $this->db->select($sql) : false;
    }
    public function getProductByCategory($category){
        $sql = "SELECT * FROM tbl_sanpham where LoaiSanPham= $category AND TrangThaiSanPham = 1";
        return $this->db->select($sql) ? $this->db->select($sql) : false;
    }
    public function sort_products_by_search($key,$start,$limit,$sort){
        if ($sort == 'price_asc') { //Tang dan
            $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 ORDER by GiaSanPham ASC limit $start,$limit";
        } else if ($sort == 'price_desc') { //Giam
            $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 ORDER by GiaSanPham DESC limit $start,$limit";
        } else if ($sort == 'date_asc') {
            $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 ORDER by created_at ASC limit $start,$limit";
        } else if ($sort == 'date_desc') {
            $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 ORDER by created_at DESC limit $start,$limit";
        }
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function filter_product_by_search($key,$form,$to,$start,$limit){
        $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 AND GiaSanPham between $form and $to limit $start,$limit";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function filter_product_by_search_count($key,$form,$to){
        $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 AND GiaSanPham between $form and $to ";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function getCommentByProduct($id )
    {
        $sql = "SELECT * FROM tbl_binhluan where MaSanPham = $id order by created_at DESC limit 3";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function search_product_by_categories_pagination($key,$category,$start,$limit){
        $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 AND LoaiSanPham IN ($category) limit $start,$limit";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function search_product_by_categories_count($key,$category){
        $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 AND LoaiSanPham IN ($category)";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function filter_product_by_search_categories_count($key,$form,$to,$category){
        $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 AND LoaiSanPham IN ($category) AND GiaSanPham between $form and $to";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function filter_product_by_search_categories_pagination($key,$form,$to,$category,$start,$limit){
        $sql = "SELECT * FROM `tbl_sanpham` where TenSanPham LIKE '%$key%' AND TrangThaiSanPham = 1 AND LoaiSanPham IN ($category) AND GiaSanPham between $form and $to limit $start,$limit";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function getSize($id){
        $sql = "SELECT * FROM tbl_size where MaSanPham = $id";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function getQuantity($id,$size){
        $sql = "SELECT * FROM tbl_sanpham,tbl_size where tbl_size.MaSanPham = $id AND tbl_sanpham.MaSanPham = tbl_size.MaSanPham AND tbl_size.Size = $size";
        $result = $this->db->select($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['SLSP'];
        } else {
            return false;
        }
    }

}


?>