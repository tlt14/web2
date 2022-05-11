
function timkiemtenkhachhang(){
    var check=document.getElementById("check_block").value;
    var searchtenkh=document.getElementById('search_tenkhachhang').value;
        if(searchtenkh=="")
        {
            alert("Không được để rỗng");
        }else{
        $.ajax({
        type: 'GET',
        url: 'xulyquanlynguoidung.php',
        data:{
            searchtenkh,
            check
        },
        success: function(data) {
            document.getElementById("table_panel").innerHTML=data;                 
        }
    })
    }
}
function locTrangthai(){
    var searchtenkh=document.getElementById('search_tenkhachhang').value;
    var check=document.getElementById("check_block").value;
    $.ajax({
        type: 'GET',
        url: 'xulyquanlynguoidung.php',
        data:{
            searchtenkh,
            check
        },
        success: function(data) {
            document.getElementById("table_panel").innerHTML=data;                 
        }
    })
  
}
function innerbangthemkh(){
    document.getElementById("bangthemkh").style.display="block";
    document.getElementById("nenden").style.display="block";
}
function back_themkhachhang(){
    document.getElementById("bangthemkh").style.display="none";
    document.getElementById("nenden").style.display="none";
}
function xacnhanthem(){
    const check=(string,pattern)=> string.match(pattern) ? true: false;
    const mailcheck= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const sdtcheck=/((09|03|07|08|05)+([0-9]{8})\b)/g;
    var tenkh=document.getElementById("txt_name").value;
    var sdt=document.getElementById('txt_phone').value;
    var diachi=document.getElementById('txt_address').value;
    var taikhoan=document.getElementById('txt_user').value;
    var matkhau=document.getElementById('txt_pasword').value;
    var ngaysinh=document.getElementById('txt_bdate').value;
    var email=document.getElementById('txt_email').value;
    var role=document.getElementById('combobox_role').value;
    if(tenkh==""||sdt==""||diachi==""||taikhoan==""||matkhau==""||email==""){
        alert("hãy nhập đầy đủ");
    }else if(taikhoan.leght<=10){
        alert("Tài khoản phải trên 10 kí tự");
    }else if(matkhau<=10){
        alert("Mật khẩu phải trên 10 kí tự");
    }else if(!check(sdt,sdtcheck))
    {
        alert("hãy nhập đúng định dạng của số điện thoại");
    }else if(!check(email,mailcheck)){
        alert("hãy nhập đúng định dạng của email");
    }
    else{
        $.ajax({
            type: 'GET',
            url: 'xulyquanlynguoidung.php',
            data:{
                taikhoan,
                act:"checktaikhoan"
            },
            success: function(data) {
                if(data=="trung")       
                {
                    alert("Tài khoản bị trùng");
                }else{
                    if(confirm("Bạn có muốn thêm tài khoản này hay không?"))
                    {
                    $.ajax({
                                        type: 'GET',
                                        url: 'xulyquanlynguoidung.php',
                                        data: {
                                            tenkh,
                                            sdt,
                                            diachi,
                                            taikhoan,
                                            matkhau,
                                            ngaysinh,
                                            email,
                                            role,
                                            act: 'add'
                                        },
                                        success: function(data) {
                                            document.getElementById("table_panel").innerHTML=data;                 
                                        }
                                    })
                                    document.getElementById("bangthemkh").style.display="none";
                                    document.getElementById("nenden").style.display="none";
                                    document.getElementById('check_block').value="macdinh";
                                    document.getElementById('search_tenkhachhang').value="";
                                }
                }       
            }
        })
    }
}
function innerupdate(idkh,idtrang){
    $.ajax({
                        type: 'GET',
                        url: 'xulyquanlynguoidung.php',
                        data:{
                            idkh,
                            idtrang,
                            act:'innerupdate'
                        },
                        success: function(data) {
                            document.getElementById("bangsuakh").innerHTML=data;
                            document.getElementById("bangsuakh").style.display="block";
                            document.getElementById("nenden").style.display="block";                
                        }
                    }) 
}
function back_suakhachhang(){
    document.getElementById("bangsuakh").style.display="none";
    document.getElementById("nenden").style.display="none";
}
function xacnhansua(idkh,idtrang){
    var searchtenkh=document.getElementById('search_tenkhachhang').value;
    var check=document.getElementById("check_block").value;
    const checkdinhdang=(string,pattern)=> string.match(pattern) ? true: false;
    const mailcheck= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const sdtcheck=/((09|03|07|08|05)+([0-9]{8})\b)/g;
    var tenkh=document.getElementById("txt_name").value;
    var sdt=document.getElementById('txt_phone').value;
    var diachi=document.getElementById('txt_address').value;
    var ngaysinh=document.getElementById('txt_bdate').value;
    var email=document.getElementById('txt_email').value;
    var role=document.getElementById('combobox_role').value;
    if(tenkh==""||sdt==""||diachi==""||email==""){
        alert("hãy nhập đầy đủ");
    }else if(!checkdinhdang(sdt,sdtcheck))
    {
        alert("hãy nhập đúng định dạng của số điện thoại");
    }else if(!checkdinhdang(email,mailcheck)){
        alert("hãy nhập đúng định dạng của email");
    }else{
        if(confirm("Bạn có muốn sửa tài khoản này hay không?"))
        {
            $.ajax({
                            type: 'GET',
                            url: 'xulyquanlynguoidung.php',
                            data: {
                                idkh,
                                tenkh,
                                sdt,
                                diachi,
                                ngaysinh,
                                email,
                                role,
                                searchtenkh,
                                check,
                                idtrang,
                                act: 'update'
                            },
                            success: function(data) {
                                document.getElementById("table_panel").innerHTML=data;                 
                            }
                        })
                        document.getElementById("bangsuakh").style.display="none";
                        document.getElementById("nenden").style.display="none";
                    }else{

                    }
        }
}
function khoatk(idkh,idtrang){
    var check=document.getElementById("check_block").value;
    var searchtenkh=document.getElementById('search_tenkhachhang').value;
    if(confirm("Bạn có muốn khóa tài khoản này hay không?"))
    {
    $.ajax({
                        type: 'GET',
                        url: 'xulyquanlynguoidung.php',
                        data:{
                            idkh,
                            idtrang,
                            searchtenkh,
                            check,
                            act:'khoatk'
                        },
                        success: function(data) {
                            document.getElementById("table_panel").innerHTML=data;
                        }
                    }) 
                }else{

                }
}
function motk(idkh,idtrang){
    var check=document.getElementById("check_block").value;
    var searchtenkh=document.getElementById('search_tenkhachhang').value;
    if(confirm("Bạn có muốn mở tài khoản này hay không?"))
    {
    $.ajax({
                        type: 'GET',
                        url: 'xulyquanlynguoidung.php',
                        data:{
                            idkh,
                            idtrang,
                            searchtenkh,
                            check,
                            act:'motk'
                        },
                        success: function(data) {
                            document.getElementById("table_panel").innerHTML=data;
                        }
                    }) 
                }else{

                }
}
window.onload=function () {
    $.ajax({
        type: 'GET',
        url: 'xulyquanlynguoidung.php',
        success: function(data) {
            document.getElementById("table_panel").innerHTML=data;                 
        }
    })
}
function phantrang(idtrang,sorts,namesort){
    var check=document.getElementById("check_block").value;
    var searchtenkh=document.getElementById('search_tenkhachhang').value;
    $.ajax({
                        type: 'GET',
                        url: 'xulyquanlynguoidung.php',
                        data:{
                            sorts,
                            namesort,
                            idtrang,
                            searchtenkh,
                            check
                        },
                        success: function(data) {
                            document.getElementById("table_panel").innerHTML=data;
                            document.querySelector(".activetrang"+idtrang).style.backgroundColor="#2980b9";
                        }
                    }) 
}
function sort(namesort,sorts){
    var check=document.getElementById("check_block").value;
    var searchtenkh=document.getElementById('search_tenkhachhang').value;
    if(namesort=="MaKhachHang"&&sorts=="giam"){
        namesort="MaKhachHang";
        sorts='tang';
    }
    else if(namesort=="MaKhachHang"&&sorts=='tang'){
        namesort="MaKhachHang";
        sorts='giam';
    }
    else if(namesort=="TenKhachHang"&&sorts=="giam"){
        namesort="TenKhachHang";
        sorts='tang';
    }
    else if(namesort=="TenKhachHang"&&sorts=="tang"){
        namesort="TenKhachHang";
        sorts='giam';
    }
    else if(namesort=="TenDangNhap"&&sorts=="giam"){
        namesort="TenDangNhap";
        sorts='tang';
    }
    else if(namesort=="TenDangNhap"&&sorts=="tang"){
        namesort="TenDangNhap";
        sorts='giam';
    }
    else if(namesort=="Email"&&sorts=="giam"){
        namesort="Email";
        sorts='tang';
    }
    else if(namesort=="Email"&&sorts=="tang"){
        namesort="Email";
        sorts='giam';
    }
    $.ajax({
        type: 'GET',
        url: 'xulyquanlynguoidung.php',
        data:{
            sorts,
            namesort,
            searchtenkh,
            check
        },
        success: function(data) {
            document.getElementById("table_panel").innerHTML=data;
        }
    })
}