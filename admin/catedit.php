<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
if(!isset($_GET['catid']) || $_GET['catid']==NULL){
    echo "<script>window.location= 'catlist.php'</script>";
}else {
    $id=$_GET['catid'];
}
    $class= new category();
	
?>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$catName=$_POST['catName'];
		$updateCate= $class->updateCat($catName,$id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
                
               <div class="block copyblock"> 
               <?php 
                    if(isset($updateCate)){
                        echo $updateCate;
                    }
                ?>
                <?php
                    $get_cate_byid= $class->getCateById($id);
                    if($get_cate_byid){
                        while($result = $get_cate_byid->fetch_assoc()){
                    
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']?>" placeholder="Nhập tên danh mục..." class="medium" />
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