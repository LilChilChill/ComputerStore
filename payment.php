<?php 
	include 'includes/header.php';
	// include 'inc/slider.php';
?>
<?php
	ob_start();
	$login_check = Session::get('customer_login'); 
	if($login_check==false){
		echo "<script>window.open('login.php','_self')</script>";
	}
		
?>
<?php

	// if(!isset($_GET['proid']) || $_GET['proid']==NULL){
 //       echo "<script>window.location ='404.php'</script>";
 //    }else{
 //        $id = $_GET['proid']; 
 //    }
 //    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
 //        $quantity = $_POST['quantity'];
 //        $AddtoCart = $ct->add_to_cart($quantity, $id);
        
 //    }
?>
<style>
	h3.payment {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
	}
	.wrapper_method {
	text-align: center;
    width: 550px;
    margin: 0 auto;
    border: 1px solid #666;
    padding: 20px;
    /* margin: 20px; */
    background: cornsilk;
	}
	.wrapper_method a {
    padding: 10px;
  
    background: red;
    color: #fff;
    
	}
	.wrapper_method h3 {
   	 margin-bottom: 20px;
	}
</style>
        
 <main class="site-main site-login">
	<div class="container">
		<ol class="breadcrumb-page">
			<li><a href="index-2.html">Trang chủ </a></li>
			<li class="active"><a href="#">Hình thức thanh toán</a></li>
		</ol>
	</div>
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
	    		
	    		
	    		<div class="clear"></div>
	    		<div class="wrapper_method">
		    		<h3 class="payment">Chọn hình thức thanh toán</h3>
						<a href="offlinepayment.php">Nhận hàng thanh toán</a>
					<form action="onlinepayment.php?vnpaypayment=vnpay" style="margin: 20px 0" method="POST">
						<button name="redirect" id="redirect">Thanh toán VNPAY</button>
					</form>
		    		<!-- <a href="onlinepayment.php">Online Payment</a><br><br><br> -->
		    		<a style="background:grey" href="cart.php"> << Quay lại giỏ hàng</a>
		    	</div>
    		</div>
		
 		</div>
 	</div>
 </main>
<?php 
	include 'includes/footer.php';
	
 ?>
