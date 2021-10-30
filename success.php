<?php
	include('inc/header.php');
?>

<style>
    .success_order{
        text-align: center;
        color: green;
    }
    .success_note{
        text-align: center;
    }
</style>
 <div class="main">
     <form action="" method="POST">
    <div class="content">
    	<div class="section group">
		<h1 class="success_order">Thanh toán thành công</h1>
        <?php
            $customer_id= Session::get('customer_id');
            $get_amount= $cart->getAmountPrice($customer_id);
           
            if($get_amount){
                $amount=0;
                while($result= $get_amount->fetch_assoc()){
                    $price= $result['price'];
                    $amount+= $price;
                }
            }
        ?>
        <p class="success_note">Tổng tiền đơn hàng bạn đã mua: <?php  $vat= $amount*0.1;
        $total= $vat + $amount;
                echo number_format($total,0,'.',',').' VNĐ';
        ?> </p>
        <p class="success_note">Chúng tôi sẽ liên hệ cho bạn trong thời gian sớm nhất, xem chi tiết đơn hàng của bạn  <a href="orderdetails.php">ở đây</a></p>
 	</div>
     </form>
	 <?php
	include('inc/footer.php');
?>