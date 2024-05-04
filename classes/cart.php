<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php

/**
 *
 */
class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $id)
    {

        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();
        $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId ='$sId'";
        $result_check_cart = $this->db->select($check_cart);
        if ($result_check_cart) {
            $msg = "<span class='error'>Sản phẩm đã được thêm vào giỏ</span>";
            return $msg;
        } else {

            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $image = $result["image"];
            $price = ($result["sale_price"] > 0) ? $result["sale_price"] : $result["price"];
            $productName = $result["productName"];


            $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId','$image','$price','$productName')";
            $insert_cart = $this->db->insert($query_insert);
            if ($insert_cart) {
                echo "<script>window.location ='cart.php'</script>";
            } else {
                echo "<script>window.location ='404.php'</script>";
            }
        }

    }


    public function get_product_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' order by cartId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_quantity_cart($quantity, $cartId)
    {

        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET

					quantity = '$quantity'

					WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if ($result) {
            echo "<script>window.location ='cart.php'</script>";
        } else {
            $msg = "<span class='error'>Số lượng sản phẩm được cập nhật không thành công</span>";
            return $msg;
        }

    }

    public function del_product_cart($cartid)
    {
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
        $result = $this->db->delete($query);
        if ($result) {

            echo "<script>window.location ='cart.php'</script>";

        } else {
            $msg = "<span class='error'>Sản phẩm bị xóa không thành công</span>";
            return $msg;
        }
    }

    public function check_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function check_order($customer_id)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_data_cart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_compare($customer_id)
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function insertOrder($customer_id)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $get_product = $this->db->select($query);
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productid = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];

                $getProduct = "SELECT * FROM tbl_product where productId = '$productid'";
			    $dataProduct = $this->db->select($getProduct);
                $productQuantity= (int)$dataProduct->fetch_assoc()['productQuantity'] - $quantity;
                // var_dump($productQuantity); die();

                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $customer_id = $customer_id;
                $query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customer_id) VALUES('$productid','$productName','$quantity','$price','$image','$customer_id')";
                $insert_order = $this->db->insert($query_order);

                $updateProduct= "UPDATE tbl_product SET
                productQuantity = '$productQuantity'
                WHERE productId = '$productid'";
                $resultUpdateProduct = $this->db->update($updateProduct);
            }
        }
    }

    public function getAmountPrice($customer_id)
    {

        $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    public function get_cart_ordered($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'  ORDER BY id desc";
        $get_cart_ordered = $this->db->select($query);
        return $get_cart_ordered;
    }

    public function get_inbox_cart()
    {
        $query = "SELECT * FROM tbl_order ORDER BY status asc";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    public function get_inbox_cart2()
    {
        $query = "SELECT * FROM tbl_order WHERE `status` = 2 ORDER BY date_order";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    public function totalMoney()
    {
        $query = "SELECT sum(price) FROM `tbl_order` WHERE `status` = 2";
        $totalMoney = $this->db->select($query);
        return $totalMoney->fetch_assoc()['sum(price)'];
    }

    public function countOrderD($year, $monthS, $dayS)
    {
        $query = "SELECT price FROM `tbl_order` WHERE `status` = 2 AND year(`date_order`)= '$year' AND month(`date_order`)= '$monthS' AND day(`date_order`)= '$dayS'";
        $totalMoney = $this->db->select($query);
        return $totalMoney;
    }

    public function countOrderPri($year, $monthS, $dayS)
    {
        $query = "SELECT sum(price)  FROM `tbl_order` WHERE `status` = 2 AND year(`date_order`)= '$year' AND month(`date_order`)= '$monthS' AND day(`date_order`)= '$dayS'";
        $totalMoney = $this->db->select($query);
        return $totalMoney->fetch_assoc()['sum(price)'];
    }

    public function countOrderT($i)
    {
        $query = "SELECT sum(price) FROM `tbl_order` WHERE `status` = 2 AND month(`date_order`)= '$i'";
        $totalMoney = $this->db->select($query);
        return $totalMoney->fetch_assoc()['sum(price)'];
    }

    public function countOrderM($i)
    {
        $query = "SELECT * FROM `tbl_order` WHERE `status` = 2 AND month(`date_order`)= '$i'";
        $countOrderM = $this->db->select($query);
        return $countOrderM;
    }

    public function shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET

					status = '1'

					WHERE id = '$id' AND date_order='$time' AND price ='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>Cập nhật đơn hàng thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Cập nhật đơn hàng không thành công</span>";
            return $msg;
        }
    }

    public function del_shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE FROM tbl_order 
					WHERE id = '$id' AND date_order='$time' AND price ='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>Xóa đơn hàng thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Xóa đơn hàng không thành công</span>";
            return $msg;
        }
    }

    public function shifted_confirm($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET
					status = '3'
					WHERE customer_id = '$id' AND date_order='$time' AND price ='$price'";
        $result = $this->db->update($query);
        return $result;
    }

    public function del_cancelid($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tbl_order SET
					status = '3'
					WHERE id = '$id'";
        $result = $this->db->update($query);
        return $result;
    }

    public function del_doneid($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tbl_order SET
					status = '2'
					WHERE id = '$id'";
        $result = $this->db->update($query);
        return $result;
    }

    public function loc_product($start_date, $end_date)
    {
        // var_dump($start_date,$end_date);
        $query = "SELECT * FROM `tbl_order` WHERE date(`date_order`) BETWEEN '$start_date' AND '$end_date'";
        $totalMoney = $this->db->select($query);
        return $totalMoney;
    }

    public function filter_product($status)
    {
        $query = "SELECT * FROM `tbl_order` WHERE status = ".$status;
        $totalMoney = $this->db->select($query);
        return $totalMoney;
    }
    public function filter_mane_customer($keyword)
    {
        $qr = "SELECT * FROM `tbl_customer` WHERE name like '%$keyword%' limit 1";
        $request = $this->db->select($qr);
        $customer_id= $request->fetch_assoc()['id'];
        $query = "SELECT * FROM `tbl_order` WHERE customer_id= '$customer_id'";
        $totalMoney = $this->db->select($query);
        return $totalMoney;
    }

}

?>