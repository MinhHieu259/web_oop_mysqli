<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php
    $product= new product();
    if(!isset($_GET['productid']) || $_GET['productid']==NULL){
        echo "<script>window.location= 'productlist.php'</script>";
    }else {
        $id=$_GET['productid'];
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		
		
		$update_product = $product->updateProduct($_POST,$_FILES,$id);
	}else {
		$update_product='';
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block"> 
            <?php
                if($update_product){
                    echo $update_product;
                }
            ?>
            <?php
                $get_product_id= $product->getProductById($id);
                if($get_product_id){
                    while($get_pd= $get_product_id->fetch_assoc()){

            ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên SP:</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $get_pd['productName']?>" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Loại danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select Category</option>
                            <?php
                                $cate= new category();
                                $list_cate= $cate->show_category();
                                if($list_cate){
                                    while($row_cate= $list_cate->fetch_assoc()){

                                    
                            ?>
                            <option <?php 
                                if($get_pd['catId']==$row_cate['catId']){
                                    echo "Selected";
                                }
                            ?> value="<?php echo $row_cate['catId']?>"><?php echo $row_cate['catName']?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option >Select Brand</option>
                            <?php
                                $brand = new brand();
                                $list_brand= $brand->show_brand();
                                if($list_brand){

                                while($row_brand= $list_brand->fetch_assoc()){

                            ?>
                            <option  <?php 
                                if($get_pd['brandId']==$row_brand['brandId']){
                                    echo "Selected";
                                }
                            ?> value="<?php echo $row_brand['brandId']?>"><?php echo $row_brand['brandName']?></option>
                            <?php
                                }
                            }
                            ?>
                            
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea class="tinymce"  name="product_desc"><?php echo $get_pd['descrip']?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input value="<?php echo $get_pd['price']?>" type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Hình ảnh</label>
                    </td>
                    <td>
                    <img width="120" src="uploads/<?php echo $get_pd['image']?>" alt="Ảnh product">
                    <br>
                        <input type="file" name="image"/>  
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type" >
                            <option>Select Type</option>
                            <?php
                                if($get_pd['type']==1){
                            ?>
                            <option selected value="1">Featured</option>
                            <option  value="0">Non-Featured</option>
                            <?php
                                }else {
                                 
                            ?>

                            <option  value="1">Featured</option>
                            <option selected  value="0">Non-Featured</option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


