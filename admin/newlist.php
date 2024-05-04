<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/new.php';?>
<?php include_once '../helpers/format.php';?>
<?php
	$new = new news();
	$fm = new Format();
	if(isset($_GET['id'])){
        $id = $_GET['id']; 
        $delnew = $new->del_new($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block"> 
        <?php
			if(isset($delnew)){
				echo $delnew;
			}
        ?> 
        	
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Mô tả</th>
					<th>Nội dung</th>
					<th>Hình ảnh</th>
					<th>Trạng thái</th>
					<th>Thuộc trang</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
			
				$newlist = $new->show_new_all();
				if($newlist){
					$i = 0;
					while($result = $newlist->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['title'] ?></td>
					<td><?php echo $fm->textShorten($result['description'], 20); ?></td>
                    <td><?php echo $fm->textShorten($result['body'], 20); ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
					<td><?php 
						if($result['status']==0){
							echo 'Ẩn';
						}else{
							echo 'Hiện';
						}
					?></td>
					<td><?php 
						if($result['type']==0){
							echo 'About';
						}else{
							echo 'Page';
						}
					?></td>
					
					<td><a href="newedit.php?newid=<?php echo $result['newId'] ?>">Sửa</a> || <a href="?id=<?php echo $result['newId'] ?>">Xoá</a></td>
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
