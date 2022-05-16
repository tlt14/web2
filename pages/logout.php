<?php
session_start();
session_destroy();
setcookie("maKhachHang", "", time()-(86400 * 30),"/");
// setcookie("maKhachHang", "", time()-(86400 * 30),"/");
// setcookie ($cookie_name, 'usr='.$f_user.'&hash='.$f_pass, time() - $cookie_time);
setcookie ("siteAuth", "",time() - 3600 * 24 * 300,"/");
header('location: ./../index.php');

?>