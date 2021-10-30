<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	 $filepath= realpath(dirname(__FILE__));
	 include_once($filepath.'/../classes/cart.php');
?>
<?php
$ct= new cart();
	if(isset($_GET['shiftid'])){
		$id= $_GET['shiftid'];
		$time= $_GET['time'];
		$price= $_GET['price'];
		$shifted= $ct->shifted($id,$time,$price);
	}

	if(isset($_GET['delshift'])){
		$id_del= $_GET['delshift'];
		$time= $_GET['time'];
		$price= $_GET['price'];
		$del_shifted= $ct->del_shifted($id_del,$time,$price);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block"> 
					<?php
						if(isset($shifted)){
							echo $shifted;
						}
						if(isset($del_shifted)){
							echo $del_shifted;
						}
					?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$cart= new cart();
							$get_inbox_cart= $cart->getInboxCart();
							if($get_inbox_cart){
								$i=0;
								while($result_inbox= $get_inbox_cart->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result_inbox['date_order'];?></td>
							<td><?php echo $result_inbox['productName'];?></td>
							<td><?php echo $result_inbox['quantity'];?></td>
							<td><?php echo $result_inbox['price'];?></td>
							<td><?php echo $result_inbox['customerId'];?></td>
							<td><a href="customer.php?customerid=<?php echo $result_inbox['customerId']?>">View Customer</a></td>
							
							<td>
									<?php
										if($result_inbox['status']==0){

										
									?>
										<a href="?shiftid=<?php echo $result_inbox['id']?>&price=<?php echo $result_inbox['price']?>&time=<?php echo $result_inbox['date_order']?>">Pending</a>
									<?php
										}elseif ($result_inbox['status']==1) {
									?>
										<?php echo 'Shifting...';?>
									<?php
										}elseif($result_inbox['status']==2){
									?>
										<a href="?delshift=<?php echo $result_inbox['id']?>&price=<?php echo $result_inbox['price']?>&time=<?php echo $result_inbox['date_order']?>">Remove</a>
									<?php
										}
									?>
						
						</td>
						</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
