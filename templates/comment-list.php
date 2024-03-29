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
            echo '<script>
            Toast.fire({
                icon: "success",
                title: "Bình luận thành công",
            });
            </script>';
        }else{
            echo '<script>
            Toast.fire({
                icon: "error",
                title: "Bình luận thất bại",
            });
            </script>';
        }
    }else{
        echo '<script>
        Toast.fire({
            icon: "error",
            title: "Bình luận thất bại",
        });
        </script>';
    }

}
?>
<?php
require_once(__DIR__.'./../classes/product.php');
$product = new Product();
$id = isset($_GET['id']) ? $_GET['id'] :$_POST['MaSanPham'];
$commentList = $product->getCommentByProduct($id);
if($commentList && $commentList->num_rows > 0 ){
    echo('
    <div class="comment-item">');
    while($row = $commentList->fetch_assoc()){
        echo '<div class="comment-item-content">
                <div class="comment-item-content-title">
                    <span style="font-size:20px; font-weight:bold">'.$row['TenKhachHang'].'</span> đã bình luận lúc <span>'.$row['created_at'].'</span>
                </div>
                <div class="comment-item-content-content">
                    <p>Nội dung: '.$row['BinhLuan'].'</p>
                </div>
            </div>';
    }
    echo '</div>';
}
