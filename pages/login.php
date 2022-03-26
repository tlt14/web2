<?php
session_start();
$flag =-1;
$conn = mysqli_connect('localhost', 'root', '', 'do_an');
$username ="";
$password ="";
if (isset($_POST['user-name'])) {
    $username = $conn->real_escape_string($_POST['user-name']);
    $password = $conn->real_escape_string($_POST['user-password']);
    $sql = "SELECT * FROM tbl_khachhang WHERE TenDangNhap='$username' AND MatKhau = '".md5($password)."'";
    $data = $conn->query($sql);
    if ($data->num_rows > 0) {
        $user = $data->fetch_assoc();
        $_SESSION['maKhachHang'] = $user['MaKhachHang'];
        setcookie('maKhachHang',$user['MaKhachHang'] , time() + (86400 * 30), "/");
        header('Location: ./../index.php');
    } else {
        $flag =1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./../css/style_login.css">
    <link rel="stylesheet" href="./../fonts/fontawesome-free-5.15.4-web/css/all.css">
</head>

<body class="">
    <div class="container">
        <div class="primary-bg">
            <div class="box signin">
                <h2>Already Have an Account?</h2>
                <button class="signinBtn">Sign in</button>
            </div>

            <div class="box signup">
                <h2>Don't Have an Account?</h2>
                <button class="signupBtn">Sign up</button>
            </div>
        </div>
        <div class="formBx">
            <div class="form signinForm">
                <form id="login-form" action="" method="post">
                    <h3>Sign In</h3>
                    <div class="form-group">
                        <input name="user-name" id="user-name" type="text" value="<?php echo $username;?>" placeholder="Username">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <input name="user-password" id="user-password" value="<?php echo $password;?>" type="password" placeholder="Password">
                        <span class="form-message">
                            <?php
                                if($flag ==1){
                                    echo('Sai tên đăng nhập hoặc mật khẩu');
                                }
                            ?>
                        </span>
                    </div>
                    <a href="#" class="forgot">Forgot Password</a>
                    <div class="form-group">
                        <button type="submit" name="login" class="form-submit login-btn">Login</button>
                    </div>
                    <div class="auth-form__social">
                        <span class="auth-form__social--title">Login with social: </span>
                        <a href="" class="auth-form__social--facebook btn btn--size-s btn--with-icon">
                            <i class="auth-form__social--icon fab fa-facebook-square"></i>
                        </a>

                        <a href="" class=" auth-form__social--google btn btn--size-s btn--with-icon">
                            <i class=" auth-form__social--icon fab fa-google"></i>
                        </a>

                        <a href="" class=" auth-form__social--github btn btn--size-s btn--with-icon">
                            <i class=" auth-form__social--icon fab fa-github"></i>
                        </a>

                    </div>

                </form>
            </div>

            <?php
            // include 'config.php';
            // if(isset($_POST['signup'])){
            //     $username= $_POST['newusername'];
            //     $userpassword= md5($_POST['newuserpassword']);
            //     $useremail= $_POST['newuseremail'];
            //     $useraddress= $_POST['newuseraddress'];
            //     $confirmpassword= $_POST['confirmuserpassword'];
            //     if(mysql_num_rows(mysql_query("SELECT username FROM tbl_account WHERE username='$username'")) > 0){
            //         echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="index.php";</script>';
            //     }
            //     $sql ="INSERT INTO tbl_account(username,password,email,address) VALUES ('$username','$userpassword','$useremail','$useraddress')";
            //     mysqli_query($conn,$sql);
            //     if($sql)
            //     echo"Đăng kí thành công";
            //     else
            //     echo"Đăng kí không thành công";
            // }
            ?>

            <div class="form signupForm">
                <form action="" method="POST" id='form-register' >
                    <h3>Sign Up</h3>
                    <div class="form-group invalid">
                        <input name="newusername" id="new-user-name" type="text" placeholder="Username">
                        <span id="errolName" class="form-message"></span>
                    </div>
                    <div class="form-group invalid">
                        <input name="newuseremail" id="new-user-email" type="text" placeholder="Email">
                        <span id="errolEmail" class="form-message"></span>
                    </div>
                    <div class="form-group invalid">
                        <input name="newuseraddress" id="new-user-address" type="text" placeholder="Address">
                        <span id="errolAddress" class="form-message"></span>
                    </div>
                    <div class="form-group invalid">
                        <input name="newuserpassword" id="new-user-password" type="password" placeholder="Password" aria-autocomplete="list">
                        <span id="errolPassword" class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <input name="confirmuserpassword" id="confirm-user-password" type="password" placeholder="Confirm Password">
                        <span id="errolConfirmPassword" class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="signup" class="form-submit">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="./../js/jquery-3.6.0.min.js"></script>
    <script src="./../js/main.js" type="text/javascript"></script>

    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('.login-btn').on('click', function() {
        //         var username = $('#user-name').val();
        //         var password = $('#user-password').val();
        //         if (username == "" || password == "") {
        //             alert("Nhập đầy đủ thông tin vào giùm");
        //         } else {
        //             $.ajax({
        //                 url: "index.php",
        //                 method: "POST",
        //                 data: {
        //                     login: 1,
        //                     username: username,
        //                     password: password
        //                 },
        //                 dataType: 'text',
        //                 success: function(response) {
        //                     $("#response").html(response);
        //                     if (response.indexOf('sucess') >= 0)
        //                         window.location = 'admin.php';
        //                     if (response.indexOf('false') >= 0)
        //                         alert("Tài khoản mật khẩu của bạn sai rồi cưng");
        //                 }
        //             });

        //         }
        //     });
        // });

        function check() {
            // var name = document.getElementById('new-user-name').value;
            // var email = document.getElementById('new-user-email').value;
            // var address = document.getElementById('new-user-address').value;
            // var password = document.getElementById('new-user-password').value;
            // var confirmpass = document.getElementById('confirm-user-password').value;
            // var flag = 1;
            // if (name == "" || name.length < 5) {
            //     document.getElementById('errolName').textContent = 'Tên không hợp lệ';
            //     flag = 0;
            // }
            // if (email == "" || email.length < 5 || email.indexOf('@') == -1) {
            //     document.getElementById('errolEmail').textContent = 'Email không hợp lệ';
            //     flag = 0;
            // }
            // if (address == "") {
            //     document.getElementById('errolAddress').textContent = 'Địa chỉ không hợp lệ';
            //     flag = 0;
            // }
            // if (password == "" || password.length < 5) {
            //     document.getElementById('errorPassword').textContent = "Password phải lớn hơn 5 kí tự";
            //     flag = 0;
            // }
            // if (confirmpass != password) {
            //     document.getElementById('errolConfirmPassword').textContent = "Password không trùng khớp";
            //     flag = 0;
            // }

        }
    </script>

</body>

</html>