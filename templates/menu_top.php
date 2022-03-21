<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web2";

// tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT *  FROM tbl_loaisanpham";
$result = $conn->query($sql);
$dropdown = $conn->query($sql);
?>
<div class="menu_top">
    <ul class=" dropdown-menu">
        <li>
            <a href="#">TRANG CHỦ</a>
        </li>
        <?php
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                if ($i < 4) {
                    echo '  <li>
                                <a href="#">GIÀY ' . $row['tenLoai'] . '</a>
                            </li>';
                }
            }
        }
        ?>
        <li class="dropdown">
            <a href="#">KHÁC</a>
            <div class="drodown-mega-menu">
                <div class="mega-menu-list">
                    <ul>
                        <?php
                            if ($dropdown->num_rows > 0) {
                                $dem = 0;
                                while ($row = $dropdown->fetch_assoc()) {
                                    $dem++;
                                    if ($dem >= 4) {
                                        echo '  <li>
                                                    <a href="#">GIÀY ' . $row['tenLoai'] . '</a>
                                                </li>'; 
                                    }
                                }
                            }
                            $conn->close();
                        ?>
                        
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>