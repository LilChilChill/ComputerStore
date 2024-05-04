<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class category
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_category($catName){

			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			
			if(empty($catName) || empty($file_name)){
				$alert = "<span class='error'>Danh mục không được để trống</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp,$uploaded_image);

				$query = "INSERT INTO tbl_category(catName,image) VALUES('$catName','$unique_image')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm danh mục thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm danh mục thất bại</span>";
					return $alert;
				}
			}
		}
		public function show_category(){
			$query = "SELECT * FROM tbl_category order by catId DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_category($catName,$id){

			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);
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

			if(empty($catName) || $file_name ==""){
				$alert = "<span class='error'>Các trường danh mục không được để trống</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					if ($file_size > 500000) {

					$alert = "<span class='success'>Kích thước hình ảnh phải nhỏ hơn 5MB!</span>";
					return $alert;
					} 
					elseif (in_array($file_ext, $permited) === false) 
					{
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
					$alert = "<span class='success'>Bạn chỉ có thể tải lên:-".implode(', ', $permited)."</span>";
					return $alert;

					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_category SET
					catName = '$catName',
					image = '$unique_image'
					WHERE catId = '$id'";
				}
				else{
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_category SET
                    catName = '$catName',
					WHERE catId = '$id'";
				}
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhật danh mục thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhật danh mục thất bại</span>";
					return $alert;
				}
			}

		}
		public function del_category($id){
			$query = "DELETE FROM tbl_category where catId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xoá danh mục thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xoá danh mục thất bại</span>";
				return $alert;
			}
			
		}
		public function getcatbyId($id){
			$query = "SELECT * FROM tbl_category where catId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_category_fontend(){
			$query = "SELECT * FROM tbl_category order by catId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_product_by_cat($id){
			$query = "SELECT * FROM tbl_product WHERE catId='$id' order by catId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_name_by_cat($id){
			$query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId FROM tbl_product,tbl_category WHERE tbl_product.catId=tbl_category.catId AND tbl_product.catId ='$id' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		


	}
?>