<?php
	include('inc/header.php');
	include('inc/slider.php');
?>
<?php
     if(isset($_GET['proid'])){
        $cus_id=Session::get('customer_id');
			$proid= $_GET['proid'];
		 	$result_delete= $product->del_wishlist($proid,$cus_id);
     }
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Sản Phẩm Ưa Thích</h2>
					
						<table class="tblone">
							<tr>
								<th width="10%">STT</th>
								<th width="20%">Tên SP</th>
								<th width="20%">Hình Ảnh</th>
								<th width="15%">Giá</th>
								<th width="20%">Hành Động</th>
							</tr>
							<?php
								$cus_id=Session::get('customer_id');
								$get_wishlist= $product->get_wishlist($cus_id);
								if($get_wishlist){
									$i=0;
									while($result_wishlist= $get_wishlist->fetch_assoc()){
										$i++;		
							?>
							<tr>
							<td><?php echo $i?></td>
								<td><?php echo $result_wishlist['productName']?></td>
								<td><img width="200" src="admin/uploads/<?php echo $result_wishlist['image']?>" alt="Ảnh product"/></td>
								<td><?php echo  number_format($result_wishlist['price'],0,'.',',').' VNĐ'?></td>
								
								
								<td><a  href="?proid=<?php echo $result_wishlist['productId']?>" >Xóa</a> ||
                               
                                <a  href="details.php?proid=<?php echo $result_wishlist['productId']?>" >Xem Chi Tiết</a>
                            </td>
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