<!-- get comment list -->
<?php
require_once(__DIR__ . './../classes/database.php');
$db = new Database();
if( isset($_POST['NoiDung'])){
    $maKhachHang = $_POST['maKhachHang'];
    $comment = $_POST['NoiDung'];
    $MaSanPham = $_POST['MaSanPham'];
    $sql="select * from tbl_khachhang where MaKhachHang =".$maKhachHang;
    $result = $db->select($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $tenDangNhap = $row['TenDangNhap'];
        $sql = "INSERT INTO tbl_binhluan(MaSanPham,TenKhachHang,BinhLuan) VALUES('$MaSanPham','$tenDangNhap','$comment')";
        $result = $db->insert($sql);
        if($result){
            echo '<script>alert("Bình luận thành công")</script>';
        }else{
            echo '<script>alert("Bình luận thất bại")</script>';
        }
    }else{
        echo '<script>alert("Bình luận thất bại")</script>';
    }

}
?>
<?php
require_once(__DIR__.'./../classes/product.php');
$product = new Product();
$id = isset($_GET['id']) ? $_GET['id'] :$_POST['MaSanPham'];
$commentList = $product->getCommentByProduct($id);
if($commentList && $commentList->num_rows > 0 ){
    echo('<h3>Lịch sử</h3>
    <div class="comment-item">');
    while($row = $commentList->fetch_assoc()){
        echo '<div class="comment-item-content">
                <div class="comment-item-content-title">
                    <span>'.$row['TenKhachHang'].'</span> <span>'.$row['created_at'].'</span>
                </div>
                <div class="comment-item-content-content">
                    <p>'.$row['BinhLuan'].'</p>
                </div>
            </div>';
    }
    echo '</div>';
}
