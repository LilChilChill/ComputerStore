<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class setting
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

        public function getSetting($id = 1)
        {
            $query = "SELECT * FROM tbl_settings where id = '$id'";
			$result = $this->db->select($query);
			return $result;
        }
        public function updateSetting($data,$files,$id)
        {
            $title = mysqli_real_escape_string($this->db->link, $data['title']);
			$description = mysqli_real_escape_string($this->db->link, $data['description']);
			$body = mysqli_real_escape_string($this->db->link, $data['body']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$link_facebook = mysqli_real_escape_string($this->db->link, $data['link_facebook']);
			$link_youtobe = mysqli_real_escape_string($this->db->link, $data['link_youtobe']);
			$link_twitter = mysqli_real_escape_string($this->db->link, $data['link_twitter']);
			$link_instagram = mysqli_real_escape_string($this->db->link, $data['link_instagram']);

			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['logo']['name'];
			$file_size = $_FILES['logo']['size'];
			$file_temp = $_FILES['logo']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($title=="" || $description=="" || $phone=="" || $email==""|| $address=="" || $link_facebook=="" || $link_youtobe==""|| $body=="" || $link_twitter=="" || $link_instagram==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				if(!empty($file_name) || !empty($file_name1)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 500000 ) {

		    		 $alert = "<span class='success'>Kích thước ảnh phải nhỏ hơn 2MB</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_settings SET
					title = '$title',
					description = '$description',
					body = '$body',
					phone = '$phone', 
					email = '$email', 
					address = '$address', 
					link_facebook = '$link_facebook',
					link_youtobe = '$link_youtobe',
					link_twitter = '$link_twitter',
					link_instagram = '$link_instagram',
					logo = '$unique_image'
					WHERE id = '$id'";
					
				}else{
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_settings SET
					ptitle = '$title',
					description = '$description',
					body = '$description',
					phone = '$phone', 
					email = '$email', 
					address = '$address', 
					link_facebook = '$link_facebook',
					link_youtobe = '$link_youtobe',
					link_twitter = '$link_twitter',
					link_instagram = '$link_instagram'
					WHERE productId = '$id'";
					
				}
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhật Setting thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhật setting thất bại</span>";
					return $alert;
				}
			}
        }
	}
?>