<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/database.php');
    class Coupon {
        private $db;

        public function __construct() {
            $this->db = new Database(); // Database là class kết nối CSDL, bạn cần thay thế bằng class của bạn
        }

        public function insertCoupon($data) {
            $coupon_code = mysqli_real_escape_string($this->db->link, $data['coupon_code']);
            $discount_percent = mysqli_real_escape_string($this->db->link, $data['discount_percent']);
            $expiration_date = mysqli_real_escape_string($this->db->link, $data['expiration_date']);
        
            if (empty($coupon_code) || empty($discount_percent) || empty($expiration_date)) {
                return "Vui lòng nhập đầy đủ thông tin mã giảm giá.";
            } else {
                // Tính toán số tiền giảm giá từ phần trăm
                $discount_amount = ($data['discount_percent'] / 100) * $discount_percent;
        
                $query = "INSERT INTO coupon_codes (code, discount_percent, discount_amount, expiration_date) VALUES ('$coupon_code', '$discount_percent', '$discount_amount', '$expiration_date')";
                $insert_row = $this->db->insert($query);
                if ($insert_row) {
                    return "Thêm mã giảm giá thành công.";
                } else {
                    return "Đã xảy ra lỗi khi thêm mã giảm giá.";
                }
            }
        }
        public function applyCoupon($coupon_code) {
            // Kết nối đến cơ sở dữ liệu
            $db = new Database();
            $query = "SELECT * FROM coupon_codes WHERE code = '$coupon_code'";
            $result = $db->select($query);
        
            // Kiểm tra xem mã giảm giá có tồn tại và hợp lệ không
            if ($result) {
                $coupon = $result->fetch_assoc();
                $expiration_date = $coupon['expiration_date'];
                $current_date = date('Y-m-d');
        
                // Kiểm tra xem mã giảm giá còn hiệu lực không
                if ($current_date <= $expiration_date) {
                    // Mã giảm giá còn hiệu lực, trả về phần trăm giảm giá hoặc số tiền giảm giá
                    $discount_percent = $coupon['discount_percent'];
                    $discount_amount = $coupon['discount_amount'];
                    
                    if (!empty($discount_percent)) {
                        return $discount_percent;
                    } elseif (!empty($discount_amount)) {
                        return $discount_amount;
                    } else {
                        // Nếu cả hai đều rỗng, trả về 0
                        return 0;
                    }
                } else {
                    // Mã giảm giá đã hết hạn, trả về 0
                    return 0;
                }
            } else {
                // Mã giảm giá không tồn tại, trả về 0
                return 0;
            }
        }
    }
?>
