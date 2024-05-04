<?php
include 'includes/header.php';
include 'includes/slider.php';

?>

<div class="block-section-99">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="dagon-iconbox style-02">
					<div class="iconbox-inner">
						<div class="icon"><span class="flaticon-delivery-truck"></span></div>
						<div class="content">
							<h4 class="title">Giao hàng nhanh</h4>
							<p class="text">Điều phối trên hầu hết các mặt hàng</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="dagon-iconbox style-02">
					<div class="iconbox-inner">
						<div class="icon"><span class="flaticon-refresh"></span></div>
						<div class="content">
							<h4 class="title">TRẢ HÀNG TRONG 30 NGÀY</h4>
							<p class="text">Để khách hàng an tâm</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="dagon-iconbox style-02">
					<div class="iconbox-inner">
						<div class="icon"><span class="flaticon-quality-badge"></span></div>
						<div class="content">
							<h4 class="title">NỘI THẤT TỐT NHẤT</h4>
							<p class="text">Nhà bán lẻ trực tuyến cho gia đình</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-top-categori">
	<div class="container">
		<div class="title-of-section main-title"><span>Danh mục sản phẩm</span></div>
		<div class="owl-carousel nav-style2" data-nav="true" data-autoplay="false" data-dots="false" data-loop="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"768":{"items":3},"992":{"items":4}}'>
		<?php 
			$catefory = $cat->show_category_fontend();
			foreach($catefory as $result){
		?>
			<div class="block-top-categori-item">
				<a href="productbycat.php?catid=<?php echo $result['catId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="c1"></a>
				<div class="block-top-categori-title"><?php echo $result['catName'] ?></div>
			</div>
		<?php 
			} 
		?>
		</div>
	</div>
