<?php 
	include 'includes/header.php';
	// include 'inc/slider.php';
?>
<?php
	 if(isset($_GET['proid'])){
	 	$customer_id = Session::get('customer_id');
         $proid = $_GET['proid']; 
         $delwlist = $product->del_wlist($proid,$customer_id);
     }
?>
 <!-- MAIN -->
 <main class="site-main shopping-cart">
        <div class="container">
            <ol class="breadcrumb-page">
                <li><a href="index-2.html">Trang chủ </a></li>
                <li class="active"><a href="#">Yêu thích</a></li>
            </ol>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-cart form-wishlist">
                        <div class="table-cart">
							<?php 
								$customer_id = Session::get('customer_id');
								$get_wishlist = $product->get_wishlist($customer_id);
								if($get_wishlist){
							
							?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="tb-image"></th>
                                    <th class="tb-product">Tên sản phẩm</th>
                                    <th class="tb-price">Giá</th>
                                    <th class="tb-add">Thêm vào giỏ</th>
                                    <th class="tb-remove"></th>

									
                                </tr>
                                </thead>
                                <tbody>
									<?php
										
										$i = 0;
										while($result = $get_wishlist->fetch_assoc()){
											$i++;
									?>
									<tr>
										<td class="tb-image"><a href="#" class="item-photo">
											<img
												src="admin/uploads/<?php echo $result['image'] ?>"
												alt="cart"></a></td>
										<td class="tb-product">
											<div class="product-name"><a href="#"><?php echo $result['productName'] ?></a></div>
										</td>
										<td class="tb-price">
											<span class="price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></span>
										</td>
										
										<td class="tb-add">
											<a href="details.php?proid=<?php echo $result['productId'] ?>">Mua ngay</a>
										</td>
										<td class="tb-remove">
										<a href="?proid=<?php echo $result['productId'] ?>" class="action-remove">
												<span><i class="flaticon-close" aria-hidden="true"></i></span></a>
										</td>
									</tr>
									<?php
										}
									
									?>
                                </tbody>
                            </table>
							<?php
								}
								else{
									echo "Chưa có sản phẩm nào mà bạn yêu thích!";
								}
							?>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </main><!-- end MAIN -->
<?php 
	include 'includes/footer.php';
	
 ?>