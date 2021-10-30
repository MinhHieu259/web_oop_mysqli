<?php
	include_once('inc/header.php');
?>
<?php
    if(!isset($_POST['txtTimkiem']) || $_POST['txtTimkiem']== NULL){
		 echo "<script>window.location= '404.php'</script>";
	}else {
		$title= $_POST['txtTimkiem'];
	}
   

?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Từ khóa tìm kiếm <?php echo $title?> </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			 	$product_search= $product->searchProduct($title); 
				 if($product_search){
					 while($result= $product_search->fetch_assoc()){
				 
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
					}else {
                        echo '<br>';
                        echo '<center><span style="color:red; font-size:20px;">Không có kết quả nào cho từ khóa '.$title.'</span></center>';
                        echo '<br>';
                    }
				?>
			</div>
		
		
	
			
		
    </div>
 </div>
 <?php
	include('inc/footer.php');
?>