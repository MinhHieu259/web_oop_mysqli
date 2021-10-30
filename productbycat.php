<?php
	include('inc/header.php');
	if(!isset($_GET['catid']) || $_GET['catid']== NULL){
		echo "<script>window.location= '404.php'</script>";
	}else {
		$id= $_GET['catid'];
	}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
			<?php
				$getName= $cate->get_name_byCat($id);
				if($getName){
					while($resultcateName=$getName->fetch_assoc()){
			?>
    		<div class="heading">
    		<h3>Category: <?php echo $resultcateName['catName']?> </h3>
    		</div>
			<?php
					}
				}
			?>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
					$getCate= $cate->get_pro_byCat($id);
					if($getCate){
						while($resultcate=$getCate->fetch_assoc()){
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details-3.php"><img src="admin/uploads/<?php echo $resultcate['image']?>" alt="Ảnh product" /></a>
					 <h2><?php echo $resultcate['productName']?> </h2>
					 <p><?php echo $resultcate['descrip']?></p>
					 <p><span class="price"><?php echo number_format($resultcate['price'],0,'.',',')?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $resultcate['productId']?>" class="details">Details</a></span></div>
				</div>
		<?php
						}
					}else {
						echo '<span style="color:red;">Category Not Have Product</span>';
					}
		?>
			</div>

	
	
    </div>
 </div>
 <?php
	include('inc/footer.php');
?>