<?php
     $filepath= realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
    class category
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db= new Database();
            $this->fm= new Format();
        }
        public function show_category()
        {
            $query="SELECT * FROM tbl_category ORDER BY catId DESC";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function Insert_category($catName)
        {
            
            $catName= $this->fm->validation($catName);
            $catName= mysqli_real_escape_string($this->db->link, $catName);
            $query="SELECT * FROM tbl_category";
                    $result_select= $this->db->select($query);
                    
                        foreach ($result_select as $value) {
                            if(empty($catName)){
                                $alert="Category must not empty";
                                return $alert;
                            }elseif ($catName!= NULL && $catName==$value['catName']) {
                                $alert="Category Already, Input Name Category Again";
                                return $alert;
                            }
                            else{
                                $query="INSERT INTO tbl_category (catName) VALUES ('".$catName."')";
                                $result= $this->db->insert($query);
                                if($result){
                                    $alert="Insert category Successfully";
                                    return $alert;
                                }
                                else{
                                    $alert="Insert category NOT Success";
                                    return $alert;
                                }
                            }
                           }   
        }
        public function updateCat($catName, $id)
        {
            $catName= $this->fm->validation($catName);
            $catName= mysqli_real_escape_string($this->db->link, $catName);
            $id= mysqli_real_escape_string($this->db->link, $id);
                            if(empty($catName)){
                                $alert="Category must not empty";
                                return $alert;
                            }
                            else{
                                $query="UPDATE tbl_category SET catName= '".$catName."' WHERE catId= '".$id."'";
                    $result= $this->db->update($query);
                                if($result){
                                    $alert="Update category Successfully";
                                    return $alert;
                                }
                                else{
                                    $alert="Update category NOT Success";
                                    return $alert;
                                }
                            }     
        }
        public function delete_category($id)
        {
            $id= mysqli_real_escape_string($this->db->link, $id);
            $query="DELETE FROM tbl_category WHERE catId = '".$id."'";
                    $result= $this->db->delete($query);
                                if($result){
                                    $alert="Delete category Successfully";
                                    return $alert;
                                }
                                else{
                                    $alert="Delete category NOT Success";
                                    return $alert;
                                }
        }
        public function getCateById($id)
        {
            $query="SELECT * FROM tbl_category WHERE catId= '".$id."'";
            $result= $this->db->select($query);
            return $result;
        }
        public function get_pro_byCat($id)
        {
            $query="SELECT * FROM tbl_category, tbl_product WHERE tbl_category.catId= tbl_product.catId AND tbl_product.catId='".$id."' LIMIT 8";
            $result= $this->db->select($query);
            return $result;
        }
        public function get_name_byCat($id)
        {
            $query="SELECT * FROM tbl_category, tbl_product WHERE tbl_category.catId= tbl_product.catId AND tbl_product.catId='".$id."' LIMIT 1";
            $result= $this->db->select($query);
            return $result;
        }
    }
    
?>