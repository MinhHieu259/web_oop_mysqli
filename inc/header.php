<?php 
   include_once('lib/session.php');
    Session::init();
?>
<?php
	    include_once('lib/database.php');
		include_once('helpers/format.php');
	$db= new Database();
	$fm= new Format();
	spl_autoload_register(function($className){
		include_once "classes/".$className.".php";
	});
	$cart= new cart();
	$us= new user();
	$cate= new category();
	$customer= new customer();
	$product = new product();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Shop Minh Hiếu</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img style="margin-top: 25px;"  src="images/logo2.jpg" width="300" alt="Logo" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="POST">
				    	<input type="text" placeholder="Nhập Thông Tin Tìm Kiếm" name="txtTimkiem">
						<input type="submit" value="Tìm Kiếm">
				    </form>
			    </div>
			  
				<div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<!-- <span class="cart_title">Cart</span> -->
								<span class="no_product">
									<?php
									$check_cart= $cart->check_cart();
									
										if($check_cart){
											$sum=Session::get("sum");
											$qty= Session::get("quantity");
											echo number_format($sum,0,'.',',').' VNĐ'.' ( '.$qty.' )';
										}else {
											echo 'Trống';
										}
									
									?>
								</span>
							</a>
						</div>
			      </div>
				<?php
					if(isset($_GET['customerid'])){
						Session::destroy();
					}
				?>
		   <div class="login">
			   <?php
			 		if(Session::get('customer_login')){
						 
						 echo '<a href="?customerid='.Session::get('customer_id').'">Đăng Xuất</a>';
					 }else {
						 echo '<a href="login.php">Đăng Nhập</a>';
					 }  
			   ?>
		   </div>
		
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Trang chủ</a></li>
	  <li><a href="products.php">Sản phẩm</a> </li>
	  
	  <?php
	 		$check_cartt= $cart->check_cart();
			 if($check_cartt){
				 echo '  <li><a href="cart.php">Giỏ Hàng</a></li>';
			 }else {
				 echo '';
			 }
	  ?>
<?php 
	$customer_lo= Session::get('customer_login');
	

?>
<?php
	if($customer_lo){
?>
	<li>
                <a href="#">Cá Nhân <span class="arrow">&#9660;</span></a>
 
                <ul class="sub-menu">
				<?php
$customer_id= Session::get('customer_id');
	 		$check_order= $cart->check_order($customer_id);
			 if($check_order){
				 echo '  <li><a href="orderdetails.php">Đơn Hàng</a></li>';
			 }else {
				 echo '';
			 }
	  ?>
                    <?php
	 	if(Session::get('customer_login')){
			 echo '<li><a href="profile.php">Thông tin cá nhân</a></li>';
		 }else {
			 echo '';
		 }
	  ?>
                    <?php
	 	if(Session::get('customer_login')){
			 echo '<li><a href="compare.php">So Sánh Sản Phẩm</a> </li>';
		 }else {
			 echo '';
		 }
	  ?>
                     <?php
	 	if(Session::get('customer_login')){
			 echo '<li><a href="wishlist.php">Sản Phẩm Yêu Thích</a> </li>';
		 }else {
			 echo '';
		 }
	  ?>
                </ul>
            </li>
<?php
	}else {
		echo '';
	}
?>
	  <li><a href="contact.php">Liên Hệ</a> </li>
	  <div class="clear"></div>
	</ul>
</div>