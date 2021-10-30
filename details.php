<?php
	include('inc/header.php');
?>
<?php
	if(!isset($_GET['proid']) || $_GET['proid']== NULL){
		// echo "<script>window.location= '404.php'</script>";
	}else {
		$id= $_GET['proid'];
	}
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
		$quantity= $_POST['quantity'];
		$addtocart= $cart->add_to_cart($quantity,$id);
	}
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['compare'])){
		$cus_id=Session::get('customer_id');
		$product_id= $_POST['productId'];
		$insertcompare= $product->insertcompare($product_id,$cus_id);
	}
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['wishlist'])){
		$cus_id=Session::get('customer_id');
		$product_id= $_POST['productId'];
		$insertWishlist= $product->insertWishlist($product_id,$cus_id);
	}
	if(isset($_POST['binhluan_submit'])){
		$insertBinhluan= $customer->insertBinhluan();
	}
	
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				$get_detail= $product->getDetail($id);
				if($get_detail){
					while($result_detail=$get_detail->fetch_assoc()){
			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_detail['image']?>" alt="Ảnh Product" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_detail['productName']?></h2>
					<p><?php echo $fm->textShorten($result_detail['descrip'],200)?></p>					
					<div class="price">
						<p>Giá: <span><?php echo number_format($result_detail['price'],0,'.',','). ' VNĐ'?></span></p>
						<p>Danh Mục: <span><?php echo $result_detail['catName']?></span></p>
						<p>Thương Hiệu:<span><?php echo $result_detail['brandName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Mua Ngay"/>
						
					</form>		
					<?php
							if(isset($addtocart)){
								echo $addtocart;
							}
							
						?> 			
				</div>

				<div class="add-cart">
				<form action="" method="post">
					<input type="hidden" name="productId" value="<?php echo $result_detail['productId']?>">
					<?php
						if(Session::get('customer_login')){
							echo '<input type="submit" class="buysubmit" name="compare" value="Thêm Vào So Sánh SP"/>'.' ';
							echo '<input type="submit" class="buysubmit" name="wishlist" value="Thêm Vào SP Yêu Thích"/>';
							echo '<br><br>';
						}else {
							echo '';
						}
					?>
					<?php
						if(isset($insertcompare)){
							echo $insertcompare;
						}
						if(isset($insertWishlist)){
							echo $insertWishlist;
						}
					?>
					</form>
				</div>
			</div>
			<div class="product-desc">
			<h2>Chi Tiết Sản Phẩm</h2>
			<p><?php echo $fm->textShorten($result_detail['descrip'],200)?></p>		
	    </div>		
	</div>
	<?php
					}
				}
	?>
				<div class="rightsidebar span_3_of_1">
					<h2>Danh Mục</h2>
					<ul>
						<?php 
							$get_cateName= $cate->show_category();
							if($get_cateName){
								while($result_cat= $get_cateName->fetch_assoc()){
						?>
				      <li><a href="productbycat.php?catid=<?php echo $result_cat['catId']?>"><?php echo $result_cat['catName']?></a></li>
				      	<?php
								}
							}
						  ?>
    				</ul>
    	
 				</div>
 		</div>
		 <?php
		 	if(Session::get('customer_login')){
		 ?>
			 <div class="binhluan">
			 <h5 style="color: lightblue;">Bình luận sản phẩm</h5>
			 <br>
			 <?php
			 	if(isset($insertBinhluan)){
					 echo $insertBinhluan;
				 }
			 ?>
			 <form action="" method="post">
				 <p><input type="hidden" value="<?php echo $id?>" name="proId_binhluan"></p>
				<input type="text" name="tieude" placeholder="Tiêu đề" size="77px">
				<br>
				 <br>
			 <textarea name="binhluan" placeholder="Bình luận" cols="70" rows="10"></textarea>
			 <p ><input style="background-color: lightblue; border: none; padding: 10px;" name="binhluan_submit" type="submit" value="Gửi bình luận"></p>
			 <br>
			 </form>
		 </div>
		 
		 <?php
			 }else {
				 echo '';
			 }
		 ?>
		<?php
		 	$show=$customer->showcomment($id);
			 if($show){
				 while($row=$show->fetch_assoc()){
		 ?>
		 <div class="showcomment">
			 <p>Người bình luận: <?php echo $row['customerName']?></p>
				 <br>
			 <p>Tiêu đề: <?php echo $row['tieude']?></p>
				<br>
			 <p>Bình luận: <?php echo $row['binhluan']?></p>
		 </div>
		 <br>
		<?php
				 }
				}else {
					echo 'Sản phẩm chưa có bình luận nào';
				}
		?>
 	</div>

	 <?php
	include('inc/footer.php');
?>