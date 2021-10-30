<?php
	include('inc/header.php');
    if(Session::get('customer_login')==false){
        header('Location:login.php');
    }
?>
<?php
	// if(!isset($_GET['proid']) || $_GET['proid']== NULL){
	// 	echo "<script>window.location= '404.php'</script>";
	// }else {
	// 	$id= $_GET['proid'];
	// }
	// if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
	// 	$quantity= $_POST['quantity'];
	// 	$addtocart= $cart->add_to_cart($quantity,$id);
	// }
	
?>
<style type="text/css">
	h3.payment {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
}
.wrapper_method{
	width: 550px;
	text-align: center;
	margin: 0 auto;
	border: 1px solid lightblue;
	padding: 20px;
	background: wheat;
}

.wrapper_method a{
	padding: 10px;
	background: lightblue;
	color: white;

}
.wrapper_method h3{
	margin-bottom: 20px;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Phương thức thanh toán</h3>
    		</div>
			
			
    		<div class="clear"></div>
			<div class="wrapper_method">
			<h3 class="payment">Chọn phương thức thanh toán</h3>
			<a href="offlinepayment.php">Thanh toán Offline</a>
			<a href="onlinepayment.php">Thanh toán Online</a>
			<br><br><br>
			<a style="background: yellowgreen;" href="cart.php">Trở về</a>
			</div>
			
    	</div>
           
           
 		</div>
 	</div>
	 <?php
	include('inc/footer.php');
?>