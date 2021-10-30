<?php
	include('inc/header.php');
	include('inc/slider.php');
?>
 <div class="main">
    <div class="content">
		<?php
			$show_pro_brand= $product->showProductBrand();
			if($show_pro_brand){
				while($row_br=$show_pro_brand->fetch_assoc()){
		?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm của <?php echo $row_br['brandName']?></h3>
			
    		</div>
			<a style="margin-left: 1050px;" href="productInBrand.php?brandid=<?php echo $row_br['brandId']?>">Xem tất cả</a>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			  	$show_product= $product->showproductinbrand($row_br['brandId']);
				  if($show_product){
					  while($row_pro=$show_product->fetch_assoc()){
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $row_pro['productId']?>"><img src="admin/uploads/<?php echo $row_pro['image']?>" alt="" /></a>
					 <h2><?php echo $row_pro['productName']?> </h2>
					 <p><?php echo $row_pro['descrip']?></p>
					 <p><span class="price"><?php echo $row_pro['price']?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $row_pro['productId']?>" class="details">Details</a></span></div>
				</div>
			<?php
					  }
					}else {
						echo '<br>';
						echo '<span style="color:red; font-size:20px;">Chưa có sản phẩm nào</span>';
						echo '<br>';
						echo '<br>';
					}
			?>
				
			</div>
			<?php
				}
			}
			?>
			
    </div>
 </div>
 <?php
	include('inc/footer.php');
?>