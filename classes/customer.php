<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class customer
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_customers($data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($data['password'] != $data['password2']){
				$alert = "<span class='error'>Hai mật khẩu không khớp nhau!</span>";
				return $alert;
			}
			if($name=="" || $email=="" || $address=="" || $phone =="" || $password ==""){
				$alert = "<span class='error'>Dữ liệu không được để trống</span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error text-red-500'>Email đã tồn tại! Vui lòng nhập một email khác
					</span>";
					return $alert;
				}else{
					$query = "INSERT INTO tbl_customer(name,email,address,phone,password) VALUES('$name','$email','$address','$phone','$password')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success text-blue-500'>Bạn đã đăng kí thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error text-red-500'>Bạn đã đăng kí không thành công</span>";
						return $alert;
					}
				}
			}
		}
		public function login_customers($data){
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($email=='' || $password==''){
				$alert = "<span class='error'>Email và mật khẩu không được để trống</span>";
				return $alert;
			}else{
				$check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
				$result_check = $this->db->select($check_login);
				if($result_check){
					$value = $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$value['id']);
					Session::set('customer_name',$value['name']);
					echo "<script>window.location ='cart.php'</script>";
				}else{
					$alert = "<span class='error'>Email và mật khẩu không chính xác!</span>";
					return $alert;
				}
			}
		}
		public function show_customers($id){
			$query = "SELECT * FROM tbl_customer WHERE id='$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_customers($data, $id){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			
			if($name=="" || $zipcode=="" || $email=="" || $address=="" || $phone ==""){
				$alert = "<span class='error'>Dữ liệu không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_customer SET name='$name',zipcode='$zipcode',email='$email',address='$address',phone='$phone' WHERE id ='$id'";
				$result = $this->db->insert($query);
				if($result){
						$alert = "<span class='success'>Cập nhật thông tin tài khoản thành công</span>";
						return $alert;
				}else{
						$alert = "<span class='error'>Cập nhật thông tin tài khoản thất bại</span>";
						return $alert;
				}
				
			}
		}
		
		public function list_contact()
		{
			$query = "SELECT * FROM tbl_contact order by id desc ";
			$result = $this->db->select($query);
			return $result;
		} 
		public function contactByid($id){
			$query = "SELECT * FROM tbl_contact where id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function insert_contact($data)
		{
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$message = mysqli_real_escape_string($this->db->link, $data['message']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			
			
			if($name=="" || $phone=="" || $email=="" || $message=="" ){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				
				$query = "INSERT INTO tbl_contact(name,phone,email,message) 
                VALUES('$name','$phone','$email','$message')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Gửi liên hệ thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Gửi liên hệ khôgn thành công</span>";
					return $alert;
				}
			}
		}


	}
?>