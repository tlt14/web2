<?php
include_once('dataProvider.php');
    if(isset($_GET['act']))
    {
        if($_GET['act']=='themloaisp'){
            $tenloaisp=$_GET['tenloaisp'];
            dataProvider::executeQuery("INSERT INTO `tbl_loaisanpham`( `TenLoai`) VALUES ('$tenloaisp')");
            loadata();
        }else if($_GET['act']=='checktenloaisp'){
            $tenloaisp=$_GET['tenloaisp'];
            $sql=dataProvider::executeQuery("SELECT tbl_loaisanpham.TenLoai FROM `tbl_loaisanpham`");
            while($row =mysqli_fetch_array($sql))
            {
                if($tenloaisp==$row['TenLoai']){
                    echo 'trung';
                }else{
                    echo 'khongtrung';
                }
            }
        }else if($_GET['act']=='innerbangsua'){
            bangsua();
        }else if($_GET['act']=='xacnhansua'){
            $idloaisp=$_GET['idloaisp'];
            $tenloaisp=$_GET['tenloaisp'];
            dataProvider::executeQuery("UPDATE `tbl_loaisanpham` SET `TenLoai`='$tenloaisp' WHERE tbl_loaisanpham.MaLoai=' $idloaisp'");
            loadata();
        }else if($_GET['act']=='xoaloaisp'){
            $idloaisp=$_GET['idloaisp'];
            dataProvider::executeQuery("UPDATE `tbl_loaisanpham` SET `TrangThai`='0' WHERE tbl_loaisanpham.MaLoai=' $idloaisp'");
            loadata();
        }
    }else{
        loadata();
    }
    function loadata(){
        echo'
        <div class="table_quanlinguoidung" id="table_quanlinguoidung"><div class="row headerbang">
        <div class="cell" >ID</div>
        <div class="cell">Tên loại</div>
        <div class="cell">Tool</div>
      </div>';
      $sql=dataProvider::executeQuery("SELECT * FROM `tbl_loaisanpham`");
        while($row =mysqli_fetch_array($sql))
            {
                if($row['TrangThai']=='1')
                {
                    echo'<div class="row">
                    <div class="cell" data-title="ID">'.$row['MaLoai'].'</div>
                    <div class="cell" data-title="Tên loại">'.$row['TenLoai'].'</div>
                    <div class="cell" data-title="Tool"><i class="fas fa-pen icon_sua" onclick="innerbangsua('.$row['MaLoai'].');"></i><i class="fas fa-trash-alt icon_xoaloaisp" onclick="xoaloaisp('.$row['MaLoai'].');"></i></div>
                    </div>';
                }else{

                }
            }
            echo'</div>';
    }
    function bangsua(){
        echo'<div id="nenden"></div>
            <h2 class="title_khachhang">Sửa thông tin khách hàng</h2>';
            $idloaisp = $_GET['idloaisp'];
            $id="";
            $result=dataProvider::executeQuery("SELECT * FROM `tbl_loaisanpham` WHERE tbl_loaisanpham.MaLoai='$idloaisp'");
                while($row =mysqli_fetch_array($result))
                {
                    $id=$row['MaLoai'];
                    echo'
                    <div>ID: '.$row['MaLoai'].'</div>
                    <div><input type="text" placeholder="Tên Loại" id="txt_name" value="'.$row['TenLoai'].'"></div>
                    ';
                }
                echo'
                <div class="bottom_bangthemkh">
                  <div class="back_themkhachhang" onclick="back_suakhachhang();">Back</div>
                  <div class="xacnhanthem" onclick="xacnhansua('.$id.');" >Xác nhận Sửa</div>
                </div>';
    }
?>