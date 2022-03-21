
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MONA</title>
    <!-- link css -->
    <link rel="stylesheet" href="./css/style.css" />
    <!-- <script src="./public/js/d3efa8ea96.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" type="text/css" href="./css/slick.css" />
    <link rel="stylesheet" href="./fonts/fontawesome-free-5.15.4-web/css/all.css">


</head>

<body>

    <?php
    require_once('./templates/header.php');
    ?>
    <?php
    require_once('./templates/menu_top.php');
    ?>
    <?php
    require_once('./templates/slider.php');
    ?>
    <?php
    require_once('./templates/offer.php');
    ?>
    <div class="content row">
        <div class="content__header">
            <div class="">
                <button class="button new_products">sản phẩm mới</button>
            </div>
            <div class="">
                <button class="button selling_products">sản phẩm bán chạy</button>
            </div>
            <div>
                <button class="button popular_products">sản phẩm phổ biến</button>
            </div>
        </div>
        <div class="products row">
            <div class="product__wrapper">
                <?php
                require_once('./templates/featured_products.php');
                ?>
            </div>
        </div>

    </div>

    <?php
    require_once('./templates/promotional_products.php');
    ?>
    <?php
    require_once('./templates/footer.php');
    ?>
    <?php
    require_once('./templates/script.php');
    ?>
</body>

</html>