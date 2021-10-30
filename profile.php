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
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Thông Tin Cá Nhân</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
           
            <table class="tblone">
                <?php
                $id= Session::get('customer_id');
                    $result_cusinfor= $customer->showCustomer($id);
                    if($result_cusinfor){
                        while($row_cus=$result_cusinfor->fetch_assoc()){
                ?>
                <tr>
                    <td>Họ Và Tên</td>
                    <td>:</td>
                    <td><?php echo $row_cus['name'] ?></td>
                </tr>
                <tr>
                    <td>Thành Phố</td>
                    <td>:</td>
                    <td><?php echo $row_cus['city'] ?></td>
                </tr>
                <tr>
                    <td>Điện Thoại</td>
                    <td>:</td>
                    <td><?php echo $row_cus['phone'] ?></td>
                </tr>
                <tr>
                    <td>Mã Zip</td>
                    <td>:</td>
                    <td><?php echo $row_cus['zipcode'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $row_cus['email'] ?></td>
                </tr>
                <tr>
                    <td>Địa Chỉ</td>
                    <td>:</td>
                    <td><?php echo $row_cus['address'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Cập Nhật Hồ Sơ</a></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
 		</div>
 	</div>
	 <?php
	include('inc/footer.php');
?>