</div>
<!--<div class="block-section-3">-->
<!--	<div class="container">-->
<!--		<div style="margin-bottom:10px !important" class="title-of-section main-title">Giảm thêm khi thanh toán Online</div>-->
<!---->
<!--		<div class="row">-->
<!--			<div class="col-md-3 col-sm-3">-->
<!--				<div class="promotion-banner style-1">-->
<!--					<a href="#" class="banner-img">-->
<!--						<img src="assets/images/380x200-380x200-2.png" alt="banner-1">-->
<!--					</a>-->
<!--					-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="col-md-3 col-sm-3">-->
<!--				<div class="promotion-banner style-1">-->
<!--					<a href="#" class="banner-img">-->
<!--						<img src="assets/images/380x200--1--380x200.jpg" alt="banner-1">-->
<!--					</a>-->
<!--					-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="col-md-3 col-sm-3">-->
<!--				<div class="promotion-banner style-1">-->
<!--					<a href="#" class="banner-img">-->
<!--						<img src="assets/images/VnPaylaptop-380x200.png" alt="banner-1">-->
<!--					</a>-->
<!--					-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="col-md-3 col-sm-3">-->
<!--				<div class="promotion-banner style-1">-->
<!--					<a href="#" class="banner-img">-->
<!--						<img src="assets/images/VNPay-iPhone-iPad-380x200.png" alt="banner-1">-->
<!--					</a>-->
<!--					-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<div class="block-section-4">
	<div class="container">
		<div class="title-of-section main-title">Sản phẩm nổi bật</div>
		<div class="tab-product tab-product-fade-effect">
			<ul class="box-tabs nav-tab">
				<li class="active"><a data-animated="" data-toggle="tab" href="#tab-1">Tất cả sản phẩm</a></li>
				<li><a data-animated="" data-toggle="tab" href="#tab-2">Dell</a></li>
				<li><a data-animated="" data-toggle="tab" href="#tab-3">HP</a></li>
				<li><a data-animated="" data-toggle="tab" href="#tab-4">Acer</a></li>
				<li><a data-animated="" data-toggle="tab" href="#tab-5">Asus</a></li>
				<li><a data-animated="" data-toggle="tab" href="#tab-6">MSI</a></li>
				<li><a data-animated="" data-toggle="tab" href="#tab-7">Apple</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-container">
					<div id="tab-1" class="tab-panel active">
						<div class="owl-carousel nav-style2 border-background equal-container" 
						data-nav="false" 
						data-autoplay="false" 
						ata-dots="false" 
						data-loop="true" 
						data-margin="30" 
						data-responsive='{"0":{"items":1},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1200":{"items":4}}'>
							<?php
								$product_feathered = $product->getproduct_feathered();
								if($product_feathered ){
									foreach($product_feathered as $result){
										?>
										<div class="product-item style1">
											<div class="product-inner equal-elem">
												<div class="product-thumb">
													<div class="thumb-inner">
														<a href="details.php?proid=<?php echo $result['productId'] ?>">
															<img src="admin/uploads/<?php echo $result['image'] ?>" style="height: 300px;object-fit: cover;" alt="r1">
														</a>
													</div>
												</div>
												<div class="product-innfo">
		
													<div class="product-name">
														<a href="details.php?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a>
													</div>
													<span class="price">
													<?php if (!empty($result['sale_price'])) { ?>
														<ins><?php echo $fm->format_currency($result['sale_price']) . " " . "VNĐ" ?></ins>

														<del><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></del>
													<?php } else { ?>
														<ins><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></ins>
													<?php } ?>
													</span>
													
												</div>
											</div>
										</div>
											
									<?php
									}
								}
							?>
						</div>
					</div>
					<div id="tab-2" class="tab-panel">
						<div class="owl-carousel nav-style2 border-background equal-container" 
						data-nav="false" 
						data-autoplay="false" 
						data-dots="false" 
						data-loop="true" 
						data-margin="30" 
						data-responsive='{"0":{"items":1},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1200":{"items":4}}'>
						<?php
							$product_LastestDell = $product->getLastestDell();
							if($product_LastestDell){
								foreach($product_LastestDell as $result){
									?>
									<div class="product-item style1">
										<div class="product-inner equal-elem">
											<div class="product-thumb">
												<div class="thumb-inner">
													<a href="details.php?proid=<?php echo $result['productId'] ?>">
														<img src="admin/uploads/<?php echo $result['image'] ?>" style="height: 300px;object-fit: cover;" alt="r1">
													</a>
												</div>
											</div>
											<div class="product-innfo">
	
												<div class="product-name">
													<a href="details.php?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a>
												</div>
												<span class="price">
												<?php if (!empty($result['sale_price'])) { ?>
													<ins><?php echo $fm->format_currency($result['sale_price']) . " " . "VNĐ" ?></ins>

													<del><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></del>
												<?php } else { ?>
													<ins><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></ins>
												<?php } ?>
												</span>
												
											</div>
										</div>
									</div>
										
								<?php
								}
							}
							?>
						</div>
					</div>
					<div id="tab-3" class="tab-panel">
						<div class="owl-carousel nav-style2 border-background equal-container" data-nav="false" data-autoplay="false" data-dots="false" data-loop="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1200":{"items":4}}'>
						<?php
							$product_LastestHp = $product->getLastestHp();
							if($product_LastestHp){
								foreach($product_LastestHp as $result){
									?>
										<div class="product-item style1">
											<div class="product-inner equal-elem">
												<div class="product-thumb">
													<div class="thumb-inner">
														<a href="details.php?proid=<?php echo $result['productId'] ?>">
														<img src="admin/uploads/<?php echo $result['image'] ?>" alt="r1"></a>
													</div>
												</div>
												<div class="product-innfo">
		
													<div class="product-name">
														<a href="details.php?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a>
														
													</div>
													<span class="price">
													<?php if (!empty($result['sale_price'])) { ?>
														<ins><?php echo $fm->format_currency($result['sale_price']) . " " . "VNĐ" ?></ins>

														<del><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></del>
													<?php } else { ?>
														<ins><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></ins>
													<?php } ?>
													</span>
													
												</div>
											</div>
										</div>
											
									<?php
							}
							
								}
							?>
						</div>
					</div>
					<div id="tab-4" class="tab-panel">
						<div class="owl-carousel nav-style2 border-background equal-container" data-nav="false" data-autoplay="false" data-dots="false" data-loop="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1200":{"items":4}}'>
						<?php
							$product_LastestAcer = $product->getLastestAcer();
							if($product_LastestAcer){
								foreach($product_LastestAcer as $result){
									?>
										<div class="product-item style1">
											<div class="product-inner equal-elem">
												<div class="product-thumb">
													<div class="thumb-inner">
														<a href="details.php?proid=<?php echo $result['productId'] ?>">
														<img src="admin/uploads/<?php echo $result['image'] ?>" alt="r1"></a>
													</div>
												</div>
												<div class="product-innfo">
		
													<div class="product-name">
														<a href="details.php?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a>
														
													</div>
													<span class="price">
													<?php if (!empty($result['sale_price'])) { ?>
														<ins><?php echo $fm->format_currency($result['sale_price']) . " " . "VNĐ" ?></ins>

														<del><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></del>
													<?php } else { ?>
														<ins><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></ins>
													<?php } ?>
													</span>
													
												</div>
											</div>
										</div>
											
									<?php
										}
							}
							
							?>
						</div>
					</div>
					<div id="tab-5" class="tab-panel">
						<div class="owl-carousel nav-style2 border-background equal-container" data-nav="false" data-autoplay="false" data-dots="false" data-loop="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1200":{"items":4}}'>
						<?php
							$product_LastestAsus = $product->getLastestAsus();
							if($product_LastestAsus){
								foreach($product_LastestAsus as $result){
									?>
										<div class="product-item style1">
											<div class="product-inner equal-elem">
												<div class="product-thumb">
													<div class="thumb-inner">
														<a href="details.php?proid=<?php echo $result['productId'] ?>">
														<img src="admin/uploads/<?php echo $result['image'] ?>" alt="r1"></a>
													</div>
												</div>
												<div class="product-innfo">
		
													<div class="product-name">
														<a href="details.php?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a>
														
													</div>
													<span class="price">
													<?php if (!empty($result['sale_price'])) { ?>
														<ins><?php echo $fm->format_currency($result['sale_price']) . " " . "VNĐ" ?></ins>

														<del><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></del>
													<?php } else { ?>
														<ins><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></ins>
													<?php } ?>
													</span>
													
												</div>
											</div>
										</div>
											
									<?php
									}
								}
							?>
						</div>
					</div>
					<div id="tab-6" class="tab-panel">
						<div class="owl-carousel nav-style2 border-background equal-container" data-nav="false" data-autoplay="false" data-dots="false" data-loop="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1200":{"items":4}}'>
						<?php
							$product_LastestMsi = $product->getLastestMsi();
							if($product_LastestMsi){
								foreach($product_LastestMsi as $result){
									?>
										<div class="product-item style1">
											<div class="product-inner equal-elem">
												<div class="product-thumb">
													<div class="thumb-inner">
														<a href="details.php?proid=<?php echo $result['productId'] ?>">
														<img src="admin/uploads/<?php echo $result['image'] ?>" alt="r1"></a>
													</div>
												</div>
												<div class="product-innfo">
		
													<div class="product-name">
														<a href="details.php?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a>
														
													</div>
													<span class="price">
													<?php if (!empty($result['sale_price'])) { ?>
														<ins><?php echo $fm->format_currency($result['sale_price']) . " " . "VNĐ" ?></ins>

														<del><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></del>
													<?php } else { ?>
														<ins><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></ins>
													<?php } ?>
													</span>
													
												</div>
											</div>
										</div>
											
									<?php
								}
								}
							?>
						</div>
					</div>
					<div id="tab-7" class="tab-panel">
						<div class="owl-carousel nav-style2 border-background equal-container" data-nav="false" data-autoplay="false" data-dots="false" data-loop="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"768":{"items":3},"992":{"items":4},"1200":{"items":4}}'>
						<?php
							$product_LastestApple = $product->getLastestApple();
							if($product_LastestApple){
								foreach($product_LastestApple as $result){
									?>
										<div class="product-item style1">
											<div class="product-inner equal-elem">
												<div class="product-thumb">
													<div class="thumb-inner">
														<a href="details.php?proid=<?php echo $result['productId'] ?>">
														<img src="admin/uploads/<?php echo $result['image'] ?>" alt="r1"></a>
													</div>
												</div>
												<div class="product-innfo">
		
													<div class="product-name">
														<a href="details.php?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a>
														
													</div>
													<span class="price">
													<?php if (!empty($result['sale_price'])) { ?>
														<ins><?php echo $fm->format_currency($result['sale_price']) . " " . "VNĐ" ?></ins>

														<del><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></del>
													<?php } else { ?>
														<ins><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></ins>
													<?php } ?>
													</span>
													
												</div>
											</div>
										</div>
											
									<?php
							}
							
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-section-6 page-product">
		<div class="promotion-banner style-3">
			<a href="#" class="banner-img"><img src="assets/images/unnamed.webp" alt="banner-3"></a>
			
		</div>
</div>

<div class="mt-20">
	<div class="container">
		<div class="title-of-section"><span>Bài viết mới nhất</span></div>
		<div class=" grid grid-cols md:grid-cols-4  gap-4 ">
			<?php
				$news_list = $new->show_new();
				foreach($news_list as $val){
			?>
			<div class="">
				<div class="w-auto p-2">
					<a href="detailsNew.php?newid=<?php echo $val['newId'] ?>">
					<img class="h-96 w-full object-fill" src="admin/uploads/<?php echo $val['image'] ?>" alt="blog1"></a>
				</div>
				<div class="mt-8 p-2 ">
					<h3 class="text-3xl">
						<a href="newsdetails.php?newid=<?php echo $val['newId'] ?>"><?php echo $fm->textShorten($val['title'], 50) ?></a>
					</h3>
					<div class="my-4">
						<span class="text-red-500">Người đăng: <span>Admin</span></span>
						<!-- <span class="comment"><i class="fa fa-comment" aria-hidden="true"></i>36 Comments</span> -->
					</div>
					<p><?php echo $fm->textShorten($val['description'], 200) ?>
					</p>
				</div>
			</div>
			<?php 
			}
			?>
		</div>
	</div>
</div>

<?php
include 'includes/footer.php';
?>