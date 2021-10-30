<?php
	include_once('inc/header.php');
	include_once('inc/slider.php');
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản Phẩm Nổi Bật</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			 	$product_feature= $product->getproduct_feature(); 
				 if($product_feature){
					 while($result= $product_feature->fetch_assoc()){
				 
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
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản Phẩm Mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		
			<div class="section group">
			<?php
			 	$product_new= $product->getproduct_new(); 
				 if($product_new){
					 while($result_new= $product_new->fetch_assoc()){
				 
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result_new['productId']?>"><img src="admin/uploads/<?php echo $result_new['image']?>" alt="Ảnh product" height="130" width="100" /></a>
					 <h2><?php echo $result_new['productName']?></h2>
					 <p><?php echo $fm->textShorten($result_new['descrip'],50)?></p>
					 <p><span class="price"><?php echo number_format( $result_new['price'],0,'.',',').' VNĐ'?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId']?>" class="details">Xem Chi Tiết</a></span></div>
				</div>

				<?php
					 }
					}
		?>
			</div>
			<div>
				<?php
					$product_all= $product->getAllproduct();
					$product_count=mysqli_num_rows($product_all);
					$product_button= ceil($product_count/4);
					if(isset($_GET['trang'])){
						$trang= $_GET['trang'];
					}else {
						$trang=1;
					}
					
					?>
					<a style="padding:10px; background-color:rgb(15, 147, 190); color:white;" <?php if($trang==1){echo 'href="index.php?trang=1"';}else {
						echo 'href="index.php?trang='.$trang-1 .'"';
					}?> > <i class="fas fa-backward"></i></a>
					<?php
					echo ' ';
					?>
					<?php
					for($i=1;$i<=$product_button;$i++){
						?>
						<a style="padding:10px; background-color:rgb(15, 147, 190); color:white;" href="index.php?trang=<?php echo $i?>"><?php echo $i?></a>
						
						<?php
						echo ' ';
					}
					?>
					<a style="padding:10px; background-color:rgb(15, 147, 190); color:white;" <?php if($trang==$product_button){echo 'href="index.php?trang='.$product_button.'"';}else {
						echo 'href="index.php?trang='.$trang+1 .'"';
					}?>> <i class="fas fa-forward"></i> </a>
				
			</div>
		
    </div>
 </div>
 <?php
	include('inc/footer.php');
?>