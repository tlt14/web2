<?php

include_once 'database.php';
?>



<?php
class Category
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getALl(){
        $sql = "SELECT * from tbl_loaisanpham";
        $result = $this->db->select($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }

    }
    public function fineName($id)
    {
        $sql = "SELECT * FROM `tbl_loaisanpham` WHERE MaLoai = $id";
        $result = $this->db->select($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['TenLoai'];
        } else {
            return false;
        }
    }

}
