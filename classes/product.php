<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class product
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function search_product($tukhoa,$category){
			// var_dump($category);
			if($category == 'all'){
				$tukhoa = $this->fm->validation($tukhoa);
				$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
				
				$result = $this->db->select($query);
				
			}
			else
			{
				$tukhoa = $this->fm->validation($tukhoa);
				$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%' AND catId = '$category'";
				
				$result = $this->db->select($query);
			}
			return $result;

		}
		public function getproduct_pagination($limit,$this_page_first_result)
		{
			$query = "SELECT * FROM tbl_product order by productId desc LIMIT ".$this_page_first_result.','.$limit;
			$result = $this->db->select($query);
			return $result;
		}
		public function filter_priece($start,$end)
		{
			$query = "SELECT * FROM tbl_product WHERE price >= '$start' AND price <= '$end' order by price ASC ";
			$result = $this->db->select($query);
			return $result;
		}
		public function insert_product($data,$files){

			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$product_body = mysqli_real_escape_string($this->db->link, $data['product_body']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$sale_price = mysqli_real_escape_string($this->db->link, $data['sale_price']);
			$productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);

			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			
			if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $product_body=="" || $price==""|| $sale_price == "" || $type=="" || $file_name ==""){
				$alert = "<span class='error'>Không được để trống!</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp,$uploaded_image);
				$query = "INSERT INTO tbl_product(productName,productQuantity,brandId,catId,product_desc,product_body,price,sale_price,type,image) VALUES('$productName','$productQuantity','$brand','$category','$product_desc','$product_body','$price','$sale_price','$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm sản phẩm thất bại</span>";
					return $alert;
				}
			}
		}
		public function insert_slider($data,$files){
			$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($sliderName=="" || $type==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 2048000) {

		    		 $alert = "<span class='success'>Kích thước hình ảnh phải nhỏ hơn 2MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>Bạn chỉ có thể tải lên:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "INSERT INTO tbl_slider(sliderName,type,slider_image) VALUES('$sliderName','$type','$unique_image')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm Banner Thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm Banner Thất bại</span>";
						return $alert;
					}
				}
				
				
			}
		}
		public function show_slider(){
			$query = "SELECT * FROM tbl_slider where type='0' order by sliderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_slider_list(){
			$query = "SELECT * FROM tbl_slider order by sliderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_product(){
			// $query = "

			// SELECT p.*,c.catName, b.brandName

			// FROM tbl_product as p,tbl_category as c, tbl_brand as b where p.catId = c.catId 

			// AND p.brandId = b.brandId 

			// order by p.productId desc";

			$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 

			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 

			order by tbl_product.productId desc";

			// $query = "SELECT * FROM tbl_product order by productId desc";

			$result = $this->db->select($query);
			return $result;
		}
		public function update_type_slider($id,$type){

			$type = mysqli_real_escape_string($this->db->link, $type);
			$query = "UPDATE tbl_slider SET type = '$type' where sliderId='$id'";
			$result = $this->db->update($query);
			return $result;
		}
		public function del_slider($id){
			$query = "DELETE FROM tbl_slider where sliderId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Đã xóa Banner thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xoá Banner không thành công</span>";
				return $alert;
			}
		}
		public function update_product($data,$files,$id){
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$product_body = mysqli_real_escape_string($this->db->link, $data['product_body']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$sale_price = mysqli_real_escape_string($this->db->link, $data['sale_price']);
			$productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($productName=="" || $brand=="" || $category=="" || $product_desc==""|| $product_body=="" || $price=="" || $type==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 500000) {

		    		 $alert = "<span class='success'>Kích thước hình ảnh phải nhỏ hơn %MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>Bạn chỉ có thể tải lên:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_product SET
					productName = '$productName',
					brandId = '$brand',
					catId = '$category', 
					type = '$type', 
					price = '$price', 
					sale_price = '$sale_price',
					productQuantity = '$productQuantity',
					image = '$unique_image',
					product_desc = '$product_desc',
					product_body = '$product_body'
					WHERE productId = '$id'";
					
				}else{
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_product SET

					productName = '$productName',
					brandId = '$brand',
					catId = '$category', 
					type = '$type', 
					price = '$price', 
					sale_price = '$sale_price',
					productQuantity = '$productQuantity',
					product_desc = '$product_desc',
					product_body = '$product_body'
					WHERE productId = '$id'";
					
				}
				$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Đã cập nhật sản phẩm thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Sản phẩm được cập nhật không thành công</span>";
						return $alert;
					}
				
			}

		}
		public function del_product($id){
			$query = "DELETE FROM tbl_product where productId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Sản phẩm đã được xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Sản phẩm bị xóa không thành công</span>";
				return $alert;
			}
			
		}
		public function del_wlist($proid,$customer_id){
			$query = "DELETE FROM tbl_wishlist where productId = '$proid' AND customer_id='$customer_id'";
			$result = $this->db->delete($query);
			return $result;
		}
		public function getproductbyId($id){
			$query = "SELECT * FROM tbl_product where productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		//END BACKEND 
		public function getproduct_feathered(){
			$query = "SELECT * FROM tbl_product where type = '0' order by productId desc LIMIT 4 ";
			$result = $this->db->select($query);
			return $result;
		} 
		public function getproduct_list(){
			$query = "SELECT * FROM tbl_product order by productId desc ";
			$result = $this->db->select($query);
			return $result;
		} 
		public function getproduct_list_loc($loc)
		{
			if($loc == 1){
				$query = "SELECT * FROM tbl_product order by price desc ";
			}elseif($loc == 2){
				$query = "SELECT * FROM tbl_product order by price asc ";
			}else{
				$query = "SELECT * FROM tbl_product order by productId desc ";
			}
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_cate_list_loc($loc, $id)
		{
			
			if($loc == 1){
				// var_dump($loc, $id);
				$query = "SELECT * FROM tbl_product WHERE catId='$id' order by price desc LIMIT 8";
			}elseif($loc == 2){
				
				$query = "SELECT * FROM tbl_product WHERE catId='$id' order by price asc LIMIT 8";
			}else{
				$query = "SELECT * FROM tbl_product WHERE catId='$id' order by productId desc LIMIT 8";
			}
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_brand_list_loc($loc, $id)
		{
			if($loc == 1){
				$query = "SELECT * FROM tbl_product WHERE brandId='$id' order by price desc LIMIT 8";
			}elseif($loc == 2){
				$query = "SELECT * FROM tbl_product WHERE brandId='$id' order by price asc LIMIT 8";
			}else{
				$query = "SELECT * FROM tbl_product WHERE brandId='$id' order by productId desc LIMIT 8";
			}
			$result = $this->db->select($query);
			return $result;
		}

		

		
		public function getproduct_new(){
			$query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		} 
		public function get_details($id){
			$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 

			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'

			";

			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestDell(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '10' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestAsus(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '12' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestAcer(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '13' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestApple(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '14' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestHp(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '9' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestMsi(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '8' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_compare($customer_id){
			$query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_wishlist($customer_id){
			$query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function insertCompare($productid, $customer_id){
			
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_compare = $this->db->select($check_compare);

			if($result_check_compare){
				$msg = "<span class='error'>Sản phẩm đã được thêm vào để so sánh</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_compare = $this->db->insert($query_insert);

			if($insert_compare){
						$alert = "<span class='success'>Đã thêm So sánh thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Đã thêm So sánh Không thành công</span>";
						return $alert;
					}
			}
		}
		public function insertWishlist($productid, $customer_id){
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_wlist = $this->db->select($check_wlist);

			if($result_check_wlist){
				$msg = "<span class='error'>Sản phẩm đã được thêm vào danh sách yêu thích</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_wlist = $this->db->insert($query_insert);

			if($insert_wlist){
						$alert = "<span class='success'>Đã thêm vào danh sách yêu thích thành công </span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Đã thêm vào danh sách yêu thích không thành công</span>";
						return $alert;
					}
			}
		}


	}
?>