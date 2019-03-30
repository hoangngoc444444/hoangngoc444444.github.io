<?php
define("TEMPLATE",true);
include_once('config/connect.php');
session_start();

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Home</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/cart.css">
  <link rel="stylesheet" href="css/category.css">
  <link rel="stylesheet" href="css/product.css">
  <link rel="stylesheet" href="css/search.css">
  <link rel="stylesheet" href="css/success.css">
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/bootstrap.js"></script>
</head>

<body>
  <!--	Header	-->
  <div id="header">
    <div class="container">
      <div class="row">
        <!-- logo -->
        <?php include_once('modules/logo/logo.php');?>
        <!-- search_box -->
        <?php include_once('modules/search/search_box.php');?>
        <!-- cart notify -->
        <?php include_once('modules/cart/cat_notify.php');?>
      </div>
    </div>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
  <!--	End Header	-->

  <!--	Body	-->
  <div id="body">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <nav>
            <!-- menu -->
            <?php include_once('modules/category/menu.php');?>
          </nav>
        </div>
      </div>
      <div class="row">
        <div id="main" class="col-lg-8 col-md-12 col-sm-12">
          <!--	Slider	-->
          <!-- slide -->
          <?php include_once('modules/slide/slide.php');?>
          <!--	End Slider	-->

          <?php
                if(isset($_GET['page_layout'])){
					switch($_GET['page_layout']){
						case 'category': include_once('modules/category/category.php'); break;
						case 'search': include_once('modules/search/search.php'); break;
						case 'product': include_once('modules/products/product.php'); break;
						case 'cart': include_once('modules/cart/cart.php'); break;
						case 'success': include_once('modules/cart/success.php'); break;
					}
				}
				else{
					include_once('modules/products/featured.php');
					include_once('modules/products/latest.php');
				}
				?>

        </div>

        <!-- sidebar -->
        <?php include_once('modules/banners/banner.php');?>
      </div>
    </div>
  </div>
  <!--	End Body	-->

  <div id="footer-top">
    <div class="container">
      <div class="row">
       <!-- logo-2 -->
       <?php include_once('modules/logo/logo-2.php');?>
        <!-- address -->
        <?php include_once('modules/address/address.php');?>
        <!-- service -->
        <?php include_once('modules/services/service.php');?>
        <!-- hotline -->
        <?php include_once('modules/hotline/hotline.php');?>
      </div>
    </div>
  </div>

  <!--	Footer	-->
  <div id="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <!-- footer_bottom -->
          <?php include_once('modules/footer/footer_bottom.php');?>
        </div>
      </div>
    </div>
  </div>
  <!--	End Footer	-->













</body>

</html>