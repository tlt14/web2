
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
    <link rel="stylesheet" href="./css/shop-page.css">

</head>

<body>

    <?php
    require_once('./templates/header.php');
    ?>
    <?php
    require_once('./templates/menu_top.php');
    ?>
    <?php
        $page='home';
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        switch ($page) {
            case 'home':
                require_once('./pages/home.php');
                break;
            case 'products':
                require_once('./pages/products.php');
                break;
            default:
                require_once('./pages/home.php');
                break;
        }
    ?>
    <?php
    require_once('./templates/footer.php');
    ?>
    <?php
    require_once('./templates/script.php');
    ?>
</body>

</html>