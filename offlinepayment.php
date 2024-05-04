<?php 
	include 'includes/header.php';
?>

<?php
    // Xử lý áp dụng mã giảm giá
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply_coupon'])) {
        $coupon_code = $_POST['coupon_code'];

        // Gọi hàm kiểm tra và áp dụng mã giảm giá từ class Coupon
        $discount_percent = $cpn->applyCoupon($coupon_code);

        // Nếu có giảm giá, tính lại tổng tiền và lưu vào session
        if ($discount_percent > 0) {
            $total_after_discount = $subtotal - ($subtotal * $discount_percent / 100);
            // Lưu tổng tiền sau khi giảm giá vào session
            $_SESSION['total_after_discount'] = $total_after_discount;
            echo $fm->format_currency($total_after_discount) . " VNĐ";
        } else {
            $vat = $subtotal * 0.08;
            $gtotal = $subtotal + $vat;
            echo $fm->format_currency($gtotal) . " VNĐ";
        }
    }

    // Xử lý thanh toán
    if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
        $customer_id = Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();
        
        // Lưu tổng tiền sau khi giảm giá vào session hoặc database
        if (isset($_SESSION['total_after_discount'])) {
            $total_to_pay = $_SESSION['total_after_discount'];
            // Đồng thời, bạn cũng có thể lưu vào database ở đây nếu cần
        } else {
            // Nếu không có session, lấy tổng tiền gốc từ trang cart.php
            $total_to_pay = $gtotal; // Thay ... bằng đoạn code lấy tổng tiền gốc từ trang cart.php
        }
        
        // Chuyển hướng đến trang success.php sau khi thanh toán
        echo "<script>window.location ='success.php'</script>";
    }
?>

<!-- Phần giao diện HTML -->
<style type="text/css">
	.box_left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 20px;	
	}
 	.box_right {
        width: 47%;
        border: 1px solid #666;
        float: right;
        padding: 20px;
	}
	a.a_order {
        background: red;
        padding: 7px 20px;
        color: #fff;
        font-size: 21px;
    }
</style>
<form action="" method="POST">
<main class="site-main site-login">
	<div class="container">
		<ol class="breadcrumb-page">
			<li><a href="index-2.html">Trang chủ </a></li>
			<li class="active"><a href="#">Thanh toán</a></li>
		</ol>
	</div>
    <div class="container">
    	<div class="section group">
		
	    	<div class="clear"></div>
    		<div class="box_left">
    			<div class="cartpage">
			    	
			    	<?php
			    	 if(isset($update_quantity_cart)){
			    	 	echo $update_quantity_cart;
			    	 }
			    	?>
			    	<?php
			    	 if(isset($delcart)){
			    	 	echo $delcart;
			    	 }
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Tên</th>
								
								<th width="15%">Giá tiền</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Thành tiền</th>
								
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
								$i = 0;
								while($result = $get_product_cart->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								
								<td><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></td>
								<td>

									<?php echo $result['quantity'] ?>

								</td>
								<td><?php
								$total = $result['price'] * $result['quantity'];
								echo $fm->format_currency($total).' '.'VNĐ' ;
								 ?></td>
								
							</tr>
						<?php
							$subtotal += $total;
							$qty = $qty + $result['quantity'];
							}
						}
						?>
							
						</table>
						<?php
						$check_cart = $ct->check_cart();
						if($check_cart){
						?>
						<table style="float:right;text-align:left;margin:5px" width="40%">
							<tr>
								<th>Thành tiền : </th>
								<td><?php echo $fm->format_currency($subtotal).' '.'VNĐ'; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>8% (<?php echo $fm->format_currency($vat = $subtotal * 0.08).' '.'VNĐ'; ?>)</td>
							</tr>
							<tr>
								<th>Mã giảm giá: </th>
								<td>
									<?php
									// Kiểm tra xem có tổng tiền sau khi áp dụng mã giảm giá được lưu trong session không
									if (isset($_SESSION['total_after_discount'])) {
										// Tính phần trăm giảm giá
										$discount_percent = (($subtotal + $vat - $_SESSION['total_after_discount']) / ($subtotal + $vat)) * 100;
										echo 'Giảm ' . round($discount_percent) . '%';
									} else {
										echo 'Không áp dụng mã giảm giá';
									}
									?>
								</td>
							</tr>
							<tr>
								<th>Tổng thanh toán :</th>
								<td>
									<?php 
									// Tính tổng thanh toán sau khi áp dụng mã giảm giá
									if (isset($_SESSION['total_after_discount'])) {
										$total_to_pay = $_SESSION['total_after_discount'];
									} else {
										// Nếu không có session, lấy tổng tiền gốc từ trang cart.php
										$total_to_pay = $gtotal; // Thay ... bằng đoạn code lấy tổng tiền gốc từ trang cart.php
									}
									echo $fm->format_currency($total_to_pay).' '.'VNĐ';
									?>
								</td>
							</tr>
						</table>
						<?php
						}else{
							echo 'Your Cart is Empty ! Please Shopping Now';
						}
						?>

					
					
					</div>
    		</div>
    		<div class="box_right">
    			<table class="tblone ">
				<?php
				$id = Session::get('customer_id');
				$get_customers = $cs->show_customers($id);
				if($get_customers){
					while($result = $get_customers->fetch_assoc()){

				?>
				<tr>
					<td>Họ tên</td>
					<td>:</td>
					<td><?php echo $result['name'] ?></td>
				</tr>
				<tr>
					<td>Thành phố</td>
					<td>:</td>
					<td><?php echo $result['city'] ?></td>
				</tr>
				<tr>
					<td>Điện thoai</td>
					<td>:</td>
					<td><?php echo $result['phone'] ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $result['email'] ?></td>
				</tr>
				<tr>
					<td>Địa chỉ</td>
					<td>:</td>
					<td><?php echo $result['address'] ?></td>
				</tr>
				
				<?php
					}
				}
				?>
			</table>
				<a class="btn btn-primary  px-4 py-2 rounded mt-[4rem]" href="editprofile.php">Chỉnh sửa thông tin </a>
    		</div>

 		</div>

 	</div>
	<center class="mt-8"><a href="?orderid=order" class="a_order " >Mua ngay</a></center><br>
 </div>
</form>
<?php 
	include 'includes/footer.php';
?>
