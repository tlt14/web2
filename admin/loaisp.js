function innerdata(){
    $.ajax({
        type: 'GET',
        url: 'xulyloaisp.php',
        
        success: function(data) {
            document.getElementById("table_panel").innerHTML=data;                 
        }
    })
}
innerdata();
function themloaisp(){
    var tenloaisp=document.getElementById('search_tenkhachhang').value;
    if(tenloaisp==""){
        alert("Không được bỏ trống");
    }else{
        $.ajax({
            type: 'GET',
            url: 'xulyloaisp.php',
            data:{
                tenloaisp:tenloaisp.toUpperCase(),
                act:'checktenloaisp'
            },
            success: function(data) {
                if(data=="khongtrung"){
                    if(confirm("Bạn có muốn thêm loại sản phẩm này hay không ?"))
                    {
                    $.ajax({
                        type: 'GET',
                        url: 'xulyloaisp.php',
                        data:{
                            tenloaisp:tenloaisp.toUpperCase(),
                            act:"themloaisp"
                        },
                        success: function(data) {
                            document.getElementById("table_panel").innerHTML=data;                 
                        }
                    })}else{

                    }
                }else{
                    alert("Tên sản phẩm này đã có rồi bạn vui lòng kiểm tra lại");
                }           
            }
        })
    }
}
function innerbangsua(idloaisp){
    $.ajax({
        type: 'GET',
        url: 'xulyloaisp.php',
        data:{
            idloaisp,
            act:'innerbangsua'
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
function xacnhansua(idloaisp){
    var tenloaisp=document.getElementById('txt_name').value;
    if(tenloaisp==""){
        alert("Không được để rỗng");
    }else{
        if(confirm("Bạn có muốn sửa loại sản phẩm này không ?"))
        {
        $.ajax({
            type: 'GET',
            url: 'xulyloaisp.php',
            data:{
                tenloaisp,
                idloaisp,
                act:'xacnhansua'
            },
            success: function(data) {
                document.getElementById("table_panel").innerHTML=data;     
                back_suakhachhang();            
            }
        })
        }else{

        }
    }
}
function xoaloaisp(idloaisp){
    if(confirm("Bạn có muốn xóa loại sản phẩm này không ?"))
    {
    $.ajax({
        type: 'GET',
        url: 'xulyloaisp.php',
        data:{
            idloaisp,
            act:'xoaloaisp'
        },
        success: function(data) {
            document.getElementById("table_panel").innerHTML=data;      
        }
    })
    }else{
        
    }
}