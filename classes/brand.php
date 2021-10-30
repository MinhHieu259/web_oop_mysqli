<?php
         $filepath= realpath(dirname(__FILE__));
         include_once($filepath.'/../lib/database.php');
         include_once($filepath.'/../helpers/format.php');
?>
<?php
    class brand
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db= new Database();
            $this->fm= new Format();
        }
        public function show_brand()
        {
            $query="SELECT * FROM tbl_brand ORDER BY brandId DESC";
                    $result= $this->db->select($query);
                    return $result;
        }
        public function Insert_brand($brandName)
        {
 
            $brandName= $this->fm->validation($brandName);
            $brandName= mysqli_real_escape_string($this->db->link, $brandName);
                            if(empty($brandName)){
                                $alert="Brand must not empty";
                                return $alert;
                            }
                            else{
                                $query="INSERT INTO tbl_brand (brandName) VALUES ('".$brandName."')";
                                $result= $this->db->insert($query);
                                if($result){
                                    $alert="Insert brand Successfully";
                                    return $alert;
                                }
                                else{
                                    $alert="Insert brand NOT Success";
                                    return $alert;
                                }
                            }            
        }
        public function updateBrand($brandName, $id)
        {
            $catName= $this->fm->validation($brandName);
            $brandName= mysqli_real_escape_string($this->db->link, $brandName);
            $id= mysqli_real_escape_string($this->db->link, $id);
                            if(empty($brandName)){
                                $alert="Brand must not empty";
                                return $alert;
                            }
                            else{
                                $query="UPDATE tbl_brand SET brandName= '".$brandName."' WHERE brandId= '".$id."'";
                    $result= $this->db->update($query);
                                if($result){
                                    $alert="Update Brand Successfully";
                                    return $alert;
                                }
                                else{
                                    $alert="Update Brand NOT Success";
                                    return $alert;
                                }
                            }     
        }
        public function delete_brand($id)
        {
            $id= mysqli_real_escape_string($this->db->link, $id);
            $query="DELETE FROM tbl_brand WHERE brandId = '".$id."'";
                    $result= $this->db->delete($query);
                                if($result){
                                    $alert="Delete Brand Successfully";
                                    return $alert;
                                }
                                else{
                                    $alert="Delete Brand NOT Success";
                                    return $alert;
                                }
        }
        public function getBrandById($id)
        {
            $query="SELECT * FROM tbl_brand WHERE brandId= '".$id."'";
            $result= $this->db->select($query);
            return $result;
        }
        
    }
    
?>