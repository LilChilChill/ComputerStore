<?php
include 'includes/header.php';
// if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
// 	echo "<script>window.location ='404.php'</script>";
// } else {
// 	$id = $_GET['proid'];
// }
$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {

	$productid = $_POST['productid'];
	$insertCompare = $product->insertCompare($productid, $customer_id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {

	$productid = $_POST['productid'];
	$insertWishlist = $product->insertWishlist($productid, $customer_id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

	$quantity = $_POST['quantity'];
	$id = $_POST['product_id'];
	$insertCart = $ct->add_to_cart($quantity, $id);
}
if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
	echo "<script>window.location ='404.php'</script>";
 }else{
	 $id = $_GET['brandid']; 
	 if(isset($_GET['loc']) && $id){
		$loc = $_GET['loc'];
	
		$loc_product_frontend = $product->getproduct_brand_list_loc($loc,$id);
	 }
	
}

if (isset($insertCart)) {
	echo $insertCart;
}

if (isset($insertCompare)) {
	echo $insertCompare;
}

if (isset($insertWishlist)) {
	echo $insertWishlist;
}

?>


<!-- MAIN -->
<main class="site-main product-list product-grid product-grid-right">
	<div class="container">
		<ol class="breadcrumb-page">
			<li><a href="index.html">Trang chủ </a></li>
			<li class="active"><a href="#">Tất cả sản phẩm</a></li>
		</ol>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-8 padding-right-5">
				<div class="main-content">
				<?php
					$name_brand = $brand->get_name_by_brand($id);
					if($name_brand){
						while($result_name = $name_brand->fetch_assoc()){
					?>
					<div class="toolbar-products">
						<h4 class="title-product text-center">Sản phẩm thuộc thương hiệu : <?php echo $result_name['brandName'] ?></h4>
						<?php 
						if (isset($insertCart)) {
							?>
							<div class="alert alert-success" role="alert">
								<?php echo $insertCart; ?>
							</div>
						<?php 
						}
						
						if (isset($insertCompare)) {
							?>
							<div class="alert alert-success" role="alert">
								<?php echo $insertCompare; ?>
							</div>
						<?php 
							
						}
						
						if (isset($insertWishlist)) {
							?>
							<div class="alert alert-success" role="alert">
								<?php echo $insertWishlist; ?>
							</div>
						<?php 
						
						}
						 ?> 
						 <form action="" method="get">
						 <div style="display: flex;
							align-items: flex-end;
							flex-wrap: nowrap;
							align-content: space-between;
							justify-content: flex-end;">
							<!-- <label style="margin-right:10px" for="">Lọc:</label> -->
							<input type="hidden" name="brandid" value="<?php echo $id ?>">
							<select name="loc" id="" class="" style="border: 1px solid;
								padding: 5px 5px;
								border-radius: 5px;">
								<option value="0">--Chọn--</option>
								<option value="1">Giá từ cao - thấp</option>
								<option value="2">Giá từ thấp - cao</option>
							</select>
							<button style="border: 1px solid;
								padding: 5px 5px;
								border-radius: 5px;
								margin-left:10px">Lọc</button>
						 </div>
						 </form>
					</div>

					<?php }} ?>
					<div class="products products-list products-grid">
					<?php
							if(isset($loc_product_frontend)){
								$productbybrand = $loc_product_frontend;
							}
							else{
								$productbybrand = $brand->get_product_by_brand($id);
							}
							if($productbybrand){
								while($value = $productbybrand->fetch_assoc()){
							?>

							<div class="product-item style1 width-33 col-md-4 col-sm-6 col-xs-6">
								<div class="product-inner">
									<div class="product-thumb">
										<div class="thumb-inner">
											<a href="details.php?proid=<?php echo $value['productId'] ?>">
											<img style="height: 325px;object-fit: cover;" src="admin/uploads/<?php echo $value['image'] ?>" alt="p8"></a>
										</div>
										<!-- <span class="onsale">-50%</span> -->
										<!-- <a href="#" class="quick-view">Quick View</a> -->
									</div>
									<div class="product-innfo">
										<div class="product-name"><a href="details.php?proid=<?php echo $value['productId'] ?>"><?php echo $value['productName'] ?>
											</a></div>
										<span class="price">
											<?php if (!empty($value['sale_price'])) { ?>
												<ins><?php echo $fm->format_currency($value['sale_price']) . " " . "VNĐ" ?></ins>

												<del><?php echo $fm->format_currency($value['price']) . " " . "VNĐ" ?></del>
											<?php } else { ?>
												<ins><?php echo $fm->format_currency($value['price']) . " " . "VNĐ" ?></ins>
											<?php } ?>

										</span>
										<span class="star-rating">

											<i class="fa fa-star" aria-hidden="true"></i>

											<i class="fa fa-star" aria-hidden="true"></i>

											<i class="fa fa-star" aria-hidden="true"></i>

											<i class="fa fa-star" aria-hidden="true"></i>

											<i class="fa fa-star" aria-hidden="true"></i>

											<span class="review">5 Review(s)</span>

										</span>
										<div class="info-product">
											<p>Weigh: 8.25 kg</p>
											<p>Size: One Size Fits All </p>
											<p>Guarantee: 2 Year</p>
										</div>
										<div class="single-add-to-cart flex space-x-4">
											<form action="" method="post">
												<input type="hidden" class="border p-4 text-center ml-2" name="quantity" value="1" min="1" />
												<input type="hidden" name="product_id" value="<?php echo $value['productId'] ?>">
												<input type="submit" class="btn-add-to-cart !p-5" name="submit" value="Thêm vào giỏ hàng" />
											</form>

											<!-- <a href="#" class="btn-add-to-cart">Add to cart</a> -->
											<form action="" method="POST">

												<input type="hidden" name="productid" value="<?php echo $value['productId'] ?>" />


												<?php

												$login_check = Session::get('customer_login');
												if ($login_check) {

													echo '<button type="submit" name="wishlist" class="wishlist p-2"><i class="fa fa-heart-o" aria-hidden="true"></i></button>';
												} else {
													echo '';
												}

												?>


											</form>
<!--											<form action="" method="POST">-->
<!---->
<!--												<input type="hidden" name="productid" value="--><?php //echo $value['productId'] ?><!--" />-->
<!---->
<!--												--><?php
//
//												$login_check = Session::get('customer_login');
//												if ($login_check) {
//													echo '<button type="submit"  name="compare" class="compare p-2"><i class="fa fa-exchange"></i></button>';
//												} else {
//													echo '';
//												}
//
//												?>x
<!---->
<!---->
<!--											</form>-->
										</div>
									</div>
								</div>
							</div>
							<?php 
								}
							}else{
								echo 'Category Not Avaiable';
							}
							?>
					</div>
					
				</div>
			</div>
			<div class="col-md-3 col-sm-4">
				<div class="col-sidebar">
					<div class="filter-options">
						<div class="block-content">
						<div class="filter-options-item filter-categori">
								<div class="filter-options-title">Danh mục sản phẩm</div>
								<div class="filter-options-content">
									<ul>
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
							<div class="filter-options-item filter-brand">
								<div class="filter-options-title">Thương hiệu sản phẩm</div>
								<div class="filter-options-content">
									<ul>
									<?php 
											$brands = $brand->show_brand();
											foreach ($brands as $key => $value) {
												?>
												<li class="mb-2">
													<a href="productbybrand.php?brandid=<?php echo $value['brandId'] ?>"><?php echo $value['brandName'] ?></a>
												</li>
											<?php
												}
											?>
										
									</ul>
								</div>
							</div>
							<!-- <div class="filter-options-item filter-price">
								<div class="filter-options-title">Price</div>
								<div class="filter-options-content">
									<div class="price_slider_wrapper">
										<div data-label-reasult="Price:" data-min="0" data-max="3000" data-unit="$" class="slider-range-price " data-value-min="85" data-value-max="2000">
											<span class="text-right">Filter</span>
										</div>
										<div class="price_slider_amount">
											<div class="price_label">
												Price: <span class="from">$85</span>-<span class="to">$2000</span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="filter-options-item filter-size">
								<div class="filter-options-title">Size</div>
								<div class="filter-options-content">
									<ul>
										<li><label class="inline"><input type="checkbox"><span class="input">S</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input">M</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input">L</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input">XL</span></label></li>
									</ul>
								</div>
							</div> -->
							<!-- <div class="filter-options-item filter-color">
								<div class="filter-options-title">Color</div>
								<div class="filter-options-content">
									<ul>
										<li><label class="inline"><input type="checkbox"><span class="input"></span>Red<span class="value">(217)</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input"></span>Black<span class="value">(79)</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input"></span>Grey<span class="value">(116)</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input"></span>While<span class="value">(38)</span></label></li>
									</ul>
									<ul>
										<li><label class="inline"><input type="checkbox"><span class="input"></span>Yellow<span class="value">(179)</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input"></span>Blue<span class="value">(283)</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input"></span>Pink<span class="value">(29)</span></label></li>
										<li><label class="inline"><input type="checkbox"><span class="input"></span>Green<span class="value">(205)</span></label></li>
									</ul>
								</div>
							</div> -->
						</div>
					</div>
					<!-- <div class="block-banner-sidebar">
						<a href="#"><img src="assets/images/product/banner-sidebar.jpg" alt="banner-sidebar"></a>
						<div class="promotion-banner-inner">
							<h4>Fly Drone</h4>
							<h3>Tincidunt interdum senectus fames sociis sem platea </h3>
							<a class="banner-link" href="grid-product.html">Shop now</a>
						</div>
					</div> -->
					<div class="block-latest-roducts">
						<div class="block-title">Latest Products</div>
						<div class="block-latest-roducts-content">
						<div class="nav-style2 flex flex-col space-y-2" >
								
								<?php 
									$new_product = $product->getproduct_feathered();
									foreach ($new_product as $key => $value) {
										?>
										<div class="product-item style1">
											<div class="product-inner">
												<div class="product-thumb">
													<div class="thumb-inner">
														<a  href="details.php?proid=<?php echo $value['productId'] ?>">
															<img style="width:100px" src="admin/uploads/<?php echo $value['image'] ?>" alt="p1">
														</a>
													</div>
												</div>
												<div class="product-innfo">
													<div class="product-name"><a href="details.php?proid=<?php echo $value['productId'] ?>"><?php echo $value['productName'] ?></a>
													</div>
													<span class="price">

													<?php if (!empty($value['sale_price'])) { ?>
														<ins><?php echo $fm->format_currency($value['sale_price']) . " " . "VNĐ" ?></ins>

														<del><?php echo $fm->format_currency($value['price']) . " " . "VNĐ" ?></del>
													<?php } else { ?>
														<ins><?php echo $fm->format_currency($value['price']) . " " . "VNĐ" ?></ins>
													<?php } ?>

													</span>
													
												</div>
											</div>
										</div>
										<?php
									}
								
								?>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main><!-- end MAIN -->

<?php
include 'includes/footer.php';

?>
