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
        public function getAll(){
            $sql = "SELECT * FROM `tbl_sanpham`";
            $result = $this->db->select($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                return false;
            }
        }
        public function get_products_by_loai($maloai,$start,$limit){
            if($start ==null && $limit ==null){
                $sql = "SELECT * FROM `tbl_sanpham` WHERE LoaiSanPham = $maloai ";
            }else{
                $sql = "SELECT * FROM `tbl_sanpham` where LoaiSanPham = $maloai limit $start,$limit";
            }
            $result = $this->db->select($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                return false;
            }
        }
        public function select_count(){
            $sql = "SELECT * FROM `tbl_sanpham`";
            $result = $this->db->select($sql);
            if($result->num_rows > 0){
                return $result->num_rows;
            }else{
                return false;
            }
        }
    }
    //add_to_cart
    
?>