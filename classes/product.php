<?php
    $filepath= realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
    class product
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db= new Database();
            $this->fm= new Format();
        }
        public function show_product()
        {
            $query="SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName
             FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
             INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId ORDER BY tbl_product.productId DESC";
            // $query="SELECT * FROM tbl_product ORDER BY productId DESC";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function Insert_product($data,$files)
        {
            
         
            $productName= mysqli_real_escape_string($this->db->link, $data['productName']);
            $category= mysqli_real_escape_string($this->db->link, $data['category']);
            $brand= mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc= mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price= mysqli_real_escape_string($this->db->link, $data['price']);
            $type= mysqli_real_escape_string($this->db->link, $data['type']);
            // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
            $permited= array('jpg', 'jpeg', 'png', 'gif');
            $file_name= $_FILES['image']['name'];
            $file_size= $_FILES['image']['size'];
            $file_temp= $_FILES['image']['tmp_name'];

            $div= explode('.',$file_name);
            $file_ext= strtolower(end($div));
            $unique_image= substr(md5(time()), 0, 10).'.'.$file_ext;
            $upload_image= "uploads/".$unique_image;
          
                    
                        
             if($productName==""||$file_name==""|| $category==""||$brand==""||$product_desc==""||$price==""||$type==""){
                $alert="Information of product must not empty";
                return $alert;
            }
        else{
            move_uploaded_file($file_temp,$upload_image);
                $query="INSERT INTO tbl_product (productName,catId,brandid,descrip,type,price,image) VALUES 
                 ('".$productName."','".$category."','".$brand."','".$product_desc."','".$type."','".$price."','".$unique_image."')";
                $result= $this->db->insert($query);
                if($result){
                    $alert="Insert product Successfully";
                return $alert;
            }
                else{
                        $alert="Insert product NOT Success";
                        return $alert;
            }
        }
                              
        }
        public function updateProduct($data, $files, $id)
        {
            $productName= mysqli_real_escape_string($this->db->link, $data['productName']);
            $category= mysqli_real_escape_string($this->db->link, $data['category']);
            $brand= mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc= mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price= mysqli_real_escape_string($this->db->link, $data['price']);
            $type= mysqli_real_escape_string($this->db->link, $data['type']);
            // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
            $permited= array('jpg', 'jpeg', 'png', 'gif','jfif');
            $file_name= $_FILES['image']['name'];
            $file_size= $_FILES['image']['size'];
            $file_temp= $_FILES['image']['tmp_name'];

            $div= explode('.',$file_name);
            $file_ext= strtolower(end($div));
            $unique_image= substr(md5(time()), 0, 10).'.'.$file_ext;
            $upload_image= "uploads/".$unique_image;

           
            $id= mysqli_real_escape_string($this->db->link, $id);
             if($productName==""|| $category==""||$brand==""||$product_desc==""||$price==""||$type==""){
                $alert="Information of product must not empty";
                return $alert;
            }else {
                // Nếu người dùng chọn ảnh
                if(!empty($file_name)){
                    // Nếu file lớn hơn 1 MB
                    if($file_size>1000000){
                       $alert="Image size should be less than 10 MB";
                       return $alert;
                       // Loại file không phải là loại trong $permited
                    }else if(in_array($file_ext,$permited) === false){
                        $alert="You can upload type file only: ".implode(', ',$permited);
                        return $alert;
                    }
                    move_uploaded_file($file_temp,$upload_image);
                    $query="UPDATE tbl_product SET 
                     productName= '".$productName."',
                      brandId= '".$brand."' ,
                     catId= '".$category."' ,
                     type= '".$type."' ,
                     price= '".$price."' ,
                     image= '".$unique_image."',
                     descrip= '".$product_desc."' 
                    WHERE productId= '".$id."'";
                    $result= $this->db->update($query);
                    if($result){
                        $alert="Update product Successfully";
                        return $alert;
                    }
                    else{
                        $alert="Update product NOT Success";
                        return $alert;
                    } 
                } else{
                    $query="UPDATE tbl_product SET 
                     productName= '".$productName."',
                      brandId= '".$brand."' ,
                     catId= '".$category."' ,
                     type= '".$type."' ,
                     price= '".$price."' ,
                     descrip= '".$product_desc."' 
                    WHERE productId= '".$id."'";
                    $result= $this->db->update($query);
                if($result){
                    $alert="Update product Successfully";
                    return $alert;
                }
                else{
                    $alert="Update product NOT Success";
                    return $alert;
                }  
                }
                      
        }
       
        }
        public function getProductById($id)
        {
            $query="SELECT * FROM tbl_product WHERE productId= '".$id."'";
            $result= $this->db->select($query);
            return $result;
        }
 public function delete_product($id)
        {
            $id= mysqli_real_escape_string($this->db->link, $id);
            $query="DELETE FROM tbl_product WHERE productId = '".$id."'";
                    $result= $this->db->delete($query);
                                if($result){
                                    $alert="Delete product Successfully";
                                    return $alert;
                                }
                                else{
                                    $alert="Delete product NOT Success";
                                    return $alert;
                                }
        }
        public function getproduct_feature(){
            $query="SELECT * FROM tbl_product WHERE type='1' limit 4";
            // $query="SELECT * FROM tbl_product ORDER BY productId DESC";
                    $result= $this->db->select($query);
                    return $result;
        }

        public function getproduct_new(){
            $sp_tungtrang=4;
            if(!isset($_GET['trang'])){
                $trang=1;
            }else {
                $trang= $_GET['trang'];
            }
            $index_lay= ($trang - 1)*$sp_tungtrang;
            $query="SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $index_lay, $sp_tungtrang";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function getAllproduct(){
            $query="SELECT * FROM tbl_product";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function getDetail($id){
            $query="SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName
             FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
             INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId ='".$id."'";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function getAsus()
        {
            $query="SELECT * FROM tbl_product  WHERE brandid='1' ORDER BY productId DESC LIMIT 1";
            // $query="SELECT * FROM tbl_product ORDER BY productId DESC";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function getMacbook()
        {
            $query="SELECT * FROM tbl_product WHERE brandid='3' ORDER BY  productId DESC LIMIT 1";
            // $query="SELECT * FROM tbl_product ORDER BY productId DESC";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function getPanasonic()
        {
            $query="SELECT * FROM tbl_product WHERE brandid='8' ORDER BY  productId DESC LIMIT 1";
            // $query="SELECT * FROM tbl_product ORDER BY productId DESC";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function getSamsung()
        {
            $query="SELECT * FROM tbl_product WHERE brandid='2' ORDER BY  productId DESC LIMIT 1";
            // $query="SELECT * FROM tbl_product ORDER BY productId DESC";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function insertcompare($product_id,$cus_id)
        {
            $product_id= $this->fm->validation($product_id);
        $cus_id= mysqli_real_escape_string($this->db->link,$cus_id);
     
 
        $query= "SELECT * FROM tbl_product WHERE productId= '".$product_id."'";
		$result= $this->db->select($query)->fetch_assoc();
        $productName= $result['productName'];
        $price= $result['price'];
        $image= $result['image'];
        $query_check_compare= "SELECT * FROM tbl_compare WHERE productId= '".$product_id."' AND customerId= '".$cus_id."'";
        $check_compare= $this->db->select($query_check_compare);
        if($check_compare){
            $msg='<span style="color:red">Product Already Add to Compare</span>';
            return $msg;
        }else {
            $query_insert="INSERT INTO tbl_compare (customerId,productId,productName,price,image) VALUES 
            ('".$cus_id."','".$product_id."','".$productName."','".$price."','".$image."')";
           $insert_comp= $this->db->insert($query_insert);
           if($insert_comp){
            $msg='<span style="color:green">Insert Compare Successfully</span>';
            return $msg;
       }
           else{
            $msg='<span style="color:green">Insert Compare NOT Successfully</span>';
            return $msg;
       }
        }
             
        }
        public function get_product_compare($cus_id)
        {
            $query="SELECT * FROM tbl_compare WHERE customerId='".$cus_id."' ORDER BY  id DESC ";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function insertWishlist($product_id,$cus_id)
        {
            $product_id= $this->fm->validation($product_id);
            $cus_id= mysqli_real_escape_string($this->db->link,$cus_id);
         
     
            $query= "SELECT * FROM tbl_product WHERE productId= '".$product_id."'";
            $result= $this->db->select($query)->fetch_assoc();
            $productName= $result['productName'];
            $price= $result['price'];
            $image= $result['image'];
            $query_check_wishlist= "SELECT * FROM tbl_wishlist WHERE productId= '".$product_id."' AND customerId= '".$cus_id."'";
            $check_wishlist= $this->db->select($query_check_wishlist);
            if($check_wishlist){
                $msg='<span style="color:red">Product Already Add to Wishlist</span>';
                return $msg;
            }else {
                $query_insert="INSERT INTO tbl_wishlist (customerId,productId,productName,price,image) VALUES 
                ('".$cus_id."','".$product_id."','".$productName."','".$price."','".$image."')";
               $insert_wish= $this->db->insert($query_insert);
               if($insert_wish){
                $msg='<span style="color:green">Insert Wishlist Successfully</span>';
                return $msg;
           }
               else{
                $msg='<span style="color:green">Insert Wishlist NOT Successfully</span>';
                return $msg;
           }
        }
    }
    public function get_wishlist($cus_id)
    {
        $query="SELECT * FROM tbl_wishlist WHERE customerId='".$cus_id."' ORDER BY  id DESC ";
                $result= $this->db->select($query);
                return $result;
    }
    public function del_wishlist($proid,$cus_id)
    {
        
        $query= "DELETE FROM tbl_wishlist WHERE productId='".$proid."' AND customerId='".$cus_id."' ";
        $result= $this->db->delete($query);
        if($result){
            $msg='<span style="color:green">Delete Wishlist Product Successfully</span>';
            return $msg;
        }else {
         $msg='<span style="color:red">Delete Wishlist Product Not Successfully</span>';
             return $msg;
        }
    }
    public function insert_slider($data,$files)
    {
        $sliderName= mysqli_real_escape_string($this->db->link, $data['title']);
        $type= mysqli_real_escape_string($this->db->link, $data['type']);
       
        // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited= array('jpg', 'jpeg', 'png', 'gif','jfif');
        $file_name= $_FILES['image']['name'];
        $file_size= $_FILES['image']['size'];
        $file_temp= $_FILES['image']['tmp_name'];

        $div= explode('.',$file_name);
        $file_ext= strtolower(end($div));
        $unique_image= substr(md5(time()), 0, 10).'.'.$file_ext;
        $upload_image= "uploads/".$unique_image;

       
     
         if($sliderName==""|| $type==""){
            $alert="Information of Slider must not empty";
            return $alert;
        }else {
            // Nếu người dùng chọn ảnh
            if(!empty($file_name)){
                // Nếu file lớn hơn 1 MB
                if($file_size>2048000){
                   $alert="Image size should be less than 2 MB";
                   return $alert;
                   // Loại file không phải là loại trong $permited
                }else if(in_array($file_ext,$permited) === false){
                    $alert="You can upload type file only: ".implode(', ',$permited);
                    return $alert;
                }
                move_uploaded_file($file_temp,$upload_image);
                $query="INSERT INTO tbl_slider (sliderName,sliderImage,type) VALUES ('".$sliderName."','".$unique_image."','".$type."')";
                 
                $result= $this->db->insert($query);
                if($result){
                    $alert="Insert product Successfully";
                    return $alert;
                }
                else{
                    $alert="Insert product NOT Success";
                    return $alert;
                } 
            } else{
                $query="INSERT INTO tbl_slider (sliderName,type) VALUES ('".$sliderName."','".$type."')";
                $result= $this->db->insert($query);
            if($result){
                $alert="Insert product Successfully";
                return $alert;
            }
            else{
                $alert="Insert product NOT Success";
                return $alert;
            }  
            }
                  
    }
    }
    public function showSlider()
    {
        $query= "SELECT * FROM tbl_slider WHERE type ='1' order by sliderId desc";
        $show= $this->db->select($query);
        return $show;
    }

    public function showAllSlider()
    {
        $query= "SELECT * FROM tbl_slider";
        $show= $this->db->select($query);
        return $show;
    }
    public function updateTypeSlider($id,$type)
    {
        if($type==0){
            $query="update tbl_slider set type ='1' where sliderId='".$id."'";
            $update= $this->db->update($query);
        }elseif ($type==1) {
            $query="update tbl_slider set type ='0'  where sliderId='".$id."'";
            $update= $this->db->update($query);
        }
        
       
    }
    public function del_slider($id)
    {
        $query="delete from tbl_slider where sliderId='".$id."'";
        $result= $this->db->delete($query);
        return $result;
    }
    public function showProductBrand()
    {
        $query="select * from tbl_brand";
        $result= $this->db->select($query);
        return $result;
    }
    public function showproductinbrand($id)
    {
        $query="select * from tbl_product where brandId='".$id."'";
        $result= $this->db->select($query);
        return $result;
    }
    public function getAllProFromBrand($idBrand)
    {
        $query="select * from tbl_product as pd, tbl_brand as br where pd.brandId=br.brandId and br.brandId='".$idBrand."'";
        $result= $this->db->select($query);
        return $result;
    }
    public function searchProduct($title)
    {
        $query="select * from tbl_product  where productName like '%".$title."%'";
        $result= $this->db->select($query);
        return $result;
    }
}
    
?>