<?php 
	include 'includes/header.php';
	// include 'inc/slider.php';
?>
<?php
	
		$login_check = Session::get('customer_login'); 
		if($login_check==false){
			header('Location:login.php');
		}

?>
<style>
	
	.order_page {
    font-size: 30px;
    font-weight: bold;
    color: red;
}
</style>
 <div class="site-main product-list product-grid product-grid-right">
    <div class="container">
    	<div class="cartoption">		
			<div class="cartpage">
			    <div class="order_page">
			    	<h3>Trang Oder</h3>
			    </div>
			</div>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php 
	include 'includes/footer.php';
	
 ?>
