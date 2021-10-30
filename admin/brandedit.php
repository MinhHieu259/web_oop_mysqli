<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
    echo "<script>window.location= 'brandlist.php'</script>";
}else {
    $id=$_GET['brandid'];
}
    $class= new brand();
	
?>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$brandName=$_POST['brandName'];
		$updateBrand= $class->updateBrand($brandName,$id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu </h2>
                
               <div class="block copyblock"> 
               <?php 
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                ?>
                <?php
                    $get_brand_byid= $class->getBrandById($id);
                    if($get_brand_byid){
                        while($result = $get_brand_byid->fetch_assoc()){
                    
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']?>" placeholder="Nhập tên thương hiệu..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                    }
                }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>