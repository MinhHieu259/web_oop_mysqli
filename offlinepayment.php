<?php
	include('inc/header.php');
?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid']== 'order'){
		$customer_id= Session::get('customer_id');
        $cart_code= Session::get('customer_cart');
        $inseroder= $cart->insert_order($customer_id);
        $delcart=$cart->delete_all_data_cart($cart_code);
        header('Location:success.php');
	}
	
?>
<style>
    .boxleft{
        width: 50%;
        border: 1px solid black;
        float: left;
        padding: 4px;
    }
    .boxright{
        width: 47%;
        border: 1px solid black;
        float: right;
        padding: 4px;
    }
    

.submit_order {
    padding: 10px 70px;
    border: none;
    background-color: blue;
    font-size: 25px;
    color: white;
    border-radius: 15px;
    text-align: center;
    cursor: pointer;
}
.submit_order:hover{
    background-color: lightseagreen;
}
</style>
 <div class="main">
     <form action="" method="POST">
    <div class="content">
    	<div class="section group">
		<div class="heading">
    		<h3>Thanh toán Offline</h3>
    		</div>
    		<div class="clear"></div>
            <div class="boxleft">
            <div class="cartpage">
			    	
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
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								
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
								<td><?php echo  number_format($result_cart['price'],0,'.',',').' VNĐ'?></td>
								<td>
									
								
                                    <?php echo $result_cart['quantity'] ?>
									
								
								</td>
								<td><?php 
								$total=$result_cart['price']*$result_cart['quantity'];
								echo number_format($total,0,'.',','). ' VNĐ'?></td>
						
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
						<table style="float:right;text-align:left; margin: 5px;" width="40%">
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
								<td>10% (<?php echo number_format(0.1 * $sub_total,0,'.',',')?>)</td>
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
            </div>
            <div class="boxright">
            <table class="tblone">
                <?php
                $id= Session::get('customer_id');
                    $result_cusinfor= $customer->showCustomer($id);
                    if($result_cusinfor){
                        while($row_cus=$result_cusinfor->fetch_assoc()){
                ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><?php echo $row_cus['name'] ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $row_cus['city'] ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $row_cus['phone'] ?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $row_cus['zipcode'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $row_cus['email'] ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $row_cus['address'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
            </div>
           
 		</div>
        <center style="margin-top: 20px;"> <a class="submit_order" href="?orderid=order">Đặt hàng</a></center>
 	</div>
                </form>
	 <?php
	include('inc/footer.php');
?>