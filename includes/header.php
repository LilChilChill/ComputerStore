<?php

include 'lib/session.php';
Session::init();
?>
<?php

include 'lib/database.php';
include 'helpers/format.php';
include 'classes/new.php';
spl_autoload_register(function ($class) {
	include_once "classes/" . $class . ".php";
});
$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cat = new category();
$brand = new brand();
$cs = new customer();
$product = new product();
$new = new news();
$setting = new setting();

if(isset($_GET['logout_customer'])){
    if(isset($_SESSION['customer_login'])) {
        unset($_SESSION['customer_login']);
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_name']);
        header('location:/');
    }
    else {
        echo 'Người dùng chưa đăng nhập. Không thể đăng xuất dược!'; die;
    }
}

?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>

<head>
	<title>Store Website</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	<link rel="stylesheet" type="text/css" href="assets/fonts/flaticon/flaticon.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="assets/css/chosen.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet">
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<link href="dist/output.css" rel="stylesheet">
	<!-- jQuery -->
	<script defer type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
	<script defer type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script defer type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
	<script defer type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
	<script defer type="text/javascript" src="assets/js/wow.min.js"></script>
	<script defer type="text/javascript" src="assets/js/jquery.actual.min.js"></script>
	<script defer type="text/javascript" src="assets/js/chosen.jquery.min.js"></script>
	<script defer type="text/javascript" src="assets/js/jquery.bxslider.min.js"></script>
	<script defer type="text/javascript" src="assets/js/jquery.sticky.js"></script>
	<script defer type="text/javascript" src="assets/js/jquery.elevateZoom.min.js"></script>
	<script defer src="assets/js/fancybox/source/jquery.fancybox.pack.js"></script>
	<script defer src="assets/js/fancybox/source/helpers/jquery.fancybox-media.js"></script>
	<script defer src="assets/js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
	<script defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
	<script defer type="text/javascript" src="assets/js/function.js"></script>
	<script defer type="text/javascript" src="assets/js/Modernizr.js"></script>
	<script defer type="text/javascript" src="assets/js/jquery.plugin.js"></script>
	<script defer type="text/javascript" src="assets/js/jquery.countdown.js"></script>
	<!-- <script defer type="text/javascript" src="assets/js/notify.js"></script>
	<script defer type="text/javascript" src="assets/js/notify.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" />

</head>

<body class="index-opt-1">
	<div class="wrapper">
		<form id="block-search-mobile" method="get" class="block-search-mobile">
			<div class="form-content">
				<div class="control">
					<a href="#" class="close-block-serach"><span class="icon flaticon-close"></span></a>
					<input type="text" name="search" placeholder="Search" class="input-subscribe">
					<button type="submit" class="btn search">
						<span><i class="flaticon-magnifying-glass" aria-hidden="true"></i></span>
					</button>
				</div>
			</div>
		</form>
	
		<!-- HEADER -->
		<header class="site-header header-opt-1">
			<!-- header-top -->
			<div class="header-top">
				<div class="container">
					<!-- hotline -->
					<ul class="nav-top-left">
						<li><a href="#">Chào mừng đến Website Bán máy tính</a></li>
					</ul><!-- hotline -->
					<!-- heder links -->
					<ul class="nav-top-right dagon-nav">
						<li class="menu-item-has-children">
							<?php 
								$login_check = Session::get('customer_login');
								if ($login_check) {
									echo '
									<a href="#"><i class="flaticon-profile" aria-hidden="true"></i> 
										Tài khoản
									</a>
									';
								}else{
									echo '
									<a href="login.php"><i class="flaticon-profile" aria-hidden="true"></i> 
										Đăng kí / Đăng nhập
									</a>
									';
								}
							?>
							
							<ul class="submenu parent-megamenu">
