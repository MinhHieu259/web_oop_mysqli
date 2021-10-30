<?php
	include('inc/header.php');
?>
<?php
	if(Session::get('customer_id')==false){
        header('Location:login.php');
    }
    $ct= new cart();
    if(isset($_GET['confirmid'])){
		$id_confirm= $_GET['confirmid'];
		$time= $_GET['time'];
		$price= $_GET['price'];
		$shifted_confirm= $ct->shifted_confirm($id_confirm,$time,$price);
	}
	
?>
<style>
    .boxleft{
        width: 100%;
        border: 1px solid black;
        padding: 4px;
    }

</style>
 <div class="main">
     <form action="" method="POST">
    <div class="content">
    	<div class="section group">
		<div class="heading">
    		<h3>Chi tiết đơn hàng đã đặt</h3>
    		</div>
    		<div class="clear"></div>
            <div class="boxleft">
            <div class="cartpage">
			    	
					<?php
						
					?>
						<table class="tblone">
							<tr>
								<th width="10%">STT</th>
								<th width="20%">Product Name</th>
                                <th width="10%">Image</th>
                                <th width="10%">Quantity</th>
								<th width="15%">Total</th>
                                <th width="20%">Date Order</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>
								
							</tr>
							<?php
                                $customer_id= Session::get('customer_id');
								$get_cart_ordered= $cart->get_ordered($customer_id);
								if($get_cart_ordered){
									$i=0;
									$qty=0;
									while($result_ordered= $get_cart_ordered->fetch_assoc()){
										$i++;	
							?>
							<tr>
							<td><?php echo $i?></td>
								<td><?php echo $result_ordered['productName']?></td>
                                <td><img src="admin/uploads/<?php echo $result_ordered['image']?>" alt="Ảnh product"/></td>
                       
                                <td>
                                    <?php echo $result_ordered['quantity'] ?>
								</td>
								<td><?php echo  number_format($result_ordered['price'],0,'.',',').' VNĐ'?></td>
                                <td><?php echo $result_ordered['date_order']?></td>
                                <td><?php 
                                    if($result_ordered['status']==0){
                                        echo 'Pending';
                                    }elseif ($result_ordered['status']==1) {
                                        ?>
                                        <span>Shifted</span>
                                   
                                    <?php
                                    }elseif($result_ordered['status']==2) {
                                        echo 'Received';
                                    }
                                    ?>
                                  
                                </td>
                                <?php
                                    if($result_ordered['status']==0){
                                ?>
                                <td><?php echo 'N/A'?></td>
                                <?php
                                    }elseif($result_ordered['status']==1) { 
                                ?>
                                    <td><a href="?confirmid=<?php echo $customer_id?>&price=<?php echo $total= $result_ordered['price']?>&time=<?php echo $result_ordered['date_order']?>">Confirm</a></td>
                                <?php
                                    }elseif($result_ordered['status']==2) {
                                ?>
                                     <td><?php echo 'Received'?></td>
                                <?php
                                    }
                                ?>
							</tr>
							<?php
                                    }
                                }
                            ?>
						</table>
                        <br>
                        
                        <div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					
					</div>
					</div>
            </div>
            
           
 		</div>
   
 	</div>
                </form>
	 <?php
	include('inc/footer.php');
?>