const searchbtn = document.querySelector('.search-icon');
const formSearch = document.querySelector('.search-wrapper');
const searchInput = document.querySelector('.search-input');
const Inputholder = document.querySelector('.input-holder');
const closebtn = document.querySelector('.close-search');
searchbtn.onclick = function() {
    formSearch.classList.add('active')
}
closebtn.onclick = function() {
    formSearch.classList.remove('active')
}

function showFunction() {
    document.getElementById('showFunction').style.display = "none";
    document.getElementById('header__setting').style.display = "flex";
    document.getElementById('hideFunction').style.display = "block";
}

function hideFunction() {
    document.getElementById('showFunction').style.display = "block";
    document.getElementById('header__setting').style.display = "none";
    document.getElementById('hideFunction').style.display = "none";
}

function displayModalBars() {
    document.getElementById('barsOverlay').style.display = "block";
    document.getElementById('barsContent').style.display = "block";
}

function hideModalBars() {
    document.getElementById('barsOverlay').style.display = "none";
    document.getElementById('barsContent').style.display = "none";
    hideCategoryBars();
}

function hideAdminBar() {
    document.querySelector('.app__category-heading').style.display = "none";
    document.querySelector('.app__category').style.width = "70px";
    document.getElementById('quanlysp').style.display = "none";
    document.getElementById('quanlynd').style.display = "none";
    document.getElementById('xulydonhang').style.display = "none";
    document.getElementById('loaisp').style.display = "none";
    document.getElementById('thongkedoanhthu').style.display = "none";
    document.getElementById('managerProduct').style.textAlign = "center";
    document.getElementById('managerUser').style.textAlign = "center";
    document.getElementById('managerCart').style.textAlign = "center";
    document.getElementById('iconloaisp').style.textAlign = "center";
    document.getElementById('managerStatistic').style.textAlign = "center";
    document.querySelector('.app__category-header').style.justifyContent = "center";
    document.getElementById('hideAdmin').style.display = "none";
    document.getElementById('displayAdmin').style.display = "block";
}

function displayAdminBar() {
    document.querySelector('.app__category-heading').style.display = "flex";
    document.querySelector('.app__category').style.width = "253px";
    document.getElementById('quanlysp').style.display = "inline";
    document.getElementById('quanlynd').style.display = "inline";
    document.getElementById('xulydonhang').style.display = "inline";
    document.getElementById('loaisp').style.display = "inline";
    document.getElementById('thongkedoanhthu').style.display = "inline";
    document.getElementById('managerProduct').style.textAlign = "left";
    document.getElementById('managerUser').style.textAlign = "left";
    document.getElementById('managerCart').style.textAlign = "left";
    document.getElementById('iconloaisp').style.textAlign = "left";
    document.getElementById('managerStatistic').style.textAlign = "left";
    document.querySelector('.app__category-header').display = "flex";
    document.getElementById('hideAdmin').style.display = "block";
    document.getElementById('displayAdmin').style.display = "none";
}

function addAdminProduct() {
    displayModalAdd();
}

function displayModalAdd() {
    document.querySelector('.modal__add-product').style.display = "block";
}

function hideModalAdd() {
    document.querySelector('.modal__add-product').style.display = "none";
}

function displayModalEdit() {
    document.querySelector('.modal__edit-product').style.display = "block";
}

function hideModalEdit() {
    document.querySelector('.modal__edit-product').style.display = "none";
}

function displayModalEditOrder() {
    document.querySelector('.modal__edit-order').style.display = "block";
}

function hideModalEditOrder() {
    document.querySelector('.modal__edit-order').style.display = "none";
}

function hideModalFunction() {
    document.querySelector('.header__setting-noti').style.display = "none";
}

function hideModalDetail() {
    document.querySelector('.modal__detail-bill').style.display = "none";
}

function showModalDetail() {
    document.querySelector('.modal__detail-bill').style.display = "block";
}


/*xử lý product */
function view_data() {
    $.ajax({
        type: "GET",
        url: "XuLyProductAdmin.php",
        success: function(data) {
            $("#loadProduct-pc").html(data);
        }
    });
}
view_data();



function deleteProduct(idDeleteProduct) {
    var check = confirm("xóa hay không");
    if (check == true) {
        $.ajax({
            type: "GET",
            url: "XuLyProductAdmin.php",
            data: {
                idDeleteProduct,
                act: "deleteProduct"
            },
            success: function(data) {
                $("#loadProduct-pc").html(data);
            }
        });
    }
}

function editProduct(id) {
    $.post("editProduct.php", { id: id }, function(data) {
        $("#modal__editProduct").html(data);
    })
}

function phantrangsanpham(idtrang) {
    var txtP = $('.search-input').val();
    $.ajax({
        type: "GET",
        url: "XuLyProductAdmin.php",
        data: {
            idtrang,
            txtP,
            act: "phantrangsanpham"
        },
        success: function(data) {
            $("#loadProduct-pc").html(data);
        }
    })
}

function phantrangsanphamSize(idtrang) {
    var txtP = $('.search-input').val();
    var sizeP = $('#check_size').val();
    $.ajax({
        type: "GET",
        url: "XuLyProductAdmin.php",
        data: {
            idtrang,
            txtP,
            sizeP,
            act: "phantrangsanphamSize"
        },
        success: function(data) {
            $("#loadProduct-pc").html(data);
        }
    })
}

function showSearch() {
    var txtP = $('.search-input').val();
    var sizeP = $('#check_size').val();
    $.ajax({
        type: "GET",
        url: "XuLyProductAdmin.php",
        data: {
            txtP,
            sizeP,
            act: "searchProduct"
        },
        success: function(data) {
            $("#loadProduct-pc").html(data);
        }
    })
}

$(document).ready(function() {
    view_data();
    view_order();
})

/* xử lý đơn hàng */

function view_order() {
    $.ajax({
        type: "GET",
        url: "XulyOrderAdmin.php",
        success: function(data) {
            console.log("abc");
            $("#loadOrder").html(data);
        }
    });
}
view_order();

function phantrangdonhang(idorder) {
    var calendar1 = $('.calendar-a').val();
    var calendar2 = $('.calendar-b').val();
    $.ajax({
        type: "GET",
        url: "XulyOrderAdmin.php",
        data: {
            calendar1,
            calendar2,
            idorder,
            act: "phantrangdonhang"

        },
        success: function(data) {
            $("#loadOrder").html(data);
        }
    });
}

function deleteOrder(idDeleteOrder) {
    var check = confirm("xóa hay không");
    if (check == true) {
        $.ajax({
            type: "GET",
            url: "XulyOrderAdmin.php",
            data: {
                idDeleteOrder,
                act: "deleteOrder"
            },
            success: function(data) {

                $("#loadOrder").html(data);
            }
        });
    }
}

function view_detail(idDetail) {
    $.ajax({
        type: "GET",
        url: "XulyOrderAdmin.php",
        data: {
            idDetail,
            act: "chitietdonhang"
        },
        success: function(data) {
            $("#show_detail").html(data);
        }
    });
}


function editOrder(id) {
    $.post("editOrder.php", { id: id }, function(data) {
        $("#show_editOrder").html(data);
    })
}

function showCalendar() {
    var calendar1 = $('.calendar-a').val();
    var calendar2 = $('.calendar-b').val();
    $.ajax({
        type: "GET",
        url: "XulyOrderAdmin.php",
        data: {
            calendar1,
            calendar2,
            act: "showcalendar"
        },
        success: function(data) {

            $("#loadOrder").html(data);
        }
    });
}