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
    $id= Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['save'])){
		
		$update_cus= $customer->update_cus($_POST,$id);
	}
	
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Cập Nhật Hồ Sơ Cá Nhân</h3>
    		</div>
    		<div class="clear"></div>
           
    	</div>
           <form action="" method="post">

           
            <table class="tblone">
                <?php
                $id= Session::get('customer_id');
                    $result_cusinfor= $customer->showCustomer($id);
                    if($result_cusinfor){
                        while($row_cus=$result_cusinfor->fetch_assoc()){
                ?>
                <tr>
                <?php
                if(isset($update_cus)){
                    echo '<td colspan="3">'.$update_cus.'<td/>';
                }
            ?>
                </tr>
                <tr>
                    <td>Họ Và tên</td>
                    <td>:</td>
                    <td><input type="text" name="name" value="<?php echo $row_cus['name'] ?>"></td>
                </tr>
                <!-- <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><input type="text" name="city" value="<?php echo $row_cus['city'] ?>"></td>
                </tr> -->
                <tr>
                    <td>Điện Thoại</td>
                    <td>:</td>
                    <td><input type="text" name="phone" value="<?php echo $row_cus['phone'] ?>"></td>
                </tr>
                <tr>
                    <td>Mã Zip</td>
                    <td>:</td>
                    <td><input type="text" name="zipcode" value="<?php echo $row_cus['zipcode'] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="text" name="email" value="<?php echo $row_cus['email'] ?>"></td>
                </tr>
                <tr>
                    <td>Dịa Chỉ</td>
                    <td>:</td>
                    <td><input type="text" name="address" value="<?php echo $row_cus['address'] ?>"></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" name="save" value="Lưu Thông Tin"></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
            </form>
 		</div>
 	</div>
	 <?php
	include('inc/footer.php');
?>