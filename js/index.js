$(document).ready(function () {
  var containermenu = $(this);
  var itemmenu = containermenu.find(".xtlab-ctmenu-item");
  itemmenu.click(function () {
    var submenuitem = containermenu.find(".xtlab-ctmenu-sub");
    submenuitem.slideToggle(500);
  });
  $(document).click(function (e) {
    if (
      !containermenu.is(e.target) &&
      containermenu.has(e.target).length === 0
    ) {
      var isopened = containermenu.find(".xtlab-ctmenu-sub").css("display");
      if (isopened == "block") {
        containermenu.find(".xtlab-ctmenu-sub").slideToggle(500);
      }
    }
  });
  $(".products__main").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    draggable: false,
    dots: false,
    // autoplay: true,
    arrows: true,
    speed: 1000,
    prevArrow: '<i class="fa fa-angle-left btn-prev"></i>',
    nextArrow: '<i class="fa fa-angle-right btn-next"></i>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
    ],
  });
  $(".slider-main").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    draggable: true,
    dots: false,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: true,
    mobileFirst: true,
    prevArrow: '<i class="fa fa-angle-left slider-prev"></i>',
    nextArrow: '<i class="fa fa-angle-right slider-next"></i>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          arrows: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      },
    ],
  });
  const offerItems = document.querySelectorAll(".col-offer");
  offerItems.forEach((item) =>
    item.addEventListener("mouseover", () => {
      item.lastElementChild.style = "display:block";
    })
  );
  offerItems.forEach((item) =>
    item.addEventListener("mouseout", () => {
      item.lastElementChild.style = "display:none";
    })
  );
  $.each($(".button"), function (i, item) {
    item.addEventListener("click", () => {
      var dataPost;
      if (i === 0) {
        dataPost = "new_products";
      } else if (i === 1) {
        dataPost = "selling_products";
      } else {
        dataPost = "popular_products";
      }
      $.ajax({
        url: "./templates/featured_products.php",
        method: "POST",
        data: {
          dataPost: dataPost,
        },
        success: function (data) {
          $(".product__wrapper").html(data);
          $(".products__main").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
            draggable: false,
            dots: false,
            // autoplay: true,
            arrows: true,
            speed: 1000,
            prevArrow: '<i class="fa fa-angle-left btn-prev"></i>',
            nextArrow: '<i class="fa fa-angle-right btn-next"></i>',
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: false,
                },
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                },
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                },
              },
            ],
          });
        },
      });
    });
  });
  var flag = -1;

  $(".dropdown").click(function () {
    if (flag === -1) {
      $(".drodown-mega-menu").show(1000);
      flag = 1;
    } else {
      $(".drodown-mega-menu").hide(1000);
      flag = -1;
    }
  });

  //add_to_cart
  $.each($(".add_to_cart"), function (i, item) {
    item.addEventListener("click", () => {
      $.ajax({
        type: "POST",
        url: "./templates/add_cart.php",
        data: item.dataset,
        success: function (response) {
          // console.log(item.dataset);
          alert("sản phẩm đã được thêm vào giỏ hàng");
          $(".qty_cart").text(response);
        },
      });
    });
  });
  // $(window).scroll(function () {
  //   if ($(this).scrollTop() > 100) {
  //     $("header").addClass("header_fixed");
  //   } else {
  //     $("header").removeClass("header_fixed");
  //   }
  // });
  $.each($(".pagi-item"), function (i, item) {
    item.addEventListener("click", () => {
      // item.classList.add("is-active");
      // $.each($(".pagi-item"), function (j, item) {
      //   if (i !== j) item.classList.remove("is-active");
      // });
      data = {
        limit: item.dataset.limit,
        p: item.dataset.p,
        idLoai: getUrlParameter("idLoai"),
        sort: $("#sort").val(),
        page: getUrlParameter("page"),
        price_from: $("#price_from").val(),
        price_to: $("#price_to").val(),
      };
      $.ajax({
        type: "GET",
        url: "./templates/product_items.php",
        data: data,
        success: function (response) {
          console.log(response);
          $(".shop-container").html(response);
        },
      });
    });
  });
  $("#sort").change(function () {
    data = {
      idLoai: getUrlParameter("idLoai"),
      sort: $("#sort").val(),
      page: getUrlParameter("page"),
      price_from: $("#price_from").val(),
      price_to: $("#price_to").val(),
    };
    $.ajax({
      type: "GET",
      url: "./templates/product_items.php",
      data: data,
      success: function (response) {
        console.log(response);
        $(".shop-container").html(response);
      },
    });
  });
  $(".filter-box").submit(function (e) {
    e.preventDefault();
    data = {
      idLoai: getUrlParameter("idLoai"),
      sort: $("#sort").val(),
      page: getUrlParameter("page"),
      price_from: $("#price_from").val(),
      price_to: $("#price_to").val(),
    };
    $.ajax({
      type: "GET",
      url: "./templates/product_items.php",
      data: data,
      success: function (response) {
        $(".shop-container").html(response);
      },
    });
  });
  $(".similar_product-wrapper").slick({
    slidesToShow: 4,
    slidesToScroll: 3,
    infinite: true,
    arrows: false,
    draggable: false,
    dots: false,
    // autoplay: true,
    arrows: true,
    speed: 1000,
    prevArrow: '<i class="fa fa-angle-left btn-prev"></i>',
    nextArrow: '<i class="fa fa-angle-right btn-next"></i>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
    ],
  });
  const quantity_sub = $(".quantity_sub");
  const quantity_add = $(".quantity_plus");
  const quantity_input = $(".quantity_input");
  // const add_cart = $('.add_cart');
  quantity_sub.click(function () {
    if (quantity_input.val() > 1) {
      quantity_input.val(parseInt(quantity_input.val()) - 1);
    }
  });
  quantity_add.click(function () {
    quantity_input.val(parseInt(quantity_input.val()) + 1);
  });
  $(".add_cart").click(function () {
    if (getUrlParameter("id") !== null) {
      $.ajax({
        type: "POST",
        url: "./templates/add_cart.php",
        data: {
          masanpham: getUrlParameter("id"),
          quantity: quantity_input.val(),
        },
        success: function (response) {
          alert("sản phẩm đã được thêm vào giỏ hàng");
          $(".qty_cart").text(response);
        },
      });
    } else {
      alert("số lượng phải lớn hơn 0");
    }
  });
  $.each($(".cart_quantity_plus"), function (indexInArray, valueOfElement) {
    valueOfElement.addEventListener("click", () => {
      var input = valueOfElement.parentElement.childNodes[3];
      input.value =
        parseInt(valueOfElement.parentElement.childNodes[3].value) + 1;
    });
  });
  $.each($(".cart_quantity_sub"), function (indexInArray, valueOfElement) {
    valueOfElement.addEventListener("click", () => {
      var input = valueOfElement.parentElement.childNodes[3];
      if (input.value > 0) {
        input.value =
          parseInt(valueOfElement.parentElement.childNodes[3].value) - 1;
      }
      if (input.value < 1) {
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?")) {
          console.log(valueOfElement.dataset);
          $.ajax({
            type: "POST",
            url: "./templates/delete_cart.php",
            data: {
              idsp: valueOfElement.dataset.idsp,
              act: "delete",
            },
            success: function (response) {
              // $(".qty_cart").text(response);
              location.reload();
              console.log(response);
            },
          });
        } else {
          input.value = 1;
        }
      }
    });
  });
  $.each($(".btn-remove"), function (indexInArray, valueOfElement) {
    valueOfElement.addEventListener("click", () => {
      if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?")) {
        $.ajax({
          type: "POST",
          url: "./templates/delete_cart.php",
          data: {
            idsp: valueOfElement.dataset.idsp,
            act: "delete",
          },
          success: function (response) {
            // $(".qty_cart").text(response);
            location.reload();
          },
        });
      }
    });
  });
  $.each($(".btn-update"), function (indexInArray, valueOfElement) {
    valueOfElement.addEventListener("click", () => {
      $qty = valueOfElement.parentElement.parentElement.querySelector('.cartquantity_input');
      $.ajax({
        type: "POST",
        url: "./templates/delete_cart.php",
        data: {
          idsp: valueOfElement.dataset.idsp,
          act: "update",
          quantity: $qty.value,
        },
        success: function (response) {
          // $(".qty_cart").text(response);
          location.reload();
        },
      });
    });
  });
  $('.alert-close').click(function () {
    $('.alert').hide();
  })
  $('.btn-alert').click(function () {
    $('.alert').hide();
  })
  $('.check_out').click(function () {
    $.ajax({
      type: "POST",
      url: "./templates/message.php",
      data: {
        test: "login",
      },
      success: function (response) {
        console.log(response);
        if (response.trim() == "Đã đăng nhập") {
          window.location.href = "?page=checkout";
        }else{
          $(".alert-body").html(response);
          $('.alert').show();
          $('.alert').css('display', 'flex');
        }
      }
    });
    
  });
  $('.btn_continue').click(function () {
    window.location.href = "?page=home";
  })
  const cod = $('#cod');
  const bacs = $('#bacs');
  cod.click(function () {
    console.log('cod');
    $('.payment_method_cod_box').show();
    $('.payment_method_bacs_box').hide();
  })
  bacs.click(function () {
    console.log('bacs');
    $('.payment_method_cod_box').hide();
    $('.payment_method_bacs_box').show() ;
  })


  $('.btn_order').click(function(){
    const name =      $('#name').val();
    const address =   $('#address').val();
    const email =     $('#email').val();
    const note =      $('#note').val();
    const city =      $('#city').val();
    const phone =     $('#phone').val();
    // console.log(name,phone,address,email,note,city);
    $.ajax({
      type: "POST",
      url: "./templates/order.php",
      data: {
        name: name,
        address: address,
        email: email,
        note: note,
        city: city,
        phone: phone,
        act:'add_order' 
      },
      success: function (response) {
        console.log(response);
        if(response.trim() == "Đặt hàng thành công"){
          $(".alert-body").html(response);
          $('.alert').show();
          $('.alert').css('display', 'flex');
          // window.location.href = "?page=home";
          // location.reload();
        }else{
          console.log(response);
        }
      }
    })
  })
  var modal = $('.modal');
  var btn = $('.btn_detail');
  var span = $('.modal-close');
  $.each(btn, function (indexInArray, valueOfElement) {
    valueOfElement.addEventListener("click", () => {
      $.ajax({
        type: "POST",
        url: "./templates/order_detail.php",
        data: {
          madh: valueOfElement.dataset.madh,
        },
        success: function (response) {
          console.log(response);
          $('.modal-body_main').html(response);
          modal.show();
          modal.css('display', 'flex');
        }
      })
    })
  });
  // btn.click(function () {
  //   console.log(btn.dataset);
  //   modal.show();
  //   modal.css('display', 'flex');
  // });

  span.click(function () {
    modal.hide();
  });

  $(window).on('click', function (e) {
    if ($(e.target).is('.modal')) {
      modal.hide();
    }
  });
});
var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split("&"),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined
        ? true
        : decodeURIComponent(sParameterName[1]);
    }
  }
  return false;
};
