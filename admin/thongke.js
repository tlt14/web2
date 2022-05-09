window.onload=function(){
    $.ajax({
        type: 'GET',
        url: 'xulythongke.php',
        success: function(data) {
            document.getElementById("tongdoanhthu").innerHTML=data;
        }
    }) 
}

function loaddataloaibegin(){
    $.ajax({
        type: 'GET',
        url: 'xulythongke.php',
        data:{
            act:'loaddataloaibegin'
        },
        success: function(data) {
            document.getElementById("doanhthucacloai").innerHTML=data;
        }
    }) 
}
loaddataloaibegin();
function loc(){
    var ngaybatdau=document.getElementById("ngaybatdau").value;
    var ngayketthuc=document.getElementById("ngayketthuc").value;
    var change=document.getElementById('loc_loaisp').value;
    console.log(change);
    $.ajax({
        type: 'GET',
        url: 'xulythongke.php',
        data:{
            ngaybatdau,
            ngayketthuc,
            change,
            act:"loc"
        },
        success: function(data) {
            document.getElementById("doanhthucacloai").innerHTML=data;                 
        }
    })
}
function locngaythang(){
    var ngaybatdau=document.getElementById("ngaybatdau").value;
    var ngayketthuc=document.getElementById("ngayketthuc").value;
    var change=document.getElementById('loc_loaisp').value;
    if(ngaybatdau>ngayketthuc){
        alert("Ngày bắt đầu không được nhỏ hơn ngày kết thúc");
    }else if(ngaybatdau==""||ngayketthuc=="")
    {
        alert("Không được để rỗng");
    }
    else{
    $.ajax({
                    type: 'GET',
                    url: 'xulythongke.php',
                    data:{
                        change,
                        ngaybatdau,
                        ngayketthuc,
                        act:'locngaythang',
                    },
                    success: function(data) {
                        document.getElementById("doanhthucacloai").innerHTML=data;
                    }
                }) 
    loctongtien(ngaybatdau,ngayketthuc);
    }
}
function loctongtien(ngaybatdau,ngayketthuc){
    $.ajax({
                    type: 'GET',
                    url: 'xulythongke.php',
                    data:{
                        ngaybatdau,
                        ngayketthuc,
                        act:'loctongtien',
                    },
                    success: function(data) {
                       
                        document.getElementById("tongdoanhthu").innerHTML=data;
                    }
                }) 
}
function phantrang(idtrang){
    var ngaybatdau=document.getElementById("ngaybatdau").value;
    var ngayketthuc=document.getElementById("ngayketthuc").value;
    $.ajax({
                    type: 'GET',
                    url: 'xulythongke.php',
                    data:{
                        idtrang,
                        ngaybatdau,
                        ngayketthuc,
                        act:'phantrang'
                    },
                    success: function(data) {
                        document.getElementById("doanhthucacloai").innerHTML=data;
                    }
                }) 
}