<?php
         $filepath= realpath(dirname(__FILE__));
         include_once($filepath.'/../lib/database.php');
         include_once($filepath.'/../helpers/format.php');
?>
<?php
    class cart
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db= new Database();
            $this->fm= new Format();
        }
      public function add_to_cart($quantity,$id){
        $quantity= $this->fm->validation($quantity);
        $quantity= mysqli_real_escape_string($this->db->link,$quantity);
        $id= mysqli_real_escape_string($this->db->link,$id);
        $codecart= Session::get('customer_cart');
        $query= "SELECT * FROM tbl_product WHERE productId= '".$id."'";
		$result= $this->db->select($query)->fetch_assoc();
        $query_check_cart= "SELECT * FROM tbl_cart WHERE productId= '".$id."' AND codecart='".$codecart."'";
        $result_check_cart= $this->db->select($query_check_cart);
        if(Session::get('customer_login')){
            if($result_check_cart){
                $msg= "Product Already Add to Cart";
                return $msg;
            }
            else {
                $query_insert="INSERT INTO tbl_cart (productId,productName,price,quantity,image,codecart) VALUES 
                ('".$id."','".$result['productName']."','".$result['price']."','".$quantity."','".$result['image']."','".$codecart."')";
               $insert_cart= $this->db->insert($query_insert);
               if($insert_cart){
                  header('Location:cart.php');
                  
           }
               else{
                   header('Location:404.php');
           }
            }
        }else {
            $msg="Please login to add to cart";
            return $msg;
        }
     
    }
    public function get_product_cart()
    {
        $codecart= Session::get('customer_cart');
        $query= "SELECT * FROM tbl_cart WHERE codecart='".$codecart."' ";
        $result= $this->db->select($query);
        return $result;
    }
    public function update_quantity_cart($quantity,$id)
    {
        $quantity= mysqli_real_escape_string($this->db->link,$quantity);
        $id= mysqli_real_escape_string($this->db->link,$id);
        $query= "UPDATE tbl_cart SET quantity='".$quantity."' WHERE cartId='".$id."'";
        $result= $this->db->update($query);
       if($result){
        header('Location:cart.php');
       }else {
        $msg='<span style="color:red">Update Quantity Not Successfully</span>';
            return $msg;
       }
    }
    public function delete_product_cart($cart_id)
    {
       $cart_id= mysqli_real_escape_string($this->db->link,$cart_id);
        $query= "DELETE FROM tbl_cart WHERE cartId='".$cart_id."' ";
        $result= $this->db->delete($query);
        if($result){
            $msg='<span style="color:green">Delete Item Cart Successfully</span>';
            return $msg;
        }else {
         $msg='<span style="color:red">Delete Item Cart Not Successfully</span>';
             return $msg;
        }
    }
    public function check_cart()
    {
        $codecart= Session::get('customer_cart');
        $query= "SELECT * FROM tbl_cart WHERE codecart= '".$codecart."'";
        $result= $this->db->select($query);
        return $result;
    }
    public function delete_all_data_cart($cart)
    {
        $cart= mysqli_real_escape_string($this->db->link,$cart);
        $query= "DELETE FROM tbl_cart WHERE codecart='".$cart."'";
        $result= $this->db->delete($query);
    }
    public function insert_order($id_cus)
    {
        $code_cart= Session::get('customer_cart');
        $query="SELECT * FROM tbl_cart WHERE  codecart= '".$code_cart."'";
        $get_product= $this->db->select($query);
        if($get_product){
            while($result= $get_product->fetch_assoc()){
                $productid= $result['productId'];
                $productName= $result['productName'];
                $quantity= $result['quantity'];
                $price= $result['price'] * $quantity;
                $image= $result['image'];
                $customer_id= $id_cus;
                $query_order="INSERT INTO tbl_order (productId,productName,customerId,quantity,price,image) VALUES 
                ('".$productid."','".$productName."','".$customer_id."','".$quantity."','".$price."','".$image."')";
               $insert_order= $this->db->insert($query_order);
               if($insert_order){
                  header('Location:cart.php');
                  
           }
               else{
                   header('Location:404.php');
           }
            }
           
        }
    }
    public function getAmountPrice($cusId)
    {
        $query="SELECT price FROM tbl_order WHERE customerId ='".$cusId."' ";
        $get_price= $this->db->select($query);
        return $get_price;
    }
    public function get_ordered($customer_id)
    {
        $query="SELECT * FROM tbl_order WHERE   customerId ='".$customer_id."' ";
        $get_order= $this->db->select($query);
        return $get_order;
    }
    public function check_order($customer_id)
    {
       
        $query= "SELECT * FROM tbl_order WHERE customerId= '".$customer_id."'";
        $result= $this->db->select($query);
        return $result;
    }
    public function getInboxCart()
    {
        $query= "SELECT * FROM tbl_order  ORDER BY date_order DESC";
        $result= $this->db->select($query);
        return $result;
    }
    public function shifted($id,$time,$price)
    {
        $id= mysqli_real_escape_string($this->db->link,$id);
        $time= mysqli_real_escape_string($this->db->link,$time);
        $price= mysqli_real_escape_string($this->db->link,$price);
        $query= "UPDATE tbl_order SET status='1' WHERE id='".$id."' AND date_order='".$time."' AND price ='".$price."'";
        $result= $this->db->update($query);
       if($result){
        $msg='<span style="color:green">Update Order  Successfully</span>';
        return $msg;
       }else {
        $msg='<span style="color:red">Update Order Not Successfully</span>';
            return $msg;
       }
    }
    public function del_shifted($id,$time,$price)
    {
        $id= mysqli_real_escape_string($this->db->link,$id);
        $time= mysqli_real_escape_string($this->db->link,$time);
        $price= mysqli_real_escape_string($this->db->link,$price);
        $query= "DELETE FROM tbl_order WHERE id='".$id."' AND date_order='".$time."' AND price ='".$price."'  ";
        $result= $this->db->delete($query);
        if($result){
            $msg='<span style="color:green">Delete Order Successfully</span>';
            return $msg;
        }else {
         $msg='<span style="color:red">Delete Order Not Successfully</span>';
             return $msg;
        }
    }
    public function shifted_confirm($id,$time,$price)
    {
        $id= mysqli_real_escape_string($this->db->link,$id);
        $time= mysqli_real_escape_string($this->db->link,$time);
        $price= mysqli_real_escape_string($this->db->link,$price);
        $query= "UPDATE tbl_order SET status='2' WHERE customerId='".$id."' AND date_order='".$time."' AND price ='".$price."'";
        $result= $this->db->update($query);
       
    }
    }
    
?>