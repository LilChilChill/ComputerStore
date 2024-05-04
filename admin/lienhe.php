<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php include '../classes/customer.php';?>
<?php
	$pd = new product();
	$fm = new Format();
	
    $cs = new customer();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách liên hệ </h2>
        <div class="block"> 
         
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên khách hàng</th>
					<th>Số điện thoại</th>
					<th>Địa chỉ email</th>
					<th>Lời nhắn</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
			
				$contact = $cs->list_contact();
				if($contact){
					$i = 0;
					while($result = $contact->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['name'] ?></td>
					<td><?php echo $result['phone'] ?></td>
					<td><?php echo $result['email'] ?></td>
					<td><?php echo $result['message'] ?></td>
					
					<td><a href="lienheshow.php?lienheid=<?php echo $result['id'] ?>">Xem</a></td>
				</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
