<?php
	include('inc/header.php');
?>
<?php
		if(isset($_GET['cartId'])){
			$id_cart= $_GET['cartId'];
			$result_delete= $cart->delete_product_cart($id_cart);
			header('Location:cart.php');
		}else {
			$result_delete='';
		
		}

		if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
			$cartId= $_POST['cartId'];
			$quantity= $_POST['quantity'];
			$update_quantity_cart= $cart->update_quantity_cart($quantity,$cartId);
			if($quantity<=0){
				$result_delete=$cart->delete_product_cart($cartId);
			}
		}else {
			$update_quantity_cart='';
		}
?>
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0,URL=?id=live'>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
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
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
						
								$get_product_cart= $cart->get_product_cart();
								if($get_product_cart){
									$i=0;
									$sub_total=0;
									$qty=0;
									while($result_cart= $get_product_cart->fetch_assoc()){
										$i++;
										
										
							?>
							<tr>
							<td><?php echo $i?></td>
								<td><?php echo $result_cart['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result_cart['image']?>" alt="Ảnh product"/></td>
								<td><?php echo  number_format($result_cart['price'],0,'.',',').' VNĐ'?></td>
								<td>
									<form action="" method="post">
									<input type="hidden" name="cartId"  value="<?php echo $result_cart['cartId']?>"/>
										<input type="number" name="quantity" min="0"   value="<?php echo $result_cart['quantity']?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php 
								$total=$result_cart['price']*$result_cart['quantity'];
								echo number_format($total,0,'.',','). ' VNĐ'?></td>
								<td><a href="?cartId=<?php echo $result_cart['cartId']?>" >Delete</a></td>
							</tr>
							<?php
							$sub_total+=$total;
							$qty++;
									}
								}
							?>
						</table>
						<?php
							if(!isset($sub_total)){
								echo 'Cart is Empty';
							}
						?>
						<?php
							
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php
									if(isset($sub_total)){
										echo number_format($sub_total,0,'.',',').' VNĐ'; 
										
									Session::set('quantity',$qty);
									}
								
									
								
								?>
								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								
								<td><?php 
									if(isset($sub_total)){
										echo number_format($sub_total + $sub_total*0.1,0,'.','.').' VNĐ' ;
										Session::set('sum',$sub_total + $sub_total*0.1);
									}
									?>
								 </td>
								 
							</tr>
					   </table>
					<?php
							
					?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include('inc/footer.php');
?>