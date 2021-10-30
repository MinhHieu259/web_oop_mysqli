<?php
	include_once('inc/header.php');
	//include_once('inc/slider.php');
?>
<?php
    if(!isset($_GET['brandid']) || $_GET['brandid']== NULL){
		 echo "<script>window.location= '404.php'</script>";
	}else {
		$idbrand= $_GET['brandid'];
	}
    $get_name_brand= $product->getAllProFromBrand($idbrand);
    if($get_name_brand){
        $row_name= $get_name_brand->fetch_assoc();
    }
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Tất cả các sản phẩm của <?php echo $row_name['brandName']?> </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			 	$product_brand= $product->getAllProFromBrand($idbrand); 
				 if($product_brand){
					 while($result= $product_brand->fetch_assoc()){
				 
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId']?>"><img src="admin/uploads/<?php echo $result['image']?>" alt="Ảnh product" height="130" width="100" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['descrip'],50)?></p>
					 <p><span class="price"><?php echo number_format( $result['price'],0,'.',',').' VNĐ'?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']?>" class="details">Xem Chi Tiết</a></span></div>
				</div>
				<?php
					 }
					}
				?>
			</div>
		
		
	
		
    </div>
 </div>
 <?php
	include('inc/footer.php');
?>