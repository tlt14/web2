<?php
include_once('dataProvider.php');

    if(isset($_GET['sorts'])){
        $sorts=$_GET['sorts'];
    }else{
        $sorts="giam";
    }
    if(isset($_GET['namesort'])){
        $namesort=$_GET['namesort'];
    }else{
        $namesort="MaKhachHang";
    }
    
    if(isset($_GET['searchtenkh'])){
        $searchtenkh=$_GET['searchtenkh'];
    }else{
        $searchtenkh="";
    }
    
    if(isset($_GET['check'])){
        $check=$_GET['check'];
    }else{
        $check="macdinh";
    }

    if(isset($_GET['idtrang']))
    {
        $idtrang=$_GET['idtrang'];
    }else{
        $idtrang=1;
    }
    $sltungtrang=5;
    $trangbatdau=($idtrang-1)*5;
    
    if(isset($_GET['act'])){
    if ($_GET['act'] == 'add') {
        echo $sorts;
        echo $namesort;
        echo $searchtenkh;
        $tenkh = $_GET['tenkh'];
        $sdt = $_GET['sdt'];
        $diachi = $_GET['diachi'];
        $taikhoan = $_GET['taikhoan'];
        $matkhau = md5($_GET['matkhau']);
        $ngaysinh = $_GET['ngaysinh'];
        $email = $_GET['email'];
        $idrole = $_GET['role'];
        themkh($tenkh,$sdt,$diachi,$taikhoan,$matkhau,$ngaysinh,$email,$idrole);
        loaddata($sorts,$namesort,$searchtenkh,$check,$trangbatdau,$sltungtrang);
    }
    else if($_GET['act'] == 'checktaikhoan'){
        $taikhoan=$_GET["taikhoan"];
        checktk($taikhoan);
    }
    else if($_GET['act'] == 'innerupdate'){
        bang_innerupdate($trangbatdau);
    }
    else if($_GET['act'] == 'update'){
        $idkh=$_GET['idkh'];
        $tenkh = $_GET['tenkh'];
        $sdt = $_GET['sdt'];
        $diachi = $_GET['diachi'];
        $ngaysinh = $_GET['ngaysinh'];
        $email = $_GET['email'];
        $idrole = $_GET['role'];
        updateData($tenkh,$sdt,$diachi,$ngaysinh,$email,$idrole,$idkh);
        loaddata($sorts,$namesort,$searchtenkh,$check,$trangbatdau,$sltungtrang);
    }
    else if($_GET['act'] == 'khoatk'){
        $idkh=$_GET['idkh'];
        block($idkh);
        loaddata($sorts,$namesort,$searchtenkh,$check,$trangbatdau,$sltungtrang);
    }
    else if($_GET['act'] == 'motk')
    {
        $idkh=$_GET['idkh'];
        unblock($idkh);
        loaddata($sorts,$namesort,$searchtenkh,$check,$trangbatdau,$sltungtrang);
    }
}else{

    loaddata($sorts,$namesort,$searchtenkh,$check,$trangbatdau,$sltungtrang);
}
    function loaddata($sorts,$namesort,$searchtenkh,$check,$trangbatdau,$sltungtrang){
        $idtrang=($trangbatdau/5)+1;
            if($sorts=="tang"&&$check=="macdinh")
            {
                $sql=dataProvider::executeQuery("SELECT VaiTro,tbl_khachhang.MaKhachHang,tbl_khachhang.TenKhachHang,tbl_khachhang.SDT,tbl_khachhang.DiaChi,tbl_khachhang.TenDangNhap,tbl_khachhang.MatKhau,tbl_khachhang.NgaySinh,tbl_khachhang.Email,tbl_khachhang.TrangThai,tbl_vaitro.TenVaiTro FROM `tbl_vaitro`,`tbl_khachhang` WHERE tbl_khachhang.VaiTro=tbl_vaitro.MaVaiTro AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%' AND tbl_khachhang.MaKhachHang ORDER BY $namesort  LIMIT $trangbatdau,$sltungtrang ");
                $sql_phantrang=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` Where tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%'");
            }
            else if($sorts=="tang"&&$check=='2'||$sorts=="tang"&&$check=='3'){
                $sql=dataProvider::executeQuery("SELECT VaiTro,tbl_khachhang.MaKhachHang,tbl_khachhang.TenKhachHang,tbl_khachhang.SDT,tbl_khachhang.DiaChi,tbl_khachhang.TenDangNhap,tbl_khachhang.MatKhau,tbl_khachhang.NgaySinh,tbl_khachhang.Email,tbl_khachhang.TrangThai,tbl_vaitro.TenVaiTro FROM `tbl_vaitro`,`tbl_khachhang` WHERE tbl_khachhang.VaiTro=tbl_vaitro.MaVaiTro AND tbl_khachhang.VaiTro='$check' AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%' AND tbl_khachhang.MaKhachHang ORDER BY $namesort LIMIT $trangbatdau,$sltungtrang ");
                $sql_phantrang=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` Where tbl_khachhang.VaiTro='$check' AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%'");
            }
            else if($sorts=="tang"&&$check=='Active'||$sorts=="tang"&&$check=='Block')
            {
                $sql=dataProvider::executeQuery("SELECT VaiTro,tbl_khachhang.MaKhachHang,tbl_khachhang.TenKhachHang,tbl_khachhang.SDT,tbl_khachhang.DiaChi,tbl_khachhang.TenDangNhap,tbl_khachhang.MatKhau,tbl_khachhang.NgaySinh,tbl_khachhang.Email,tbl_khachhang.TrangThai,tbl_vaitro.TenVaiTro FROM `tbl_vaitro`,`tbl_khachhang` WHERE tbl_khachhang.VaiTro=tbl_vaitro.MaVaiTro AND tbl_khachhang.TrangThai='$check' AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%' AND tbl_khachhang.MaKhachHang ORDER BY $namesort LIMIT $trangbatdau,$sltungtrang ");
                $sql_phantrang=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` Where tbl_khachhang.TrangThai='$check' AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%'");
            }
            else if($sorts=="giam"&&$check=="macdinh")
            {
                $sql=dataProvider::executeQuery("SELECT VaiTro,tbl_khachhang.MaKhachHang,tbl_khachhang.TenKhachHang,tbl_khachhang.SDT,tbl_khachhang.DiaChi,tbl_khachhang.TenDangNhap,tbl_khachhang.MatKhau,tbl_khachhang.NgaySinh,tbl_khachhang.Email,tbl_khachhang.TrangThai,tbl_vaitro.TenVaiTro FROM `tbl_vaitro`,`tbl_khachhang` WHERE tbl_khachhang.VaiTro=tbl_vaitro.MaVaiTro AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%' AND tbl_khachhang.MaKhachHang ORDER BY $namesort DESC LIMIT $trangbatdau,$sltungtrang ");
                $sql_phantrang=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` Where tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%'");
            }
            else if($sorts=="giam"&&$check=='2'||$sorts=="giam"&&$check=='3'){
                $sql=dataProvider::executeQuery("SELECT VaiTro,tbl_khachhang.MaKhachHang,tbl_khachhang.TenKhachHang,tbl_khachhang.SDT,tbl_khachhang.DiaChi,tbl_khachhang.TenDangNhap,tbl_khachhang.MatKhau,tbl_khachhang.NgaySinh,tbl_khachhang.Email,tbl_khachhang.TrangThai,tbl_vaitro.TenVaiTro FROM `tbl_vaitro`,`tbl_khachhang` WHERE tbl_khachhang.VaiTro=tbl_vaitro.MaVaiTro AND tbl_khachhang.VaiTro='$check' AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%' AND tbl_khachhang.MaKhachHang ORDER BY $namesort DESC LIMIT $trangbatdau,$sltungtrang ");
                $sql_phantrang=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` Where tbl_khachhang.VaiTro='$check' AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%'");
            }
            else if($sorts=="giam"&&$check=='Active'||$sorts=="giam"&&$check=='Block')
            {
                $sql=dataProvider::executeQuery("SELECT VaiTro,tbl_khachhang.MaKhachHang,tbl_khachhang.TenKhachHang,tbl_khachhang.SDT,tbl_khachhang.DiaChi,tbl_khachhang.TenDangNhap,tbl_khachhang.MatKhau,tbl_khachhang.NgaySinh,tbl_khachhang.Email,tbl_khachhang.TrangThai,tbl_vaitro.TenVaiTro FROM `tbl_vaitro`,`tbl_khachhang` WHERE tbl_khachhang.VaiTro=tbl_vaitro.MaVaiTro AND tbl_khachhang.TrangThai='$check' AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%' AND tbl_khachhang.MaKhachHang ORDER BY $namesort DESC LIMIT $trangbatdau,$sltungtrang ");
                $sql_phantrang=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` Where tbl_khachhang.TrangThai='$check' AND tbl_khachhang.TenKhachHang LIKE '%$searchtenkh%'");
            }
            echo'<div class="table_quanlinguoidung" id="table_quanlinguoidung"><div class="row headerbang">';
            $iconsortid="down";
            $iconsorttenkh="down";
            $iconsorttk="down";
            $iconsortemail="down";
            if($namesort=='MaKhachHang'&&$sorts=="giam"){
                $iconsortid="down";
            }
            else if($namesort=='MaKhachHang'&&$sorts=="tang"){
                $iconsortid="up";
            }
            else if($namesort=='TenKhachHang'&&$sorts=="giam"){
                $iconsorttenkh="down";
            }
            else if($namesort=='TenKhachHang'&&$sorts=="tang"){
                $iconsorttenkh="up";
            }
            else if($namesort=='TenDangNhap'&&$sorts=="giam"){
                $iconsorttk="down";
            }
            else if($namesort=='TenDangNhap'&&$sorts=="tang"){
                $iconsorttk="up";
            }
            else if($namesort=='Email'&&$sorts=="giam"){
                $iconsortemail="down";
            }
            else if($namesort=='Email'&&$sorts=="tang"){
                $iconsortemail="up";
            }
            echo'<div class="cell" >ID <span id="changeIconid"><i class="fas fa-caret-'.$iconsortid.'" onclick="sort('."'".'MaKhachHang'."'".','."'".''.$sorts.''."'".');" id="cell_idkh"></i></span></div>
            <div class="cell" >Name <span id="changeIcontenkh"><i class="fas fa-caret-'.$iconsorttenkh.'" onclick="sort('."'".'TenKhachHang'."'".','."'".''.$sorts.''."'".');" id="cell_namekh"></i></span></div>
            <div class="cell" >Phone</div>
            <div class="cell">Address</div>
            <div class="cell" >Account <span id="changeIconitaikhoan"><i class="fas fa-caret-'.$iconsorttk.'" onclick="sort('."'".'TenDangNhap'."'".','."'".''.$sorts.''."'".');" id="cell_taikhoan"></i></span></div>
            <div class="cell">Bdate</div>
            <div class="cell" >Email <span id="changeIconemail"><i class="fas fa-caret-'.$iconsortemail.'" onclick="sort('."'".'Email'."'".','."'".''.$sorts.''."'".');" id="cell_email"></i></span></div>
            <div class="cell">Condition</div>
            <div class="cell">Role</div>
            <div class="cell">Tool</div>
            </div>';
                $d=0;
                $lock='';
                while($row =mysqli_fetch_array($sql))
                {
                    echo'
                    <div class="row">
                    <div class="cell" data-title="ID">'.$row['MaKhachHang'].'</div>
                    <div class="cell" data-title="Name">'.$row['TenKhachHang'].'</div>
                    <div class="cell" data-title="Phone">'.$row['SDT'].'</div>
                    <div class="cell" data-title="Address">'.$row['DiaChi'].'</div>
                    <div class="cell" data-title="User">'.$row['TenDangNhap'].'</div>
                    <div class="cell" data-title="Bdate">'.$row['NgaySinh'].'</div>
                    <div class="cell" data-title="Email">'.substr($row['Email'],0,strpos($row['Email'],"@")).'</div>
                    <div class="cell" data-title="Condition">'.$row['TrangThai'].'</div>
                    <div class="cell" data-title="Role">'.$row['TenVaiTro'].'</div>';
                    if($row['TrangThai']=="Block")
                    {
                        $lock='<i class="fas fa-unlock unclock" onclick="motk('.$row['MaKhachHang'].','.$idtrang.');"></i>';
                    }else{
                        $lock='<i class="fas fa-lock icon_khoatk" onclick="khoatk('.$row['MaKhachHang'].','.$idtrang.');"></i>';
                    }
                    if($row['VaiTro']=='1')
                    {
                        $lock="";
                    }
                    echo'<div class="cell" data-title="Tool"><i class="fas fa-pen icon_sua" onclick="innerupdate('.$row['MaKhachHang'].','.$idtrang.');"></i>'.$lock.'</div>
                    </div>';
                    }
                    while($rows =mysqli_fetch_array($sql_phantrang))
                    {
                        $d++;
                    }
                    $trang=ceil($d/5);
                    if($trang>1){
                    echo'</div><div class="trang">';
                    for($i=1;$i<=$trang;$i++){
                    echo'<div class="trang_inner" onclick="phantrang('.$i.','."'".''.$sorts.''."'".','."'".''.$namesort.''."'".')">'.$i.'</div>';
                    }
                    echo' </div>';
                }
    }
    function bang_innerupdate($trangbatdau){
        $idtrang=($trangbatdau/5)+1;
        echo'<div id="nenden"></div>
          <h2 class="title_khachhang">Sửa thông tin khách hàng</h2>';
          $idkh = $_GET['idkh'];
          $id="";
          $result=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` WHERE tbl_khachhang.MaKhachHang='$idkh'");
                while($row =mysqli_fetch_array($result))
                {
                    $id=$row['MaKhachHang'];
                    echo'
                    <div id="idkh">ID: '.$row['MaKhachHang'].'</div>
                    <div><input type="text" placeholder="Tên khách hàng" id="txt_name" value="'.$row['TenKhachHang'].'"></div>
                    <div><input type="number" placeholder="Số điện thoại" id="txt_phone" value="'.$row['SDT'].'"></div>
                    <div><input type="text" placeholder="Địa chỉ" id="txt_address" value="'.$row['DiaChi'].'"></div>
                    <div><input type="date" placeholder="Ngày sinh" id="txt_bdate" value="'.$row['NgaySinh'].'"></div>
                    <div><input type="text" placeholder="Email" id="txt_email" value="'.$row['Email'].'"></div>
                    ';
                }
                        $result1=dataProvider::executeQuery("SELECT * FROM `tbl_vaitro` WHERE tbl_vaitro.MaVaiTro=2 OR tbl_vaitro.MaVaiTro=3");
                        $result=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` WHERE tbl_khachhang.MaKhachHang='$idkh'");
                        $sqlcheck=dataProvider::executeQuery("SELECT * FROM `tbl_khachhang` WHERE tbl_khachhang.MaKhachHang='$idkh'");
                        $mavaitrokh="";
                        while($kq =mysqli_fetch_array($sqlcheck))
                        {
                            if($kq['VaiTro']=='1'){

                            }else{
                                echo'<div><select name="" id="combobox_role">';
                                while($row =mysqli_fetch_array($result))
                                {
                                    $mavaitrokh=$row['VaiTro'];
                                }
                               while($row1 =mysqli_fetch_array($result1))
                               {
                        
                                   if($row1['MaVaiTro']==$mavaitrokh)
                                   {
                                    echo '<option selected value="'.$row1['MaVaiTro'].'">'.$row1['TenVaiTro'].'</option>';
                                   }  else{
                                    echo '<option value="'.$row1['MaVaiTro'].'">'.$row1['TenVaiTro'].'</option>';
                                   }  
                                   
                               }
                            }
                    }
             

         echo' </select></div>
          <div class="bottom_bangthemkh">
            <div class="back_themkhachhang" onclick="back_suakhachhang();">Back</div>
            <div class="xacnhanthem" onclick="xacnhansua('.$id.','.$idtrang.');" >Xác nhận Sửa</div>
          </div>';
    }
    function unblock($idkh){
        $query  = "UPDATE `tbl_khachhang` SET `TrangThai`='Active' WHERE tbl_khachhang.MaKhachHang='$idkh'";
        dataProvider::executeQuery($query);
    }
    function block($idkh){
        $query  = "UPDATE `tbl_khachhang` SET `TrangThai`='Block' WHERE tbl_khachhang.MaKhachHang='$idkh'";
        dataProvider::executeQuery($query);
    }
    function updateData($tenkh,$sdt,$diachi,$ngaysinh,$email,$idrole,$idkh){
        $query  = "UPDATE `tbl_khachhang` SET `TenKhachHang`='$tenkh',`SDT`='$sdt',`DiaChi`='$diachi',`NgaySinh`='$ngaysinh',`Email`='$email',`VaiTro`='$idrole' WHERE tbl_khachhang.MaKhachHang='$idkh'";
        dataProvider::executeQuery($query);
    }
    function checktk($taikhoan){
        $check="";
        $query="SELECT tbl_khachhang.TenDangNhap FROM `tbl_khachhang`";
        $result=dataProvider::executeQuery($query);
        while($row=mysqli_fetch_array($result)){
            if($row['TenDangNhap']==$taikhoan){
                $check="trung";
                break;
            }else{
                $check="khongtrung";
            }
        }
        echo $check;
    }
    function themkh($tenkh,$sdt,$diachi,$taikhoan,$matkhau,$ngaysinh,$email,$idrole){
        $query  = "INSERT INTO tbl_khachhang values (NULL,'$tenkh','$sdt','$diachi','$taikhoan','$matkhau','$ngaysinh','$email','Active','$idrole')";
        dataProvider::executeQuery($query);
    }
?>