<?php
         $filepath= realpath(dirname(__FILE__));
         include_once($filepath.'/../lib/database.php');
         include_once($filepath.'/../helpers/format.php');
?>
<?php
    class customer
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db= new Database();
            $this->fm= new Format();
        }
       
    public function Insert_customer($data)
    {
         function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
         
            return $random_string;
        }
        $name= mysqli_real_escape_string($this->db->link, $data['name']);
        $city= mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode= mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email= mysqli_real_escape_string($this->db->link, $data['email']);
        $address= mysqli_real_escape_string($this->db->link, $data['address']);
        $country= mysqli_real_escape_string($this->db->link, $data['country']);
        $phone= mysqli_real_escape_string($this->db->link, $data['phone']);
        $password= mysqli_real_escape_string($this->db->link, $data['passwordregist']);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cartrand=generate_string($permitted_chars, 20);
        $cartcode= mysqli_real_escape_string($this->db->link, $cartrand);
        if($name==""||$city==""|| $zipcode==""||$email==""||$address==""||$phone==""||$password==""){
            $alert="Information of customer must not empty";
            return $alert;
        }else {
            $checkemail= "SELECT * FROM tbl_customer WHERE email= '".$email."'";
            $result_check= $this->db->select($checkemail);
            if($result_check){
                $alert="Account Already Existed";
            return $alert;
            }else {
                $query="INSERT INTO tbl_customer (name,address,city,country,zipcode,phone,email,password,codecart) VALUES 
                ('".$name."','".$address."','".$city."','".$country."','".$zipcode."','".$phone."','".$email."','".$password."','".$cartcode."')";
               $result= $this->db->insert($query);
               if($result){
                   $alert="Insert customer Successfully";
               return $alert;
           }
               else{
                       $alert="Insert customer NOT Success";
                       return $alert;
           }
            }
        }
    }
    public function Login_customer($data)
    {
        $email= mysqli_real_escape_string($this->db->link,$data['emaillogin']);
        $password= mysqli_real_escape_string($this->db->link,$data['passwordlogin']);
        if($email==""||$password==""){
            $alert="Email or Password must not empty";
            return $alert;
        }else {
            $checklogin= "SELECT * FROM tbl_customer WHERE email= '".$email."' AND password= '".$password."'";
            $result_check= $this->db->select($checklogin);
            if($result_check != false){
                $value_cus= $result_check->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$value_cus['id']);
                Session::set('customer_name',$value_cus['name']);
                Session::set('customer_cart',$value_cus['codecart']);
               header('Location:cart.php');
            }else {
                $alert="Email or Password Wrong";
                return $alert;
            }
        }
    }
    public function showCustomer($id)
    {
        $query="SELECT * FROM tbl_customer WHERE id= '".$id."'";
        $result= $this->db->select($query);
        return $result;
    }
    public function update_cus($data,$id)
    {
        $name= mysqli_real_escape_string($this->db->link, $data['name']);

        $zipcode= mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email= mysqli_real_escape_string($this->db->link, $data['email']);
        $address= mysqli_real_escape_string($this->db->link, $data['address']);

        $phone= mysqli_real_escape_string($this->db->link, $data['phone']);


 
        if($name==""|| $zipcode==""||$email==""||$address==""||$phone==""){
            $alert="Information of customer must not empty";
            return $alert;
        }else {
           
                $query="UPDATE  tbl_customer SET name='".$name."',zipcode='".$zipcode."',email='".$email."',address='".$address."',phone='".$phone."' WHERE id='".$id."' ";
               $result= $this->db->update($query);
               if($result){
                   $alert='<span style="color:green">Update Customer Successfully</span>';
               return $alert;
           }
               else{
                       $alert='<span style="color:red">Update Customer Not Successfully</span>';
                       return $alert;
           
            }
        }
    }
    public function insertBinhluan()
    {
        $tieude= $_POST['tieude'];
        $binhluan=$_POST['binhluan'];
        $proid=$_POST['proId_binhluan'];
        if($tieude=='' || $binhluan==''){
            $msg='<span style="color:red">Thông tin bình luận không được để trống</span>';
            return $msg;
        }else {
            $query="SELECT * from tbl_comment where customerId='".Session::get('customer_id')."' and productId='".$proid."'";
            $check_cm=$this->db->select($query);
            if($check_cm){
                $msg='<span style="color:red">Bạn chỉ được bình luận 1 lần ở sản phẩm này</span>';
                return $msg;
            }else {
                $query_in="INSERT INTO tbl_comment (tieude,binhluan,productId,customerId,customerName) VALUES 
                ('".$tieude."','".$binhluan."','".$proid."','".Session::get('customer_id')."','".Session::get('customer_name')."')";
               $result= $this->db->insert($query_in);
               if($result){
                $msg='<span style="color:green">Bình luận thành công</span>';
               return $msg;
           }
               else{
                $msg='<span style="color:red">Bình luận không thành công</span>';
                       return $msg;
           }
            }
        }
    }
    public function showcomment($id)
    {
        $query="select * from tbl_comment where productId='".$id."'";
        $result= $this->db->select($query);
        return $result;
    }
    }
    
?>