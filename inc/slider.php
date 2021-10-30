<?php
	ob_start();
?>
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getAsus= $product->getAsus();
					if($getAsus){
						while($result_asus= $getAsus->fetch_assoc()){
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_asus['productId']?>"> <img src="admin/uploads/<?php echo $result_asus['image']?>" alt="Ảnh Asus" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_asus['productName']?></h2>
						<p><?php echo $result_asus['descrip']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_asus['productId']?>">Chi Tiết</a></span></div>
				   </div>
			   </div>	
			   		<?php
					}
				}
					   ?>

<?php
					$getMacbook= $product->getMacbook();
					if($getMacbook){
						while($result_Mac= $getMacbook->fetch_assoc()){
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_Mac['productId']?>"> <img src="admin/uploads/<?php echo $result_Mac['image']?>" alt="Ảnh Macbook" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_Mac['productName']?></h2>
						<p><?php echo $result_Mac['descrip']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_Mac['productId']?>">Chi Tiết</a></span></div>
				   </div>
			   </div>	
				<?php
					}
				}
					   ?>
			</div>
			<div class="section group">
			<?php
					$getPana= $product->getPanasonic();
					if($getPana){
						while($result_Pana= $getPana->fetch_assoc()){
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_Pana['productId']?>"> <img src="admin/uploads/<?php echo $result_Pana['image']?>" alt="Ảnh Macbook" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_Pana['productName']?></h2>
						<p><?php echo $result_Pana['descrip']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_Pana['productId']?>">Chi Tiết</a></span></div>
				   </div>
			   </div>	
				<?php
					}
				}
					   ?>			
			<?php
					$getSam= $product->getSamsung();
					if($getSam){
						while($result_Sam= $getSam->fetch_assoc()){
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_Sam['productId']?>"> <img src="admin/uploads/<?php echo $result_Sam['image']?>" alt="Ảnh Macbook" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_Sam['productName']?></h2>
						<p><?php echo $result_Sam['descrip']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_Sam['productId']?>">Chi Tiết</a></span></div>
				   </div>
			   </div>	
				<?php
					}
				}
					   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
					<?php 
						$show_slider= $product->showSlider();
						if($show_slider){
							while($row_slider= $show_slider->fetch_assoc()){
					?>
						<li><img src="admin/uploads/<?php echo $row_slider['sliderImage']?>" alt="<?php echo $row_slider['sliderName']?>"/></li>
						<?php 
							}
						}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>