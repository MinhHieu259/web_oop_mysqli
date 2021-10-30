<?php
	include('inc/header.php');
	include('inc/slider.php');
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>So Sánh Sản Phẩm</h2>
					<?php
						if(isset($update_quantity_cart)){
							echo $update_quantity_cart.'</br>';
						}
						if(isset($result_delete)){
							echo $result_delete;
						}
					?>
						<table class="tblone">
							<tr>
								<th width="20%">STT</th>
								<th width="20%">Tên SP</th>
								<th width="35%">Hình Ảnh</th>
								<th width="10%">Giá</th>
								<th width="15%">Hành Động</th>
							</tr>
							<?php
								$cus_id=Session::get('customer_id');
								$get_compare= $product->get_product_compare($cus_id);
								if($get_compare){
									$i=0;
									while($result_compare= $get_compare->fetch_assoc()){
										$i++;		
							?>
							<tr>
							<td><?php echo $i?></td>
								<td><?php echo $result_compare['productName']?></td>
								<td><img width="200" src="admin/uploads/<?php echo $result_compare['image']?>" alt="Ảnh product"/></td>
								<td><?php echo  number_format($result_compare['price'],0,'.',',').' VNĐ'?></td>
								
								
								<td><a  href="details.php?proid=<?php echo $result_compare['productId']?>" >Xem Chi Tiết</a></td>
							</tr>
							<?php
									}
								}
							?>
						</table>
						
					</div>
					<div class="shopping">
						
							<center><a href="index.php"> <img src="images/shop.png" alt="" /></a></center>
						
					
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include('inc/footer.php');
?>