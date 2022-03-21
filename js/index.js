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
    draggable: false,
    dots: false,
    autoplay: true,
    speed: 3000,
    arrows: true,
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
  $.each($(".add_to_cart"), function (i, item) {
    item.addEventListener("click", () => {
      console.log(item.dataset);
      $.ajax({
        type: "get",
        url: "./templates/header.php",
        data: {
          masanpham: item.dataset.masanpham,
        },
        success: function (response) {
          console.log(response);
        },
      });
    });
  });
});