<!--								--><?php
//									$customer_id = Session::get('customer_id');
//									$check_order = $ct->check_order($customer_id);
//									if ($check_order == true) {
//										echo '
//											<li class="switcher-option">
//												<a href="orderdetails.php" class="switcher-flag icon">Đơn hàng</a>
//											</li>
//										';
//									}
//								?>
								<?php
									$login_check = Session::get('customer_login');
									if ($login_check) {
										echo '
											<li class="switcher-option">
												<a href="profile.php" class="switcher-flag icon">Thông tin tài khoản</a>
											</li>
											<li class="switcher-option">
												<a href="orderdetails.php" class="switcher-flag icon">Đơn hàng</a>
											</li>
											
											<li class="switcher-option">
												<a href="?logout_customer=' . Session::get('customer_id') . '" class="switcher-flag icon">Đăng xuất</a>
											</li>
										';
									}
									else{
										echo'<li class="switcher-option "><p>Bạn chưa đăng nhập !</p></li>';
									}
								?>
							</ul>
						</li>
					</ul><!-- heder links -->
				</div>
			</div> <!-- header-top -->
			<!-- header-content -->
			<?php
            $get_setting = $setting->getSetting();
            if($get_setting){
                while($result = $get_setting->fetch_assoc()){
                
            ?>
			<div class="header-content">
				<div class="container">
					<div class="row">
						<div class="col-md-2 nav-left">
							<!-- logo -->
							<strong class="logo">
								<a href="index.php"><img style="width: 70px;" src="admin/uploads/<?php echo $result['logo'] ?>" alt="logo"></a>
							</strong>
							<!-- logo -->
						</div>
						<div class="col-md-8 nav-mind">
							<!-- block search -->
							<div class="block-search">
								<div class="block-content">
								<form action="search.php" method="post">
									<div class="categori-search ">
										<select title="categories" name="category" data-placeholder="All Categories" class="chosen-select categori-search-option">
										<option value="all">Tất cả danh mục</option>
											<?php 
												$category = $cat->show_category_fontend();
												foreach ($category as $key => $value) {
											?>
											
											<option value="<?php echo $value['catId'] ?>"><?php echo $value['catName'] ?></option>
											<?php
												}
											?>
										</select>
									
									</div>
									<div class="form-search">
										<div class="box-group">
											<input type="text" name="tukhoa" class="form-control" placeholder="Từ khoá...">
											<button name="search_product" class="btn btn-search" type="submit">
												<span class="flaticon-magnifying-glass"></span>
											</button>
										</div>
									</div>
									</form>
								</div>
							</div><!-- block search -->
						</div>
						<div class="col-md-2 nav-right">
							<!-- block mini cart -->
							<span data-action="toggle-nav" class="menu-on-mobile hidden-md style2">
								<span class="btn-open-mobile home-page">
									<span></span>
									<span></span>
									<span></span>
								</span>
								<span class="title-menu-mobile">Main menu</span>
							</span>
							<div class="block-minicart dropdown style2">
								<a class="minicart" href="cart.php">
									<span class="counter qty">
										<span class="cart-icon"><i class="flaticon-shopping-cart" aria-hidden="true"></i></span>
										<?php
											$check_cart = $ct->check_cart();
											if ($check_cart) {
												$qty = Session::get("qty");
												echo'<span class="counter-number">'.$qty.'</span>';
											}
											else { ?> 
												<span class="counter-number">0</span>
											<?php }
										?>
										
									</span>
									<span class="counter-your-cart">
										<span class="counter-label">Giỏ hàng:</span>
										<?php
											$check_cart = $ct->check_cart();
											if ($check_cart) {
												$sum = Session::get("sum");
												echo'
												<span class="counter-price">'.number_format($sum).'đ</span>
												';
											}
											else { ?> 
												<span class="counter-price">0</span>
											<?php }
										?>			
									</span>
								</a>
								
							</div><!-- block mini cart -->
							<a href="#" class="hidden-md search-hidden"><span class="flaticon-magnifying-glass"></span></a>
							<a class="wishlist-minicart" href="wishlist.php"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
			</div><!-- header-content -->
			<?php } } ?>
			<!-- header-menu-bar -->
			<div class="header-menu-bar header-sticky">
				<div class="header-menu-nav menu-style-2">
					<div class="container">
						<div class="header-menu-nav-inner ">
						<div id="box-vertical-megamenus" class="box-vertical-megamenus nav-toggle-cat">
                            <h4 class="title active">

                                    <span class="btn-open-mobile home-page">

                                        <span></span>

                                        <span></span>

                                        <span></span>

                                    </span>
                                <span class="title-menu">Danh mục sản phẩm</span>
                            </h4>
                            <div class="vertical-menu-content">
                                <span class="btn-close hidden-md"><i class="flaticon-close"
                                                                     aria-hidden="true"></i></span>
                                <ul class="vertical-menu-list">

                                   
                                    <?php 
									$category = $cat->show_category_fontend();
									foreach ($category as $key => $value) {
										?>
										<li class="mb-2">
											<a href="productbycat.php?catid=<?php echo $value['catId'] ?>"><?php echo $value['catName'] ?></a>
										</li>
									<?php
										}
									?>
                                </ul>
                            </div>
                        </div>
							<div class="header-menu header-menu-resize">
								<ul class="header-nav dagon-nav md:flex md:ml-12 space-x-2">
									<li class="btn-close hidden-md"><i class="flaticon-close" aria-hidden="true"></i></li>
									<li class="menu-item-has-children arrow">
										<a href="index.php">Trang chủ</a>
									</li>
									<li class="menu-item-has-children arrow item-megamenu">
										<a href="about.php">Giới thiệu</a>
									</li>
									<li class="menu-item-has-children arrow">
										<a href="products.php">Sản phẩm</a>
									</li>
									<li class="menu-item-has-children arrow">
										<a href="news.php">Bài viết</a>
									</li>
									<li class="menu-item-has-children arrow">
										<a href="contact.php">Liên hệ</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end header-menu-bar -->
		</header>
		<!-- END HEADER -->
		<!-- MAIN -->
		<main class="site-main">
